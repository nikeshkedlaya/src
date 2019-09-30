<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Timetableservice
 *
 * @author KaHO
 */
include_once getcwd() . '/application/libraries/Kahoxmlprocessor.php';

class Timetableservice extends Kahoservices
{

    // put your code here
    public function __construct()
    {
        parent::__construct();
    }

    public function getTimeTable()
    {
        $postParams = $this->getPostParams();
        $this->addAYCodeAsFirstParam($postParams)->changeAllParamsPosition($postParams, [
            TEACHER_CODE,
            SECTION_AY_CODE
        ], 2);
        // ->setDefaultValueIfPostValNotFound($postParams, USER_CODE, $this->userCode, 2)
        // ->setDefaultValueIfPostValNotFound($postParams, "sayCode", NULL, 3);
        $resp = $this->kahoCrudServices->getRecord($this->getProcedureName(), $postParams)
            ->getResponse();
        if (! $this->kahoCrudServices->isDBOperationSuccess()) {
            $this->kahoCrudServices->printResponse(NULL, FALSE, Kahoutility::getCallieFunctionName(1));
        } else {
            $anotherVal = [];
            foreach ($resp as $val) {
                if (! isset($anotherVal['Monday'])) {
                    $anotherVal['Monday'] = [];
                }
                if (! isset($anotherVal['Tuesday'])) {
                    $anotherVal['Tuesday'] = [];
                }
                if (! isset($anotherVal['Wednesday'])) {
                    $anotherVal['Wednesday'] = [];
                }
                if (! isset($anotherVal['Thursday'])) {
                    $anotherVal['Thursday'] = [];
                }
                if (! isset($anotherVal['Friday'])) {
                    $anotherVal['Friday'] = [];
                }
                if (! isset($anotherVal['Saturday'])) {
                    $anotherVal['Saturday'] = [];
                }
                $getValByDay = function ($day, $val) {
                    $array = [];
                    $array['Period'] = $val['Period'];
                    // $array['Timings'] = $val['Timings'];
                    $array['Subject'] = Kahoutility::isStringParamValid($val[$day]) ? $val[$day] : "Free Period";
                    return $array;
                };
                array_push($anotherVal['Monday'], $getValByDay("Monday", $val));
                array_push($anotherVal['Tuesday'], $getValByDay("Tuesday", $val));
                array_push($anotherVal['Wednesday'], $getValByDay("Wednesday", $val));
                array_push($anotherVal['Thursday'], $getValByDay("Thursday", $val));
                array_push($anotherVal['Friday'], $getValByDay("Friday", $val));
                array_push($anotherVal['Saturday'], $getValByDay("Saturday", $val));
            }
            // sort($anotherVal);
        }
        $this->kahoCrudServices->printResponse($anotherVal, TRUE, Kahoutility::getCallieFunctionName(1));
    }

    public function getTeacherTimeTable()
    {
        $spParams = [];
        $this->mergeAYNUserCodeToSPParams($spParams);
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
            $vals['Class_Section_Subject_Label'] = is_null($vals['Subject_Code']) ? "--" : $vals['Class_Section_Subject'];
        }
        return $vals;
    }

    public function addOrUpdateTeacherTimeTable()
    {
        $params = $this->getPostParams();
        $this->addAYCodeAsFirstParam($params)
            ->setDefaultValueIfPostValNotFound($params, "Teacher_Code", $this->userCode, 2)
            ->processInputParams($params, [
            'Data_XML' => [
                "Kahoxmlprocessor::convertJSONStringToXML"
            ]
        ])
            ->changeAllParamsPosition($params, [
            'Data_XML',
            'Week_Day',
            'ClassTeacher_Section_AY_Code'
        ], 3)->kahoCrudServices->addRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }
}
