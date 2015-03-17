<?php

class MessageTest extends PHPUnit_Framework_TestCase {
    
    protected $instancia;

    protected function setUp(){
        $this->instancia = New \Cartao\services\model\card\Message();
    }
    
    /**
     * @group testMakeMessage()
     */
    public function testMakeMessage() {
        $this->assertInstanceOf('\Cartao\services\model\card\Message', $this->instancia);
    }     
}
