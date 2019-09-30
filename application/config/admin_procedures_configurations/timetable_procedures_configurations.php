<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$timetable = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */

$timetable['setupAddClassTimeTable'] = "sSetupAddClassTimeTable"; // sSetupAddClassTimeTable(IN PUser_Code VARCHAR(16), IN PSection_AY_Code INT, IN PData_XML TEXT)

$timetable['setupGetClassTimeTable'] = "sSetupGetClassTimeTable"; // sSetupGetClassTimeTable(IN PSection_AY_Code INT)

$timetable['addOrUpdateTeacherTimeTable'] = "sAddOrUpdateTeacherTimeTable"; // sAddOrUpdateTeacherTimeTable(IN PAY_Code VARCHAR(16),IN PTeacher_Code VARCHAR(16),IN PData_XML TEXT,IN PWeek_Day INT,IN PClassTeacher_Section_AY_Code INT)

$timetable['getTeacherTimeTable'] = "sGetTeacherTimeTable"; // `sGetTeacherTimeTable`(IN PAY_Code varchar(16),IN PTeacher_Code varchar(16))

$config['timetable'] = $timetable; // key name must be controller class name in lower case
