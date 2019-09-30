<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 *
 * ****** KaHOCrudService
 *
 */

/**
 * Description of kahocrudservice
 *
 * @author KaHO
 */
final class Kahocrudservices {

    private $ciLibrary;
//    private $isBroadcastEnabled;
    public $dbResponse;
    private $responseCode;
    // will hold the response code
    private $responseMessage;
    // will hold the response message, wont' be null if server explicitly want to override client's message
    private $isDBOperationSuccess;

    // will hold the boolean value either true or false after processing the response after
    // private $responseMessageKey; // will hold the response message key

    /* rest response code const */
    const RESPONSE_FOUND = "response_found";
    const RESPONSE_NOT_FOUND = "response_not_found";
    const CUDU_CHANGED = "cudu_changed";
    const CUDU_NOT_CHANGED = "cudu_not_changed";
    const DB_OPERATION_FAILED = "db_operation_failed";
    const DB_OPERATION_FAILED_MESSAGE = "there is an internal error";
    const RESPONSE_MSG_KEY = "response_msg_key";
    const RESPONSE_MSG = "response_msg";
    const RESPONSE_CODE = "response_code";

    /* db response const */
    const DB_RESPONSE_KEY_IS_SUCCESS = "IS_SUCCESS";
    const DB_RESPONSE_KEY_TRANSACTION_ID = "TRANSACTION_ID";
    const DB_RESPONSE_KEY_PRIMARY_COLUMN = "PRIMARY_COLUMN";
    const DB_RESPONSE_KEY_DB_RESPONSE_CODE = "DB_RESPONSE_CODE";
    const DB_RESPONSE_KEY_DB_RESPONSE_MESSAGE = "DB_RESPONSE_MESSAGE";

    // PTransStatus as IS_SUCCESS, -- 1 or -1
    // PTransaction_ID as TRANSACTION_ID, -- Last_insert_id or actual primary key id
    // PPrimary_Column as PRIMARY_COLUMN, -- column name of primary key
    // PError_Code as DB_RESPONSE_CODE, -- error code (Ex: ERROR001)
    // PError_Message as DB_RESPONSE_MESSAGE -- actual error (Ex: Email already exists)
    public function __construct() {
        $this->ciLibrary = Kahoutility::getCILibrary();
        $this->ciLibrary->load->library("kahobroadcastservice", NULL, "kahobroadcastservice");
    }

    // <editor-fold defaultstate="collapsed" desc="reloadDatabase">
    /**
     * is reloading the db again to change the db when setting or unsetting the db from session
     */
    public function reloadDatabase() {
        $this->ciLibrary->dbService->loadDatabase();
    }
    
    public function loadDatabaseByKey($dbKey) {
        $this->ciLibrary->dbService->loadDatabaseByKey($dbKey);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="preAddRecord">
    /**
     * will invoke if any callback param
     * 
     * @param type $preAddCallback
     */
    private function preAddRecord($preAddCallback) {
//        $this->registerBroadcastListener(Kahoutility::getCallieFunctionName(), $preAddCallback);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="addRecord">
    /**
     * will do the add record functionality
     * 
     * @param string $spName
     * @param array $spParam
     * @param callback $registerListener
     */
    public function addRecord(string $spName, array $spParam, callable $registerListener = null) {
        $this->preAddRecord($registerListener);
        $this->dbResponse = $this->callDBServiceMethod("addRecord", array(
            $spName,
            $spParam
        ));
        $this->postAddRecord();
        return $this;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="postAddRecord">
    /**
     * will invoked after adding
     */
    private function postAddRecord() {
        $this->processDBResponse($this->dbResponse);
        $this->sendBroadcastMessage();
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="preUpdateRecord">
    /**
     * will invoke if any callback param
     * 
     * @param type $preUpdateCallback
     */
    private function preUpdateRecord($preUpdateCallback) {
//        $this->registerBroadcastListener(Kahoutility::getCallieFunctionName(), $preUpdateCallback);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="updateRecord">
    /**
     * will do the update record
     * 
     * @param string $spName
     * @param array $spParam
     * @param callable $registerListener
     * @return $this
     */
    public function updateRecord(string $spName, array $spParam, callable $registerListener = null) {
        $this->preUpdateRecord($registerListener);
        $this->dbResponse = $this->callDBServiceMethod("updateRecord", array(
            $spName,
            $spParam
        ));
        $this->postUpdateRecord();
        return $this;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="postUpdateRecord">
    /**
     * will invoked after updating
     */
    private function postUpdateRecord() {
        $this->processDBResponse($this->dbResponse);
        $this->sendBroadcastMessage();
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="preDeleteRecord">
    /**
     *
     * @param type $preDeleteCallback
     */
    public function preDeleteRecord($preDeleteCallback) {
//        $this->registerBroadcastListener(Kahoutility::getCallieFunctionName(), $preDeleteCallback);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="deleteRecord">
    /**
     * will delete the record
     * 
     * @param type $ctrlObj
     * @param type $outputPar
     * @param type $eventSuccessMessage
     * @param type $eventErrorMessage
     */
    public function deleteRecord(string $spName, array $spParam, callable $registerListener = null) {
        $this->preDeleteRecord($registerListener);
        $this->dbResponse = $this->callDBServiceMethod("deleteRecord", array(
            $spName,
            $spParam
        ));
        $this->postDeleteRecord();
        return $this;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="postDeleteRecord">
    /**
     * will invoke deleting
     */
    private function postDeleteRecord() {
        $this->processDBResponse($this->dbResponse);
        $this->sendBroadcastMessage();
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="preGetRecord">
    /**
     *
     * @param callable $registerListener
     */
    private function preGetRecord(callable $registerListener = null) {
//        $this->registerBroadcastListener(Kahoutility::getCallieFunctionName(), $registerListener);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getRecord">
    /**
     * will get the record from db
     * 
     * @param string $spName
     * @param array $spParam
     * @param callable $registerListener
     * @return $this
     */
    public function getRecord(string $spName, array $spParam = null, callable $registerListener = null) {
        $this->preGetRecord($registerListener);
        $this->dbResponse = $this->callDBServiceMethod("getRecord", array(
            $spName,
            $spParam
        ));
        $this->postGetRecord();
        return $this;
    }

    // </editor-fold>
    public function executeInlineQuery($inlineQuery) {
        $this->ciLibrary->dbService->executedLocalDataInlineQuery($inlineQuery);
    }

    private function postGetRecord() {
        $this->processDBResponse($this->dbResponse, FALSE);
        $this->sendBroadcastMessage();
    }

    // <editor-fold defaultstate="collapsed" desc="callDBServiceMethod">
    /**
     * will simply call the crud db service method by name,provided by callie,so this would be gateway to connect to dbservice method for any crud operation
     * 
     * @param string $dbServiceMethodName
     * @param array $dbServiceMethodParams
     * @return array|null
     * @throws LogicErrorException
     */
    private function callDBServiceMethod(string $dbServiceMethodName, $dbServiceMethodParams = []) {
        $dbServiceMethodResp = NULL;
        if (Kahoutility::getRequestedHeaderValueByKey(Kahoutility::getCallieFunctionName(4)) === "true") {
            $vals = [];
            array_walk($dbServiceMethodParams[1], function ($val, $key) use (&$vals) {
                $vals[$key] = [
                    $val => gettype($val)
                ];
            });
            echo json_encode($vals);
            exit();
        }
        try {
            if (isStringParamValid($dbServiceMethodName)) {
                $callableMethod = array(
                    $this->ciLibrary->dbService,
                    $dbServiceMethodName
                );
                $dbServiceMethodResp = call_user_func_array($callableMethod, $dbServiceMethodParams);
            } else {
                throw new LogicErrorException("dbServiceMethodName is null");
            }
        } catch (LogicErrorException $logicErrExcep) {
            $this->ciLibrary->writelog->writeErrorLog($logicErrExcep->GetCustomErrMessage());
        } finally {
            return $dbServiceMethodResp;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getCRUDSuccessResponseCode">
    /**
     * create,update,delete,upload : will return the success message
     * 
     * @param bool $isCUDU
     *            will return the success message based on either response found or data changed
     * @return string response code
     */
    protected function getCRUDSuccessResponseCode(bool $isCUDU = true) {
        $crudSuccessResponseCode = self::RESPONSE_FOUND;
        if ($isCUDU) {
            $crudSuccessResponseCode = self::CUDU_CHANGED;
        }
        return $crudSuccessResponseCode;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getCRUDFailureResponseCode">
    /**
     * will return the failure code either from well defined failure code container or from db code response, in case of crud failure, will always expect the response code and message
     * 
     * @param type $dbCodeResponse
     * @param bool $isCUDU
     */
    protected function getCRUDFailureResponseCodeNMessage($dbCodeResponse, bool $isCUDU = true) {
        $crudFailureResponseCodeNMessage = array();
        if (Kahoutility::checkArrayParam($dbCodeResponse)) {
            if (isset($dbCodeResponse[0]) && Kahoutility::checkArrayParam($dbCodeResponse) && isset($dbCodeResponse[0][self::DB_RESPONSE_KEY_DB_RESPONSE_CODE])) {
                $crudFailureResponseCodeNMessage[0] = $this->dbResponse[0][self::DB_RESPONSE_KEY_DB_RESPONSE_CODE];
                $crudFailureResponseCodeNMessage[1] = isset($this->dbResponse[0][self::DB_RESPONSE_KEY_DB_RESPONSE_MESSAGE]) ? $this->dbResponse[0][self::DB_RESPONSE_KEY_DB_RESPONSE_MESSAGE] : "";
            }
        }
        return $crudFailureResponseCodeNMessage;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="sendBroadcastMessage">
    /**
     * will broadcast db response if broadcasting enabled
     */
    private function sendBroadcastMessage() {
        Dbcrudsubject::getDBCrudSubjectIns()->update($this, $this->dbResponse);
    }

    // </editor-fold>
//    private function registerBroadcastListener($keyname, $broadcastListener) {
//        $this->ciLibrary->kahobroadcastservice->registerListener($keyname, $broadcastListener);
//    }
//    private function isBroadCastEnabled() {
//        $isBroadCastEnabled = FALSE;
//        if ($this->isBroadcastEnabled === TRUE) {
//            $isBroadCastEnabled = true;
//        }
//        return $isBroadCastEnabled;
//    }
    // <editor-fold defaultstate="collapsed" desc="sendResponse">
    /**
     * will process the db response and send the response
     * 
     * @param array $conf
     * @param bool $isMultipleResultSet
     * @param bool $isResponseKeyArray
     *            will make the response key as an array
     */
    public function sendResponse(array $conf = null, bool $isMultipleResultSet = false, bool $isResponseKeyArray = false) {
        if ($this->isDBOperationSuccess()) {
            $processedResponse = $this->buildRespStructure($this->dbResponse, $conf, $isMultipleResultSet);
            $this->printResponse($processedResponse, $isResponseKeyArray);
        } else {
            $this->printResponse(NULL, $isResponseKeyArray);
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="buildRespStructure">
    /**
     * would be invoked by send response method, will process the response by building the response using respstructurebuilder class
     * 
     * @param array $dbResp
     * @param array $configuration
     * @param bool $isMultipleResultSet
     * @return type
     */
    public function buildRespStructure($dbResp, array $configuration = null, bool $isMultipleResultSet = false) {
        return $this->ciLibrary->respstructurebuilder->buildResponse($dbResp, $configuration, $isMultipleResultSet)->getBuiltResponse();
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getResponse">
    /**
     * will return the db response of last db transaction
     * 
     * @return array
     */
    public function getResponse() {
        return $this->dbResponse;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="printResponse">
    /**
     * will print the response
     * 
     * @param array $response
     * @param string $istomakekeyarray
     *            is it required to make the response key array or not
     * @param type $responseKey
     *            would be calling function name of contr
     * @param type $responseMessage
     *            if callie want to pass
     * @param type $responseCode
     */
    public function printResponse($response = null, $istomakekeyarray = false, $responseKey = null, $responseMessage = null, $responseCode = null): void {
        $json = array();
        $responseKey = $responseKey ?? Kahoutility::getCallieFunctionName();
        $json[self::RESPONSE_CODE] = $responseCode ?? $this->getResponseCode();
        // $json[self::RESPONSE_CODE] = self::RESPONSE_NOT_FOUND;$response = NULL;
        $json[self::RESPONSE_MSG_KEY] = $responseMessage ?? Kahoutility::convertStringToSlugName($responseKey) . "_" . $json[self::RESPONSE_CODE];
        $json[self::RESPONSE_MSG] = $responseMessage ?? $this->getResponseMessage() ?? Kahoutility::getLangFileRespMessage($json[self::RESPONSE_MSG_KEY]);
        if (Kahoutility::checkArrayParam($response) || Kahoutility::isStringParamValid($response)) {
            $responseKey = Kahoutility::getRequestedHeaderValueByKey("User-Agent") === ANDROID_USER_AGENT_NAME ? ucfirst($responseKey) : $responseKey;
            if ($istomakekeyarray) {
                $json[$responseKey][] = $response;
            } else {
                $json[$responseKey] = $response;
            }
        }
        echo Kahoutility::convertInJSON($json);
        exit();
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="destructProps">
    /**
     * will destruct the props so that next method of derived service class can have its own resp
     */
    public function destructProps() {
        unset($this->dbResponse, $this->responseCode, $this->responseMessage);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="setResponseCode">
    /**
     * will set the response code based on db response
     * 
     * @param bool $isCUDU
     */
    private function setResponseCode(bool $isCUDU = true) {
        // if ($this->ciLibrary->dbService->isDBOperationSuccess()) { // checking that db operation is success by not having any pdo exception
        // if (Kahoutility::checkArrayParam($this->dbResponse)) { // checking that db response is not null
        // if ($isCUDU) {
        // $this->responseCode = $this->getCUDUResponseCode($this->dbResponse);
        // } else {
        // $this->responseCode = self::RESPONSE_FOUND;
        // }
        // } else {
        // $this->responseCode = self::RESPONSE_NOT_FOUND;
        // }
        // } else {
        // $this->responseCode = self::OPERATION_FAILED;
        // }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getResponseCode">
    /**
     * will return the response code after processing the db response
     * 
     * @return string
     */
    private function getResponseCode() {
        return $this->responseCode;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getResponseCode">
    /**
     * will return the response message key after processing the response
     * 
     * @return string
     */
    private function getResponseMessage() {
        return $this->responseMessage;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="isCRUDSuccess">
    /*
     * will just check that curd response is ok or not
     * create,update,delete,upload,get : first key of array would be is_success key,callie will make sure that db response code available then it will call this method
     * @param array) $dbResponseCodeArray
     */
    private function isCRUDSuccess(array $dbResponseCodeArray): bool {
        $isCRUDSuccess = FALSE;
        if (Kahoutility::checkArrayParam($dbResponseCodeArray) && (int) $dbResponseCodeArray[self::DB_RESPONSE_KEY_IS_SUCCESS] === 1) {
            $isCRUDSuccess = true;
        }
        return $isCRUDSuccess;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="processDBResponse">
    /**
     * will process the db response and set the enough response code and response message such as db response message like email already exists,data found and data not found
     * 
     * @param type $dbResponse
     * @param bool $isCUDU
     */
    public function processDBResponse($dbResponse, bool $isCUDU = true) {
        $this->isDBOperationSuccess = FALSE;
        if (!$this->ciLibrary->dbService->isPDOExceptionOccured()) { // checking that db operation is success by not having any pdo exception
            if (Kahoutility::checkArrayParam($dbResponse)) { // checking that db response is not null
                if ($this->isDBResponseCodeAvailable($dbResponse)) {
                    if ($this->isDBResponseCodeSuccess($dbResponse)) {
                        $this->isDBOperationSuccess = TRUE;
                        $this->setResponseCodeNMessage($this->getCRUDSuccessResponseCode($isCUDU));
                    } else {
                        $crudFailureResponseCodeNMessage = $this->getCRUDFailureResponseCodeNMessage($dbResponse, $isCUDU);
                        $this->setResponseCodeNMessage($crudFailureResponseCodeNMessage[0], $crudFailureResponseCodeNMessage[1]);
                    }
                } else {
                    $this->isDBOperationSuccess = TRUE;
                    $this->setResponseCodeNMessage(self::RESPONSE_FOUND);
                }
            } else {
                $this->setResponseCodeNMessage(self::RESPONSE_NOT_FOUND);
            }
        } else {
            $this->setResponseCodeNMessage(self::DB_OPERATION_FAILED, self::DB_OPERATION_FAILED_MESSAGE);
        }
        return $this;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="isDBResponseCodeAvailable">
    /**
     * will process the db response and check response code is_success(must be available in case of add/update/delete) available or not, in case of get record it may be absent
     * 
     * @param type $dbResponse
     */
    public function isDBResponseCodeAvailable($dbResponse) {
        $isDBResponseCodeAvailable = FALSE;
        if (Kahoutility::checkArrayParam($dbResponse)) {
            if (isset($dbResponse[0]) && array_key_exists(self::DB_RESPONSE_KEY_IS_SUCCESS, $dbResponse[0])) {
                $isDBResponseCodeAvailable = true;
            }
        }
        return $isDBResponseCodeAvailable;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="isDBResponseCodeSuccess">
    /**
     * will check that is db response success or not by checking that response code is available or not and also is_success key = 1
     * 
     * @param array $dbResponse
     *            Description
     * @return boolean
     */
    public function isDBResponseCodeSuccess($dbResponse): bool {
        $isDBResponseSuccess = FALSE;
        try {
            if (checkArrayParam($dbResponse)) {
                if ($this->isCRUDSuccess($dbResponse[0])) {
                    $isDBResponseSuccess = TRUE;
                }
            }
        } catch (Exception $exc) {
            
        } finally {
            return $isDBResponseSuccess;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="setResponseCodeNMessage">
    /**
     * will set the response code and message, which would be passed to rest response to client
     * 
     * @param string $responseCode
     * @param string $responseMessage
     */
    public function setResponseCodeNMessage(string $responseCode, string $responseMessage = null) {
        if (Kahoutility::isStringParamValid($responseCode)) {
            $this->responseCode = $responseCode;
        }
        if (Kahoutility::isStringParamValid($responseMessage)) {
            $this->responseMessage = $responseMessage;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="isDBOperationSuccess">
    /**
     * will just return boolean value if isDBOperation Success or failure after processing the db response
     */
    public function isDBOperationSuccess(): bool {
        return $this->isDBOperationSuccess;
    }

    // </editor-fold>
}
