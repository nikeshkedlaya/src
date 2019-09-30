<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Generalservice
 *
 * @author KaHO
 */
class Generalservice extends Kahoservices {

    public function __construct() {
        parent::__construct();
        $this->ciLibrary->load->library("processattachmentservice");
    }

    public function updateMDM() {
        $params = $this->getPostParams();
        $params['School_Code'] = Kahoutility::getCISessionValueByKey("School_Code");
        $this->addUserCodeAsFirstParam($params)
                ->changeAllParamsPosition($params, [
                    'School_Code',
                    'Date',
                    'Is_Served',
                    'Number_Served',
                    'Reason_ID',
                    'Remarks',
                    // 'Attachment',
                    UPLOADED_ATTACHMENT
//                    "Is_Offline"
                        ], 2)->processAttachedData($params, $this->ciLibrary->processattachmentservice);

//        print_r($params); exit ;

        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

    public function updateFacility() {
        $params = $this->getPostParams();
        $params['School_Code'] = Kahoutility::getCISessionValueByKey("School_Code");
        $this->addUserCodeAsFirstParam($params)
                ->changeAllParamsPosition($params, [
                    'School_Code',
                    'Facility_Detail',
                    'Date',
                    'General_Comment'
//                    "Is_Offline"
                        ], 2);

        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

    public function getFacilities() {
        $params = array();
        $params['School_Code'] = Kahoutility::getCISessionValueByKey("School_Code");
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

    public function getMDMUpdates() {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)
                ->changeAllParamsPosition($params, [
                    'From_Date',
                    'To_Date'
                        ], 2);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
                ->sendResponse(Kahoutility::getParseAttachmentXMLStringConfiguration("announcement")
        );
    }

}
