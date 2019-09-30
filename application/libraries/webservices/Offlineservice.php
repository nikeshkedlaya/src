<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Offlineservice
 *
 * @author KaHO
 */
class Offlineservice extends Kahoservices{
    public function __construct() {
        parent::__construct();
    }
    
    public function offlineSchoolAttendanceAdd(){
        $params = $this->getPostParams();
        $this->changeAllParamsPosition($params, [
            'School_Code',
            'School_User_Code',
            'Attendance_Date',
            'SAY_Code',
            'Period',
            'Absent_Student_Code'
        ], 2);
        
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }
    
    public function offlineUpdateMDM(){
        $params = $this->getPostParams();
        $this
                ->setDefaultValueIfPostValNotFound($params, 'Number_Served', 0)
                ->setDefaultValueIfPostValNotFound($params, 'Reason_ID', 0)
                ->changeAllParamsPosition($params, [
            'School_Code',
            'School_User_Code',
            'Date',
            'Is_Served',
            'Number_Served',
            'Reason_ID',
            'Remarks',
            'Attachment'
        ], 2);
        
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }
    
    public function offlineUpdateFacility(){
        $params = $this->getPostParams();
        $this->changeAllParamsPosition($params, [
            'School_Code',
            'School_User_Code',
            'Facility_Detail',
            'Date',
            'General_Comment'
        ], 2);
        
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }
    
    public function offlineAddCalendarEvent(){
        $params = $this->getPostParams();
        $this->changeAllParamsPosition($params, [
            'School_Code',
            'School_User_Code',
            'Group_IDs',
            'Short_Desc',
            'Desc',
            'Start_Date',
            'End_Date',
            'IsHoliday',
            'Attachment',
            'Tags'
        ], 2);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }
}
