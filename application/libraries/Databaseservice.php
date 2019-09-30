<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * ***** Rules & Regulation ******
 * 1) will perform the crud operation on database
 * 2) create,update and delete will always return one row either success or error
 * 3) will return the db response code which may be anything, but column name will like db_response_code,db_response_message and primary column name
 * 4) is having one
 *
 */

/**
 * Description of Databaseservice
 *
 * @author KaHO
 */
class Databaseservice {

    // put your code here
    private $ciLibrary;
    private $dbConnection;
    private $prepareStmt;
    private $isPDOExceptionOccured;

    public function __construct() {
        $this->ciLibrary = Kahoutility::getCILibrary();
        $this->loadDatabase();
        $this->isPDOExceptionOccured = FALSE;
    }

    // <editor-fold defaultstate="collapsed" desc="loadDatabase">
    /**
     * will load the database based on login status
     */
    public function loadDatabase() {        
        if (Kahoutility::isStringParamValid($dbName = Phpsessionservice::getPHPSessionServiceInstance()->getPHPSessionValueByKey(DB_SESSION_KEY_NAME))) {
            $dbName = strtolower($dbName);
            $this->dbConnection = $this->ciLibrary->load->database($dbName, true);
        } else {
            $this->dbConnection = $this->ciLibrary->load->database("default", TRUE);
        }
    }

    public function loadDatabaseByKey($dbKey) {
        $this->dbConnection = $this->ciLibrary->load->database($dbKey, true);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="addRecord">
    /**
     *
     * @param string $spName
     * @param array $spParam
     */
    public function addRecord(string $spName, array $spParam) {
        return $this->performCUDDBOperation($spName, $spParam);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="updateRecord">
    /**
     * will perform the
     *
     * @param string $spName
     * @param array $spParam
     */
    public function updateRecord(string $spName, array $spParam) {
        return $this->performCUDDBOperation($spName, $spParam);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="deleteRecord">
    /**
     * will perform the delete operation
     *
     * @param string $spName
     * @param array $spParam
     */
    public function deleteRecord(string $spName, array $spParam) {
        return $this->performCUDDBOperation($spName, $spParam);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getRecord">
    /**
     * will return the record from select statement
     *
     * @param string $spName
     * @param array $spParam
     * @return type
     * @throws LogicErrorException
     */
    public function getRecord(string $spName, array $spParam = null) {
        $this->ciLibrary->writelog->writeInitiatedDebugLog(__METHOD__, array(
            $spName,
            $spParam
        ));
        $dbResp = NULL;
        try {
            if (!$this->isSPNameEmpty($spName)) {
                $this->executeStatement($spName, $spParam);
                $dbResp = $this->fetchRecord();
            } else {
                throw new LogicErrorException("either spname is empty");
            }
        } catch (LogicErrorException $logicErrExcep) {
            $this->ciLibrary->writelog->writeErrorLog($logicErrExcep->GetCustomErrMessage());
        } catch (PDOException $pdoException) {
            $this->handlePDOException($pdoException);
        } finally {
            $this->ciLibrary->writelog->writeReturnedDebugLog(__METHOD__, $dbResp);
            return $dbResp;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="executedLocalDataInlineQuery">
    public function executedLocalDataInlineQuery($inlineQuery) {
        $inlineQueryArray = explode(";", $inlineQuery);
        try {
            $this->dbConnection->prepare($inlineQueryArray[0])->execute();
            $this->dbConnection->prepare($inlineQueryArray[1], [
                PDO::MYSQL_ATTR_LOCAL_INFILE => true
            ])->execute();
        } catch (PDOException $pdoException) {
            $this->handlePDOException($pdoException);
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="fetchRecord">
    /**
     *
     * @return array
     */
    private function fetchRecord(): array {
        $this->ciLibrary->writelog->writeInitiatedDebugLog(__METHOD__);
        $result = array();
        try {
            do {
                $result[] = $this->prepareStmt->fetchAll(PDO::FETCH_ASSOC);
            } while ($this->prepareStmt->nextRowset());
        } catch (PDOException $pdoException) {
            $isMultiFetchRecordTrue = count($result) > 0 ? TRUE : FALSE;
        } finally {
            $this->ciLibrary->writelog->writeReturnedDebugLog(__METHOD__, $result);
            $respLength = count($result);
            return (empty($result[0]) === true && $respLength === 1) ? null : ($respLength === 1 ? $result[0] : ($this->isMultipleRespNull($result) ? null : $result));
        }
    }

    private function isMultipleRespNull(array $result): bool {
        $isMultipleRespNull = true;
        if (Kahoutility::checkArrayParam($result)) {

            foreach ($result as $val) {
                if (count($val) > 0) {
                    $isMultipleRespNull = false;
                    break;
                }
            }
        }
        return $isMultipleRespNull;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="beginTransaction">
    /**
     * will begin the transaction
     */
    private function beginTransaction() {
        try {
            if (!is_null($this->dbConnection)) {
                $this->dbConnection->beginTransaction();
            } else {
                throw new LogicErrorException("db conn is empty");
            }
        } catch (TransactionException $transException) {
            $this->ciLibrary->writelog->writeErrorLog($transException->GetCustomErrMessage());
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="commitTransaction">
    /**
     * will commit the transaction after successful cudu operation
     */
    private function commitTransaction() {
        try {
            if ($this->dbConnection->inTransaction() === TRUE) {
                $this->dbConnection->commit();
            } else {
                throw new LogicErrorException("db is not in transaction");
            }
        } catch (TransactionException $transException) {
            $this->ciLibrary->writelog->writeErrorLog($transException->GetCustomErrMessage());
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="rollbackTransaction">
    /**
     * will rollback the transaction after any unsuccessful cudu operation
     *
     * @return boolean
     */
    private function rollbackTransaction() {
        try {
            if ($this->dbConnection->inTransaction() === TRUE) {
                return $this->dbConnection->rollBack();
            } else {
                return FALSE;
            }
        } catch (TransactionException $transException) {
            $this->ciLibrary->writelog->writeErrorLog($transException->GetCustomErrMessage());
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="prepareStatement">
    /**
     *
     * @param string $spName
     * @param array $spParam
     */
    private function prepareStatement(string $spName, array $spParam = null) {
        $prepareStmt = "CALL " . $spName . "(";
        $prepareStmt .= $this->buildSPParam($spParam);
        $prepareStmt .= ")";
        $this->prepareStmt = $this->dbConnection->prepare($prepareStmt);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="executeStatement">
    /**
     * will prepare the stmt and execute it, will return the prepare object
     *
     * @param string $spName
     * @param array $spParam
     */
    private function executeStatement(string $spName, array $spParam = null) {
        $this->prepareStatement($spName, $spParam);
        $this->prepareStmt->execute($this->buildSPParamsBoundedVal($spParam));
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="buildSPParam">
    /**
     * will build the param for procedure if not empty
     *
     * @param array $spParam
     * @return string
     */
    private function buildSPParam(array $spParam = null): string {
        $spParamInStr = "";
        if (checkArrayParam($spParam)) {
            $spParamLen = count($spParam);
            foreach ($spParam as $key => $val) {
                if ($spParamLen > 1) {
                    $spParamInStr .= ":" . $key . ",";
                } else {
                    $spParamInStr .= ":" . $key;
                }
                $spParamLen --;
            }
        }
        return $spParamInStr;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="buildSPParamsBoundedVal">
    /**
     * will build the sp param bounded value, to be passed in execute param
     *
     * @param array $spParam
     * @return array
     */
    private function buildSPParamsBoundedVal(array $spParam = null): array {
        $spParamsBoundedVal = [];
        if (isStringParamValid($builtSPParam = $this->buildSPParam($spParam))) {
            $spParamsBoundedVal = array_combine(explode(",", str_replace(":", "", $builtSPParam)), array_values($spParam));
        }
        return $spParamsBoundedVal;
    }

    // </editor-fold>
    private function handlePDOException(PDOException $pdoException, $isMultiFetchRecordTrue = false) {
        if (!$isMultiFetchRecordTrue) {
            $this->isPDOExceptionOccured = TRUE;
        }
    }

    public function isPDOExceptionOccured() {
        return $this->isPDOExceptionOccured;
    }

    // <editor-fold defaultstate="collapsed" desc="isSPNameEmpty">
    /**
     * will check that sp name is empty or not
     *
     * @param string $spName
     * @return bool
     */
    private function isSPNameEmpty(string $spName): bool {
        $isSPNameEmpty = TRUE;
        if (Kahoutility::isStringParamValid($spName)) {
            $isSPNameEmpty = FALSE;
        }
        return $isSPNameEmpty;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="isCUDSPParamEmpty">
    /**
     * will check that is param empty or not while creating,updating and delete db operations
     *
     * @param array $spParam
     */
    private function isCUDSPParamEmpty($spParam): bool {
        $isCUDSPParamEmpty = TRUE;
        if (Kahoutility::checkArrayParam($spParam)) {
            $isCUDSPParamEmpty = FALSE;
        }
        return $isCUDSPParamEmpty;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="performCUDDBOperation">
    /**
     * is a common method to perform common operation of create,update and delete db operation
     *
     * @param string $spName
     * @param array $spParam
     * @return array will
     */
    private function performCUDDBOperation(string $spName, array $spParam, callable $preCUDDBOperationCallable = null) {
        $this->ciLibrary->writelog->writeInitiatedDebugLog(__METHOD__, array(
            $spName,
            $spParam
        ));
        $dbResp = NULL;
        try {
            if (!$this->isSPNameEmpty($spName) && !$this->isCUDSPParamEmpty($spParam)) {
                $this->preCUDDBOperation($preCUDDBOperationCallable);
                $this->executeStatement($spName, $spParam);
                $dbResp = $this->fetchRecord();
                $this->postCUDDBOperation();
            } else {
                throw new LogicErrorException("either spname or sp param is empty");
            }
        } catch (LogicErrorException $logicErrExcep) {
            $this->ciLibrary->writelog->writeErrorLog($logicErrExcep->GetCustomErrMessage());
        } catch (PDOException $pdoException) {
            $this->rollbackTransaction();
            $this->handlePDOException($pdoException);
        } finally {
            $this->ciLibrary->writelog->writeReturnedDebugLog(__METHOD__, $dbResp);
            return $dbResp;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="preCUDDBOperation">
    /**
     * will be invoked by performCUDDBOperation method
     * will invoke if any callback passed before c,u,d db operation othwerwise will simply begin the transaction
     *
     * @param callable $preCUDDBOperationCallable
     */
    private function preCUDDBOperation($preCUDDBOperationCallable) {
        // $this->beginTransaction();
        // if (is_callable($preCUDDBOperationCallable)) {
        // call_user_func($preCUDDBOperationCallable);
        // }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="postCUDUAction">
    /**
     * will be invoked by performCUDDBOperation method
     */
    private function postCUDDBOperation() {
        $this->commitTransaction();
    }

    // </editor-fold>
}
