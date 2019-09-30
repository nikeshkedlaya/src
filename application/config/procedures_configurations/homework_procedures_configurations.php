<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$homework = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */
$homework['getHomeworkSubmissions'] = "sGetHomeworkSubmissions"; // sGetHomeworkSubmissions(IN PAY_Code varchar(16), IN PTeacher_Code varchar(16), IN PSection_AY_Code int, IN PPageNum int, IN PNumOfRec int)
$homework['getPendingHWStudents'] = "sGetPendingHWStudents"; // sGetPendingHWStudents(IN PHomeWork_Id int)
$homework['updateHomeWork'] = "sUpdateHomeWork"; // sUpdateHomeWork( IN PUser_Code varchar(16), IN PHW_Id int, IN PPending_Student_Code text)
$homework['homeWorkListForTeacher'] = "sHomeWorkListForTeacher"; // sHomeWorkListForTeacher(IN PAY_Code varchar(16), IN PTeacher_Code varchar(16), IN PSection_AY_Code int, IN PPageNum int, IN PNumOfRec int)
$homework['assignHomework'] = "sAssignHomework"; // sAssignHomework( IN PTeacher_Code varchar(16), IN PSection_AY_Code int,IN PSubject_Code varchar(16),IN PRemarks text character set utf8 collate utf8_unicode_ci,IN PSubmit_By varchar(24),IN PAttachment text character set utf8 collate utf8_unicode_ci, OUT TransStatus int)

$homework['getHomeworkCount'] = "sGetHomeworkCount"; // sGetHomeworkCount(IN PUser_Code varchar(16), IN PDate varchar(24))
$homework['getHomeWorkUpdateCount'] = "sGetHomeWorkUpdateCount"; // sGetHomeWorkUpdateCount(IN PAY_Code VARCHAR(16), IN PStudent_Code VARCHAR(16), IN PSection_AY_Code INT, IN PSubject_Code varchar(16))

$homework['getHomeWorkTrend'] = "sGetHomeWorkTrend"; // sGetHomeWorkTrend(IN PAY_Code VARCHAR(16), IN PStudent_Code VARCHAR(16), IN PSection_AY_Code INT, IN PSubject_Code varchar(16))

$config['homework'] = $homework; // key name must be controller class name in lower case
