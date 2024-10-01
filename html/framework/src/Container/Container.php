<?php

namespace Bek\Framework\Container;

use Bek\Framework\Container\Exceptions\ContainerException;
use Bek\Framework\Tests\Somecode;
use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    private array $services = [];

    public function add(string $id, string|object $concrete = null){
        if(is_null($concrete )){
            if(!class_exists($id)){
                throw new ContainerException("Service $id not found!!!");
            }
            $concrete = $id;
        }
        $this->services[$id] = $concrete; 
    }

    public function test_container_has_exception_ContainerExceptiopn_if_wrong_service()
    {
        $container = new Container();
        $container->expectException(ContainerException::class);
        $container->add('no-class',Somecode::class);
    }

    public function get(string $id){
        return new $this->services[$id];
    }

    public function has(string $id):bool
    {

    }
}