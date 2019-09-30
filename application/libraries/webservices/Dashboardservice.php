<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dashboardservice
 *
 * @author KaHO
 */
class Dashboardservice extends Kahoservices
{

    // put your code here
    public function __construct()
    {
        parent::__construct();
    }

    private function invokeDashboardMethod($isUserTypeParamsExists = false, $params = [])
    {
        $this->mergeAYNUserCodeToSPParams($params);
        $isUserTypeParamsExists ? $this->setDefaultValueIfPostValNotFound($params, USER_TYPE, $this->userType, 3) : "";
        $this->kahoCrudServices->getRecord($this->getProcedureName(4), $params)
            ->sendResponse();
    }

    public function getDashboardTaskCount()
    {
        $this->invokeDashboardMethod();
    }

    public function getDashboardTaskFollowUpCount()
    {
        $this->invokeDashboardMethod();
    }

    public function getDashboardNewMailCount()
    {
        $this->invokeDashboardMethod(TRUE);
    }

    public function getDashboardMeetingList()
    {
        $this->invokeDashboardMethod(TRUE);
    }

    public function getDashboardHWUpdate()
    {
        $this->invokeDashboardMethod();
    }

    public function getDashboardConcernShareCount()
    {
        $this->invokeDashboardMethod();
    }

    public function getDashboardRosterDutyList()
    {
        $this->invokeDashboardMethod();
    }

    public function getLogBookDetail()
    {
        $this->invokeDashboardMethod();
    }

    public function getDashboardTeacherObservationReview()
    {
        $this->invokeDashboardMethod();
    }

    public function getDashboardLPApprovals()
    {
        $this->invokeDashboardMethod();
    }

    public function getDashboardAnnouncement()
    {
        $this->invokeDashboardMethod(TRUE);
    }

    // <editor-fold defaultstate="collapsed" desc="invokeAYCodeNTeacherCodeParamsMethod">
    /**
     * desc will be called by every method which is using ay code and teacher code as params
     */
    private function invokeAYCodeNTeacherCodeParamsMethod($isToAddMonthNumber = false)
    {
        $params = $this->getPostParams();
        $this->addAYCodeAsFirstParam($params)->setDefaultValueIfPostValNotFound($params, 'Teacher_Code', $this->userCode, 2);
        if ($isToAddMonthNumber) {
            $this->changeAllParamsPosition($params, [
                'Month'
            ], 3);
        }
        $this->kahoCrudServices->getRecord($this->getProcedureName(4), $params)
            ->sendResponse();
    }

    // </editor-fold>
    public function getDashboardTeacherActivity()
    {
        $this->invokeAYCodeNTeacherCodeParamsMethod();
    }

    public function getDashboardLeaderList()
    {
        $this->invokeAYCodeNTeacherCodeParamsMethod(TRUE);
    }

    public function getDashboardImproveList()
    {
        $this->invokeAYCodeNTeacherCodeParamsMethod(TRUE);
    }

    public function getDashboardSubstituteDetail()
    {
        $this->invokeAYCodeNTeacherCodeParamsMethod();
    }

    public function getDashboardSubstituteCount()
    {
        $this->invokeAYCodeNTeacherCodeParamsMethod();
    }

    public function getDashboardRosterDutyTeachersList()
    {
        $this->invokeDashboardMethod();
    }

    public function getDashboardStudentAttendanceTrend()
    {
        $params = $this->getCommonParamsForStudentAttendanceIrregularityNTrends();
        $this->changeParamsPosition($params, 'Days', 5);
        $this->invokeDashboardMethod(FALSE, $params); // Days as 5th param
    }

    private function getCommonParamsForStudentAttendanceIrregularityNTrends()
    {
        $params = $this->getPostParams();
        $this->setDefaultValueIfPostValNotFound($params, IS_HIERARCHY, 1, 3)->setDefaultValueIfPostValNotFound($params, "IsSchoolwise", 0, 4);
        return $params;
    }

    public function getDashboardStudentAttendanceIrregularity()
    {
        $this->invokeDashboardMethod(FALSE, $this->getCommonParamsForStudentAttendanceIrregularityNTrends()); // 4th as Class_Code,5th Section_Code
    }

    public function getDashboardConcernList()
    {
        $params = $this->getPostParams();
        $this->mergeAYNUserCodeToSPParams($params)
            ->setDefaultValueIfPostValNotFound($params, 'IsMine', 1)
            ->setDefaultValueIfPostValNotFound($params, IS_HIERARCHY, 1)
            ->setDefaultValueIfPostValNotFound($params, "IsResolved", 0)
            ->changeAllParamsPosition($params, [
            'From_Date',
            'To_Date',
            'IsMine',
            'IsResolved',
            IS_HIERARCHY
        ], 3);
        $conf = array(
            "Concern_ID" => Respstructurebuilder::SHOW_ALL_KEY,
            Respstructurebuilder::GROUP_BY_KEY => "Concern_ID"
        );
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse($conf, FALSE, TRUE);
    }

    private function getTCWithDateRangeCommonParams()
    {
        $params = $this->getPostParams();
        $this->setDefaultValueIfPostValNotFound($params, "Teacher_Code", "")->changeAllParamsPosition($params, [
            'From_Date',
            'To_Date',
            'Teacher_Code'
        ]);
        return $params;
    }

    public function getDashboardPortionCompletion()
    {
        $params = $this->getTCWithDateRangeCommonParams();
        // another two params Class_Code,Section_Code,Subject_Code
        $this->invokeDashboardMethod(FALSE, $params);
    }

    public function getDashboardTeacherReflection()
    {
        $params = $this->getTCWithDateRangeCommonParams();
        // last params Class_Code
        $this->invokeDashboardMethod(FALSE, $params);
    }

    public function getDashboardInputPercentage()
    {
        $params = $this->getPostParams();
        $this->setDefaultValueIfPostValNotFound($params, IS_HIERARCHY, 1)->changeAllParamsPosition($params, [
            'IsAll',
            IS_HIERARCHY,
            "From_Date",
            "To_Date",
            "Filter_Type",
            "Input_Type"
        ], 3);
        $this->invokeDashboardMethod(FALSE, $params);
    }

    public function getDashboardLateComers()
    {
        $params = $this->getPostParams();
        $this->changeAllParamsPosition($params, [
            'Attendance_Date',
            'Class_Code',
            'Section_Code'
        ]);
        $this->invokeDashboardMethod(FALSE, $params);
    }

    public function getDashboardClassAttendanceCount()
    {
        $params = $this->getPostParams();
        $this->setDefaultValueIfPostValNotFound($params, IS_HIERARCHY, 1)->changeAllParamsPosition($params, [
            IS_HIERARCHY,
            "IsAll",
            "Attendance_Date"
        ]);
        $this->invokeDashboardMethod(FALSE, $params);
    }

    public function getDashboardTeacherTopicNonCoverage()
    {
        $params = $this->getTCWithDateRangeCommonParams();
        $this->mergeAYNUserCodeToSPParams($params); // Class_Code,Section_Code,Subject_Code
        $conf = array(
            "Teacher_Code" => "Teacher_Name,Teacher_Code",
            "Plan_ID" => "Plan_ID,From_Date,To_Date,Whats_Being_Taught",
            "Section_AY_Code" => "Section_AY_Code,Class_Code,Section_Code,Subject_Code,Class_Name,Section_Name,Subject_Name,RequiredPeriods,AvailablePeriods,Completed_Periods,Lagging,Lagging_Percentage",
            Respstructurebuilder::GROUP_BY_KEY => "Teacher_Code,Plan_ID,Section_AY_Code"
        );
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse($conf, FALSE, TRUE);
    }
}
