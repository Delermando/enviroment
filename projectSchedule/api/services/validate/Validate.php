<?php

namespace Cartao\services\validate;

class Validate {

    private $error = array();

    public function getError() {
        return $this->error;
    }

    public function getStatusValitadion() {
        return $this->checkStatusValidation();
    }

    public function arrayIsSet($data) {
        $setError = array();
        $arrayKeys = array_keys($data);
        $toTest = array('', ' ', null);
        for ($i = 0; sizeof($data) > $i; $i++) {
            if (in_array($data[$arrayKeys[$i]], $toTest)) {
                $setError[] = $arrayKeys[$i];
            }
        }
        $this->setMessageError('paramNotSet', $setError);
    }

    public function isEmail($arrayValues, $keyValueToTest) {
        $toTest = $this->setValueToTest($arrayValues, $keyValueToTest);
        if (!filter_var($toTest, FILTER_VALIDATE_EMAIL)) {
            $this->setMessageError('wrongEmailFormat', $keyValueToTest);
        }
    }

    public function isInt($arrayData, $intKey ) {
        $toTest = $this->setValueToTest($arrayData, $intKey);
        if (!preg_match('/^[1-9][0-9]*$/', $toTest)) {
            $this->setMessageError('isNotInt',$intKey);
        }
    }

    public function isDate($arrayData, $dateKey) {
        $toTest = $this->setValueToTest($arrayData, $dateKey);
        $regexTesteDate = "~^\d{2}-\d{2}-\d{4}$~";
        $testRegex = filter_var(
            $toTest,FILTER_VALIDATE_REGEXP,
            array("options"=>array("regexp"=> $regexTesteDate))
        );
        
        if($testRegex == false){
            $this->setMessageError('wrongDateFormat', $dateKey);
        }
    }
    
    public function updateReturn($updateReturn) {
        if ($updateReturn === 0) {
            $this->setMessageError('noDiferentDataToUpdate');
        } else {
            return array('numbOfLinesAffected' => $updateReturn);
        }
    }

    public function checkNumbOfRegisters($registers) {
        if (count($registers) < 1) {
            $this->setMessageError('noRegisters');
        }
    }

    public function checkJsonFormat($arrayDataJson, $arrayOfKeysToCheck) {
        if ($this->compareNumbOfParameters($arrayDataJson, $arrayOfKeysToCheck)) {
            $this->compareParametersName($arrayDataJson, $arrayOfKeysToCheck);
        }
    }

    private function compareNumbOfParameters($arrayDataJson, $arrayOfKeysToCheck) {
        $sizeKeysToCheck = sizeof($arrayOfKeysToCheck);
        if (sizeof($arrayDataJson) !== $sizeKeysToCheck) {
            $this->setMessageError('wrongNumbOfParams', array('expected' => $sizeKeysToCheck));
        } else {
            return true;
        }
    }
    
    private function compareParametersName($arrayParamIN, $arrayParamToCompare) {
        $arrayKeysIn = array_keys($arrayParamIN);
        $paramErrors = array();
        for ($i = 0; sizeof($arrayParamToCompare) > $i; $i++) {
            if (!in_array($arrayKeysIn[$i], $arrayParamToCompare)) {
                $paramErrors[] = $arrayKeysIn[$i];
            }
        }
        $this->setMessageError('wrongParamName', $paramErrors);
    }

    private function checkStatusValidation() {
        if (sizeof($this->error)) {
            return false;
        }
        return true;
    }

    private function setMessageError($messageKeyName = '', $errors = '') {
        if (count($errors)) {
            $this->error[] = array($messageKeyName => $errors);
        }
    }
    private function setValueToTest($array, $key){
        if(isset($array[$key])){
            return $array[$key];
        }  
        return '';
    }

}
