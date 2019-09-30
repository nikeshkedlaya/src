<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Postparamsbuilder
 *
 * @author KaHO
 */
trait Postparamsbuilder {

    //put your code here
    // <editor-fold defaultstate="collapsed" desc="mergeAYNUserCodeToSPParams">
    /**
     * will merge the ay code and usercode to procedures params
     * 
     * @param array $spParams
     * @param int $ayCodePos
     * @param int $userCodePos
     */
    protected function mergeAYNUserCodeToSPParams(array &$spParams, int $ayCodePos = 1, int $userCodePos = 2): Kahoservices {
        try {
            if (is_array($spParams)) {
                $this->addDefaultParamToSPParams($spParams, AY_CODE, $this->ayCode, $ayCodePos)->setDefaultValueIfPostValNotFound($spParams, USER_CODE, $this->userCode, $userCodePos);
            }
        } catch (Exception $exc) {
            
        } finally {
            return $this;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="setDefaultValueIfPostValNotFound">
    /**
     * will manipulate the post param value,and return either post value or default value
     * 
     * @param type $postVal
     * @param type $defaultVal
     * @param int $position
     *            will add the value to default pos
     * @return type
     */
    protected function setDefaultValueIfPostValNotFound(array &$arrayParams, string $arrayParamsKey, $defaultVal = null, $position = 0): Kahoservices {
        try {
            if (is_array($arrayParams) && Kahoutility::isStringParamValid($arrayParamsKey)) {
                if (!isset($arrayParams[$arrayParamsKey]) || $arrayParams[$arrayParamsKey] === "" || is_null($arrayParams[$arrayParamsKey]) || $arrayParams[$arrayParamsKey] === "null") {
                    $arrayParams[$arrayParamsKey] = $defaultVal;
                }
            }
            if ($position > 0) {
                $this->changeParamsPosition($arrayParams, $arrayParamsKey, $position);
            }
        } catch (Exception $ex) {
            
        } finally {
            return $this;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getUriSegments">
    /**
     * will return the uri segments param or get params
     * 
     * @return array
     */
    protected function getUriSegments(int $segmentCnt = 3): array {
        $segments = [];
        $segmentVal = "";
        while (($segmentVal = $this->ciLibrary->uri->segment($segmentCnt)) !== FALSE) {
            $segments[$segmentVal . "_" . $segmentCnt] = $segmentVal;
            ++$segmentCnt;
        }
        return $segments;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getPostParams">
    /**
     * will return the post params
     * 
     * @return array
     */
    protected function getPostParams() {
        $postParams = $this->ciLibrary->input->post();
        if ($postParams === FALSE) {
            $postParams = [];
        } else {
            ksort($postParams, SORT_STRING | SORT_FLAG_CASE);
        }
        return $postParams;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="processInputParams">
    /**
     *
     * @param array $input
     * @param array $callbackContainer
     *            would be the key and value, key name would be input param key name and its value would be callback array container where first elem would be callback or next elem would be params of callback such as ["Student_Code" => ["Kahoutility::splitArrayByDelimiter"]].could be used to change the format and split the array into string using any delimter
     * @param array $defaultParams
     *            would be default param which may not be available in post but procedure is expecting
     * @return array processed post or get items
     */
    public function processInputParams(array &$input, array $callbackContainer = null) {
        try {
            if (Kahoutility::checkArrayParam($input) && Kahoutility::checkArrayParam($callbackContainer)) {
                foreach ($callbackContainer as $callbackContainerKey => $callbackContainerVal) {
                    if (array_key_exists($callbackContainerKey, $input)) {
                        $input[$callbackContainerKey] = Kahoutility::invokeCallback($input[$callbackContainerKey], $callbackContainerVal);
                    }
                }
            }
        } catch (Exception $exc) {
            
        } finally {
            return $this;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="addDefaultParamToSPParams">
    /**
     * will process the default params means if any params is not provided by client then service can pass one or more param which will add to the main param container at given position, such as not sending the date post param but procedure is expecting then we have to use this method
     * 
     * @param array $defaultParams
     */
    protected function addDefaultParamToSPParams(array &$spParams, string $arrayKey, string $arrayVal = null, int $position = 0) {
        try {
            if (is_array($spParams) && Kahoutility::isStringParamValid($arrayKey) && !array_key_exists($arrayKey, $spParams)) {
                $spParams[$arrayKey] = $arrayVal;
                if ($position > 0) {
                    $this->changeParamsPosition($spParams, $arrayKey, $position);
                }
            }
        } catch (Exception $exc) {
            // array_slice($spParams, 0, $position - 1, TRUE) + array($arrayKey => $arrayVal) + array_slice($spParams, $position - 1, count($spParams), TRUE);
        } finally {
            return $this;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="changeParamsPosition">
    /**
     * will change the position of input params as per procedure requires of existing key in post/get params
     * 
     * @param array $arrayParams
     * @param string $arrayParamsKey
     * @param int $position
     * @return type
     */
    protected function changeParamsPosition(array &$arrayParams, string $arrayParamsKey, int $position): Kahoservices {
        Kahoutility::changeArrayParamsPosition($arrayParams, $arrayParamsKey, $position);
        return $this;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="changeAllParamsPosition">
    /**
     * will change the params position in bulk
     * 
     * @param array $arrayParams
     * @param array $arrayParamsKeyArray
     * @return \Kahoservices
     */
    public function changeAllParamsPosition(array &$arrayParams, array $arrayParamsKeyArray, int $startFrom = 1): Kahoservices {
        try {
            if (Kahoutility::checkArrayParam($arrayParams) && Kahoutility::checkArrayParam($arrayParamsKeyArray)) {
                foreach ($arrayParamsKeyArray as $key => $val) {
                    $this->changeParamsPosition($arrayParams, $val, $key + $startFrom);
                }
            }
        } catch (Exception $exc) {
            
        } finally {
            return $this;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="mergeAYNStudentCodeToSPParams">
    /**
     * will merge the ay code and selected student code to procedures params
     * 
     * @param array $spParams
     * @param int $ayCodePos
     * @param int $userCodePos
     */
    protected function mergeAYNStudentCodeToSPParams(array &$spParams, int $ayCodePos = 1, int $userCodePos = 2): Kahoservices {
        try {
            if (is_array($spParams)) {
                $this->addDefaultParamToSPParams($spParams, AY_CODE, $this->ayCode, $ayCodePos)->setDefaultValueIfPostValNotFound($spParams, SELECTED_STUDENT_CODE, Kahoutility::getSelectedStudentCode(), $userCodePos);
            }
        } catch (Exception $exc) {
            
        } finally {
            return $this;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="mergePaginationParamsToSPParams">
    /**
     * will merge the ay code and usercode to procedures params
     * 
     * @param array $spParams
     */
    protected function mergePaginationParamsToSPParams(array &$spParams): Kahoservices {
        try {
            if (is_array($spParams)) {
                $this->changeParamsPosition($spParams, PAGE_NO_KEY, count($spParams))->changeParamsPosition($spParams, NO_OF_RECORD_KEY, (array_search(PAGE_NO_KEY, array_keys($spParams), true) + 1));
            }
        } catch (Exception $exc) {
            
        } finally {
            return $this;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="addUserCodeAsFirstParam">
    /**
     * will add the user code to first params
     * 
     * @param array $spParams
     */
    protected function addUserCodeAsFirstParam(array &$spParams,$pos=2): Kahoservices {
        try {
            $this->setDefaultValueIfPostValNotFound($spParams, USER_CODE, $this->userCode, 1);
        } catch (Exception $exc) {
            
        } finally {
            return $this;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="addAYCodeAsFirstParam">
    /**
     * will add the user code to first params
     * 
     * @param array $spParams
     */
    protected function addAYCodeAsFirstParam(array &$spParams): Kahoservices {
        try {
            $this->addDefaultParamToSPParams($spParams, AY_CODE, $this->ayCode, 1);
        } catch (Exception $exc) {
            
        } finally {
            return $this;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="addUserCodeOrStudentCodeToParams">
    /**
     * desc will add the student code if parent logged in otherwise teacher code
     * 
     * @param array $spParams
     * @return \Kahoservices
     */
    public function addUserCodeOrStudentCodeToParams(array &$spParams, $pos = 1): Kahoservices {
        try {
            $userCode = $this->userType === USER_TYPE_PARENT ? Kahoutility::getSelectedStudentCode() : $this->userCode;
            $this->addDefaultParamToSPParams($spParams, USER_CODE, $userCode, $pos);
        } catch (Exception $exc) {
            
        } finally {
            return $this;
        }
    }

    // </editor-fold>
}
