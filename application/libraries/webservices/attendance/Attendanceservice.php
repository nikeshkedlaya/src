<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Attendanceservice
 *
 * @author KaHO
 */
class Attendanceservice extends Kahoservices
{

    // put your code here
    public function __construct()
    {
        parent::__construct();
    }

    private function getListenerClassPath()
    {
        return parent::getListenerClassBasePath() . "attendance/Attendancenotificationlistener";
    }

    public function getAttendancePeriodList()
    {
        $params = $this->getPostParams();
        $this->addAYCodeAsFirstParam($params)->changeAllParamsPosition($params, [
            SECTION_AY_CODE,
            TEACHER_CODE,
            "attendance_date"
        ], 2);
        $response = $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->getResponse();
        if ($this->kahoCrudServices->isDBOperationSuccess()) {
            $this->pustPeriodTitle($response);
        }
        $this->kahoCrudServices->printResponse($response, FALSE, "getAttendancePeriodList");
    }

    private function pustPeriodTitle(&$response)
    {
        if (Kahoutility::checkArrayParam($response)) {
            foreach ($response as $key => &$value) {
                $value['period_title'] = ($key === (int) 0 ? "Morning" : ($key === (int) 1 ? "Afternoon" : "Period " . $value['PeriodNum']));
                if ($value['Absent_Count'] === "-") {
                    $presentStudentCnt = 0;
                } else {
                    $absentCount = explode("/", $value['Absent_Count']);
                    $totalStudentCnt = (int) $absentCount[1];
                    $presentStudentCnt = (int) $absentCount[0];
                    $presentStudentCnt = Kahoutility::getPercent($presentStudentCnt, $totalStudentCnt);
                }
                $value['Present_Percent'] = $presentStudentCnt;
            }
        }
    }

    public function getStudentsForAttendance()
    {
        $params = $this->getPostParams();
        $this->changeAllParamsPosition($params, [
            "SAYCode",
            "periodno",
            "attendance_date"
        ]);
        $resp = $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->
        sendResponse(Kahoutility::getStudentImageConfForAppend());
    }

    public function attendanceAdd()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)
            ->changeAllParamsPosition($params, [
            "attendance_date",
            "SAYCode",
            "periodno",
            "absent_students"
//                "Is_Offline"
        ], 2)
            ->setDefaultValueIfPostValNotFound($params, "absent_students", null)
            ->processInputParams($params, [
            'absent_students' => [
                "Kahoutility::splitArrayByDelimiter"
            ]
        ]);
        Facadelistener::getFacadeListenerIns()->registerNotificationListener($this->getListenerClassPath(), "sendAddAttendanceNotification", $params);
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function updateStudentAttendance()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)
            ->changeAllParamsPosition($params, [
            'Attendance_ID',
            'Students'
        ], 2)
            ->processInputParams($params, [
            'Students' => [
                "Kahoutility::splitArrayByDelimiter",
                MULTIPLE_ATTACHMENT_DELIMITER
            ]
        ]);
        Facadelistener::getFacadeListenerIns()->registerNotificationListener($this->getListenerClassPath(), "sendUpdateAttendanceNotification", $params);
        $this->kahoCrudServices->updateRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getAttendanceCount()
    {
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $this->getAnalysisParams())
            ->sendResponse();
    }

    public function getAttendanceTrend()
    {
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $this->getAnalysisParams(FALSE))
            ->sendResponse();
    }

    public function getAttendanceTrendForMonth()
    {
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $this->getAnalysisParams())
            ->sendResponse();
    }

    public function getAttendanceNotTakenDetail()
    {
        $params = $this->getPostParams();
        $this->mergeAYNUserCodeToSPParams($params)
            ->addDefaultParamToSPParams($params, IS_HIERARCHY, 0)
            ->addDefaultParamToSPParams($params, "IsAll", 1)
            ->changeAllParamsPosition($params, [
            'Attendance_Date',
            "IsAll",
            IS_HIERARCHY
        ], 3); // Attendance_Date
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }
}
