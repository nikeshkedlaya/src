<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Notificationabstractfactory
 *  abstract level notification factory of notification factories such as push notification,sms notification and email notification factory,
 * @author KaHO
 */
abstract class Notificationabstractfactory {

    //put your code here
    protected $notificationEventConfiguration;
    protected $notificationBuilder;
    protected $ciLibrary;

    public function __construct(Notificationbuilder $notificationBuilder) {
        $this->ciLibrary = Kahoutility::getCILibrary();
        $this->notificationBuilder = $notificationBuilder;
        $this->initNotificationRequest();
    }

    protected abstract function initNotificationRequest();

    protected abstract function sendNotification();
}
