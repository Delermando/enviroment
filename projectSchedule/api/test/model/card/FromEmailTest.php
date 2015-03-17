<?php
class FromEmailTest extends PHPUnit_Framework_TestCase {
   
    protected $instancia;
    
    protected function setUp(){
        $this->instancia = New \Cartao\services\model\card\FromEmail();
    }
    
    public function testMakeFromEmail() {
        $this->assertInstanceOf('\Cartao\services\model\card\FromEmail', $this->instancia);
    }

    
}
