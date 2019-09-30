<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Attendancenotificationlistener
 *
 * @author KaHO
 */
class Attendancenotificationlistener extends Notificationlisteners
{

    // put your code here
    public function __construct()
    {
        parent::__construct();
    }

    public function sendAddAttendanceNotification($dbResponse, $inputParams)
    {
        $this->ciLibrary->notificationbuilder->setUserCode($inputParams['absent_students'])
            ->setEventType("student_attendance_add")
            ->setAudienceType(AUDIENCE_TYPE_STUDENT)
            ->setMessageFormatterValue($inputParams['attendance_date'], Kahoapplicationservice::getKaHOAppSerIns()->getLoggedInUserName())
            ->build()
            ->sendNotification();
    }

    public function sendUpdateAttendanceNotification($dbResponse, $inputParams)
    {
        $this->ciLibrary->notificationbuilder->setUserCode($inputParams['Students'])
            ->setEventType("student_attendance_update")
            ->setAudienceType(AUDIENCE_TYPE_STUDENT)
            ->setMessageFormatterValue(Kahoapplicationservice::getKaHOAppSerIns()->getLoggedInUserName())
            ->build()
            ->sendNotification();
    }
}
