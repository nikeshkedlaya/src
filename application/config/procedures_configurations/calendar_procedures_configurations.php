<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$calendar = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */
$calendar['addCalendarEvent'] = "sAddCalendarEvent"; // sAddCalendarEvent(IN PUser_Code varchar(16), IN PGroup_IDs text, IN PShort_Desc text character set utf8 COLLATE utf8_unicode_ci, IN PDesc text CHARACTER set utf8 COLLATE utf8_unicode_ci, IN PStart_Date varchar(64), IN PEnd_Date varchar(64), IN PIsHoliday int, IN PAttachment text)
$calendar['addMeetingRequest'] = "sAddMeetingRequest"; // sAddMeetingRequest(IN Puser_Code varchar(16), IN PAttendees text, IN PSubject text CHARACTER set utf8 COLLATE utf8_unicode_ci, IN PDesc text character set utf8 COLLATE utf8_unicode_ci, IN PMeeting_From varchar(64), IN PMeeting_To varchar(64), IN PLocation text)
$calendar['getEvents'] = "sGetEvents"; // sGetEvents(IN PUser_Code varchar(16), IN PUser_Type varchar(16), IN PMonthNmber int, IN PYear int)
$calendar['getUpComingEvents'] = "sGetUpComingEvents"; /* sGetUpComingEvents(IN PAY_Code VARCHAR(16), IN PUser_Code VARCHAR(16), IN PUser_Type VARCHAR(16) */
$config['calendar'] = $calendar; // key name must be controller class name in lower case
