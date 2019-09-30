<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Iphonenotification
 *
 * @author KaHO
 */
class Iphonenotification extends Abstractnotification {

    //put your code here
    //put your code here
    public function __construct($notificationData, $deviceId) {
        parent::__construct($notificationData, $deviceId);
    }
    public function buildPayload() {
        
    }

    public final function sendNotification() {
        
    }

}
