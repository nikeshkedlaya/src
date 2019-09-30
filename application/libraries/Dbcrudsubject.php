<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dbcrudsubject
 * would be notifing the all service observer if any crud happens
 *
 * @author KaHO
 */
final class Dbcrudsubject {

    //put your code here
    private static $dbCrudSubjectIns;
    private $listenerPool;

    private function __construct() {
        $this->listenerPool = [];
    }

    public static function getDBCrudSubjectIns(): Dbcrudsubject {
        if (is_null(self::$dbCrudSubjectIns)) {
            self::$dbCrudSubjectIns = new Dbcrudsubject();
        }
        return self::$dbCrudSubjectIns;
    }

    public function registerListener(Dbcrudlistenerinterface $dbcrudlistenerinterface, string $callback, array $callbackParams=null): void {
        try {
            if ($dbcrudlistenerinterface instanceof Dbcrudlistenerinterface && $this->isListenerRegistered($dbcrudlistenerinterface, $callback) === FALSE) {
                $this->listenerPool[$callback] = [$dbcrudlistenerinterface, $callbackParams];
            } else {
                throw new Exception("here is the exception");
            }
        } catch (Exception $exc) {
            
        }
    }

    private function isListenerRegistered(Dbcrudlistenerinterface $dbcrudlistenerinterface, string $callback): bool {
        return (array_key_exists($callback, $this->listenerPool) && ($this->listenerPool[$callback][0] instanceof $dbcrudlistenerinterface));
    }

    public function unRegisterListener(Dbcrudlistenerinterface $dbcrudlistenerinterface, string $callback): void {
        try {
            if ($this->isListenerRegistered($dbcrudlistenerinterface, $callback)) {
                unset($this->listenerPool[$callback]);
            }
        } catch (Exception $exc) {
            
        }
    }

    public function update(Kahocrudservices $kahocrudservices, $dbCrudResponse): void {
        try {
            if ($kahocrudservices instanceof Kahocrudservices && Kahoutility::checkArrayParam($this->listenerPool)) {
                foreach ($this->listenerPool as $key => $value) {
                    $dbcrudlistenerinterfaceObj = current($value);
                    $dbcrudlistenerinterfaceObj->update($key, $dbCrudResponse, end($value));
                }
            } else {
                throw new Exception("sdsdd");
            }
        } catch (Exception $exc) {
            
        }
    }

}
