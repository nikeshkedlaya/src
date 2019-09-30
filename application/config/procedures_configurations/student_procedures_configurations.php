<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$student = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */
$student['getStudentsList'] = "sGetStudentsList"; // sGetStudentsList(IN PAY_Code varchar(16),IN PSAY_Code int, IN PPageNum int, IN PNumOfRec int)
$student['getHomeworkListForStudent'] = "sGetHomeworkListForStudent"; // sGetHomeworkListForStudent(IN PStudent_Code varchar(16),IN PPage_Num int,IN PNumOfRec int)
$student['getStudentProfile'] = "sGetStudentProfile"; // sGetStudentProfile(IN PStudent_Code varchar(16))
$student['getStudentsListByClasses'] = "sGetStudentsListByClasses"; // sGetStudentsListByClasses(IN PSection_AY_Codes VARCHAR(1024))
$student['observationDetailAdd'] = "sObservationDetailAdd"; // sObservationDetailAdd(IN PTeacher_Code varchar(16), IN PRemarks text character set utf8 collate utf8_unicode_ci, IN PLikes text character set utf8 collate utf8_unicode_ci, IN PDisLikes text character set utf8 collate utf8_unicode_ci,IN PStudent_Codes text,IN PCharacteristics text character set utf8 collate utf8_unicode_ci, IN PPrivacy_Flag varchar(16), IN Tags text)
$student['complimentDetailAdd'] = "sComplimentDetailAdd"; // sComplimentDetailAdd(IN PTeacher_Code varchar(16), IN PRemarks text character set utf8 collate utf8_unicode_ci, IN PLikes text character set utf8 collate utf8_unicode_ci, IN PDisLikes text character set utf8 collate utf8_unicode_ci,IN PStudent_Codes text,IN PCharacteristics text character set utf8 collate utf8_unicode_ci, IN Tags text)
$student['concernAdd'] = "sConcernAdd"; // sConcernAdd(IN PUser_Code varchar(16), IN PConcern text character set utf8 collate utf8_unicode_ci,IN PDescription text character set utf8 collate utf8_unicode_ci, IN PStudent_Codes text,IN PIsResolved int(1),IN PResolution_Comment text character set utf8 collate utf8_unicode_ci,IN PAssigned_To varchar(16),IN PComments text character set utf8 collate utf8_unicode_ci,IN PShare_To text)
$student['getStudentMyInputs'] = "sGetStudentMyInputs"; // sGetStudentMyInputs(IN PUser_Type varchar(16),IN PStudent_Code varchar(16),IN PType varchar(16), IN PPageNum int, IN PNumOfRec int)
$student['getAssessmentListForStudent'] = "sGetAssessmentListForStudent"; // sGetAssessmentListForStudent(IN PAY_Code varchar(16), IN PStudent_Code varchar(16))
$student['getStudentAssessmentGraph'] = "sGetStudentAssessmentGraph"; // sGetStudentAssessmentGraph(IN PStudent_Code varchar(16), IN PAssessment_ID int)
$student['getStudentSubjectTrend'] = "sGetStudentSubjectTrend"; // sGetStudentSubjectTrend(IN PAY_Code VARCHAR(16), IN PStudent_Code VARCHAR(16), IN PAssessment_Id INT, IN PSubject_Code VARCHAR(16))
$student['getStudentLatestAssessmentGraph'] = "sGetStudentLatestAssessmentGraph"; // sGetStudentLatestAssessmentGraph(IN PStudent_Code varchar(16))
$student['getSharedUsersComment'] = "sGetSharedUsersComment"; // sGetSharedUsersComment(IN PConcern_ID int)
$student['getConcernHistory'] = "sGetConcernHistory"; // sGetConcernHistory(IN PConcern_ID int)
$student['getConcernFlow'] = "sGetConcernFlow"; // sGetConcernFlow(IN PConcern_ID int, IN PPageNum int, IN PNumOfRec int)
$student['getConcernsList'] = "sGetConcernsList"; // sGetConcernsList(IN PAY_Code varchar(16), IN PUser_Code varchar(16), IN PIsResolved int(1), IN PPageNum int, IN PNumOfRec int)
$student['getConcernShareList'] = "sGetConcernShareList"; // sGetConcernShareList(IN PAY_Code varchar(16), IN PUser_Code varchar(16), IN PPageNum int, IN PNumOfRec int)
$student['getConcernStudents'] = "sGetConcernStudents"; // sGetConcernStudents(IN PConcern_ID int)
$student['updateConcern'] = "sUpdateConcern"; // sUpdateConcern(IN PUser_Code varchar(16),IN PConcern_ID int, IN PConcern_Detail_IDs text,IN PAction_Taken text character set utf8 collate utf8_unicode_ci,IN PIsResolved int(1),IN PAssigned_To varchar(16),IN PComments text character set utf8 collate utf8_unicode_ci)
$student['addSharedUserComment'] = "sAddSharedUserComment"; // sAddSharedUserComment(IN PUser_Code varchar(16),IN PShare_ID int,IN PConcern_Detail_IDs text,IN PComments text character set utf8 collate utf8_unicode_ci)
$student['getMyInputsList'] = "sGetMyInputsList"; // sGetMyInputsList(IN PAY_Code VARCHAR(16), IN PUser_Code VARCHAR(16), IN PSection_AY_Code INT, IN PPageNum int, IN PNumOfRec int)
$student['updateStudentProfile'] = "sUpdateStudentProfile"; // sUpdateStudentProfile(IN PStudent_Code VARCHAR(16), IN PPet_Name VARCHAR(64), IN PPhoto TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci, IN PSpecial_Notes TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci, IN PAllergic_To TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci)
$student['getAssessmentListByClass'] = "sGetAssessmentListByClass"; // sGetAssessmentListByClass(in PAY_Code VARCHAR(16), in PSection_AY_Code int, in PClass_Code VARCHAR(16))

$config['student'] = $student; // key name must be controller class name in lower case
