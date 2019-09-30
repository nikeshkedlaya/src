<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Kahoapplicationservice
 * would be a common class for application level context from http request to http response
 * 
 * @author KaHO
 */
class Kahoapplicationservice {

    // put your code here
    private static $kahoapplicationservice;
    private $userCode;
    private $userId;
    private $userType;
    private $ciLibrary;
    private $getClientConfiguraion;
    private $getRequestedSubDomainName;
    private $ayCode;
    private $loggedInUserName;

    private function __construct() {
        $this->ciLibrary = Kahoutility::getCILibrary();
    }

    // <editor-fold defaultstate="collapsed" desc="getKaHOAppSerIns">
    /**
     * will return the kahoapplication service object
     * 
     * @return type
     */
    public static function getKaHOAppSerIns() {
        if (is_null(self::$kahoapplicationservice)) {
            self::$kahoapplicationservice = new Kahoapplicationservice();
        }
        return self::$kahoapplicationservice;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getUserCode">
    /**
     * will return the user code
     * 
     * @return type
     */
    public function getUserCode() {
        if (!Kahoutility::isStringParamValid($this->userCode)) {
            $this->userCode = $this->ciLibrary->session->userdata("User_Code");
        }
        return $this->userCode;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getLoggedInUserName">
    /**
     * will return the user code
     * 
     * @return type
     */
    public function getLoggedInUserName() {
        if (!Kahoutility::isStringParamValid($this->loggedInUserName)) {
            $this->loggedInUserName = $this->ciLibrary->session->userdata("Name");
        }
        return $this->loggedInUserName;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getUserId">
    /**
     * will return the user id
     * 
     * @return type
     */
    public function getUserId() {
        if (!Kahoutility::isStringParamValid($this->userId)) {
            $this->userId = $this->ciLibrary->session->userdata("User_Id");
        }
        return $this->userId;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getUserType">
    /**
     * will return the user type
     * 
     * @return type
     */
    public function getUserType() {
        $this->userType = null;
        if (!Kahoutility::isStringParamValid($this->userType)) {
            $this->userType = $this->ciLibrary->session->userdata("User_Type");
        }
        return $this->userType;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="isUserTypeTeacher">
    /**
     * will return true if user type is teacher else false
     */
    public function isUserTypeTeacher() {
        $isUserTypeTeacher = true;
        if ($this->getUserType() !== USER_TYPE_TEACH) {
            $isUserTypeTeacher = false;
        }
        return $isUserTypeTeacher;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="isUserTypeParent">
    /**
     * will return true if user type is parent else false
     */
    public function isUserTypeParent() {
        $isUserTypeParent = true;
        if ($this->getUserType() !== USER_TYPE_PARENT) {
            $isUserTypeParent = false;
        }
        return $isUserTypeParent;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getClientConfiguraion">
    /**
     * will return thje client configuration
     * 
     * @return type
     */
    public function getClientConfiguraion(): array {
        if (!Kahoutility::checkArrayParam($this->getClientConfiguraion)) {
            $this->getClientConfiguraion = $this->ciLibrary->config->item($this->getRequestedHostSubDomainName());
        }
        return $this->getClientConfiguraion;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getRequestedHostSubDomainName">
    /**
     * will return the sub domain name so that we can find client identity
     * 
     * @return strning
     */
    public function getRequestedHostSubDomainName(): string {
        if (!Kahoutility::isStringParamValid($this->getRequestedSubDomainName)) {
            $host = $_SERVER['HTTP_HOST'];
            $getRequestedHostName = current(explode(".", $host));
            $this->getRequestedSubDomainName = $getRequestedHostName === "192" ? "development" : $getRequestedHostName;
        }
        return $this->getRequestedSubDomainName;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getAYCode">
    /**
     * will return the ay code
     * 
     * @return type
     */
    public function getAYCode() {
        if (!Kahoutility::isStringParamValid($this->ayCode)) {
            $this->ayCode = Kahoutility::getCISessionValueByKey("AY_Code");
        }
        return $this->ayCode;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="setAYCode">
    /**
     * will set the ay code
     */
    public function setAYCode($ayCode) {
        if (Kahoutility::isStringParamValid($ayCode)) {
            Kahoutility::getCILibrary()->session->set_userdata("AY_Code", $ayCode);
            $this->ayCode = NULL;
        }
    }

    // </editor-fold>
}
