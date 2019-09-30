<?php

/**
 * @created by Sandeep kosta <sandeep@kaholabs.com> on 4 Mar, 2015 11:35:26 AM
 * 
 * Descripion: 
 * 
 * Security : 
 * 
 * Change History :-
 * 
 * 
 * 
 * 
 * @Audited by :-
 */
include_once 'Errorface.php';

class Memlibrary implements Errorface
{

    private $MemcachedCon;

    private $MemcachedConfigItems;

    private $GetCIInstance;

    const ROOT_CACHE_KEY = "root_master_key";
 // root key name for getting all key stored under in
    private static $MEMERRORCODE_SET_ERROR = "There is an error while storing the data in memcached";

    private static $MEMERRORCODE_GET_ERROR = "There is an error while getting the data from memcached";

    private static $MEMERRORCODE_KEY_EMPTY_ERROR = "key name is empty";

    private static $MEMERRORCODE_CLASS_KEY_EMPTY_ERROR = "class key name is empty for deletion";

    private $customMemcachedError;
 // would be used when callie wanna have a look at exact error message
    public function __construct($ciInstance)
    {
        $this->GetCIInstance = $ciInstance[0]; // can load and access any ci library;
                                               // $this->GetMemConfig = $this->GetCIInstance;
        $this->GetCIInstance->config->load("memcached_library");
        $this->GetCIInstance->load->library(array(
            "monitorlog/bmonitorlog",
            "monitorlog/cmonitorlog"
        ));
        $this->MemcachedConfigItems = $this->GetCIInstance->config->item("memcached");
        $this->MemcachedCon = new Memcached();
        $this->SetMemcachedConfigurations();
        $this->AddServer();
    }

    private function SetMemcachedConfigurations()
    { // will set some pre defined option to memcached for global memcached configurarion
        if (! empty($this->MemcachedConfigItems)) {
            if (isset($this->MemcachedConfigItems['memcached_set_option'])) {
                foreach ($this->MemcachedConfigItems['memcached_set_option'] as $key => $val) {
                    $this->MemcachedCon->setOption($key, $val);
                }
            }
        }
    }

    private function AddServer()
    { // going to add the server to memcached server pool
        try {
            if (! $this->MemcachedCon->addServer($this->MemcachedConfigItems['server_amazon']['host'], $this->MemcachedConfigItems['server_amazon']['port'], $this->MemcachedConfigItems['server_amazon']['weight'])) {
                throw new Mymemcachedexception("there is an error while adding the server to memcached pool with result code " . $this->MemcachedCon->getResultCode() . " with result message " . $this->MemcachedCon->getResultMessage());
            }
        } catch (Mymemcachedexception $MemcachedExp) {
            $this->GetCIInstance->writelog->writeErrorLog($MemcachedExp->GetMemcachedCustomErrMessage());
        }
    }

    public function Set($key, $val, $expirationTime)
    { // will set the data with given key in memcached
        $this->GetCIInstance->writelog->writeInitiatedDebugLog(__METHOD__, array(
            $key,
            $val,
            $expirationTime
        ));
        if (! empty($key)) {
            if (! $this->MemcachedCon->set($key, $val, $expirationTime)) {
                $this->setCustomMemcachedError(self::$MEMERRORCODE_SET_ERROR, __METHOD__);
                goto LabelReturnFalse;
            } else {
                return true;
            }
        }
        $this->setCustomMemcachedError(self::$MEMERRORCODE_KEY_EMPTY_ERROR, __METHOD__);
        LabelReturnFalse:
        $this->GetCIInstance->writelog->writeReturnedDebugLog(__METHOD__);
        return FALSE;
    }

    public function Get($key)
    { // will retrieve the value for given key
        $this->GetCIInstance->writelog->writeInitiatedDebugLog(__METHOD__, $key);
        $getResponse = FALSE;
        if (! empty($key)) {
            if (! $getResponse = $this->MemcachedCon->get($key)) {
                $this->setCustomMemcachedError(self::$MEMERRORCODE_GET_ERROR . " with key" . $key, __METHOD__);
                goto LabelReturnFalse;
            }
        } else {
            $this->setCustomMemcachedError(self::$MEMERRORCODE_KEY_EMPTY_ERROR . " with key" . $key, __METHOD__);
        }
        LabelReturnFalse:
        $this->GetCIInstance->writelog->writeReturnedDebugLog(__METHOD__, $getResponse);
        return $getResponse;
    }

    public function setCustomMemcachedError($errorMessage, $methodName)
    { // would register the recently error occured
        $this->customMemcachedError = $errorMessage . " inside method " . $methodName . $this->GetMemcachedResult();
        $this->GetCIInstance->writelog->writeErrorLog($this->customMemcachedError);
    }

    public function getCustomMemcachedError()
    { // will return the recently error occured
        return $this->customMemcachedError;
    }

    public function GetMemcachedResult()
    { // will return the memcached result of recently perform action
        return $this->MemcachedCon->getResultCode() . " with result message " . $this->MemcachedCon->getResultMessage();
    }

    public function getKeyAppended($key)
    { // $key will come with class name which would be key inside root key in memcache store
        $this->GetCIInstance->writelog->writeInitiatedDebugLog(__METHOD__, $key);
        if (! empty($key) && strlen($key) > 0) {
            $classKey = current(explode("_", $key)); // will extract the class name from the built key
            $allKeysArray = $this->GetAllKeyStructureData(); // $this->Get($this->RootCacheKey);
            if (! empty($allKeysArray)) {
                if (key_exists($classKey, $allKeysArray)) {
                    if (in_array($key, $allKeysArray[$classKey]) === FALSE) {
                        goto LabelAppend;
                    } else {
                        return true; // key already sitting so do nothing and return true
                    }
                }
                {
                    goto LabelAppend;
                }
            } else {
                LabelAppend:
                $allKeysArray[$classKey][] = $key;
                return $this->Set(self::ROOT_CACHE_KEY, $allKeysArray, 86400);
            }
        } else {
            $this->setCustomMemcachedError(self::$MEMERRORCODE_KEY_EMPTY_ERROR, __METHOD__);
            $this->GetCIInstance->writelog->writeReturnedDebugLog(__METHOD__);
            return FALSE;
        }
    }

    public function getClassAllCacheKey($classKey)
    { // will return the all key stored in specific module stored in related class name as key if success otherwise false
        $this->GetCIInstance->writelog->writeInitiatedDebugLog(__METHOD__, $classKey);
        if (! empty($classKey)) {
            $allKeysArray = $this->GetAllKeyStructureData();
            if (! empty($allKeysArray)) {
                if (key_exists($classKey, (array) $allKeysArray)) {
                    return $allKeysArray[$classKey];
                } else {
                    goto LabelClassKeyEmpty;
                }
            } else {
                goto LabelClassKeyEmpty;
            }
        } else {
            LabelClassKeyEmpty:
            $this->setCustomMemcachedError(self::$MEMERRORCODE_CLASS_KEY_EMPTY_ERROR, __METHOD__);
            return FALSE;
        }
    }

    private function GetAllKeyStructureData()
    { // will return all keys from key pool stored in cache under key "root_master_key" which would be used to invalidate the data stored in memcached server when new data would be inserted, updated or deleted
        $this->GetCIInstance->writelog->writeInitiatedDebugLog(__METHOD__);
        $allKeyStructureData = $this->Get(self::ROOT_CACHE_KEY);
        $this->GetCIInstance->writelog->writeReturnedDebugLog(__METHOD__, $allKeyStructureData);
        return $allKeyStructureData;
    }

    public function DeleteKeyFromRootCacheKeyStructure($key, $getCallieClassName)
    { // will invalidate the key from master cache key structure, would be needed when program fail to set the data came from db
        $this->GetCIInstance->writelog->writeInitiatedDebugLog(__METHOD__, array(
            $key,
            $getCallieClassName
        ));
        if ($allKeysArray = $this->GetAllKeyStructureData()) {
            if ($searchedKey = array_search($key, $allKeysArray[$getCallieClassName])) {
                unset($allKeysArray[$getCallieClassName][$searchedKey]);
            }
        }
    }

    public function Delete($key)
    {
        $this->GetCIInstance->writelog->writeInitiatedDebugLog(__METHOD__, $key);
        if (! empty($key)) {
            return $this->MemcachedCon->delete($key);
        }
        $this->setCustomMemcachedError(self::$MEMERRORCODE_KEY_EMPTY_ERROR, __METHOD__);
        $this->GetCIInstance->writelog->writeReturnedDebugLog(__METHOD__);
        return FALSE;
    }

    public function MultipleDelete($arrayKey)
    {
        $this->GetCIInstance->writelog->writeInitiatedDebugLog(__METHOD__, $arrayKey);
        if (! empty($arrayKey) && is_array($arrayKey)) {
            if ($this->MemcachedCon->deleteMulti($arrayKey)) {
                return TRUE;
            } else {
                $this->Flush(); // if there is any problem to delete the specific key from cache then delete the whole cache to avoid any unwanted issues
                goto WriteLogForFailureOfThisMethod;
            }
        } else {
            $this->setCustomMemcachedError(self::$MEMERRORCODE_KEY_EMPTY_ERROR, __METHOD__);
            goto WriteLogForFailureOfThisMethod;
        }
        WriteLogForFailureOfThisMethod:
        $this->GetCIInstance->writelog->writeErrorLog($this->getCustomMemcachedError(), Writelog::MAIL_ERROR_CODE);
        return FALSE;
    }

    public function Flush()
    {
        return $this->MemcachedCon->flush();
    }

    public function InsertCacheLog($getCallieClassNMethod, $dataSource)
    {
        if ($this->GetCIInstance->config->item("memcache_log") === true) {
            $this->GetCIInstance->writelog->writeInitiatedDebugLog(__METHOD__, $getCallieClassNMethod);
            if (empty($getCallieClassNMethod) === FALSE) {
                $this->GetCIInstance->cmonitorlog->GetCallieClassNMethod = $getCallieClassNMethod[1] . "_" . $getCallieClassNMethod[2];
                $this->GetCIInstance->cmonitorlog->SOURCETYPE = $dataSource;
                $OutputParam = array(
                    "Status"
                );
                $result = $this->GetCIInstance->bmonitorlog->Insert($this->GetCIInstance->cmonitorlog, $OutputParam);
            }
            $this->GetCIInstance->writelog->writeInitiatedDebugLog(__METHOD__, print_r($result, true));
        }
    }
}
