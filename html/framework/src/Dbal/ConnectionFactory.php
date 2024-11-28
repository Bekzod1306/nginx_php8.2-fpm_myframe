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
        $connection = DriverManager::getConnection($connectionParams);
        return  $connection;
    }
}
