<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tasknotificationlistner
 *
 * @author Rakshith B.K<rakshith@kaholabs.com>
 */
class Tasknotificationlistner extends Notificationlisteners
{

    // put your code here
    public function __construct()
    {
        parent::__construct();
    }

    public function sendAddTaskNotification($dbResponse, $inputParams)
    {
        $this->ciLibrary->notificationbuilder->setUserCode($inputParams['Assigned_To'])
            ->setEventType("add_teacher_task")
            ->setAudienceType(AUDIENCE_TYPE_TEACHER)
            ->setMessageFormatterValue($inputParams['Title'], Kahoapplicationservice::getKaHOAppSerIns()->getLoggedInUserName())
            ->build()
            ->sendNotification();
    }

    public function sendUpdateTaskNotification($dbResponse, $inputParams)
    {
        $this->ciLibrary->notificationbuilder->setUserCode($dbResponse[0]['TRANSACTION_ID'])
            ->setEventType("update_teacher_task")
            ->setAudienceType(AUDIENCE_TYPE_TEACHER)
            ->setMessageFormatterValue(Kahoapplicationservice::getKaHOAppSerIns()->getLoggedInUserName())
            ->build()
            ->sendNotification();
    }
}
