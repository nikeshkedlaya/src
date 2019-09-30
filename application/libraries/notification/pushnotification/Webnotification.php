<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Webnotification
 *
 * @author sandeep
 */
include_once 'Abstractpushnotification.php';

class Webnotification extends Abstractpushnotification {

    //put your code here
    public function __construct($notificationData, $deviceId) {
        parent::__construct($notificationData, $deviceId);
    }

    public function buildPayload() {
        
    }

    public final function sendNotification() {
        
    }

}
