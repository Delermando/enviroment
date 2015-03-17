<?php namespace Cartao\services\model\card;

class FromEmail{
    private $DB;
     
    public function __construct() {
       $this->DB = new \Cartao\services\db\DBConnection();
    }
    
    public function save($name, $email){
        $return = $this->testIfExist($email);
        if($return === true){
           return  $this->insert($name, $email);
        }
        return $return;
    }
    
    public function delete($id) {
        $delete = "DELETE FROM psnFromEmail WHERE agnID= :id";
        $stm = $this->DB->prepare($delete);
        $stm->bindParam(":id", $id, \PDO::PARAM_INT);
        return $this->DB->runDelete($stm);       
    }
    
    public function update($email, $name, $id){
        $sql = "UPDATE psnFromEmail SET agnEmail = :email, agnName = :name WHERE agnID = :id";
        $stm = $this->DB->prepare($sql);
        $stm->bindParam(":email", $email, \PDO::PARAM_STR);
        $stm->bindParam(":name", $name, \PDO::PARAM_STR);
        $stm->bindParam(":id", $id, \PDO::PARAM_INT);
        return $this->DB->runUpdate($stm);
    }
    
    private function insert($name, $email) {
        $sql = "INSERT INTO psnFromEmail(agnEmail,agnName)"
                    ." VALUES (:email, :name)";
        $stm = $this->DB->prepare($sql);
        $stm->bindParam(":name", $name, \PDO::PARAM_STR);
        $stm->bindParam(":email", $email, \PDO::PARAM_STR);
        return $this->DB->runInsert($stm);  
    }
    
    private function testDelete($rowDelete) {
        if($rowDelete == 1){
            return true;
        }
        return false;
    }
    
    private function selectByEmail($email) {
        $sql = "SELECT agnID FROM psnFromEmail WHERE agnEmail = :email";
        $stm = $this->DB->prepare($sql);
        $stm->bindValue(":email", $email, \PDO::PARAM_STR);
        return  $this->DB->runSelect($stm);
    }  
    private function lastInsert() {
        $sql = "SELECT agnID FROM psnFromEmail WHERE agnEmail = :email";
        $stm = $this->DB->prepare($sql);
        $stm->bindValue(":email", $email, \PDO::PARAM_STR);
        return  $this->DB->runSelect($stm);
    }

    private  function testIfExist($email) {
        $emailExist = $this->selectByEmail($email);
        if(sizeof($emailExist) == 0){
            return true;
        }
        return intval($emailExist[0]['agnID']);
    }
    
}
