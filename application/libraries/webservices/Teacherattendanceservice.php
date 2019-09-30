<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Teacherattendanceservice
 *
 * @author KaHO
 */
class Teacherattendanceservice extends Kahoservices {

    // put your code here
    public function __construct() {
        parent::__construct();
    }

    public function getTeachersForAttendance() {
        $params = $this->getPostParams(); // Date
        $params['School_Code'] = Kahoutility::getCISessionValueByKey("School_Code");
        $this->addUserCodeAsFirstParam($params); //
        // $respProcessingConf = [];
        // $respProcessingConf["Attendance_Taken_Status"] = array(
        // "IsTaken" => Respstructurebuilder::SHOW_ALL_KEY
        // );
        // $respProcessingConf["Teacher_Code"] = array_merge(array(
        // "Teacher_Code" => Respstructurebuilder::SHOW_ALL_KEY
        // ), Kahoutility::getTeacherImageConfForAppend());
        $this->changeAllParamsPosition($params, [
            "School_Code",
            "Date"
                ], 2);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
                ->sendResponse(Kahoutility::getTeacherImageConfForAppend(), false, false);
    }

    public function addTeacherAttendance() {
        $params = $this->getPostParams();
        $params['School_Code'] = Kahoutility::getCISessionValueByKey("School_Code");
        $this->addUserCodeAsFirstParam($params)
                ->changeParamsPosition($params, "School_Code", 2)
                ->changeParamsPosition($params, "Date", 3)
                ->changeParamsPosition($params, "AbsentTeachers", 4)
                ->processInputParams($params, [
                    "AbsentTeachers" => [
                        "Kahoutility::splitArrayByDelimiter"
                    ]
        ]);
        
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

    public function getSubstituteTeacher() {
        $params = $this->getPostParams(); // Teacher_Code
        $this->setDefaultValueIfPostValNotFound($params, "Date", date(DATE_FORMAT), 2);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

    public function addSubstitute() {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)
                ->setDefaultValueIfPostValNotFound($params, "Date", date(DATE_FORMAT), 2)
                ->changeParamsPosition($params, "DataIn", 3);
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

    public function getTeachersForSubstitute() {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params); // Date;
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
                ->sendResponse(Kahoutility::getTeacherImageConfForAppend());
    }

}
