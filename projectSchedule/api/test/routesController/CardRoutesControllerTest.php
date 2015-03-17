<?php

class CardRoutesControllerTest extends PHPUnit_Framework_TestCase {

    protected $instancia;

    protected function setUp() {
        $this->instancia = New \Cartao\services\routesController\CardRoutesController();
    }

    /**
     * @group testMakeCardRoutesController
     */
    public function testMakeCardRoutesController() {
        $this->assertInstanceOf('\Cartao\services\routesController\CardRoutesController', $this->instancia);
    }


}
