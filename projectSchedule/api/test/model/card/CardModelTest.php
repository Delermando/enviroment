<?php
class CardModelTest extends PHPUnit_Framework_TestCase {
    
    protected $instancia;

    protected function setUp(){
        $this->instancia = New \Cartao\services\model\card\CardModel();
    }
      
    public function testMakeCardModelComParametro() {
        $this->assertInstanceOf('\Cartao\services\model\card\CardModel', $this->instancia);
    }
}
