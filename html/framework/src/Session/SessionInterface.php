<?php

namespace Bek\Framework\Session;

interface SessionInterface {
    public function set(string $key,$value):void;
    public function get(string $key,$default=null);
    public function has(string $key):bool;
    public function remove(string $key):void;
    public function getFlash(string $key):array;
    public function setFlash(string $key,string $message):void;
    public function hasFlash(string $key):bool;
    public function clearFlash(string $key):void;
}