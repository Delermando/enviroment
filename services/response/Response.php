<?php

namespace Cartao\services\response;

class Response {

    private $return = array('response' => '', 'message' => '', 'data' => '');
    public $message = array();
    public $data;
    public $status = true;

    public function json() {
        $this->return['data'] = $this->data();
        $this->return['response'] = $this->response();
        $this->return['message'] = $this->message();
        return json_encode($this->return);
    }

    private function response() {
        if ($this->status) {
            return 'success';
        }
        return 'failed';
    }

    private function message() {
        $toCompare = array(null, "", " ");
        if (!in_array($this->message, $toCompare)) {
            return $this->message;
        }
        return 'no error';
    }

    private function data() {
        $toCompare = array(null, "", " ", false, 0);
        if (!in_array($this->data, $toCompare)) {
            return $this->data;
        } else {
            $this->setResponseCaseNoData();
        }
        return ($this->data);
    }

    private function setResponseCaseNoData() {
        $this->status = false;
        $this->data = null;
        if (!count($this->message)) {
            $this->message[] = 'noRegisters';
        }
    }

}
