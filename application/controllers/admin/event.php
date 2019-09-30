<?php

/**
 * @created by Karthik <karthik@kaholabs.com> on 18-Aug-2015 12:15:05
 * 
 * Descripion: 
 * 
 * Security : 
 * 
 * Change History :-
 * 
 * 
 * 
 * 
 * @Audited by :-
 */
include_once 'kahoadmincontroller.php';

class Event extends Kahoadmincontroller
{

    public function __construct()
    {
        parent::__construct("eventservice");
    }

    public function addEvent()
    {
        $this->eventservice->addEvent();
    }

    // public function AddEvent() {
    // $this->object->UserId = $this->session->userdata("User_Code");
    // $this->object->Title = trim($this->input->post("Title"));
    // $this->object->Description = trim($this->input->post("Description"));
    // $this->object->Start_Date = trim($this->input->post("Start_Date"));
    // $this->object->End_Date = trim($this->input->post("End_Date"));
    // $this->object->IsHoliday = trim($this->input->post("IsHoliday"));
    // $this->kahocrudservice->addRecord($this);
    //
    // // $OutputParam = array("Result", "ErrorMsg");
    // // $res = $this->badmincalendar->Insert($this->object, $OutputParam);
    // //
    // // if ((int) $res['Result'] > 0) {
    // // GetSuccessMessage($res, "Calendar event Added Successfully");
    // // } else {
    // // $err = $res["ErrorMsg"];
    // // if (empty($err) == true) {
    // // GetErrorMessage("There is an error while adding calendar event");
    // // } else {
    // // GetErrorMessage($err);
    // // }
    // // }
    // }
    public function updateCalendarEvent()
    {
        $this->eventservice->updateCalendarEvent();
    }

    // public function UpdateCalendarEvent() {
    // $this->object->UserId = $this->session->userdata("User_Code");
    // $this->object->Calender_ID = trim($this->input->post("Calendar_Id"));
    // $this->object->Title = trim($this->input->post("Title"));
    // $this->object->Description = trim($this->input->post("Description"));
    // $this->object->Start_Date = trim($this->input->post("Start_Date"));
    // $this->object->End_Date = trim($this->input->post("End_Date"));
    // $this->object->IsHoliday = trim($this->input->post("IsHoliday"));
    // $this->kahocrudservice->updateRecord($this);
    // // $OutputParam = array("Result", "ErrorMsg");
    // // $res = $this->badmincalendar->Update($this->object, $OutputParam);
    // //
    // // if ((int) $res['Result'] > 0) {
    // // GetSuccessMessage($res, "Calendar event updated successfully");
    // // } else {
    // // $err = $res["ErrorMsg"];
    // // if (empty($err) == true) {
    // // GetErrorMessage("There is an error while updating calendar event");
    // // } else {
    // // GetErrorMessage($err);
    // // }
    // // }
    // }
    public function deleteEvent($CalendarId)
    {
        $this->eventservice->deleteEvent();
    }

    // public function DeleteEvent($CalendarId) {
    //
    // $this->object->UserId = $this->session->userdata("User_Code");
    // $this->object->DeleteId = $CalendarId;
    // $this->kahocrudservice->deleteRecord($this);
    // // $OutputParam = array("Result", "ErrorMsg");
    // // $res = $this->badmincalendar->Delete($this->object, $OutputParam);
    // // if ((int) $res['Result'] > 0) {
    // // GetSuccessMessage($res, "Calendar event deleted successfully");
    // // } else {
    // // GetErrorMessage($res["ErrorMsg"]);
    // // }
    // }
    public function getEventForEditRecord($eventCode)
    {
        $this->eventservice->getEventForEditRecord();
    }

    // public function getEventForEditRecord() {
    // $this->object->eventCode = $this->input->post("Event_Code");
    // $this->kahocrudservice->getEditRecord($this);
    // }
    public function getEventList($pageNo = 1, $noOfRecordPerPage = 10, $sorting = "1")
    {
        $this->eventservice->getEventList();
    }
    
    // public function getEventList($pageNo = 1, $noOfRecordPerPage = 10, $sorting = "1") {
    // $conf = $this->getGridListRespConf();
    // $conf[$this->gridListKey] = array("Event_Id" => "Title,Event_Description,Start,End,Event_Attachment,IsHoliday");
    // $this->processGridListParams($this->input->post(), $sorting, $pageNo, $noOfRecordPerPage);
    // $this->kahocrudservice->getList($this, $conf);
    // }
}
