<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$schoolinfo = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */
$schoolinfo['addSchoolInfo'] = "sAddSchoolInfo"; // (IN PUser_Code VARCHAR(16),IN PSchoo_Name VARCHAR(1024),IN PAddress VARCHAR(4028),IN PPhone VARCHAR(64),IN PSchool_Email VARCHAR(264),IN PSchool_URL VARCHAR(4028),IN PLogo TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci,IN PBoard VARCHAR(16),IN PPrincipal_Name VARCHAR(264),IN PPrincipal_Email VARCHAR(264),IN PPrincipal_Phone VARCHAR(64),IN PStart_Date VARCHAR(24),IN PEnd_Date VARCHAR(24),IN IsSaturday_Working INT DEFAULT 1,IN PNum_Periods_Weekday INT,IN PNum_Periods_Saturday INT,IN PHouse_Detail TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci

$schoolinfo["getHouseList"] = "sGetHouseList";
$schoolinfo["getSchoolInfo"] = "sGetSchoolInfo";

$schoolinfo['updateSchoolInfo'] = "sUpdateSchoolInfo"; // (IN PUser_Code VARCHAR(16),IN PSchoo_Name VARCHAR(1024),IN PAddress VARCHAR(4028),IN PPhone VARCHAR(64),IN PSchool_Email VARCHAR(264),IN PSchool_URL VARCHAR(4028),IN PLogo TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci,IN PBoard VARCHAR(16),IN PStart_Date VARCHAR(24),IN PEnd_Date VARCHAR(24),IN PAY_Code VARCHAR(64),IN IsSaturday_Working INT DEFAULT 1,IN PNum_Periods_Weekday INT,IN PNum_Periods_Saturday INT,IN PHouse_Detail TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci

$config['schoolinfo'] = $schoolinfo; // key name must be controller class name in lower case
