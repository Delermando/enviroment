<?php namespace Cartao\services\routesController;

use Symfony\Component\HttpFoundation\Request as Request;
use Cartao\services\controllers\CardController as CardController;

class CardRoutesController{
    private $cardController;
    private $app;
    private $payload;
    
    public function __construct() {
        $this->cardController = new CardController();
    }

    public function home() {
        return 'API Agenda';
    }
    public function cardList() {
      return $this->cardController->select();
    }
    
    public function getUnicCard($idCard){
         return $this->cardController->selectUnicCard($idCard);
    }

    public function cardSave() {
        $this->constructPayload();
        return $this->cardController->save($this->payload);
    }
    
    public function cardUpdate() {
      $this->constructPayload();
      return $this->cardController->update($this->payload);
    }
    public function cardDelete() {
      $this->constructPayload();
      return $this->cardController->delete($this->payload);
    }
    
    private function constructPayload(){
        $request = new Request();
        $this->payload = json_decode($request->getContent(), true);//true json_decode
    }
}
