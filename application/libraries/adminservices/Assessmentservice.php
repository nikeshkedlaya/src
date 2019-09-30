<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Assessmentservice extends Kahoadminservices
{

    public function __construct()
    {
        parent::__construct();
    }

    public function asssessmentAdd()
    {
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $this->getAssessmentAddNUpdateParams())
            ->sendResponse();
    }

    private function getAssessmentAddNUpdateParams()
    {
        $params = $this->getPostParams();
        $this->getUsercodeNAYCode($params)->changeAllParamsPosition($params, [
            'Assessment_Name',
            'Start_Date',
            'End_Date',
            'Marks'
        ], 3);
        return $params;
    }

    private function getUsercodeNAYCode(&$params)
    {
        $this->addUserCodeAsFirstParam($params)->addDefaultParamToSPParams($params, AY_CODE, $this->ayCode, 2);
        return $this;
    }

    public function getClassSectionListForAssessment()
    {
        $params = $this->getPostParams(); // Assessment_ID
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getClassSubjectListForAssessment()
    {
        $params = $this->getPostParams(); // Assessment_ID
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function asssessmentUpdate()
    {
        $params = $this->getAssessmentAddNUpdateParams();
        $this->changeParamsPosition($params, "Assessment_ID", 2);
        $this->kahoCrudServices->updateRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function assessmentDelete()
    {
        $params = $this->getPostParams(); // Assessment_ID
        $this->kahoCrudServices->deleteRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function assessmentCreatedGetList()
    {
        $params = [];
        $this->getUsercodeNAYCode($params);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function assessmentDetailGetList()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)->changeAllParamsPosition($params, [
            'Year',
            'Month'
        ], 2);
        $conf = [
            "Assessment_Id" => "Assessment_Id,Assessment_Id,From_Date,Start_Date,Event_Type_Name,End_Date,To_Date,Name,Max_Mark",
            "Assessment_Detail_Id" => "Assessment_Detail_Id,Assessment_Date,Class_Code,Class_Name,Section_Code,Section_Name,Max_Mark,Subject_Code,Subject_Name",
            Respstructurebuilder::GROUP_BY_KEY => "Assessment_Id,Assessment_Detail_Id",
            Respstructurebuilder::CALLBACK_KEY => [
                [
                    $this,
                    "processAsessmentResponse"
                ]
            ]
        ];
        $resp = $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->
        // getResponse();
        // print_r($resp);
        // exit();
        sendResponse($conf, false, true);
    }

    public function processAsessmentResponse($arrayVal)
    {
        $arrayVal['Start_Date'] = $arrayVal['From_Date'];
        $arrayVal['Event_Type_Name'] = "assessment";
        $arrayVal['End_Date'] = $arrayVal['To_Date'];
        return $arrayVal;
    }

    private function asssessmentDetailUpdateNAddNDeleteParams()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)->changeAllParamsPosition($params, [
            "Assessment_ID",
            "Assessment_Details"
        ], 2);
        return $params;
    }

    private function assessmentDetailAddOrUpdateOrDelete()
    {
        return $this->getProcedureName(2);
    }

    public function asssessmentDetailUpdate()
    {
        $this->kahoCrudServices->updateRecord($this->assessmentDetailAddOrUpdateOrDelete(), $this->asssessmentDetailUpdateNAddNDeleteParams())
            ->sendResponse();
    }

    public function asssessmentDetailAdd()
    {
        $this->kahoCrudServices->addRecord($this->assessmentDetailAddOrUpdateOrDelete(), $this->asssessmentDetailUpdateNAddNDeleteParams())
            ->sendResponse();
    }

    public function asssessmentDetailDelete()
    {
        $this->kahoCrudServices->deleteRecord($this->assessmentDetailAddOrUpdateOrDelete(), $this->asssessmentDetailUpdateNAddNDeleteParams())
            ->sendResponse();
    }

    public function adminAssessmentDetailSectionGetList()
    {
        $this->callGridListMethod($this->getProcedureName(), $this->processGridListParams(), "Assessment_Detail_Section_ID");
    }
}
