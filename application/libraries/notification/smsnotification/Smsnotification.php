<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Smsnotification
 * wo
 * @author KaHO
 */
class Smsnotification implements Notificationinterface {

    /**
     * @var Notificationbuilder
     */
    private $notificationBuilder;
    private $ciLibrary;
    private $bManagerObj;

//put your code here

    public function __construct(Notificationbuilder $notificationBuilder, $bManagerObj) {
        $this->ciLibrary = GetCILibrary();
        $this->notificationBuilder = $notificationBuilder;
        $this->bManagerObj = $bManagerObj;
    }

    public function buildNotificationData() {
        ;
    }

    public function sendNotification() {
        ;
    }

}
