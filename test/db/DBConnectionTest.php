<?php

class DBConnectionTest extends PHPUnit_Framework_TestCase {

    protected $instancia;

    protected function setUp() {
        $this->instancia = New \Cartao\services\db\DBConnection();
    }

    /**
     * @group testMakeDBConnection
     */
    public function testMakeDBConnection() {
        $this->assertInstanceOf('\Cartao\services\db\DBConnection', $this->instancia);
    }


}
