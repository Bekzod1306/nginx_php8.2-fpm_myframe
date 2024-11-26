<?php

namespace Bek\Framework\Console;

use DirectoryIterator;

class Kernel {
    public function handle(){
        $this->registerCommands();
        dd('test');
        return 0;
    }
    private function registerCommands():void
    {
        $commandFiles = new DirectoryIterator(__DIR__.'/Commands');
        foreach($commandFiles as $commandFile){
            if(!$commandFiles->isFile()){
                continue;
            }
        }
    }
}