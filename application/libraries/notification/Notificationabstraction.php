<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NotificationAbstraction
 *
 * @author Quadir
 */
get_instance()->load->Iface("NotificationInterface");

abstract class NotificationAbstraction implements NotificationInterface {

    //put your code here

    private $getPlatformSpecificConfiguration;
    private $deviceId;
    private $notificationData;
    private $ciLibrary;
    private $platformType;

    public function __construct($platformType, $deviceID) {
        $this->deviceId = $deviceID;
        $this->platformType = $platformType;
        $this->ciLibrary = GetCILibrary();
        $this->ciLibrary->config->load("push_notification_conf");
        $this->getPlatformSpecificConfiguration = $this->ciLibrary->config->item("push_notification_conf")[$this->platformType];
    }

    public function getDevicesIdByUser($UserId, $eventType) { // fetching the device id from db based on user code for parents
        try {
            if (empty($UserId) === false) {
                return ['APA91bHSawf20OlBU-4lG2Qh7xLgEFOC9lkPAKN1ez1ltusEILqGV2mhbbxVfnoh1s_hKfn5jtP4Ru4Cnp83hi_slTlaex9Um5hSbNwY946m1Vet6b6OeT1JCGM7Tppq22QJ-PM78fFv'];
            } else {
                throw new Pushnotificationexception(__METHOD__ . " 's param must be an object");
            }
        } catch (Pushnotificationexception $pushExp) {
            
        }
    }

}
