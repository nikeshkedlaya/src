<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$classroomobservation = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */
// $classroomobservation['getClassRoomObservationTemplate'] = "sGetClassRoomObservationTemplate"; // sGetClassRoomObservationTemplate(IN PID int)

$classroomobservation['getClassRoomObservationList'] = "sGetClassRoomObservationList"; // sGetClassRoomObservationList(IN PUser_Code varchar(16))

$classroomobservation['addClassRoomObservation'] = "sAddClassRoomObservation"; // sAddClassRoomObservation(IN PUser_Code varchar(16),IN PSurvey_ID int, IN PTeacher_Code varchar(16), IN PSection_AY_Code int, IN PSubject_Code varchar(16), IN PTopic varchar(16), IN PPeriodNum int, IN PUser_Input text, IN PObserver_Comment text character set utf8 collate utf8_unicode_ci,Obtained_Grade", "Max_Grade)

$classroomobservation['addClassRoomObservationComment'] = "sAddClassRoomObservationComment"; // sAddClassRoomObservationComment(IN PUser_Code varchar(16), IN PIsObserver int, IN PObservation_ID int, IN PComments text character set utf8 collate utf8_unicode_ci, IN PIsOthers int(1))

$classroomobservation['getMyClassRoomObservation'] = "sGetClassRoomObservation"; // sGetClassRoomObservation(IN PUser_Code varchar(16), IN PPageNum int, IN PNumOfRec int)

$classroomobservation['getClassRoomObservationComments'] = "sGetClassRoomObservationComments"; // sGetClassRoomObservationComments(IN PUser_Code varchar(16), IN PObservation_ID int)

$classroomobservation['getUserInput'] = "sGetUserInput"; // sGetUserInput(IN PObservation_ID int)
$classroomobservation['getTeacherObservationCount'] = "sGetTeacherObservationCount"; // sGetTeacherObservationCount(IN PUser_Code varchar(16), IN PDate varchar(24))

$config['classroomobservation'] = $classroomobservation; // key name must be controller class name in lower case
