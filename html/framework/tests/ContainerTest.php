<?php

namespace Bek\Framework\Tests;

use Bek\Framework\Container\Container;
use PHPUnit\Framework\TestCase;

class ContainerTest extends TestCase
{
    public function test_getting_service_from_container()
    {
        $container = new Container();
        $container->add('somecode',Somecode::class);
        $this->assertInstanceOf(Somecode::class,$container->get('somecode'));
    }
}
