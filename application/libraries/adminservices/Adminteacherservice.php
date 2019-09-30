<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Adminteacherservice extends Kahoadminservices {

    public function __construct() {
        parent::__construct();
        $this->ciLibrary->load->library("processattachmentservice");
    }

    public function adminTeacherGetList() {
        $this->callGridListMethod($this->getProcedureName(), $this->processGridListParams(), "Teacher_Code");
    }

    public function teacherAdd() {
        $params = $this->getTeacherAddNUpdateParams();
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

    public function teacherUpdate() {
        $params = $this->getTeacherUpdateParams();
        $this->changeParamsPosition($params, TEACHER_CODE, 2);
        $this->kahoCrudServices->updateRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

    public function teacherDelete() {
        $params = $this->getPostParams();
        $this->addAYCodeAsFirstParam($params); // Teacher_Code
        $this->kahoCrudServices->deleteRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

    private function getTeacherAddNUpdateParams() {
        $params = $this->getPostParams();
        $params['School_Code'] = Kahoutility::getCISessionValueByKey("School_Code");
        $this->addUserCodeAsFirstParam($params)
                ->addDefaultParamToSPParams($params, "IsActive", 1)
                ->changeAllParamsPosition($params, [
                    'School_Code',
                    'First_Name',
                    'Middle_Name',
                    'Last_Name',
                    'Email',
                    'Phone',
                    'Gender',
                    'DOB',
                    'DOJ',
                    'Qualification',
                    'Address',
                    'ReportsTo',
                    'Designation_Code',
                    'Photo',
                    'IsActive'
                        ], 2);
        return $params;
    }
    
    private function getTeacherUpdateParams() {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)
                ->addDefaultParamToSPParams($params, "IsActive", 1)
                ->changeAllParamsPosition($params, [
                    'First_Name',
                    'Middle_Name',
                    'Last_Name',
                    'Email',
                    'Phone',
                    'Gender',
                    'DOB',
                    'DOJ',
                    'Qualification',
                    'Address',
                    'ReportsTo',
                    'Designation_Code',
                    'Photo',
                    'IsActive'
                        ], 2);
        return $params;
    }

    // teacherImportData
    public function teacherImportData() {
        $this->processUploadedCSV();
    }

    public function downloadTeacherCSVTemplate() {
        $this->downloadTemplate("teacher.csv");
    }

    public function uploadTeacherPicsAttachment() {
        $this->uploadAttachment($_FILES, $this->ciLibrary->processattachmentservice, TEACHERS_IMAGE_PATH);
    }

    public function designationGet() {
        $this->kahoCrudServices->getRecord($this->getProcedureName())
                ->sendResponse();
    }

}
