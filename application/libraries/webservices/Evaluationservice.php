<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Evaluationservice
 *
 * @author KaHO
 */
include_once getcwd() . '/application/libraries/Kahoxmlprocessor.php';

class Evaluationservice extends Kahoservices
{

    // put your code here
    public function __construct()
    {
        parent::__construct();
    }

    public function getEvaluationTemplates()
    {
        $params = $this->getPostParams();
        $this->addAYCodeAsFirstParam($params)->changeAllParamsPosition($params, [
            'Section_AY_Code',
            'Subject_Code'
        ], 2)->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse($this->getXMLTemplateConf());
    }

    private function getXMLTemplateConf(): array
    {
        return [
            Respstructurebuilder::CALLBACK_KEY => [
                "Kahoutility::convertXMLToArrayCallback",
                "Template",
                false
            ]
        ];
    }

    public function addEvaluation()
    {
        $params = $this->getPostParams();
        $this->changeAllParamsPosition($params, [
            'Teacher_Code',
            'Template_ID',
            'Conducted_On',
            'Evaluation_Title',
            'Evaluation_Description',
            'Section_AY_Code',
            'Subject_Code',
            'IsMark',
            'Max_Marks',
            'Duration',
            'Assessment_ID'
        ])->kahoCrudServices->addRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getEvaluationList()
    {
        $params = $this->getPostParams();
        $this->addAYCodeAsFirstParam($params)
            ->setDefaultValueIfPostValNotFound($params, IS_HIERARCHY, 0)
            ->setDefaultValueIfPostValNotFound($params, MINE, 1)
            ->changeAllParamsPosition($params, [
            TEACHER_CODE,
            'Section_AY_Code',
            'Subject_Code',
            'From_Date',
            'To_Date',
            MINE,
            IS_HIERARCHY
        ], 2)
            ->mergePaginationParamsToSPParams($params)->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse($this->getXMLTemplateConf());
    }

    public function getStudentsEvaluationDetail()
    {
        $params = $this->getPostParams(); // Evaluation_ID
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse([
            Respstructurebuilder::CALLBACK_KEY => [
                [
                    $this,
                    "processGetStudentsEvaluationDetailCallback"
                ]
            ]
        ]);
    }

    public function processGetStudentsEvaluationDetailCallback($arrayVal)
    {
        $arrayVal = Kahoutility::convertXMLToArrayCallback($arrayVal, "Template", FALSE);
        $arrayVal = Kahoutility::appendAbsoluteFilePath($arrayVal, "Photo", STUDENT_IMAGE_PATH, TRUE);
        return $arrayVal;
    }

    public function addStudentEvaluationDetail()
    {
        $params = $this->getPostParams();
        $this->processInputParams($params, [
            "Template_XML" => [
                "Kahoxmlprocessor::convertJSONStringToXML"
            ]
        ])->changeAllParamsPosition($params, [
            'Evaluation_ID',
            'Student_Code',
            'Comments',
            'Template_XML',
            'Marks',
            'Grade'
        ])->kahoCrudServices->addRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }
}
