<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of teacherattendance
 *
 * @author KaHO
 */
class Teacherattendance extends KaHO_Controller
{

    // put your code here
    public function __construct()
    {
        parent::__construct("teacherattendanceservice");
    }

    public function getTeachersForAttendance()
    {
        $this->teacherattendanceservice->getTeachersForAttendance();
    }

    public function addTeacherAttendance()
    {
        $this->teacherattendanceservice->addTeacherAttendance();
    }

    public function getSubstituteTeacher()
    {
        $this->teacherattendanceservice->getSubstituteTeacher();
    }

    public function addSubstitute()
    {
        $this->teacherattendanceservice->addSubstitute();
    }

    public function getTeachersForSubstitute()
    {
        $this->teacherattendanceservice->getTeachersForSubstitute();
    }
}
