<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$lessonplan = [];
/* lesson plan procedures */
/* method name would be key name and value would be procedure name */
$lessonplan['getAccessList'] = "sGetAccessList"; /* sGetAccessList(IN PUser_Code VARCHAR(16)) */
$lessonplan['getLearningActivity'] = "sGetLearningActivity"; // sGetLearningActivity()
$lessonplan['createLessonPlanDraft'] = "sAddLessonPlanDraft"; // sAddLessonPlanDraft()
$lessonplan['updateLessonPlanDraft'] = "sUpdateLessonPlanDraft"; // sUpdateLessonPlanDraft()
$lessonplan['deleteLessonPlanDraft'] = "sDeleteLessonPlanDraft"; // sDeleteLessonPlanDraft(IN PDraftID int)
$lessonplan['getLessonPlanLog'] = "sGetLessonPlanLog"; // sGetLessonPlanLog(IN PAY_Code VARCHAR(16), IN PTeacher_Code VARCHAR(16), IN PClass_Code VARCHAR(16), IN PSubject_Code VARCHAR(16), IN PFrom_Date VARCHAR(24), IN PTo_Date VARCHAR(24),PContains TEXT)
$lessonplan['getLessonPlanDetail'] = "sGetLessonPlanDetail"; // sGetLessonPlanDetail(IN PAY_Code VARCHAR(16), IN PTeacher_Code VARCHAR(16), IN PHeader_ID int)
$lessonplan['createLessonPlanFromDraft'] = "sCreateLessonPlanFromDraft"; // sCreateLessonPlanFromDraft(IN PUser_Code varchar(16),IN PClass_Code varchar(16), IN PSubject_Code varchar(16),IN PFrom_Date varchar(24),IN PTo_Date varchar(24), IN PApprove_By VARCHAR(16),IN PDraftHeader_ID INT)
$lessonplan['getLPDraftList'] = "sGetLPDraftList"; // sGetLPDraftList(IN PUser_Code varchar(16))
$lessonplan['getLPDraftDetail'] = "sGetLPDraftDetail"; // sGetLPDraftDetail(IN PHeader_ID int)
$lessonplan['editLessonPlan'] = "sEditLessonplan"; // sEditLessonplan(IN PUser_Code VARCHAR(16),IN PPlan_ID INT,IN PMainTopic TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci, IN PDescription TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci,IN PLO TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci,IN PLearning_Activity VARCHAR(1024),IN PResources TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci, IN PActivity TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci,IN PAssessment_Strategy TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci, IN PRemedial_Strategy TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci, IN PHomeWork TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci,IN PMCQ INT,IN PAssets VARCHAR(1024), -- '1,2,3'IN PSchool_Specific TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci)

$lessonplan['deleteDailyPlan'] = "sDeleteDailyPlan"; // sDeleteDailyPlan(IN PPlan_ID INT)
$lessonplan['copyLessonPlan'] = "sCopyLessonPlan"; // sCopyLessonPlan(IN PUser_Code IN PHeader_ID INT,IN PSubject_Codes TEXT)

$config['lessonplan'] = $lessonplan; // key name must be controller class name in lower case