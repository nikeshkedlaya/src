<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NotificationFactory
 * wo
 * @author KaHO
 */
include_once APPPATH . 'libraries/notification/Notificationabstractfactory.php';

class EmailnotificationFactory extends Notificationabstractfactory {

    /**
     * @var Notificationbuilder
     */
//put your code here

    public function __construct(Notificationbuilder $notificationBuilder) {
        parent::__construct($notificationBuilder);
    }

    public function initNotificationRequest() {
        
    }

    public function sendNotification() {
        
    }

}
