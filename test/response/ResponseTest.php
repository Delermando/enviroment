<?php

class ResponseTest extends PHPUnit_Framework_TestCase {

    protected $instancia;

    protected function setUp() {
        $this->instancia = New \Cartao\services\response\Response();
    }

    /**
     * @group testMakeResponse
     */
    public function testMakeResponse() {
        $this->assertInstanceOf('\Cartao\services\response\Response', $this->instancia);
    }
    
    /**
     * @group testJson
     * @dataProvider dataForJson
     */
    public function testJson($expected, $data) {
        $this->instancia->data = $data['data'];
        $this->instancia->message = $data['message'];
         $this->assertJsonStringEqualsJsonString( json_encode($expected), $this->instancia->json());
    }
    public function dataForJson() {
        return array(
            array(array("response" => "success", 
                        "message"=>"no error",
                        "data"=> array('teste')),
                  array("data" => array('teste'), 
                        'message' => '')),
            
            array(array("response" => "failed", 
                        "message"=>"error",
                        "data"=> ''),
                  array("data" => '', 
                        'message' => 'error')),
        );
    }


}
