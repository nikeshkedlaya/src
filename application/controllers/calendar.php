<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of calendar
 *
 * @author KaHO
 */
class calendar extends KaHO_Controller
{

    // put your code here
    public function __construct()
    {
        parent::__construct("calendar/calendarservice");
    }

    public function getEvents()
    {
        $this->calendarservice->getEvents();
    }

    public function addMeetingRequest()
    {
        $this->calendarservice->addMeetingRequest();
    }

    public function addCalendarEvent()
    {
        $this->calendarservice->addCalendarEvent();
    }

    public function uploadEventAttachment()
    {
        $this->calendarservice->uploadEventAttachment();
    }

    public function getUpComingEvents()
    {
        $this->calendarservice->getUpComingEvents();
    }
}
