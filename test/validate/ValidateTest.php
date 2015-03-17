<?php

class ValidateTest extends PHPUnit_Framework_TestCase {
    
    protected $instancia;
        
    protected function setUp(){
        $this->instancia = New \Cartao\services\validate\Validate();
    }
   
    /**
     * @group testMakeValidate
     */
    public function testMakeValidate() {
        $this->assertInstanceOf('\Cartao\services\validate\Validate', $this->instancia);
    }

    
    /**
     * @group testArrayIsSet
     * @dataProvider dataForTestArrayIsSet
     */
    public function testArrayIsSet($expected, $data) {
        $this->instancia->arrayIsSet($data);
        $this->assertEquals($expected,$this->instancia->getStatusValitadion());
    }
    public function dataForTestArrayIsSet() {
        return array(
            array(false, array('teste1' => ' ')),
            array(false, array('teste1' => '')),
            array(false, array('teste1' => 0)),
            array(false, array('teste1' => false)),
            array(true, array('teste1' => 'de')),
        );
    }
    
     /**
     * @group testIfIsEmail
     * @dataProvider dataForIfIsEmail
     */
    public function testIfIsEmail($expected, $data) {
        $this->instancia->isEmail($data, 'teste');
        $this->assertEquals($expected, $this->instancia->getStatusValitadion());
    }
    public function dataForIfIsEmail() {
         return array(
            array(true, array('teste'=>'delsan@toshotmail.com.br')), 
            array(true, array('teste'=>'123delsantos@hotmail.com.br')), 
            array(false, array('teste'=>'delsantos@hotmail')), 
            array(false, array('teste'=>'delsantos@hotmail.123')), 
            array(false, array('teste'=>'@#$%¨delsantos@hotmail.com.br')), 
            array(false, array('teste'=>'123delsantos@hotmail_com')), 
        );
    }
    
     /**
     * @group testIfIsInt
     * @dataProvider dataForIfIsInt
     */
    public function testIfIsInt($expected, $data) {
        $this->instancia->isInt($data, 'teste');
        $this->assertEquals($expected, $this->instancia->getStatusValitadion());
    }
    public function dataForIfIsInt() {
         return array(
            array(true, array('teste'=>true)), 
            array(true, array('teste'=>1)), 
            array(true, array('teste'=>235)), 
            array(true, array('teste'=>1.000)), 
            array(false, array('teste'=>false)), 
            array(false, array('teste'=>0)), 
            array(false, array('teste'=>null)), 
            array(false, array('teste'=>-3)), 
            array(false, array('teste'=>1.200)), 
            array(false, array('teste'=>0.1)), 
            array(false, array('teste'=>'')), 
            array(false, array('teste'=>' ')), 
            array(false, array('teste'=>'teste')), 
        );
    }
    
    
    /**
     * @group testIfIsDate
     * @dataProvider dataForIfIsDate
     */
    public function testIfIsDate($expected, $data) {
        $this->instancia->isDate($data, 'teste');
        $this->assertEquals($expected, $this->instancia->getStatusValitadion());
    }
    public function dataForIfIsDate() {
         return array(
            array(true, array('teste'=>'24-01-1992')), 
            array(false, array('teste'=>'s24-01-1992')), 
            array(false, array('teste'=>'24-0s1-1992')), 
            array(false, array('teste'=>'24-0s1-1992s')), 
            array(false, array('teste'=>'424-01-1992s')), 
            array(false, array('teste'=> '24-101-1992s')), 
            array(false, array('teste'=>'24-01-11992')), 
            array(false, array('teste'=>'24-01-11992')), 
            array(false, array('teste'=>'')), 
            array(false, array('teste'=>' ')), 
            array(false, array('teste'=>' asdasd ')), 
            array(false, array('teste'=>12)), 
        );
    }
    
     /**
     * @group testJsonFormat
     * @dataProvider dataForJsonFormat
     */
    public function testJsonFormat($expected, $data) {
        $this->instancia->checkJsonFormat($data, array('key1', 'key2'));
        $this->assertEquals($expected, $this->instancia->getStatusValitadion());
    }
    public function dataForJsonFormat() {
         return array(
            array(true, array('key1'=>'', 'key2'=>'')), 
            array(false, array('key1', 'key2')), 
            array(false, array('key'=>'', 'key2'=>'')), 
        );
    }
    
    /**
     * @group testNumbOfRegisters
     * @dataProvider dataForNumbOfRegisters
     */
    public function testNumbOfRegisters($expected, $data) {
        $this->instancia->checkNumbOfRegisters($data);
        $this->assertEquals($expected, $this->instancia->getStatusValitadion());
    }
    public function dataForNumbOfRegisters() {
         return array(
            array(true, array('key1'=>'', 'key2'=>'')), 
            array(true, array('key1'=>'')), 
            array(true, array('')), 
            array(true, array(1)), 
            array(false, array()), 
        );
    }

    /**
     * @group testUpdateReturn
     * @dataProvider dataForUpdateReturn
     */
    public function testUpdateReturn($expected, $data) {
        $this->instancia->updateReturn($data);
        $this->assertEquals($expected, $this->instancia->getStatusValitadion());
    }
    public function dataForUpdateReturn() {
         return array(
            array(false,0), 
            array(true,1), 
            array(true,2), 
        );
    }
}