<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$attendance = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */
$attendance['getAttendancePeriodList'] = "sGetAttendancePeriodList"; // sGetAttendancePeriodList(IN PAY_Code varchar(16), IN PSection_AY_Code int, IN PUser_Code varchar(16), IN PAttendance_Date varchar(24))
$attendance['getStudentsForAttendance'] = "sGetStudentsForAttendance"; // sGetStudentsForAttendance(IN PSection_AY_Code int, IN PPeriod int, IN PAttendance_Date varchar(24))
$attendance['attendanceAdd'] = "sAttendanceAdd"; /* sAttendanceAdd(IN PUser_Code varchar(16),IN PAttendance_Date varchar(24), IN PSAY_Code int, IN PPeriod int,IN PAbsent_Student_Code varchar(255)) */
$attendance['updateStudentAttendance'] = "sUpdateStudentAttendance"; /* sUpdateStudentAttendance(IN PUser_Code VARCHAR(16), IN PAttendance_ID INT, IN PStudents TEXT CHARACTER SET utf8 COLLATE utf_unicode_ci) */
$attendance['getAttendanceCount'] = "sGetAttendanceCount"; // sGetAttendanceCount(IN PAY_Code VARCHAR(16), IN PStudent_Code VARCHAR(16), IN PSection_AY_Code INT, IN PMonth_Number INT)
$attendance['getAttendanceTrend'] = "sGetAttendanceTrend"; // sGetAttendanceTrend(IN PAY_Code VARCHAR(16), IN PStudent_Code VARCHAR(16), IN PSection_AY_Code INT)
$attendance['getAttendanceTrendForMonth'] = "sGetAttendanceTrendForMonth"; // sGetAttendanceTrendForMonth(IN PAY_Code VARCHAR(16), IN PStudent_Code VARCHAR(16), IN PSection_AY_Code INT, IN PMonth_Number INT)
$attendance['getAttendanceNotTakenDetail'] = "sGetAttendanceNotTakenDetail"; // sGetAttendanceNotTakenDetail( IN PAY_Code VARCHAR(16),IN PUser_Code VARCHAR(16),IN PAttendance_Date VARCHAR(24))

$config['attendance'] = $attendance; // key name must be controller class name in lower case
