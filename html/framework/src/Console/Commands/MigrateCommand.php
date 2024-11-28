<?php

namespace Bek\Framework\Console\Commands;

use Bek\Framework\Console\CommandInterface;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use PhpParser\Node\Expr\Cast\String_;
use Throwable;

class MigrateCommand implements CommandInterface
{
    private string $name = 'migrate';
    private const MIGRATIONS_TABLE = 'migrations';
    public function __construct(private Connection $connection, private $migrationPath) {}
    public function execute(array $parameters = []): int
    {
        try {
            $this->createMigrationsTable();

            $this->connection->beginTransaction();

            $appliedMigrations = $this->getAppliedMigrations();

            $migrationFiles = $this->getMigrationFiles();

            $migrationsToAppay = array_values(array_diff($migrationFiles, $appliedMigrations));

            $schema = new Schema();

            foreach ($migrationsToAppay as $migration) {
                $migrationInstance = require $this->migrationPath . "/$migration";
                $migrationInstance->up($schema);
                $this->addMigration($migration);
            }

            $sqlArray = $schema->toSql($this->connection->getDatabasePlatform());
            foreach ($sqlArray as $sql) {
                $this->connection->executeQuery($sql);
            }

            $this->connection->commit();
        } catch (Throwable $e) {
            $this->connection->rollBack();
            throw $e;
        }
        return 0;
    }
    private function createMigrationsTable(): void
    {
        $schemaManager = $this->connection->createSchemaManager();

        if (!$schemaManager->tableExists(self::MIGRATIONS_TABLE)) {
            $schema = new Schema();
            $table = $schema->createTable(self::MIGRATIONS_TABLE);
            $table->addColumn('id', Types::INTEGER, [
                'unsigned' => true,
                'autoincrement' => true
            ]);
            $table->addColumn('migration', Types::STRING);
            $table->addColumn('created_at', Types::DATETIME_IMMUTABLE, [
                'default' => 'CURRENT_TIMESTAMP'
            ]);
            $table->setPrimaryKey(['id']);
            $sqlArray = $schema->toSql($this->connection->getDatabasePlatform());
            $this->connection->executeQuery($sqlArray[0]);
            echo "Migrations table created" . PHP_EOL;
        }
    }
    private function getAppliedMigrations()
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        return $queryBuilder->select('migration')
            ->from(self::MIGRATIONS_TABLE)
            ->executeQuery()
            ->fetchFirstColumn();
    }
    private function getMigrationFiles(): array
    {
        $migrationFiles = scandir($this->migrationPath);
        return array_splice($migrationFiles, 2);
    }
    private function addMigration(string $migraion): void
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->insert(self::MIGRATIONS_TABLE)
            ->values(['migration' => ':migration'])
            ->setParameter('migration', $migraion)
            ->executeQuery();
    }
}
