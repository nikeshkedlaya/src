<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$mcq = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */
$mcq['getMCQDetailByID'] = "sGetMCQByID"; // sGetMCQByID(IN PMCQ_ID int)
$mcq['getMCQCount'] = "sGetMCQCount"; // sGetMCQCount(IN PUser_Code varchar(16), IN PDate varchar(24))
$mcq['getMCQList'] = "sGetMCQList"; // sGetMCQList(IN PUser_Code VARCHAR(16), IN PClass_Code VARCHAR(16), IN PSubject_Code VARCHAR(16), IN PTopic TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci, IN PConcept TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci)
$mcq['getPushedMCQTopicsList'] = "sGetPushedMCQTopicsList"; // sGetPushedMCQTopicsList(IN PAY_Code VARCHAR(16), IN PTeacher_Code VARCHAR(16), IN PClass_Code VARCHAR(16), IN PSubject_Code VARCHAR(16))
$mcq['getMCQBYID'] = "sGetMCQByID"; // sGetMCQByID(IN PMCQ_ID int)
$mcq['getQuestionwiseReflection'] = "sGetQuestionwiseReflection"; // sGetQuestionwiseReflection(IN PAY_Code VARCHAR(16), IN PPush_By VARCHAR(16), PTopicQuestion_ID INT)

$mcq['getCategorywiseReflection'] = "sGetCategorywiseReflection"; // sGetCategorywiseReflection(IN PAY_Code VARCHAR(16), IN PPush_By VARCHAR(16), PTopicQuestion_ID INT)
$mcq['getMCQStudentsYetToTake'] = "sGetMCQStudentsYetToTake"; // sGetMCQStudentsYetToTake(IN PTopicQuestion_ID INT, IN PPush_By VARCHAR(16), IN PSection_AY_Code INT)

$mcq['getMCQStudentsToWatch'] = "sGetMCQStudentsToWatch"; // sGetMCQStudentsToWatch(IN PTopiQuestion_ID INT, IN PPush_By VARCHAR(16), IN PSection_AY_Code INT, IN PQuestion_ID INT)

$mcq['addMCQDraft'] = "sAddMCQDraft"; // sAddMCQDraft(IN PMCQDraftHeader_ID INT,IN PTeacher_Code VARCHAR(16),IN PClass_Code VARCHAR(16),IN PSubject_Code VARCHAR(16),IN PTitle TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci,IN PTopic TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci,IN PConcept TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci,IN PQuestion TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci,IN PQuestion_Assets TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci,IN PDifficulty_Level VARCHAR(16),IN PCategory VARCHAR(16),IN PAnswer1_Desc TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci,IN PAnswer1_Asset TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci,IN PAnswer2_Desc TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci,IN PAnswer2_Asset TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci,IN PAnswer3_Desc TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci,IN PAnswer3_Asset TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci,IN PAnswer4_Desc TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci,IN PAnswer4_Asset TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci,IN PCorrect_Answers VARCHAR(264) -- 1~1|2~0|3~0|4~0)

$mcq['updateMCQDraft'] = "sUpdateMCQDraft"; // sUpdateMCQDraft( IN PMCQDraft_ID INT, IN PQuestion TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci,IN PQuestion_Assets TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci,IN PDifficulty_Level VARCHAR(16),IN PCategory VARCHAR(16),IN PAnswer1_Desc TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci,IN PAnswer1_Asset TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci,IN PAnswer2_Desc TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci,IN PAnswer2_Asset TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci,IN PAnswer3_Desc TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci,IN PAnswer3_Asset TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci,IN PAnswer4_Desc TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci,IN PAnswer4_Asset TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci,IN PCorrect_Answers VARCHAR(264) -- 1~1|2~0|3~0|4~0)

$mcq['deleteMCQDraft'] = "sDeleteMCQDraft"; // sDeleteMCQDraft(IN PMCQDraft_ID int)

$mcq['getMCQListForStudentBySubject'] = "sGetMCQListForStudentBySubject"; // sGetMCQListForStudentBySubject(IN PAY_Code VARCHAR(16), IN PStudent_Code VARCHAR(16))

$mcq['getMCQListForStudent'] = "sGetMCQListForStudent"; // sGetMCQListForStudent(IN PAY_Code VARCHAR(16), IN PStudent_Code VARCHAR(16), IN PSubject_Code VARCHAR(16), IN PIsCompleted INT, IN PPageNum int, IN PNumOfRec int)

$mcq['getQuestionsForStudent'] = "sGetQuestionsForStudent"; // sGetQuestionsForStudent(IN PStudent_MCQ_ID int)

$mcq['addMCQStudentAnswer'] = "sAddMCQStudentAnswer"; // sAddMCQStudentAnswer(IN PStudent_MCQ_ID INT, IN PQuestion_ID INT, IN PAnswer_ID VARCHAR(64), PIsCompleted INT)
$mcq['getMCQDetailCount'] = "sGetMCQDetailCount"; // sGetMCQDetailCount(IN PAY_Code VARCHAR(16), IN PStudent_Code VARCHAR(16), IN PSection_AY_Code INT, IN PMonth_Number INT)

$mcq['getMCQTrend'] = "sGetMCQTrend"; // sGetMCQTrend(IN PAY_Code VARCHAR(16), IN PStudent_Code VARCHAR(16), IN PSection_AY_Code INT)

$mcq['getMCQTrendForMonth'] = "sGetMCQTrendForMonth"; // sGetMCQTrendForMonth(IN PAY_Code VARCHAR(16), IN PStudent_Code VARCHAR(16), IN PSection_AY_Code INT, IN PMonth_Number INT)
$mcq['getMCQDraftList'] = "sGetMCQDraftList"; // sGetMCQDraftList(IN PUser_Code VARCHAR(16), IN PClass_Code VARCHAR(16), IN PSubject_Code VARCHAR(16))
$mcq['getMCQDraft'] = "sGetMCQDraft"; // sGetMCQDraft(IN PMCQDraftHeader INT)
$mcq['addMCQFromDraft'] = "sAddMCQFromDraft"; // sAddMCQFromDraft(IN PUser_Code VARCHAR(16), IN PMCQDraftHeader_ID INT)

$config['mcq'] = $mcq; // key name must be controller class name in lower case
