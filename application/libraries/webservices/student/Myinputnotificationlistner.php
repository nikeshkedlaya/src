<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Myinputnotificationlistner
 *
 * @author Rakshith B.K<rakshith@kaholabs.com>
 */
class Myinputnotificationlistner extends Notificationlisteners
{

    // put your code here
    public function __construct()
    {
        parent::__construct();
    }

    public function sendAddComplimentNotification(array $dbResponse, $inputParams): void
    {
        $this->ciLibrary->notificationbuilder->setUserCode($inputParams['StudentCodes'])
            ->setEventType("add_compliments")
            ->setAudienceType(AUDIENCE_TYPE_STUDENT)
            ->setMessageFormatterValue(Kahoapplicationservice::getKaHOAppSerIns()->getLoggedInUserName())
            ->build()
            ->sendNotification();
    }

    public function sendAddObservationNotification(array $dbResponse, $inputParams): void
    {
        $this->ciLibrary->notificationbuilder->setUserCode($inputParams['StudentCodes'])
            ->setEventType("add_observation")
            ->setAudienceType(AUDIENCE_TYPE_STUDENT)
            ->setMessageFormatterValue(Kahoapplicationservice::getKaHOAppSerIns()->getLoggedInUserName())
            ->build()
            ->sendNotification();
    }
}
