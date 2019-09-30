<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reportservice
 *
 * @author KaHO
 */
class Reportservice extends Kahoservices{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->ciLibrary->load->library("processattachmentservice");
    }
    
    public function getAttendanceSummary(){
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)
                ->changeAllParamsPosition($params, [
            'Type',
            'Date'
        ], 2);
        
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }
    
    public function getCalendarEventsForADay(){
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)
                ->changeAllParamsPosition($params, [
            'Date'
        ], 2);
        
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }
    
    public function getInspectionSummary(){
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params);
        
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }
    
    public function getOverallSummary(){
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params);
        
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }
    
    public function getAttendanceSummaryBlockwise(){
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)
                ->changeAllParamsPosition($params, [
            'Type',
            'Date'
        ], 2);
        
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }
    
    public function getAttendanceDetailBlockwise(){
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)
                ->changeAllParamsPosition($params, [
            'Type',
            'Date',
            'Block_ID'
        ], 2);
        
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }
    
    public function getMDMSummary(){
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)
                ->changeAllParamsPosition($params, [
            'Date'
        ], 2);
        
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }
    
    public function getMDMSummaryBlockwise(){
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)
                ->changeAllParamsPosition($params, [
            'Date'
        ], 2);
        
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }
    
    public function getMDMReasonSummary(){
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)
                ->changeAllParamsPosition($params, [
            'Date'
        ], 2);
        
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }
    
    public function getMDMReasonSummaryBlockwise(){
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)
                ->changeAllParamsPosition($params, [
            'Date'
        ], 2);
        
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }
    
    public function getFacilityDetail(){
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)
                ->changeAllParamsPosition($params, [
            'Search_Keyword'
        ], 2);
        
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }
    
    public function getSchoolsList(){
        $params = $this->getPostParams();
        $this->setDefaultValueIfPostValNotFound($params, 'Block_ID', 0)
                ->addUserCodeAsFirstParam($params)
                ->changeAllParamsPosition($params, [
                    'Block_ID',
            'Search_Keyword'
        ], 2);
        
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }
    
    public function getFacilityDetailBySchool(){
        $params = $this->getPostParams();
        $this->changeAllParamsPosition($params, [
                    'School_Code'
        ], 1);
        
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }
    
    public function getFacilitySummary(){
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params);
        
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }
    
    public function getFacilitySummaryDetail(){
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)
                ->changeAllParamsPosition($params, [
            'Facility_ID', 'Type'
        ], 2);
        
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }
    
    public function getMDMDetailSchoolList(){
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)
                ->changeAllParamsPosition($params, [
            'Date', 'Block_ID','Is_Served'
        ], 2);
        
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse(Kahoutility::getParseAttachmentXMLStringConfiguration("announcement"));
    }
    
    public function rptAnnouncementDetailAdd(){
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)
            ->changeAllParamsPosition($params, [
            "Subject",
            "Message",
            UPLOADED_ATTACHMENT
        ], 2)
            ->processAttachedData($params, $this->ciLibrary->processattachmentservice);
        
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }
    
    public function getAnnouncements(){
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params);
        
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse(Kahoutility::getParseAttachmentXMLStringConfiguration("announcement"));
    }
    
}
