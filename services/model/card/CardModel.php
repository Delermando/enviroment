<?php

namespace Cartao\services\model\card;

class CardModel {

    private $FromEmail = 'FromEmail';
    private $ToEmail = 'ToEmail';
    private $Message = 'Message';
    private $RelationCard = 'RelationCard';

    public function save($arrayToSave) {
        return array('lastIdInserted'=>$this->saveInAllEntities($arrayToSave));
    }

    public function delete($IdSchedule) {
        $arrayItenDelete = array();
        for ($i = 0; sizeof($IdSchedule['idCard']) > $i; $i++) {
            $arrayListID = $this->instanceSelectIDsToDeleteRelationCard($IdSchedule['idCard'][$i]);
            if (isset($arrayListID[0])) {
                if (sizeof($arrayListID[0]) == 3) {
                    $arrayListID[0]['IDSchedule'] = $IdSchedule['idCard'][$i];
                    $arrayItenDelete[] = $this->deleteInAllEntities($arrayListID[0]);
                }
            }
        }
        return $this->checkDeletedInten($arrayItenDelete);
    }

    public function update($arrayDataForUpdate) {
        $idsToUpdate = $this->instanceSelectIDsToDeleteRelationCard($arrayDataForUpdate['idCard']);
        if (isset($idsToUpdate[0])) {
            if (sizeof($idsToUpdate[0]) == 3) {
                $return['fromEmail'] = $this->instanceUpdateFromEmail($arrayDataForUpdate['fromEmail'], $arrayDataForUpdate['fromName'], $idsToUpdate[0]['IDFromEmail']);
                $return['toEmail'] = $this->instanceUpdateToEmail($arrayDataForUpdate['toEmail'], $arrayDataForUpdate['toName'], $idsToUpdate[0]['IDToEmail']);
                $return['message'] = $this->instanceUpdateMessage($arrayDataForUpdate['message'], $idsToUpdate[0]['IDMessage']);
                $return['schedule'] = $this->instanceUpdateRelationCard($arrayDataForUpdate['date'], $arrayDataForUpdate['idCard']);
                return $this->checkUpdated($return);
            }
        }
    }

    public function select() {
        return $this->instanceSelectRelationCard();
    }

    public function selectUnicUser($idCard) {
        return $this->instanceSelectUnicRelationCard($idCard);
    }

    private function saveInAllEntities($arrayDataToInsert) {
        $idFromEmail = $this->instanceSaveFromEmail($arrayDataToInsert['fromName'], $arrayDataToInsert['fromEmail']);
        $idToEmail = $this->instanceSaveToEmail($arrayDataToInsert['toName'], $arrayDataToInsert['toEmail']);
        $idMessage = $this->instanceSaveMessage($arrayDataToInsert['message']);
        return $this->instanceSaveRelationCard($idFromEmail, $idToEmail, $idMessage, $arrayDataToInsert['date']);
    }

    private function deleteInAllEntities($arrayDelete) {
        $return = $this->instanceDeleteRelationCard($arrayDelete['IDSchedule']);
        $this->deleteFromEmailIfIsUnic($arrayDelete['IDFromEmail']);
        $this->deleteToEmailIfIsUnic($arrayDelete['IDToEmail']);
        $this->instanceDeleteMessage($arrayDelete['IDMessage']);
        return $return;
    }

    private function instanceSaveFromEmail($name, $email) {
        return $this->chooseInstance($this->FromEmail)->save($name, $email);
    }

    private function instanceDeleteFromEmail($id) {
        return $this->chooseInstance($this->FromEmail)->delete($id);
    }

    private function instanceUpdateFromEmail($email, $name, $id) {
        return $this->chooseInstance($this->FromEmail)->update($email, $name, $id);
    }

    private function instanceSaveToEmail($name, $email) {
        return $this->chooseInstance($this->ToEmail)->save($name, $email);
    }

    private function instanceDeleteToEmail($id) {
        return $this->chooseInstance($this->ToEmail)->delete($id);
    }

    private function instanceUpdateToEmail($email, $name, $id) {
        return $this->chooseInstance($this->ToEmail)->update($email, $name, $id);
    }

    private function instanceSaveMessage($messageToInsert) {
        return $this->chooseInstance($this->Message)->save($messageToInsert);
    }

    private function instanceDeleteMessage($id) {
        return $this->chooseInstance($this->Message)->delete($id);
    }

    private function instanceUpdateMessage($message, $id) {
        return $this->chooseInstance($this->Message)->update($message, $id);
    }

    private function instanceSaveRelationCard($idFromEmail, $idToEmail, $idMessage, $dataEnvio) {
        return $this->chooseInstance($this->RelationCard)->save($idFromEmail, $idToEmail, $idMessage, $dataEnvio);
    }

    private function instanceUpdateRelationCard($date, $id) {
        return $this->chooseInstance($this->RelationCard)->update($date, $id);
    }

    private function instanceDeleteRelationCard($id) {
        return $this->chooseInstance($this->RelationCard)->delete($id);
    }

    private function instanceSelecCountIDIsnFromEmail($id) {
        return $this->chooseInstance($this->RelationCard)->selecCountIDsInFromEmail($id);
    }

    private function instanceSelecCountIDIsnToEmail($id) {
        return $this->chooseInstance($this->RelationCard)->selecCountIDsInToEmail($id);
    }

    private function instanceSelectRelationCard() {
        return $this->chooseInstance($this->RelationCard)->selectAllRegisters();
    }

    private function instanceSelectUnicRelationCard($idCard) {
        return $this->chooseInstance($this->RelationCard)->selectUnicCard($idCard);
    }

    private function instanceSelectIDsToDeleteRelationCard($id) {
        return $this->chooseInstance($this->RelationCard)->selectIDsToDelete($id);
    }

    private function deleteFromEmailIfIsUnic($id) {
        $fromEmail = $this->instanceSelecCountIDIsnFromEmail($id);
        if ($fromEmail[0]['repeated'] == 0) {
            $this->instanceDeleteFromEmail($id);
        }
    }

    private function deleteToEmailIfIsUnic($id) {
        $toEmail = $this->instanceSelecCountIDIsnToEmail($id);
        if ($toEmail[0]['repeated'] == 0) {
            $this->instanceDeleteToEmail($id);
        }
    }

    private function chooseInstance($className) {
        $mountClass = "\Cartao\\services\\model\\card\\" . $className;
        return new $mountClass();
    }

    private function checkDeletedInten($arrayItenDelete) {
        $numbOfDeletedItems = count($arrayItenDelete);
        if ($numbOfDeletedItems > 0) {
            return array('numbOfDeletedItems' => $numbOfDeletedItems);
        } else {
            return '';
        }
    }

    private function checkUpdated($arrayReturnUpdate) {
        $values = array_values($arrayReturnUpdate);
        if (in_array(1, $values)) {
            return $arrayReturnUpdate;
        } else {
            return false;
        }
    }

}
