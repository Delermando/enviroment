<?php namespace Cartao\services\controllers;
    
class CardController {
    private $card;
    private $validate;
    private $response;

    public function __construct() {
        $this->card = new \Cartao\services\model\card\CardModel();
        $this->validate = new \Cartao\services\validate\Validate();
        $this->response = new \Cartao\services\response\Response();
    }
    
    public function save($toSave){
        $this->validate->arrayIsSet($toSave);
        $this->validate->checkJsonFormat($toSave, array('fromEmail', 'fromName', 'toEmail', 'toName', 'message','date'));
        $this->validate->isEmail($toSave,'fromEmail');
        $this->validate->isEmail($toSave,'toEmail');
        $this->validate->isDate($toSave, 'date');
        $this->response->message = $this->validate->getError();
        $this->response->status = $this->validate->getStatusValitadion();
        $this->response->data = $this->saveIfNoErros($toSave);
        return $this->response->json();             
    }
    
    public function select(){
        $this->response->data = $this->card->select();
        return $this->response->json();
    }
    public function selectUnicCard($idCard){
        $this->response->data = $this->card->selectUnicUser($idCard);
        return $this->response->json();
    }
    
    public function delete($idToDelete){
        $this->validate->checkJsonFormat($idToDelete, array('idCard'));
        $this->response->message = $this->validate->getError();
        $this->response->status = $this->validate->getStatusValitadion();
        $this->response->data = $this->deleteIfNoErros($idToDelete);
        return $this->response->json();
    }
    
    public function update($arrayToUpdate){
        $this->validate->arrayIsSet($arrayToUpdate);
        $this->validate->checkJsonFormat($arrayToUpdate, array('idCard','fromEmail', 'fromName', 'toEmail', 'toName', 'message','date'));
        $this->validate->isEmail($arrayToUpdate,'fromEmail');
        $this->validate->isEmail($arrayToUpdate,'toEmail');
        $this->validate->isDate($arrayToUpdate, 'date');
        $this->response->data  = $this->card->update($arrayToUpdate);
        $this->response->message = $this->validate->getError();
        return $this->response->json();
    }
    
    private function deleteIfNoErros($idToDelete){
        if($this->validate->getStatusValitadion()){
            return $this->response->data = $this->card->delete($idToDelete);
        }
    }
    
    private function saveIfNoErros($arrayToSave){
        if($this->validate->getStatusValitadion()){
            return $this->response->data = $this->card->save($arrayToSave);
        }
    }
    private function deleteIfIdIsInt($idToDelete){
        if($this->validate->getStatusValitadion()){
            return $this->response->data = $this->card->delete($idToDelete);
        }
    }

}
