<?php

namespace Bek\Framework\Tests;

use Bek\Framework\Session\Session;
use PHPUnit\Framework\TestCase;

class SessionTest extends TestCase{

    public function setUp():void{
        unset($_SESSION); 
    }

    public function test_set_and_get_flash(){
        $session = new Session();
        $session->setFlash('success','Успешно!');
        $session->setFlash('error','Ошибка!');
        $this->assertTrue($session->hasFlash('success'));
        $this->assertTrue($session->hasFlash('error'));
        $this->assertEquals(['Успешно!'],$session->getFlash('success'));
        $this->assertEquals(['Ошибка!'],$session->getFlash('error'));
        $this->assertEquals([],$session->getFlash('warning'));
    }
}