<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$evaluation = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */
$evaluation['getEvaluationTemplates'] = "sGetEvaluationTemplates"; /* sGetEvaluationTemplates(IN PAY_Code VARCHAR(16), in PSection_AY_Code int, in PSubject_Code VARCHAR(16)) */
$evaluation['addEvaluation'] = "sAddEvaluation"; /*  sAddEvaluation(IN PTeacher_Code VARCHAR(16), IN PTemplate_ID INT, IN PConducted_On VARCHAR(24), IN PEvaluation_Title VARCHAR(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci, IN PEvaluation_Description TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci,IN PSection_AY_Code INT, IN PSubject_Code VARCHAR(16), in PIsMark int, IN PMax_Marks INT, IN PDuration VARCHAR(24), IN PAssessment_ID INT) */

$evaluation['getEvaluationList'] = "sGetEvaluationList"; /* sGetEvaluationList(IN PAY_Code VARCHAR(16), IN PTeacher_Code VARCHAR(16),IN PSection_AY_Code VARCHAR(16), IN PSubject_Code VARCHAR(16),IN PFrom_Date VARCHAR(24), IN PTo_Date VARCHAR(24), IN PIsMine INT,IN PIsHierarchy INT, IN PPageNum INT, IN PNumOfRec INT) */
$evaluation['getStudentsEvaluationDetail'] = "sGetStudentsEvaluationDetail"; /* sGetStudentsEvaluationDetail(IN PEvaluation_ID INT) */
$evaluation['addStudentEvaluationDetail'] = "sAddStudentEvaluationDetail"; /* sAddStudentEvaluationDetail(IN PEvaluation_ID INT,IN PStudent_Code VARCHAR(16),IN PComments TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci,IN PTemplate_XML TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci,in PMarks int,in PGrade varchar(16)) */

$config['evaluation'] = $evaluation; // key name must be controller class name in lower case
