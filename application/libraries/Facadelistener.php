<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FacadeListener
 *
 * @author KaHO
 */
class Facadelistener {

    //put your code here
    private static $facadeListenerIns;
    private $ciLibrary;

    private function __construct() {
        $this->ciLibrary = Kahoutility::getCILibrary();
        $this->ciLibrary->load->Iface("Dbcrudlistenerinterface");
        include_once 'listeners/Cachelisteners.php';
        include_once 'listeners/Notificationlisteners.php';
    }

    public static function getFacadeListenerIns() {
        if (is_null(self::$facadeListenerIns)) {
            self::$facadeListenerIns = new Facadelistener();
        }
        return self::$facadeListenerIns;
    }

    public function registerNotificationListener(string $listenerClassName, string $listenerClassMethodName, $callbackParams = null) {
        try {
            if ($this->isListenerClassExists($listenerClassName) && $this->isListenerClassMethodExists($listenerClassMethodName)) {
                Dbcrudsubject::getDBCrudSubjectIns()->registerListener($this->ciLibrary->listernClass, $listenerClassMethodName, $callbackParams);
            }
        } catch (Exception $exc) {
            
        } finally {
            return $this;
        }
    }

    public function registerCacheListener(string $listenerClassName, string $listenerClassMethodName, $callbackParams = null) {
        try {
            if ($this->isListenerClassExists($listenerClassName) && $this->isListenerClassMethodExists($listenerClassMethodName)) {
                
            }
        } catch (Exception $exc) {
            
        } finally {
            return $this;
        }
    }

    // <editor-fold defaultstate="collapsed" desc="isListenerClassExists">
    /**
     * desc will check that listener class exists or not such as child class of cache and notification listener
     * @param string $listenerClassName
     * @throws Exception
     */
    private function isListenerClassExists(string $listenerClassName) {
        if ($isListenerClassExists = file_exists(APPPATH . "libraries/" . $listenerClassName . ".php") === true) {
            $this->ciLibrary->load->library($listenerClassName, NULL, "listernClass");
        }
        return $isListenerClassExists;
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="isListenerClassMethodExists">
    /**
     * desc will check that listener class method exists or not such as child class of cache and notification listener
     * @param string $listenerClassMethodName
     * @throws Exception
     */
    private function isListenerClassMethodExists(string $listenerClassMethodName) {
        $isListenerClassMethodExists = FALSE;
        try {
            if (method_exists($this->ciLibrary->listernClass, $listenerClassMethodName)) {
                $isListenerClassMethodExists = TRUE;
            } else {
                throw new Exception("method name " . $listenerClassMethodName . " doesn't exists");
            }
        } catch (Exception $exc) {
            
        } finally {
            return $isListenerClassMethodExists;
        }
    }

// </editor-fold>
}
