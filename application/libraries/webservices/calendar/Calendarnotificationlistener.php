<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Calendarnotificationlistener
 *
 * @author Rakshith B.K<rakshith@kaholabs.com>
 */
class Calendarnotificationlistener extends Notificationlisteners
{

    // put your code here
    public function __construct()
    {
        parent::__construct();
    }

    public function sendMeetingRequestNotification($dbResponse, $inputParams)
    {
        $notificationMsgVals = array();
        $this->ciLibrary->notificationbuilder->setUserCode($inputParams['Attendees'])
            ->setEventType("add_meeting_request")
            ->setAudienceType(AUDIENCE_TYPE_USERS_WITH_GROUP)
            ->setEventSpecificData(array(
            "reminder" => "true",
            "reminder_message" => $inputParams['Subject'],
            "reminder_time" => $inputParams['Meeting_From']
        ))
            ->setMessageFormatterValue($inputParams['Subject'], Kahoapplicationservice::getKaHOAppSerIns()->getLoggedInUserName(), $inputParams['Meeting_From'])
            ->build()
            ->sendNotification();
    }

    public function sendAddCalendarEventNotification($dbResponse, $inputParams)
    {
        $this->ciLibrary->notificationbuilder->setUserCode($inputParams['Group_IDs'])
            ->setEventType("calender_event_create")
            ->setAudienceType(AUDIENCE_TYPE_GROUPS)
            ->setMessageFormatterValue($inputParams['Short_Desc'], Kahoapplicationservice::getKaHOAppSerIns()->getLoggedInUserName(), $inputParams['Start_Date'])
            ->build()
            ->sendNotification();
    }
}
