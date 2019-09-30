<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cacheobservermanager
 *
 * @author Sandeep Kosta
 */
include_once 'Errorface.php';

class Cacheobservermanager implements Errorface
{
 // this will act as subject in observer pattern where bmanager class will act as a client to register the icache implemented class as observer
                                                  // put your code here
    private $cacheConfigurations;

    const CACHE_CONFIGURATIONS_EXPIRATION_TIME = 86400;

    const CACHE_CONFIGURATION_KEY = "cache_configuration";

    static $CACHE_ELEMENT_EXPIRATION_TIME = 86400;
 // would be used to store the cache element expiration time coming from db
    private $bManagerInstance;

    private $ciInstance;

    private $customMemcachedError;

    const NO_CACHE_CONFIGURATION_FOUND = "there is no cache configuration found";

    const CALLIE_CLASS_METHOD_NOT_FOUND = "calling class and method name can't be empty";

    const KEY_TO_BE_REMOVED_NOT_AVAILABLE = "key to be removed is either empty or not in expected strcuture";

    const CACHE_KEY_IS_EMPTY = "cache key is empty";

    public function __construct($bManagerObjs)
    { // as it is singlelton pattern then it would be instantiated whenever it's required and will store the cache configuration information in the property
        $this->bManagerInstance = $bManagerObjs[0]; // this is bmanager instance
        $this->ciInstance = $bManagerObjs[1]; // this is ci instance
        $this->ciInstance->writelog->writeInitiatedDebugLog(__METHOD__);
    }

    private function setCacheConfiguration()
    {
        $this->ciInstance->writelog->writeInitiatedDebugLog(__METHOD__);
        $isSetConfiguration = FALSE;
        $cacheConfigurations = $this->bManagerInstance->GetObjectReport("sCacheConfigurationGet");
        if (empty($cacheConfigurations) === FALSE) {
            $this->cacheConfigurations = getCacheConfigurationArrayStructure($cacheConfigurations); //
            if ($this->ciInstance->memlibrary->Set(self::CACHE_CONFIGURATION_KEY, $this->cacheConfigurations, self::CACHE_CONFIGURATIONS_EXPIRATION_TIME)) {
                $isSetConfiguration = TRUE;
            }
        }
        $this->setCustomMemcachedError(self::NO_CACHE_CONFIGURATION_FOUND, __METHOD__);
        $this->ciInstance->writelog->writeReturnedDebugLog(__METHOD__, $isSetConfiguration);
        return $isSetConfiguration;
    }

    public function getCacheConfiguration()
    {
        $this->ciInstance->writelog->writeInitiatedDebugLog(__METHOD__);
        if ($this->cacheConfigurations === null) {
            $this->cacheConfigurations = $this->ciInstance->memlibrary->Get(self::CACHE_CONFIGURATION_KEY); // will fetch the data from cache if exist
            if (empty($this->cacheConfigurations) === TRUE) {
                $this->setCacheConfiguration(); // storing the data to property if retrieved the data from db
            }
        }
        $this->ciInstance->writelog->writeReturnedDebugLog(__METHOD__, $this->cacheConfigurations);
        return $this->cacheConfigurations;
    }

    public function setCustomMemcachedError($errorMessage, $methodName)
    { // would be used internally to store
        $this->customMemcachedError = $errorMessage . " inside method " . $methodName;
        $this->ciInstance->writelog->writeErrorLog($this->customMemcachedError);
    }

    public function getCustomMemcachedError()
    {
        return $this->customMemcachedError;
    }

    // public function isEnabledForCaches($callieClassNMethod) { // will check that the object which is requesting to be cached is eligible or not for caching
    // $this->ciInstance->writelog->writeInitiatedDebugLog(__METHOD__, $callieClassNMethod);
    // $isEnabled = FALSE;
    // if (empty($this->getCacheConfiguration()) === FALSE && is_array($callieClassNMethod)) {
    // $className = $callieClassNMethod[1];
    // $methodName = $callieClassNMethod[2];
    // foreach ($this->getCacheConfiguration() as $key => $val) {
    // if (is_array($val) === TRUE) {
    // if (key_exists($className, $val)) {
    // foreach ($val[$className] as $keys => $vals) {
    // if (strtolower($methodName) === $vals['Method_Name']) {
    // $isEnabled = TRUE;
    // self::$CACHE_ELEMENT_EXPIRATION_TIME = $vals['Expiration_Time'];
    // break 2;
    // }
    // }
    // }
    // }
    // }
    // }
    // $this->setCustomMemcachedError(self::CALLIE_CLASS_METHOD_NOT_FOUND, __METHOD__);
    // $this->ciInstance->writelog->writeReturnedDebugLog(__METHOD__, $isEnabled);
    // return $isEnabled;
    // }
    public function isEnabledForCache($callieClassNMethod)
    { // either it would be an string as class name or array with class n method name this method will check that callie is eligible for caching or not, second callie is having an observer or not to invalidate in case of callie either being inserted,updated or deleted
        $this->ciInstance->writelog->writeInitiatedDebugLog(__METHOD__, $callieClassNMethod);
        $isEnabled = FALSE;
        $className = $methodName = "";
        if (empty($this->getCacheConfiguration()) === FALSE) {
            if (is_array($callieClassNMethod)) {
                $className = $callieClassNMethod[1];
                $methodName = $callieClassNMethod[2];
                foreach ($this->getCacheConfiguration() as $key => $val) {
                    if (is_array($val) === TRUE) {
                        if (key_exists($className, $val)) {
                            foreach ($val[$className] as $keys => $vals) {
                                if (strtolower($methodName) === $vals['Method_Name']) {
                                    $isEnabled = TRUE;
                                    self::$CACHE_ELEMENT_EXPIRATION_TIME = $vals['Expiration_Time'];
                                    break 2;
                                }
                            }
                        }
                    }
                }
            } else {
                if (key_exists($callieClassNMethod, $this->getCacheConfiguration())) { // here $callieClassNMethod would be a string as class name
                    return $this->getCacheConfiguration()[$callieClassNMethod];
                }
            }
        }
        $this->setCustomMemcachedError(self::CALLIE_CLASS_METHOD_NOT_FOUND, __METHOD__);
        $this->ciInstance->writelog->writeReturnedDebugLog(__METHOD__, $isEnabled);
        return $isEnabled;
    }

    // public function updateObserver($callieClassName) {
    // $this->ciInstance->writelog->writeInitiatedDebugLog(__METHOD__, $callieClassName);
    // if (empty($callieClassName) === FALSE) {
    // if (empty($this->getCacheConfiguration() === FALSE)) {
    // if (key_exists($callieClassName, $this->getCacheConfiguration())) {
    // return $this->getCacheConfiguration()[$callieClassName];
    // // return $this->retrieveKeyAndInvalidateCache($this->getCacheConfiguration()[$callieClassName]);
    // }
    // }
    // }
    // $this->setCustomMemcachedError(self::CALLIE_CLASS_METHOD_NOT_FOUND, __METHOD__);
    // $this->ciInstance->writelog->writeReturnedDebugLog(__METHOD__);
    // return FALSE;
    // }
    public function retrieveKeyAndInvalidateCache($removalCacheConfigurationsArrayData)
    {
        $this->ciInstance->writelog->writeInitiatedDebugLog(__METHOD__, $removalCacheConfigurationsArrayData);
        if (empty($removalCacheConfigurationsArrayData) === FALSE && is_array($removalCacheConfigurationsArrayData)) {
            $allKey = array();
            foreach ($removalCacheConfigurationsArrayData as $key => $val) {
                array_push($allKey, $this->ciInstance->memlibrary->getClassAllCacheKey($key));
            }
            return $this->ciInstance->memlibrary->MultipleDelete(current($allKey));
        }
        $this->setCustomMemcachedError(self::KEY_TO_BE_REMOVED_NOT_AVAILABLE, __METHOD__);
        $this->ciInstance->writelog->writeReturnedDebugLog(__METHOD__);
        return FALSE;
    }

    public function attachObserver(Icache $observer, $cacheKey)
    {
        $this->ciInstance->writelog->writeInitiatedDebugLog(__METHOD__, $cacheKey);
        if (empty($cacheKey) === FALSE) {
            return $this->ciInstance->memlibrary->getKeyAppended($cacheKey);
        }
        $this->setCustomMemcachedError(self::CACHE_KEY_IS_EMPTY, __METHOD__);
        $this->ciInstance->writelog->writeInitiatedDebugLog(__METHOD__);
        return FALSE;
    }
}
