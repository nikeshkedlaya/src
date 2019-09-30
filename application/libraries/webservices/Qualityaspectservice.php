<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Qualityaspectservice
 *
 * @author KaHO
 */
include_once getcwd() . '/application/libraries/Kahoxmlprocessor.php';

class Qualityaspectservice extends Kahoservices
{

    // put your code here
    public function __construct()
    {
        parent::__construct();
    }

    public function getQualityCheckList()
    {
        $params = $this->getPostParams();
        $this->mergeAYNUserCodeToSPParams($params)->changeAllParamsPosition($params, [
            'Section_AY_Code',
            'Subject_Code',
            'Teacher_Code'
        ], 3)->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getStudentListQuality()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)->changeAllParamsPosition($params, [
            'Section_AY_Code',
            'Filter_Type',
            'Num_Students'
        ], 2)->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse(Kahoutility::getStudentImageConfForAppend(), FALSE, false);
    }

    public function qualityDetailAdd()
    {
        $params = $this->getPostParams();
        $this->setDefaultValueIfPostValNotFound($params, USER_CODE, $this->userCode, 1)
            ->setDefaultValueIfPostValNotFound($params, 'Header_ID', NULL)
            ->processInputParams($params, [
            'Student_Codes' => [
                "Kahoutility::splitArrayByDelimiter"
            ],
            "CheckList" => [
                "Kahoxmlprocessor::convertJSONStringToXML"
            ]
        ])
            ->changeAllParamsPosition($params, [
            'Header_ID',
            'Section_AY_Code',
            'Teacher_Code',
            'Subject_Code',
            'Student_Codes',
            'CheckList'
        ], 2)->kahoCrudServices->addRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getQualityListForUser()
    {
        $params = $this->getPostParams();
        $this->mergeAYNUserCodeToSPParams($params)
            ->setDefaultValueIfPostValNotFound($params, IS_HIERARCHY, 1)
            ->changeAllParamsPosition($params, [
            'Section_AY_Code',
            'Teacher_Code',
            'Subject_Code',
            IS_HIERARCHY
        ], 3)
            ->mergePaginationParamsToSPParams($params)->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getQualityDetail()
    {
        // Quality_Aspect_ID
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $this->getPostParams())
            ->sendResponse([
            Respstructurebuilder::CALLBACK_KEY => [
                [
                    $this,
                    "getQualityDetailResponseCallback"
                ],
                "",
                FALSE
            ]
        ]);
    }

    public function getQualityDetailResponseCallback($val)
    {
        $val = Kahoutility::convertXMLToArrayCallback($val, 'XML_Data', FALSE);
        $val = Kahoutility::appendAbsoluteFilePath($val, "Photo", STUDENT_IMAGE_PATH, true);
        return $val;
    }
}
