<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Homeworknotificationlistener
 *
 * @author KaHO
 */
final class Kahogallerynotificationlistener extends Notificationlisteners
{

    // put your code here
    public function __construct()
    {
        parent::__construct();
    }

    public function sendSharedGalleryNotification(array $dbResponse, array $inputParams)
    {
        $this->ciLibrary->notificationbuilder->setUserCode($inputParams['Users'])
            ->setAudienceType(AUDIENCE_TYPE_USERS_WITH_GROUP)
            ->setEventType("sharing_gallery")
            ->setMessageFormatterValue(Kahoapplicationservice::getKaHOAppSerIns()->getLoggedInUserName())
            ->build()
            ->sendNotification();
    }
}
