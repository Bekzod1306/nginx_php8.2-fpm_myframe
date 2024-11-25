<?php

namespace Bek\Framework\Dbal;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Tools\DsnParser;

class ConnectionFactory
{
    public function __construct(private readonly string $databaseUrl) {}

    public function create(): Connection {
        $dsnParser = new DsnParser(['postgres' => 'pdo_pgsql']);
        $connectionParams = $dsnParser
            ->parse($this->databaseUrl);
        $connectionParams = [
            'dbname' => 'my_db',
            'user' => 'root',
            'password' => 'r00t',
            'host' => 'db',
            'driver' => 'pdo_pgsql',
            'port' => 5432
        ];
        return DriverManager::getConnection($connectionParams);
    }
}
