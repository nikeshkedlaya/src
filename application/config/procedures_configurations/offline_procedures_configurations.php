<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$offline = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */
$offline['offlineSchoolAttendanceAdd'] = "sOfflineSchoolAttendanceAdd"; /* sOfflineSchoolAttendanceAdd
  (
    IN PSchool_Code         VARCHAR(128),
    IN PSchool_User_Code    VARCHAR(16),
    IN PAttendance_Date     VARCHAR(24),
    IN PSAY_Code            INT,
    IN PPeriod              INT,
    IN PAbsent_Student_Code VARCHAR(1024)
  ) */ 

$offline['offlineUpdateMDM'] = "sOfflineUpdateMDM"; /* sOfflineUpdateMDM
  (
    IN PSchool_Code      VARCHAR(128),
    IN PSchool_User_Code VARCHAR(16),
    IN PDate             VARCHAR(64),
    IN PIs_Served        INT,
    IN PNumber_Served    INT,
    IN PReason_ID        INT,
    IN PRemarks          TEXT CHARACTER SET utf8
                         COLLATE utf8_unicode_ci,
    IN PAttachment       TEXT
  ) */

$offline['offlineUpdateFacility'] = "sOfflineUpdateFacility"; /* sOfflineUpdateFacility
  (
    IN PSchool_Code      VARCHAR(128),
    IN PSchool_User_Code VARCHAR(16),
    IN PFacility_Detail  TEXT CHARACTER SET utf8
                         COLLATE utf8_unicode_ci,
    IN PDate             VARCHAR(24),
    IN PGeneral_Comment  TEXT CHARACTER SET utf8
                         COLLATE utf8_unicode_ci
  ) */

$offline['offlineAddCalendarEvent'] = "sOfflineAddCalendarEvent"; /* sOfflineAddCalendarEvent
  (
    IN PSchool_Code      VARCHAR(16),
    IN PSchool_User_Code VARCHAR(16),
    IN PGroup_IDs        TEXT,
    IN PShort_Desc       TEXT CHARACTER SET utf8
                         COLLATE utf8_unicode_ci,
    IN PDesc             TEXT CHARACTER SET utf8
                         COLLATE utf8_unicode_ci,
    IN PStart_Date       VARCHAR(64),
    IN PEnd_Date         VARCHAR(64),
    IN PIsHoliday        INT,
    IN PAttachment       TEXT CHARACTER SET utf8
                         COLLATE utf8_unicode_ci,
    IN PTag_IDs          VARCHAR(264)
  ) */

$config['offline'] = $offline; // key name must be controller class name in lower case
