<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$teacherattendance = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */
$teacherattendance['getTeachersForAttendance'] = "sGetTeachersForAttendance"; // sGetTeachersForAttendance(IN PUser_Code varchar(16), IN PDate varchar(24))
$teacherattendance['addTeacherAttendance'] = "sAddTeacherAttendance"; // sAddTeacherAttendance(IN PUser_Code varchar(16), IN PDate varchar(24), IN PAbsentTeachers text)
$teacherattendance['getSubstituteTeacher'] = "sGetSubstituteTeacher"; // sGetSubstituteTeacher(IN PTeacher_Code varchar(16),in PDate varchar(24))
$teacherattendance['addSubstitute'] = "sAddSubstitute"; // sAddSubstitute(in PUser_Code varchar(16), in PDate varchar(24), in PDataIn varchar(1024))
$teacherattendance['getTeachersForSubstitute'] = "sGetTeachersForSubstitute"; // sGetTeachersForSubstitute(IN PUser_Code varchar(16))
$config['teacherattendance'] = $teacherattendance; // key name must be controller class name in lower case
