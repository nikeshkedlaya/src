<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$qualityaspect = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */
$qualityaspect['getQualityCheckList'] = "sGetQualityCheckList"; /* sGetQualityCheckList(IN PAY_Code VARCHAR(16), IN PUser_Code varchar(16), IN PSection_AY_Code int, IN PSubject_Code varchar(16), IN PTeacher_Code varchar(16)) */
$qualityaspect['getStudentListQuality'] = "sGetStudentListQuality"; /* sGetStudentListQuality(IN PUser_Code varchar(16),IN PSection_AY_Code int,IN PFilter_Type int(1), IN PNum_Students int) */
$qualityaspect['qualityDetailAdd'] = "sQualityDetailAdd"; /* sQualityDetailAdd(IN PUser_Code varchar(16), IN PHeader_ID INT, IN PSection_AY_Code int, IN PTeacher_Code varchar(16), IN PSubject_Code varchar(16), IN PStudent_Code VARCHAR(16), IN PCheckList TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci) */
$qualityaspect['getQualityListForUser'] = "sGetQualityListForUser"; /* sGetQualityListForUser(IN PAY_Code VARCHAR(16), IN PUser_Code VARCHAR(16), IN PSection_AY_Code VARCHAR(16), IN PTeacher_Code VARCHAR(16), IN PSubject_Code VARCHAR(16), IN PPageNum int, IN PNumOfRec int ) */
$qualityaspect['getQualityDetail'] = "sGetQualityDetail"; /* sGetQualityDetail(IN PQuality_Aspect_ID INT) */
$config['qualityaspect'] = $qualityaspect; // key name must be controller class name in lower case
