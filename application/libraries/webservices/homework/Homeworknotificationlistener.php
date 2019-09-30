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
final class Homeworknotificationlistener extends Notificationlisteners
{

    // put your code here
    public function __construct()
    {
        parent::__construct();
    }

    public function sendAssignHomeworkNotification(array $dbResponse, array $inputParams)
    {
        $this->ciLibrary->notificationbuilder->setUserCode($inputParams['SAYCode'])
            ->setAudienceType(AUDIENCE_TYPE_CLASS_SECTION)
            ->setEventType("add_hw_details")
            ->setMessageFormatterValue(Kahoapplicationservice::getKaHOAppSerIns()->getLoggedInUserName())
            ->build()
            ->sendNotification();
    }

    public function sendUpdateHomeworkNotification(array $dbResponse, array $inputParams)
    {
        $this->ciLibrary->notificationbuilder->setUserCode($inputParams['Pending_Student_Code'])
            ->setAudienceType(AUDIENCE_TYPE_STUDENT)
            ->setEventType("hw_update")
            ->setMessageFormatterValue(Kahoapplicationservice::getKaHOAppSerIns()->getLoggedInUserName())
            ->build()
            ->sendNotification();
    }
}
