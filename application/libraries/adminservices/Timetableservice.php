<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once getcwd() . '/application/libraries/Kahoxmlprocessor.php';

class Timetableservice extends Kahoadminservices
{

    public function __construct()
    {
        parent::__construct();
    }

    public function setupAddClassTimeTable()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)
            ->processInputParams($params, [
            'Data_XML' => [
                "Kahoxmlprocessor::convertJSONStringToXML"
            ]
        ])
            ->changeAllParamsPosition($params, [
            'Section_AY_Code',
            'Data_XML'
        ], 2);
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function setupGetClassTimeTable()
    {
        $params = $this->getPostParams(); // Section_AY_Code
        $conf = array(
            "Week_Day" => Respstructurebuilder::SHOW_ALL_KEY,
            Respstructurebuilder::GROUP_BY_KEY => "Week_Day",
            Respstructurebuilder::CALLBACK_KEY => [
                [
                    $this,
                    "appendClassSectionSubjectLabel"
                ]
            ],
            Respstructurebuilder::SORT_BY_KEY => [
                "Week_Day" => Respstructurebuilder::SORT_BY_INTEGER
            ]
        );
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse($conf, FALSE, TRUE);
    }

    public function addOrUpdateTeacherTimeTable()
    {
        $params = $this->getPostParams();
        $this->addDefaultParamToSPParams($params, "Week_Day", NULL)
            ->processInputParams($params, [
            'Data_XML' => [
                "Kahoxmlprocessor::convertJSONStringToXML"
            ]
        ])
            ->changeAllParamsPosition($params, [
            AY_CODE,
            "Teacher_Code",
            'Data_XML',
            'Week_Day',
            'ClassTeacher_Section_AY_Code'
        ]);
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getTeacherTimeTable()
    {
        $spParams = $this->getPostParams();
        $conf = array(
            "Week_Day" => Respstructurebuilder::SHOW_ALL_KEY,
            Respstructurebuilder::GROUP_BY_KEY => "Week_Day",
            Respstructurebuilder::CALLBACK_KEY => [
                [
                    $this,
                    "appendClassSectionSubjectLabel"
                ]
            ],
            Respstructurebuilder::SORT_BY_KEY => [
                "Week_Day" => Respstructurebuilder::SORT_BY_INTEGER
            ]
        );
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $spParams)
            ->sendResponse($conf, FALSE, TRUE);
    }

    public function appendClassSectionSubjectLabel($vals)
    {
        if (Kahoutility::checkArrayParam($vals)) {
            // $vals['Class_Section_Subject_Label'] = is_null($vals['Subject_Code']) ? "--" : $vals['Class_Section_Subject'];
        }
        return $vals;
    }
}
