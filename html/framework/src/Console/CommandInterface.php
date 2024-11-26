<?php

namespace Bek\Framework\Console;

interface CommandInterface{
    public function execute(array $parameters = []):int;
}