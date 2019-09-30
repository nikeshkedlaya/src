<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of learningresourcelistner
 *
 * @author Rakshith B.K<rakshith@kaholabs.com>
 */
class Learningresourcenotificationlistener extends Notificationlisteners
{

    // put your code here
    public function __construct()
    {
        parent::__construct();
    }

    public function sendSharedLearningResourceNotification($dbResponse, $inputParams)
    {
        $this->ciLibrary->notificationbuilder->setUserCode($inputParams['Users'])
            ->setEventType("share_learning_resource")
            ->setAudienceType(AUDIENCE_TYPE_USERS_WITH_GROUP)
            ->setMessageFormatterValue($inputParams['Title'], Kahoapplicationservice::getKaHOAppSerIns()->getLoggedInUserName())
            ->build()
            ->sendNotification();
    }
}
