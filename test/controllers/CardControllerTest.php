<?php

class CardControllerTest extends PHPUnit_Framework_TestCase {

    protected $instancia;

    protected function setUp() {
        $this->instancia = New \Cartao\services\controllers\CardController();
    }

    /**
     * @group testMakeCardControl
     */
    public function testMakeCardControl() {
        $this->assertInstanceOf('\Cartao\services\controllers\CardController', $this->instancia);
    }


}
