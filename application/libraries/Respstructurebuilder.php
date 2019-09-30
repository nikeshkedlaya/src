<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Respstructurebuilder
 *
 * @author Rakshith B.K<rakshith@kaholabs.com>
 *        
 *         configuration rules
 *         1) is an array
 *         2) key would be the column id name
 *         3) value would be the column name to show inside specific container such as array("Class_Code" => "Class_Code", "Section_Code" => "Section_Code", "Student_Code" => "Student_Name,Father_Email,Mother_Email");
 *         4) we can as as many level as we want such as Class_Code -> Section_Code -> Student_Code and so on
 *         5)we can group by the value by its column id when we know that last level of conf is a redundant value such as Student_Code will never be repeated in case of above configuration so don't need to use group by otherwise use the "Group_By" as last elemnent's key name and column id name would be its value
 *         6) in case of multiple result set there must be a conf with as many element as result set is coming but key must be a relevant name to hold the specific result set but value which is an array and configuration for specific result could be null or empty i.e $conf = array("row_count" => array(), "column_configuration" => array(), "search_list" => NULL);
 *         7) callback or group by can be passed alone without passing column configuration
 *        
 */
class Respstructurebuilder {

    // put your code here
    private $response;
    // is a array object,would be db response
    private $configuration;
    // is a array object, would be configuration for level of iteration, sorting and putting and key name for object container and many more
    private $arrayContainer;
    private $callback;
    private $callbackParams;
    private $groupBy;
    private $sortBy;
    private $isMultipleResultSet;

    const GROUP_BY_KEY = "group_by";
    const CALLBACK_KEY = "callback";
    const SORT_BY_KEY = "sort_by";
    const SHOW_ALL_KEY = "show_all";

    /* sorting type */
    const SORT_BY_INTEGER = "sort_by_integer";
    const SORT_BY_DATE_ASC = "sort_by_date_asc";
    const SORT_BY_DATE_DESC = "sort_by_date_desc";
    const SORT_BY_DEFAULT = "sort_by_default";

    public function __construct() {
        
    }

    // <editor-fold defaultstate="collapsed" desc="buildResponse">
    /**
     * will build the array resp based on db resp and configuration
     * 
     * @param type $response
     *            db resp
     * @param type $configuration
     *            configuraion value for deep level structure
     * @return $this
     */
    public function buildResponse(array $response, array $configuration = null, bool $isMultipleResultSet = false) {
        $this->response = $response;
        $this->isMultipleResultSet = $isMultipleResultSet;
        $this->configuration = $configuration; // !empty($configuration) ? new ArrayObject($configuration) : NULL;
        $this->arrayContainer = array(); // initiated with empty array that would be used to store the built array or array container here
        $this->processResponse();
        return $this;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="processResponse">
    /**
     * will process the db response and check that it is single or multiple result set
     */
    private function processResponse() {
        if ($this->isMultipleResultSet) {
            $this->processMultipleResultSet();
        } else {
            $this->processSingleResultSet();
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="processMultipleResultSet">
    /**
     * will process on multiple result set
     */
    private function processMultipleResultSet() {
        try {
            if (checkArrayParam($this->configuration)) {
                $cnt = 0;
                foreach ($this->yieldGenerator($this->getIterator($this->getArrayObjectInstance($this->configuration))) as $configurationObj) {
                    if (isset($this->response[$cnt]) && checkArrayParam($this->response[$cnt])) {
                        $responseIterator = $this->getIterator($this->getArrayObjectInstance($this->response[$cnt]));
                        $configurationObjKey = $configurationObj->key();
                        $currentResultSetConfigurationObj = $configurationObj->current();
                        $configurationArrayObj = $this->processConfiguration($currentResultSetConfigurationObj, $configurationObjKey);
                        $this->processResultSet($responseIterator, $configurationArrayObj, $this->arrayContainer[$configurationObjKey], $configurationObjKey);
                    }
                    $cnt ++;
                }
            } else {
                throw "configuration and container name can't be empty in multiple result set";
            }
        } catch (Exception $ex) {
            
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="processSingleResultSet">
    /**
     * will process on single result set
     */
    private function processSingleResultSet() {
        $conf = $this->configuration;
        $confObj = $this->processConfiguration($conf);
        $response = new ArrayObject($this->response);
        $this->processResultSet($this->getIterator($response), $confObj, $this->arrayContainer);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getArrayObjectInstance">
    /**
     * will return the ArrayObject instance
     * 
     * @param type $arrayData
     * @return ArrayObject
     * @throws Exception
     */
    private function getArrayObjectInstance($arrayData) {
        $arrayObjectInstance = NULL;
        try {
            if (checkArrayParam($arrayData)) {
                $arrayObjectInstance = new ArrayObject($arrayData);
            } else {
                throw new Exception("array data can't be empty");
            }
        } catch (Exception $ex) {
            
        } finally {
            return $arrayObjectInstance;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getBuiltResponse">
    /**
     * will return the built array response after process
     * 
     * @return array
     */
    public function getBuiltResponse() {
        return $this->arrayContainer;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getIterator">
    /**
     * will return the iterator obj to iterate the db response
     * 
     * @return obj
     */
    private function getIterator($arrayObj) {
        $arrayIterator = NULL;
        if ($arrayObj instanceof ArrayObject) {
            $arrayIterator = $arrayObj->getIterator();
        }
        return $arrayIterator;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="processConfiguration">
    /**
     *
     * @param array $configuration
     * @param array $configurationKey
     *            would be the container key in multiple result set to hold the callback for specific container
     *            will process the current configuration and check the group_by stuff
     */
    private function processConfiguration(&$configuration, $configurationKey = NULL) {
        $configurationArrayObj = NULL;
        if (checkArrayParam($configuration)) {
            /* will process on configuration if group by key exists */
            $this->processIfGroupByKeyExistsInConfiguration($configuration);

            /* will process on configuration if callback key exists */
            $this->processIfCallbackKeyExistsInConfiguration($configuration, $configurationKey);

            /* will process on configuration if sort by key exists */
            $this->processIfSortByKeyExistsInConfiguration($configuration, $configurationKey);

            // instantiating the obj after removing the every key which doesn't matter in build the array element like callback and group_by
            $configurationArrayObj = $this->getArrayObjectInstance($configuration);
        }
        return $configurationArrayObj;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="processIfGroupByKeyExistsInConfiguration">
    /**
     *
     * @param array $configuration
     *            passed by callie
     *            will process on configuration if group by key exists
     */
    private function processIfGroupByKeyExistsInConfiguration(&$configuration) {
        if ($this->isKeyExistsInConfiguration($configuration, self::GROUP_BY_KEY)) {
            $this->groupBy = $configuration[self::GROUP_BY_KEY];
            unset($configuration[self::GROUP_BY_KEY]);
        } else {
            $this->groupBy = NULL;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="processIfSortByKeyExistsInConfiguration">
    /**
     *
     * @param array $configuration
     *            passed by callie
     *            will process on configuration if sort by key exists
     */
    private function processIfSortByKeyExistsInConfiguration(&$configuration) {
        if ($this->isKeyExistsInConfiguration($configuration, self::SORT_BY_KEY)) {
            $this->sortBy = $configuration[self::SORT_BY_KEY];
            unset($configuration[self::SORT_BY_KEY]);
        } else {
            $this->sortBy = NULL;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="processIfCallbackKeyExistsInConfiguration">
    /**
     * will process on configuration if callback key exists
     */
    private function processIfCallbackKeyExistsInConfiguration(&$configuration, $configurationKey = null) {
        if ($this->isKeyExistsInConfiguration($configuration, self::CALLBACK_KEY)) {
            $length = is_object($configuration[self::CALLBACK_KEY][0]) ? 2 : 1;
            $callback = array_splice($configuration[self::CALLBACK_KEY], 0, $length);
            $callback = count($callback) > 1 ? $callback : current($callback);
            if (isStringParamValid($configurationKey)) {
                $this->callback[$configurationKey] = $callback;
                $this->callbackParams = checkArrayParam($configuration[self::CALLBACK_KEY]) ? $configuration[self::CALLBACK_KEY] : "";
            } else {
                $this->callback = $callback;
                $this->callbackParams = checkArrayParam($configuration[self::CALLBACK_KEY]) ? $configuration[self::CALLBACK_KEY] : NULL;
            }
            unset($configuration[self::CALLBACK_KEY]);
        } else {
            $this->callback = NULL;
            $this->callbackParams = NULL;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="isKeyExistsInConfiguration">
    /**
     * will just check that group by
     * 
     * @param type $configuration
     * @return boolean
     */
    private function isKeyExistsInConfiguration($configuration, $key) {
        $isKeyExistsInConfiguration = FALSE;
        if (checkArrayParam($configuration) && isStringParamValid($key)) {
            if (array_key_exists($key, $configuration)) {
                $isKeyExistsInConfiguration = TRUE;
            }
        }
        return $isKeyExistsInConfiguration;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="processResultSet">
    /**
     *
     * @param ArrayIterator $responseIterator
     * @param ArrayObject $configurationArrayObj
     *            passing ArrayObject becuase in every element loop need fresh iterator of $configurationArrayObj i.e see line no 142 of this file
     * @param array $arrayContainer
     *            pass by reference which is container to hold the processed response
     * @param string $configurationObjKey
     *            which is a configuration container, won't be null in case of multiple result set
     *            will build the db response and store the processed response in arrayContainer object
     * @return $this
     */
    private function processResultSet($responseIterator, $configurationArrayObj, &$arrayContainer, $configurationObjKey = null) { // will iterate through response
        try {
            if ($configurationArrayObj instanceof ArrayObject) {
                foreach ($this->yieldGenerator($responseIterator) as $responseIteratorItem) {
                    $arrElement = $this->getProcessedArrayElemValues($responseIteratorItem, $configurationObjKey);
                    $this->buildArrayElementWithConfigure($arrayContainer, $arrElement, $this->getIterator($configurationArrayObj));
                }
                // echo '<pre>';
                // print_r($arrayContainer);
                // exit;

                $this->recursivelySorting($arrayContainer, $configurationArrayObj);
            } else {
                foreach ($this->yieldGenerator($responseIterator) as $responseIteratorItem) {
                    $arrElement = $this->getProcessedArrayElemValues($responseIteratorItem, $configurationObjKey);
                    $this->buildArrayElementWithoutConfigure($arrayContainer, $arrElement);
                }
            }
        } catch (Exception $ex) {
            
        } finally {
            return $this;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getProcessedArrayElemValues">
    /**
     * will return the processed elem values if any callback otherwise simple array obj
     * 
     * @param type $responseIteratorItem
     * @return type
     */
    private function getProcessedArrayElemValues($responseIteratorItem, $configurationObjKey = null) {
        $respIteratorItem = $responseIteratorItem->current();
        $callbackParams = is_array($this->callbackParams) ? $this->callbackParams : (array) $this->callbackParams;
        if (!is_null($this->callback)) {
            array_unshift($callbackParams, $respIteratorItem);
            if (!is_null($configurationObjKey) && isset($this->callback[$configurationObjKey])) {
                $respIteratorItem = call_user_func_array($this->callback[$configurationObjKey], $callbackParams);
            } else {
                $respIteratorItem = call_user_func_array($this->callback, $callbackParams);
            }
        }
        return $respIteratorItem;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="yieldGenerator">
    /**
     * is being used to yield the response element
     * 
     * @param type $arrIterators
     */
    private function yieldGenerator($arrIterators) {
        if (!empty($arrIterators) && $arrIterators instanceof ArrayIterator) {
            while ($arrIterators->valid()) {
                yield $arrIterators;
                $arrIterators->next();
            }
        }
    }

    // </editor-fold>
    private function buildArrayElementWithConfigure(&$arrayContainer, $arrElement, $configurationIterator) {
        $this->iterateConfigurationIteratorObj($arrayContainer, $arrElement, $configurationIterator);
    }

    private function buildArrayElementWithoutConfigure(&$arrayContainer, $arrElement) {
        $arrayContainer[] = $arrElement;
    }

    // <editor-fold defaultstate="collapsed" desc="iterateConfigurationIteratorObj">
    /**
     * will iterate through every array item and create the structure
     * 
     * @param type $arrayContainer
     * @param type $arrElement
     * @param type $configurationIterator
     * @return boolean
     */
    private function iterateConfigurationIteratorObj(&$arrayContainer, $arrElement, $configurationIterator) {
        if ($configurationIterator->valid()) {
            $key = $configurationIterator->key();
            if (isStringParamValid($this->groupBy) && $this->groupBy === $key) {
                $this->buildObjectContainerValue($arrayContainer[$this->buildObjectContainerKey($key)][$arrElement[$key]][], $arrElement, $configurationIterator);
            } else {
                $this->buildObjectContainerValue($arrayContainer[$this->buildObjectContainerKey($key)][$arrElement[$key]], $arrElement, $configurationIterator);
            }
            $configurationIterator->next();
            $this->iterateConfigurationIteratorObj($arrayContainer[$this->buildObjectContainerKey($key)][$arrElement[$key]], $arrElement, $configurationIterator);
        }
        return TRUE;
    }

    // </editor-fold>
    private function buildObjectContainerKey($keyName) { // would be the key for holding one level down object,like holding section detail object inside class_key object
        return $keyName;
    }

    // <editor-fold defaultstate="collapsed" desc="getShowingItemsIterator">
    /**
     * will return the showing items arrat iterator, will process the showing items
     * 
     * @param array|string $showingItems
     *            if callie doesn't pass the comma separated string
     * @return ArrayIterator
     */
    private function getShowingItemsIterator($showingItems): ArrayIterator {
        $showingItemsArray = $showingItems;
        $showingItemsArrayObjIterator = NULL;
        try {
            if (!is_null($showingItemsArray) && !is_array($showingItems)) {
                $showingItemsArray = strpos($showingItems, ",") >= 0 ? explode(",", $showingItems) : array(
                    $showingItems
                );
            }
            $showingItemsArrayObj = $this->getArrayObjectInstance($showingItemsArray);
            $showingItemsArrayObjIterator = $this->getIterator($showingItemsArrayObj);
        } catch (Exception $exc) {
            
        } finally {
            return $showingItemsArrayObjIterator;
        }
    }

    // </editor-fold>
    private function buildObjectContainerValue(&$arrayHolder, $arrElem, $configurationIteratorCurrentItem) {
        $showingItems = $configurationIteratorCurrentItem->current();
        if ($this->isShowAll($showingItems)) {
            $showingItems = array_keys($arrElem); // just sending the key
        }
        $showingItemsGenerator = $this->getShowingItemsIterator($showingItems);
        if (!is_null($showingItemsGenerator) && $showingItemsGenerator instanceof ArrayIterator) {
            foreach ($this->yieldGenerator($showingItemsGenerator) as $showingItemsIteObj) {
                $arrayHolder[$showingItemsIteObj->current()] = isset($arrElem[$showingItemsIteObj->current()]) ? $arrElem[$showingItemsIteObj->current()] : "";
            }
        }
    }

    // <editor-fold defaultstate="collapsed" desc="isShowAll">
    /**
     * will return the
     * 
     * @param string $showingItemsStr
     * @return boolean
     */
    private function isShowAll($showingItemsStr): bool {
        $isShowAll = FALSE;
        if (isStringParamValid($showingItemsStr) && $showingItemsStr === Respstructurebuilder::SHOW_ALL_KEY) {
            $isShowAll = TRUE;
        }
        return $isShowAll;
    }

    // </editor-fold>
    public function recursivelySorting(&$arrayVal, $configurationArrayObj) { // would be used to sort recursively when we have configure option
        if (Kahoutility::checkArrayParam($arrayVal)) {
            foreach ($arrayVal as $key => &$value) {
                if (is_array($value)) {
                    $sortType = NULL;
                    if ((Kahoutility::checkArrayParam($this->sortBy) && array_key_exists($key, $this->sortBy) && $sortType = $this->sortBy[$key] ?? $sortType) || $configurationArrayObj->offsetExists($key)) {
                        $this->sortValBySortType($sortType, $value);
                    }
                    $this->recursivelySorting($value, $configurationArrayObj);
                }
            }
        }
    }

    private function sortValBySortType($sortType, array &$arrayVal) {
        switch ($sortType) {
            case self::SORT_BY_INTEGER:
                sort($arrayVal, SORT_NUMERIC);
                break;
            case self::SORT_BY_DATE_ASC:
                usort($arrayVal, "Dateparser::sortDateStringAsc");
                break;
            case self::SORT_BY_DATE_DESC:
                usort($arrayVal, "Dateparser::sortDateStringDesc");
                break;
            default:
                sort($arrayVal);
                break;
        }
    }

}
