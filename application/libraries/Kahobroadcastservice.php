<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Kahobroadcastservice
 *
 * @author KaHO
 */
class Kahobroadcastservice {

    // put your code here
    private $registeredListenerContainer = array();

    public function __construct() {
        
    }

    // <editor-fold defaultstate="collapsed" desc="registerListener">
    /**
     * will be used by service class to register itself to listen broadcast
     * 
     * @param type $keyname
     * @param type $callback
     */
    public function registerListener($keyname, $callback) {
        try {
            if (Kahoutility::isStringParamValid($keyname) && is_callable($callback)) {
                $this->setListener($keyname, $callback);
            }
        } catch (LogicErrorException $logicErrExcep) {
            
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="setListener">
    /**
     * will be used to set the listener inside registeredListenerContainer
     * 
     * @param type $keyname
     *            // would be key name, inside callback would be registered
     * @param type $listener
     *            // a $listener to be invoked when something broadcast
     */
    private function setListener($keyname, $listener) {
        if (!isset($this->registeredListenerContainer[$keyname])) {
            $this->registeredListenerContainer[$keyname] = array();
        }
        array_push($this->registeredListenerContainer[$keyname], $listener);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="broadcast">
    /**
     * will be used to broadcast message by invoking every callback if listener registered
     * 
     * @param type $keyname
     * @param type $data
     */
    public function broadcast(string $keyname, $data = null) {
        try {
            if (Kahoutility::isStringParamValid($keyname)) {
                $this->processListenerCallback($keyname, $data);
            }
        } catch (LogicErrorException $logicErrExcep) {
            
        }
    }

    // </editor-fold>

    /**
     * would be invoked by broadcast method with data to broadcast, will iterate through every listener registered into registeredListenerContainer
     * 
     * @param type $keyname
     * @param type $data
     */
    private function processListenerCallback(string $keyname, $data) {
        if (checkArrayParam($this->registeredListenerContainer)) {
            foreach ($this->registeredListenerContainer as $key => $val) {
                if ($keyname === $key) {
                    $this->invokeListenerCallback($val, $data);
                    break;
                }
            }
        }
    }

    // <editor-fold defaultstate="collapsed" desc="invokeListenerCallback">
    /**
     *
     * @param type $callbackArray
     *            would be index array as callback val
     * @param type $broadcastData
     */
    private function invokeListenerCallback($callbackArray, $broadcastData) {
        if (checkArrayParam($callbackArray)) {
            foreach ($callbackArray as $callback) {
                if (is_callable($callback)) {
                    call_user_func($callback, $broadcastData);
                }
            }
        }
    }

    // </editor-fold>
}
