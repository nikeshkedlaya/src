<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dashboard
 *
 * @author KaHO
 */
class Dashboard extends KaHO_Controller
{

    // put your code here
    public function __construct()
    {
        parent::__construct("dashboardservice");
    }

    public function getDashboardTaskCount()
    {
        $this->dashboardservice->getDashboardTaskCount();
    }

    public function getDashboardTaskFollowUpCount()
    {
        $this->dashboardservice->getDashboardTaskFollowUpCount();
    }

    public function getDashboardNewMailCount()
    {
        $this->dashboardservice->getDashboardNewMailCount();
    }

    public function getDashboardMeetingList()
    {
        $this->dashboardservice->getDashboardMeetingList();
    }

    public function getDashboardHWUpdate()
    {
        $this->dashboardservice->getDashboardHWUpdate();
    }

    public function getDashboardConcernShareCount()
    {
        $this->dashboardservice->getDashboardConcernShareCount();
    }

    public function getDashboardRosterDutyList()
    {
        $this->dashboardservice->getDashboardRosterDutyList();
    }

    public function getLogBookDetail()
    {
        $this->dashboardservice->getLogBookDetail();
    }

    public function getDashboardTeacherObservationReview()
    {
        $this->dashboardservice->getDashboardTeacherObservationReview();
    }

    public function getDashboardLPApprovals()
    {
        $this->dashboardservice->getDashboardLPApprovals();
    }

    public function getDashboardAnnouncement()
    {
        $this->dashboardservice->getDashboardAnnouncement();
    }

    public function getDashboardLeaderList()
    {
        $this->dashboardservice->getDashboardLeaderList();
    }

    public function getDashboardImproveList()
    {
        $this->dashboardservice->getDashboardImproveList();
    }

    public function getDashboardSubstituteDetail()
    {
        $this->dashboardservice->getDashboardSubstituteDetail();
    }

    public function getDashboardTeacherActivity()
    {
        $this->dashboardservice->getDashboardTeacherActivity();
    }

    public function getDashboardSubstituteCount()
    {
        $this->dashboardservice->getDashboardSubstituteCount();
    }

    public function getDashboardRosterDutyTeachersList()
    {
        $this->dashboardservice->getDashboardRosterDutyTeachersList();
    }

    public function getDashboardStudentAttendanceTrend()
    {
        $this->dashboardservice->getDashboardStudentAttendanceTrend();
    }

    public function getDashboardStudentAttendanceIrregularity()
    {
        $this->dashboardservice->getDashboardStudentAttendanceIrregularity();
    }

    public function getDashboardConcernList()
    {
        $this->dashboardservice->getDashboardConcernList();
    }

    public function getDashboardPortionCompletion()
    {
        $this->dashboardservice->getDashboardPortionCompletion();
    }

    public function getDashboardTeacherReflection()
    {
        $this->dashboardservice->getDashboardTeacherReflection();
    }

    public function getDashboardInputPercentage()
    {
        $this->dashboardservice->getDashboardInputPercentage();
    }

    public function getDashboardClassAttendanceCount()
    {
        $this->dashboardservice->getDashboardClassAttendanceCount();
    }

    public function getDashboardLateComers()
    {
        $this->dashboardservice->getDashboardLateComers();
    }

    public function getDashboardTeacherTopicNonCoverage()
    {
        $this->dashboardservice->getDashboardTeacherTopicNonCoverage();
    }
}
