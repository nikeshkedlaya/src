<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Announcementnotificationlistener
 *
 * @author KaHO
 */
class Announcementnotificationlistener extends Notificationlisteners {

    //put your code here

    public function __construct() {
        parent::__construct();
    }


    public function sendAddAnnouncementNotification($dbResponse, $inputParams) {
        $this->ciLibrary->notificationbuilder
                ->setUserCode($inputParams['Announce_To'])
                ->setEventType("add_announcement")
                ->setAudienceType(AUDIENCE_TYPE_GROUPS)
                ->setMessageFormatterValue(Kahoapplicationservice::getKaHOAppSerIns()->getLoggedInUserName())
                ->build()->sendNotification();
    }

}
