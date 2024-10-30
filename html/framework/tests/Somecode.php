<?php

namespace Bek\Framework\Tests;

class Somecode {

    public function __construct(private readonly TestCode $testCode) {
    }
    public function getTestCode(){
        return $this->testCode;
    }
}