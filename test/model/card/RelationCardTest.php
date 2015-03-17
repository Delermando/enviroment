<?php

class RelationCardTest extends PHPUnit_Framework_TestCase {
    
    protected $instancia;

    protected function setUp(){
        $this->instancia = New \Cartao\services\model\card\RelationCard();
    }
    
    /**
     * @group testMakeRelationCard()
     */
    public function testMakeRelationCard() {
        $this->assertInstanceOf('\Cartao\services\model\card\RelationCard', $this->instancia);
    }     
}
