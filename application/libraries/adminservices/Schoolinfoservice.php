<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Schoolinfo
 *
 * @author KaHO
 */
class Schoolinfoservice extends Kahoadminservices
{

    // put your code here
    public function __construct()
    {
        parent::__construct();
        $this->ciLibrary->load->library("processattachmentservice");
    }

    public function addSchoolInfo()
    {
        $params = $this->getParamsForSchoolInfo();
        /*
         * 'Principal_Name',
         * 'Principal_Email',
         * 'Principal_Phone',
         */
        $this->changeParamsPosition($params, "Principal_Name", 9)
            ->changeParamsPosition($params, "Principal_Email", 10)
            ->changeParamsPosition($params, "Principal_Phone", 11);
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function updateSchoolInfo()
    {
        $params = $this->getParamsForSchoolInfo();
        $this->changeParamsPosition($params, AY_CODE, 11);
        $this->kahoCrudServices->updateRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    private function getParamsForSchoolInfo(): array
    {
        $param = $this->getPostParams();
        $params['School_Code'] = Kahoutility::getCISessionValueByKey("School_Code") ;
        $this->addUserCodeAsFirstParam($param)
            ->processInputParams($param, [
            'House_Detail' => [
                "Kahoutility::splitArrayByDelimiter"
            ]
        ])
            ->changeAllParamsPosition($param, [
                'School_Code',
            'School_Name',
            'Address',
            'Phone',
            'School_Email',
            'School_Url',
            'Logo',
            'Board',
            'Start_Date',
            'End_Date',
            'IsSaturday_Working',
            'Num_Periods_Weekday',
            'Num_Periods_Saturday',
            'House_Detail'
        ], 2);
        return $param;
    }

    public function uploadSchoolLogo()
    {
        $this->uploadAttachment($_FILES, $this->ciLibrary->processattachmentservice, "school_assets", ATTACHMENT_FILE_FIELD_NAME, WORKING_DIRECTORY_ADMIN_KEY);
    }

    public function getHouseList()
    {
        $this->kahoCrudServices->getRecord($this->getProcedureName())
            ->sendResponse();
    }

    public function getSchoolInfo()
    {
        $params = $this->getPostParams();
        $params['School_Code'] = Kahoutility::getCISessionValueByKey("School_Code") ;
        $this->changeAllParamsPosition($params, [
            'School_Code'
        ], 1);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }
}
