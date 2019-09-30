<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of report
 *
 * @author KaHO
 */
class Report extends KaHO_Controller {
    
    public function __construct() {
        parent::__construct("reportservice");
    }
    
    public function getAttendanceSummary(){
        $this->reportservice->getAttendanceSummary();
    }
    
    public function getCalendarEventsForADay(){
        $this->reportservice->getCalendarEventsForADay();
    }
    
    public function getInspectionSummary(){
        $this->reportservice->getInspectionSummary();
    }
    
    public function getOverallSummary(){
        $this->reportservice->getOverallSummary();
    }
    
    public function getAttendanceSummaryBlockwise(){
        $this->reportservice->getAttendanceSummaryBlockwise();
    }
    
    public function getAttendanceDetailBlockwise(){
        $this->reportservice->getAttendanceDetailBlockwise();
    }
    
    public function getMDMSummary(){
        $this->reportservice->getMDMSummary();
    }
    
    public function getMDMSummaryBlockwise(){
        $this->reportservice->getMDMSummaryBlockwise();
    }
    
    public function getMDMReasonSummary(){
       $this->reportservice->getMDMReasonSummary();
    }
    
    public function getMDMReasonSummaryBlockwise(){
       $this->reportservice->getMDMReasonSummaryBlockwise();
    }
    
    public function getFacilityDetail(){
       $this->reportservice->getFacilityDetail();
    }
    
    public function getSchoolsList(){
       $this->reportservice->getSchoolsList();
    }
    
    public function getFacilityDetailBySchool(){
       $this->reportservice->getFacilityDetailBySchool();
    }
    
    public function getFacilitySummary(){
       $this->reportservice->getFacilitySummary();
    }
    
    public function getFacilitySummaryDetail(){
       $this->reportservice->getFacilitySummaryDetail();
    }
    
    
    public function getMDMDetailSchoolList(){
       $this->reportservice->getMDMDetailSchoolList();
    }
        
    public function rptAnnouncementDetailAdd(){
       $this->reportservice->rptAnnouncementDetailAdd();
    }
    public function getAnnouncements(){
       $this->reportservice->getAnnouncements();
    }
}
