<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$teacher = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */
$teacher['getTeacherTaskForWeek'] = "sGetTeacherTaskForWeek"; // sGetTeacherTaskForWeek(IN PAY_Code varchar(16), IN PTeacher_Code varchar(16), IN PDate varchar(24))
$teacher['kaHOPointsGet'] = "sKaHOPointsGet"; // sKaHOPointsGet(IN PAY_Code varchar(16), IN PTeacher_Code varchar(16), IN PMonth int, IN PIsHierarchy int)
$teacher['getDashboardNotifications'] = "sGetDashboardNotifications"; // sGetTeacherSubjectGraphSection(IN PTeacher_Code varchar(16), IN PClass_Code varchar(16), IN PSubject_Code varchar(16), IN PAssessment_Id int)
$teacher['updateTeacherTask'] = "sUpdateTeacherTask"; // sUpdateTeacherTask(IN PTeacher_Code varchar(16),IN PTask_Date varchar(24),IN PPlan_ID text,IN PSectionAYCodes varchar(255), IN PIsFullyCompleted int,IN PCompleted_Topic varchar(255),IN PRemaining_Topic varchar(255), IN PHW_ID int,IN PSubmit_By varchar(24),IN PMCQ_ID int, IN PEngagement_ID int,IN PComments text character set utf8 collate utf8_unicode_ci, IN PFeedback text character set utf8 collate utf8_unicode_ci,IN PPeriodNum varchar(255),IN PUsage_Smartboard int,IN PSmartboard_Usage_Detail text character set utf8 collate utf8_unicode_ci, IN PParentalInteraction text character set utf8 collate utf8_unicode_ci)
$teacher['getTeacherOtherTask'] = "sGetTeacherOtherTask"; // sGetTeacherOtherTask(IN PTeacher_Code varchar(16), IN PSubject_Code varchar(16), IN PSAY int, in PPlan_ID int)
$teacher['getClassForTask'] = "sGetClassForTask"; // sGetClassForTask(IN PTeacher_Code varchar(16), IN PPlan_Id int, IN PWeek_Day int, IN PAction_Date varchar(24))
$teacher['getTeacherTask'] = "sGetTeacherTask"; // sGetTeacherTask(IN PAY_Code varchar(16),IN PTeacher_Code varchar(16), IN PSubject_Code varchar(16), IN PSAY int, IN PPlan_ID int, IN PTeacher_Task_ID int)
                                                // $teacher['getClassForCompletedTask'] = "sGetCompletedClassByLessonPlan";
$teacher['addFreePeriodDetail'] = "sAddFreePeriodDetail"; // sAddFreePeriodDetail(IN PTeacher_Code varchar(16), IN PDate varchar(24), IN PPeriodNum varchar(255), IN PComments text character set utf8 collate utf8_unicode_ci, IN PTag_IDs varchar(128), OUT PTransStatus int(1))
$teacher['getFreePeriodDetail'] = "sGetFreePeriodDetail"; // sGetFreePeriodDetail(IN PFreePeriod_ID int)
$teacher['getFreePeriods'] = "sGetFreePeriod"; // sGetFreePeriod(IN PTeacher_Code varchar(16),IN PWeek_Day int, IN PDateOfAction varchar(16))
                                               // $teacher['getMediaForLessonPlan'] = "sMediaGetForDailyPlan";
$teacher['getAvgKaHOPoints'] = "sGetAvgKaHOPoints"; // sGetAvgKaHOPoints(IN PAY_Code varchar(16),IN PTeacher_Code varchar(16))
$teacher['getAssessmentForTeacher'] = "sGetAssessmentForTeacher"; // sGetAssessmentForTeacher(IN PAY_Code int, IN PTeacher_Code varchar(16))
$teacher['getTeacherClassGraph'] = "sGetTeacherClassGraph"; // sGetTeacherClassGraph(IN PTeacher_Code varchar(16), IN PSAY_Code int, IN PAssessment_Id int)
$teacher['getTeacherSubjectGraph'] = "sGetTeacherSubjectGraph"; // sGetTeacherSubjectGraph(IN PTeacher_Code varchar(16), IN PClass_Code varchar(16), IN PSubject_Code varchar(16), IN PAssessment_Id int)
$teacher['getTeacherClassGraphBC'] = "sGetTeacherClassGraphBC"; // sGetTeacherClassGraphBC(IN PSAY_Code int, In PSubject_Code varchar(16), IN PAssessment_Id int)
$teacher['getTeacherClassGraphStudent'] = "sGetTeacherClassGraphStudent"; // sGetTeacherClassGraphStudent(IN PSAY_Code int, IN PAssessment_Id int,PSubject_Code varchar(16), PRange varchar(16))

$teacher['teacherSubjectGraphSectionBC'] = "sTeacherSubjectGraphSectionBC"; // sTeacherSubjectGraphSectionBC(IN PTeacher_Code varchar(16), IN PSAY_Code varchar(16), IN PSubject_Code varchar(16), IN PAssessment_Id int)

$teacher['teacherSubjectGraphStudent'] = "sTeacherSubjectGraphStudent"; // sTeacherSubjectGraphStudent(IN PSAY_Code int, IN PAssessment_Id int,PSubject_Code varchar(16), PRange varchar(16))
$teacher['getTeachersList'] = "sGetTeachersList"; // sGetTeachersList(IN PUser_Code varchar(16), IN PIsHierarchy int(1))
$teacher['getTeacherProfile'] = "sGetTeacherProfile"; // sGetTeacherProfile(IN PUser_Code varchar(16))
$teacher['updateTeacherProfile'] = "sUpdateTeacherProfile"; // sUpdateTeacherProfile(IN PUser_Code varchar(16),IN PFirst_Name varchar(64),IN PMiddle_Name varchar(64),IN PLast_Name varchar(64),IN PPhone varchar(64),IN PQualification text CHARACTER set utf8 COLLATE utf8_unicode_ci, IN PAddress text CHARACTER set utf8 COLLATE utf8_unicode_ci,IN PPhoto text CHARACTER set utf8 COLLATE utf8_unicode_ci,IN PBio text CHARACTER set utf8 COLLATE utf8_unicode_ci,IN PFav_Colour text CHARACTER set utf8 COLLATE utf8_unicode_ci,IN PFav_Restaurant text CHARACTER set utf8 COLLATE utf8_unicode_ci,IN PFav_Drink text CHARACTER set utf8 COLLATE utf8_unicode_ci,IN PFav_Hobby text CHARACTER set utf8 COLLATE utf8_unicode_ci,IN PFav_Store text CHARACTER set utf8 COLLATE utf8_unicode_ci,IN PFav_Teaching_Item text CHARACTER set utf8 COLLATE utf8_unicode_ci,IN PFav_Books text CHARACTER set utf8 COLLATE utf8_unicode_ci,IN PFav_Movies text CHARACTER set utf8 COLLATE utf8_unicode_ci,IN PAbout_Teacher text CHARACTER set utf8 COLLATE utf8_unicode_ci,IN PLinkedIn_Profile text CHARACTER set utf8 COLLATE utf8_unicode_ci, IN PFacebook_Profile text CHARACTER set utf8 COLLATE utf8_unicode_ci)
$teacher['getTeacherSubjectGraphSection'] = "sGetTeacherSubjectGraphSection"; // sGetTeacherSubjectGraphSection(IN PTeacher_Code varchar(16), IN PClass_Code varchar(16), IN PSubject_Code varchar(16), IN PAssessment_Id int)
$teacher['getTeacherDairy'] = "sGetTeachersDairy"; // sGetTeachersDairy(IN PUser_Code varchar(16), IN PFrom_Date varchar(24), IN PTo_Date varchar(16))
$teacher['addTeacherTaskComment'] = "sAddTeacherTaskComment"; // sAddTeacherTaskComment(IN PUser_Code varchar(16),IN PTeacher_Code VARCHAR(16), IN PDate VARCHAR(24), IN PComments text character set utf8 collate utf8_unicode_ci)

$teacher['getMyInputCount'] = "sGetMyInputCount"; // sGetMyInputCount(IN PUser_Code varchar(16), IN PDate varchar(24))
$teacher['getKaHOPointsForToday'] = "sGetKaHOPointsForToday"; // sGetKaHOPointsForToday(IN PUser_Code varchar(16), IN PDate varchar(24))
$teacher['getComments'] = "sGetComments"; // sGetComments(IN PUser_Code varchar(16), IN PDate varchar(24))
$teacher['getTeacherPerformance'] = "sGetTeacherPerformance"; // sGetTeacherPerformance(IN PAY_Code VARCHAR(16), IN PUser_Code VARCHAR(16), IN PTeacher_Code VARCHAR(16), IN PClass_Code VARCHAR(16), IN PSubject_Code VARCHAR(16), IN PFrom_Date VARCHAR(24), IN PTo_Date VARCHAR(24))

$config['teacher'] = $teacher; // key name must be controller class name in lower case
