<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Phpsessionservice
 *
 * @author KaHO
 */
include 'Kahosessionhandler.php';

class Phpsessionservice
{

    // put your code here
    private static $phpSessionServiceInstance;

    private function __construct()
    {
        session_start();
//        $kahosessionHandler = new Kahosessionhandler();
//        if (session_start() === PHP_SESSION_NONE) {
//            ini_set('session.save_handler', 'files');
//            session_set_save_handler($kahosessionHandler, true);
//            session_start();
//        }
    }

    // <editor-fold defaultstate="collapsed" desc="getPHPSessionServiceInstance">
    /**
     * will return the Phpsessionservice object
     *
     * @return Phpsessionservice
     */
    public static function getPHPSessionServiceInstance()
    {
        if (is_null(self::$phpSessionServiceInstance)) {
            self::$phpSessionServiceInstance = new Phpsessionservice();
        }
        return self::$phpSessionServiceInstance;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="createPHPSessionId">
    public static function createPHPSessionId()
    {
        session_create_id();
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="setPHPSessionValueByKey">
    /**
     * will set the php session by key
     *
     * @param string $sessionKeyName
     * @param type $sessionValue
     * @return void
     */
    public function setPHPSessionValueByKey(string $sessionKeyName, $sessionValue): void
    {
        try {
            if (Kahoutility::isStringParamValid($sessionKeyName)) {
                $_SESSION[$sessionKeyName] = $sessionValue;
            }
        } catch (Exception $exc) {}
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getPHPSessionValueByKey">
    /**
     * will return the session value by key
     *
     * @param string $sessionKeyName
     * @return string|null
     */
    public function getPHPSessionValueByKey(string $sessionKeyName)
    {
        $phpSessionValueByKey = NULL;
        try {
            if (Kahoutility::isStringParamValid($sessionKeyName) && isset($_SESSION[$sessionKeyName])) {
                $phpSessionValueByKey = $_SESSION[$sessionKeyName];
            }
        } catch (Exception $exc) {} finally {
            return $phpSessionValueByKey;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="unsetPHPSessionValueByKey">
    /**
     * will unset the php session by key
     *
     * @param string $sessionKeyName
     * @return void
     */
    public function unsetPHPSessionValueByKey(string $sessionKeyName)
    {
        try {
            if (Kahoutility::isStringParamValid($sessionKeyName) && isset($_SESSION[$sessionKeyName])) {
                unset($_SESSION[$sessionKeyName]);
            }
        } catch (Exception $exc) {}
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="unsetWholePHPSession">
    /**
     * will unset the whole php session
     */
    public function unsetWholePHPSession()
    {
        // session_gc();
        session_destroy();
    }
    
    // </editor-fold>
}
