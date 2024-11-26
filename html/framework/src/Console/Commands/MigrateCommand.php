<?php

namespace Bek\Framework\Console\Commands;

use Bek\Framework\Console\CommandInterface;

class MigrateCommand implements CommandInterface{
    private string $name = 'migrate';
    public function execute(array $parameters = []):int
    {
        //handle
        return 0;
    }
}