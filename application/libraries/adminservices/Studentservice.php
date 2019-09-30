<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Studentservice extends Kahoadminservices
{

    public function __construct()
    {
        parent::__construct();
        $this->ciLibrary->load->library("processattachmentservice");
    }

    public function studentImportData()
    {
        $this->processUploadedCSV();
    }

    public function getAdminStudentList()
    {
        $this->callGridListMethod($this->getProcedureName(), $this->processGridListParams(), "Student_Code");
    }

    public function studentAdd()
    {
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $this->getStudentParams())
            ->sendResponse();
    }

    public function studentUpdate()
    {
        $params = $this->getStudentParams();
        $this->changeParamsPosition($params, "Student_Code", 2);
        $this->kahoCrudServices->updateRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function studentDelete()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params); // Student_Code
        $this->kahoCrudServices->deleteRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function uploadStudentPicsAttachment()
    {
        $this->uploadAttachment($_FILES, $this->ciLibrary->processattachmentservice, STUDENT_IMAGE_PATH);
    }

    public function downloadStudentCSVTemplate()
    {
        $this->downloadTemplate();
    }

    private function getStudentParams()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)->changeAllParamsPosition($params, [
            'Admission_No',
            'Roll_No',
            'Student_First_Name',
            'Student_Middle_Name',
            'Student_Last_Name',
            'Student_Gender',
            'Student_DOB',
            'Student_Admission_Date',
            'SAY_Code',
            'Father_Name',
            'Father_Email',
            'Father_Phone',
            'Father_Occupation',
            'Mother_Name',
            'Mother_Email',
            'Mother_Phone',
            'Mother_Occupation',
            'Local_Address',
            'Permanent_Address',
            'Student_Special_Notes',
            'Student_Allergic_To',
            'Student_Photo'
        ], 2);
        return $params;
    }
}
