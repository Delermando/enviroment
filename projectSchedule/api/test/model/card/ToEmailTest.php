<?php

class ToEmailTest extends PHPUnit_Framework_TestCase {
    
    protected $instancia;

    protected function setUp(){
        $this->instancia = New \Cartao\services\model\card\ToEmail();
    }
    
    /**
     * @group testMakeToEmail()
     */
    public function testMakeToEmail() {
        $this->assertInstanceOf('\Cartao\services\model\card\ToEmail', $this->instancia);
    }     
}
