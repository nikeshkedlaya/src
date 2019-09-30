<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$timetable = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */
$timetable['getTimeTable'] = "sGetTimeTable"; // sGetTimeTable(IN PAY_Code varchar(16), IN PTeacher_Code varchar(16), IN PSection_AY_Code int)
$timetable['getTeacherTimeTable'] = "sGetTeacherTimeTable"; // sGetTeacherTimeTable(IN PAY_Code varchar(16),IN PTeacher_Code varchar(16))
$timetable['addOrUpdateTeacherTimeTable'] = "sAddOrUpdateTeacherTimeTable"; /* sAddOrUpdateTeacherTimeTable (IN PAY_Code VARCHAR(16),IN PTeacher_Code VARCHAR(16),IN PData_XML TEXT,in PWeek_Day int,in PClassTeacher_Section_AY_Code int) */

$config['timetable'] = $timetable; // key name must be controller class name in lower case
