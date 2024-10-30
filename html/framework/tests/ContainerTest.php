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

    public function test_has_method()
    {
        $container = new Container();
        $container->add('somecode',Somecode::class);
        $this->assertTrue($container->has('somecode'));
        $this->assertFalse(($container->has('no-class')));
        
    }

    public function test_recursively_autowired()
    {
        $container = new Container();
        $container->add('somecode',Somecode::class);
        /** $var Somecode $somecode */
        $somecode = $container->get('somecode');

        $this->assertInstanceOf(TestCode::class,$somecode->getTestCode());
        // $this->assertInstanceOf(Somecode::class,$container->get('somecode'));
    }
}
