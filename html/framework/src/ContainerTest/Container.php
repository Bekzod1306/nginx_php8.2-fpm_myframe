<?php

namespace Bek\Framework\Container;

use Bek\Framework\Container\Exceptions\ContainerException;
use Bek\Framework\Tests\Somecode;
use Psr\Container\ContainerInterface;
use ReflectionClass;

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
        if(!$this->has($id)){
            if(!class_exists($id)){
                throw new ContainerException("Service $id could not be resolved!!!");
            }
            $this->add($id);
        }
        $instance = $this->resolve($this->services[$id]);
        return $instance;
    }

    private function resolve($class)
    {
        $reflactionClass = new ReflectionClass($class);
        $constructor = $reflactionClass->getConstructor();
        if(is_null($constructor)){
            return $reflactionClass->newInstance();
        }
        $constructorParams = $constructor->getParameters();

        $classDependencies = $this->resolveClassDependencies($constructorParams);

        $instance = $reflactionClass->newInstanceArgs($classDependencies);
        // dd($instance);
        return $instance;
    }

    private function resolveClassDependencies(array $constructorParams)
    {
        $classDependencies = [];

        foreach($constructorParams as $constructorParam){
            $serviceType = $constructorParam->gettype();
            $service = $this->get($serviceType->getName());
            $classDependencies[] = $service;
        }
        return $classDependencies;
    }

    public function has(string $id):bool
    {
        return  array_key_exists($id,$this->services);
    }
}