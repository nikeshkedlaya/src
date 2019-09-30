<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Howschooldoingservice
 *
 * @author KaHO
 */
class Howschooldoingservice extends Kahoservices
{

    // put your code here
    public function __construct()
    {
        parent::__construct();
    }

    public function getAssessmentList()
    {
        $params = $this->getPostParams();
        $this->mergeAYNUserCodeToSPParams($params)->setDefaultValueIfPostValNotFound($params, MINE, "1", 3);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getGrades()
    {
        $this->kahoCrudServices->getRecord($this->getProcedureName())
            ->sendResponse();
    }

    public function getClasswiseGraph()
    {
        $params = $this->getClassNSectionWiseParams();
        $this->addAYCodeAsFirstParam($params)->processInputParams($params, [
            'Class_Code' => [
                "Kahoutility::splitArrayByDelimiter",
                ","
            ],
            'Grade' => [
                "Kahoutility::splitArrayByDelimiter",
                ","
            ]
        ]);
        $conf = array(
            "Class_Code" => Respstructurebuilder::SHOW_ALL_KEY,
            Respstructurebuilder::GROUP_BY_KEY => "Class_Code"
        );
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse($conf, FALSE, TRUE);
    }

    private function getClassNSectionWiseParams()
    { // for method getClasswiseGraph,getClassSectionwiseGraph
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)
            ->setDefaultValueIfPostValNotFound($params, "Assessment_Id", NULL)
            ->changeAllParamsPosition($params, [
            'Class_Code',
            'Grade',
            'Assessment_Id'
        ], 2);
        return $params;
    }

    public function getClassSectionwiseGraph()
    {
        $params = $this->getClassNSectionWiseParams();
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getClassSectionSubjectwiseGraph()
    {
        $params = $this->getClassNSectionWiseParams();
        $this->changeParamsPosition($params, "Section_Code", 3);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getClassSectionStudentGraph()
    {
        $params = $this->getClassNSectionWiseParams();
        $this->changeAllParamsPosition($params, [
            'Section_Code',
            'Subject_Code'
        ], 3);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getTeacherSubjectwiseGraph()
    {
        $params = $this->getTeacherSubjectNClasswiseGraphParam();
        $this->addAYCodeAsFirstParam($params)->processInputParams($params, [
            'Teacher_Code' => [
                "Kahoutility::splitArrayByDelimiter",
                ","
            ],
            'Subject_Code' => [
                "Kahoutility::splitArrayByDelimiter",
                ","
            ],
            'Grade' => [
                "Kahoutility::splitArrayByDelimiter",
                ","
            ]
        ]);
        $conf = array(
            "Teacher_Subject" => Respstructurebuilder::SHOW_ALL_KEY,
            Respstructurebuilder::GROUP_BY_KEY => "Teacher_Subject"
        );
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse($conf, FALSE, true);
    }

    private function getTeacherSubjectNClasswiseGraphParam()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)
            ->setDefaultValueIfPostValNotFound($params, "Assessment_Id", NULL)
            ->changeAllParamsPosition($params, [
            'Assessment_Id',
            'Teacher_Code',
            'Subject_Code',
            'Grade'
        ], 2);
        return $params;
    }

    public function getTeacherSubjectClasswiseGraph()
    {
        $params = $this->getTeacherSubjectNClasswiseGraphParam();
        $this->changeParamsPosition($params, 'Subject_Code', 5);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getTeacherSubjectClassSectionwiseGraph()
    {
        $params = $this->getTeacherSubjectNClasswiseGraphParam();
        $this->changeAllParamsPosition($params, [
            'Grade',
            'Class_Code',
            'Subject_Code'
        ], 4);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getTeacherSubjectClassSectionStudentGraph()
    {
        $params = $this->getTeacherSubjectNClasswiseGraphParam();
        $this->changeAllParamsPosition($params, [
            'Grade',
            'Class_Code',
            'Section_Code',
            'Subject_Code'
        ], 4);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }
}
