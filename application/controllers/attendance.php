<?php

/**
 * @created by Nikesh<nikesh@kaholabs.com> on 15 Nov, 2014 11:40:50 AM
 * 
 * Descripion: 
 * 
 * Security : 
 * 
 * Change History :-
 * 
 * 
 * 
 * 
 * @Audited by :-
 */
// namespace kaholabs
class Attendance extends KaHO_Controller
{

    public function __construct()
    {
        parent::__construct("attendance/attendanceservice");
    }

    public function getAttendancePeriodList()
    {
        $this->attendanceservice->getAttendancePeriodList();
    }

    public function getStudentsForAttendance()
    {
        $this->attendanceservice->getStudentsForAttendance();
    }

    public function attendanceAdd()
    {
        $this->attendanceservice->attendanceAdd();
    }

    public function updateStudentAttendance()
    {
        $this->attendanceservice->updateStudentAttendance();
    }

    public function getAttendanceCount()
    {
        $this->attendanceservice->getAttendanceCount();
    }

    public function getAttendanceTrend()
    {
        $this->attendanceservice->getAttendanceTrend();
    }

    public function getAttendanceTrendForMonth()
    {
        $this->attendanceservice->getAttendanceTrendForMonth();
    }

    public function getAttendanceNotTakenDetail()
    {
        $this->attendanceservice->getAttendanceNotTakenDetail();
    }
}
