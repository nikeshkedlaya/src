<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Validatecsvcontent
 *
 * @author KaHO
 */
class Validatecsvcontent {

    // put your code here
    private $validationFieldConfigurationRule;
    private $fieldLabel;
    private $csvData;
    private $errorMessageContainer;

    const ERROR_TYPE_FIELD_NOT_FOUND = "field_not_found";

    public function __construct($params) {
        $this->ciLibrary = Kahoutility::getCILibrary();
        $this->ciLibrary->config->load("validation_configuration/" . $params[0] . "_validation_configuration"); // loading the validation configuration library
        $this->csvData = $params[1];
        $this->validationFieldConfigurationRule = $this->ciLibrary->config->item($params[0]);
        $this->errorMessageContainer = [];
    }

    public function validateCSV() {
        try {
            if (Kahoutility::checkArrayParam($this->csvData)) {
                $this->fieldLabel = array_shift($this->csvData);
                if ($this->isCSVColumnValid() === 0) {
                    foreach ($this->csvData as $val) {
                        $this->validateCSVContentByRowField($val);
                    }
                } else {
                    array_push($this->errorMessageContainer, " either fields are mismatch");
                }
            }
        } catch (Exception $exc) {
            
        }
        return $this->errorMessageContainer;
    }

    private function isCSVColumnValid() {
        return count(array_diff($this->fieldLabel, array_keys($this->validationFieldConfigurationRule)));
    }

    private function validateCSVContentByRowField($csvRowVal) {
        try {
            foreach ($csvRowVal as $key => $fieldValue) {
                $field = $this->fieldLabel[$key];
                // if (in_array($field, $this->validationFieldConfigurationRule)) {
                $validationRuleByField = $this->validationFieldConfigurationRule[$field];
                $this->validateCSVFieldByRule($field, $fieldValue, $validationRuleByField);
            }
        } catch (Exception $exc) {
            
        }
    }

    private function validateCSVFieldByRule($fieldLabel, $rowVal, $validationRuleByField) {
        try {
            foreach ($validationRuleByField as $ruleArray) {
                if (call_user_func([
                            $this,
                            current($ruleArray)
                                ], $rowVal) === FALSE) {
                    $this->buildValidationErrorMessage($rowVal, $fieldLabel, end($ruleArray));
                }
            }
        } catch (Exception $exc) {
            
        }
    }

    private function buildFieldNotFoundInCSVErrorMessage($fieldName) {
        if (Kahoutility::isStringParamValid($fieldName)) {
            array_push($this->errorMessageContainer, $fieldName . " not found in csv");
        }
    }

    private function buildValidationErrorMessage($rowVal, $fieldLabel, $errorMessage) {
        $message = "input value '" . $rowVal . "' for " . sprintf($errorMessage, $fieldLabel);
        array_push($this->errorMessageContainer, $message);
    }

    private function isInputEmpty($inputVal) {
        return Kahoutility::isStringParamValid($inputVal);
    }

    private function isBitValid($bitVal) {
        $isBitValid = FALSE;
        if ($bitVal === 0 || $bitVal === 1) {
            $isBitValid = TRUE;
        }
        return $isBitValid;
    }

    private function isEmailValid($emailVal) {
        $isEmailValid = true;
        if (Kahoutility::isStringParamValid($emailVal)) {
            $isEmailValid = boolval(preg_match_all('^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$^', $emailVal));
        }
        return $isEmailValid;
    }

    private function isNameValid($nameVal) {
        $isNameValid = TRUE;
        if (Kahoutility::isStringParamValid($nameVal)) {
            $isNameValid = boolval(!preg_match('/[^a-zA-Z _]+/i', $nameVal));
        }
        return $isNameValid;
    }

    private function isPhoneNumberValid($phoneNumber) {
        $isPhoneNumberValid = true;
        if (Kahoutility::isStringParamValid($phoneNumber)) {
            $isPhoneNumberValid = ($this->isNumberValid($phoneNumber) && strlen($phoneNumber) === 10);
        }
        return $isPhoneNumberValid;
    }

    private function isNumberValid($numberVal) {
        $isNumberValid = TRUE;
        if (empty($numberVal) === FALSE) {
            $isNumberValid = (int) is_numeric($numberVal);
        }
        return $isNumberValid;
    }

    private function isAlphaNumericValid($alphaNumericVal) {
        $isAlphaNumericValid = TRUE;
        if (Kahoutility::isStringParamValid($alphaNumericVal)) {
            $isAlphaNumericValid = ctype_alnum($alphaNumericVal);
        }
        return $isAlphaNumericValid;
    }

    private function isDateValid($dateVal) {
        $isDateValid = TRUE;
        if (Kahoutility::isStringParamValid($dateVal)) {
            $dateValArray = explode("/", $dateVal);
            $isDateValid = checkdate($dateValArray[1], $dateValArray[0], $dateValArray[2]);
        }
        return $isDateValid;
    }

    private function isGenderValid($genderVal) {
        $isGenderValid = TRUE;
        if (Kahoutility::isStringParamValid($genderVal)) {
            $isGenderValid = in_array($genderVal, [
                'male',
                'female'
            ]);
        }
        return $isGenderValid;
    }

}
