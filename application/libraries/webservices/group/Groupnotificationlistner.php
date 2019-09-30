<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Groupnotificationlistner
 *
 * @author Rakshith B.K<rakshith@kaholabs.com>
 */
class Groupnotificationlistner extends Notificationlisteners {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function sendAddGroupNotification($dbResponse, $inputParams) {
        $formatterMessage = [$inputParams['Group_Name'], Kahoapplicationservice::getKaHOAppSerIns()->addLoggedInUserInGroup()];

        $this->ciLibrary->notificationbuilder
                ->setUserCode($inputParams['Users'])
                ->setEventType("add_group")
                ->setAudienceType(AUDIENCE_TYPE_GROUPS)
                ->setMessageFormatterValue($formatterMessage)
                ->build()->sendNotification();
    }

}
