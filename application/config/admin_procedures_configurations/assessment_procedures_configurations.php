<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$assessment = [];
/* groups procedures */

$assessment['asssessmentAdd'] = "sAsssessmentAdd"; // sAsssessmentAdd(IN PUser_Code VARCHAR(16),IN PAY_Code VARCHAR(16),IN PAssessment_Name VARCHAR(64),IN PFrom_Date VARCHAR(24),IN PTo_Date VARCHAR(24),IN PMarks INT)
$assessment['asssessmentUpdate'] = "sAsssessmentUpdate"; // sAsssessmentUpdate(IN PUser_Code VARCHAR(16),IN PAssessment_ID INT,IN PAY_Code VARCHAR(16),IN PAssessment_Name VARCHAR(64),IN PFrom_Date VARCHAR(24),IN PTo_Date VARCHAR(24),IN PMarks INT)

$assessment['assessmentDelete'] = "sAssessmentDelete"; // sAssessmentDelete(IN PUser_Code VARCHAR(16),IN PAssessment_ID INT)
$assessment['assessmentCreatedGetList'] = "sAssessmentCreatedGetList"; // sAssessmentCreatedGetList(IN PUser_Code VARCHAR(16),IN PAY_Code VARCHAR(16))
$assessment['assessmentDetailGetList'] = "sAssessmentDetailGetList"; // sAssessmentDetailGetList(IN PUser_Code VARCHAR(16),IN PYear year,IN PMonth_Number int)

$assessment['getClassSectionListForAssessment'] = "sGetClassSectionListForAssessment"; // sGetClassSectionListForAssessment (IN PAssessment_ID int)
$assessment['getClassSubjectListForAssessment'] = "sGetClassSubjectListForAssessment"; // sGetClassSectionListForAssessment (IN PAssessment_ID int)

$assessment['assessmentDetailAddOrUpdateOrDelete'] = "sAssessmentDetailAddOrUpdateOrDelete"; // sAssessmentDetailAddOrUpdateOrDelete(IN PUser_Code VARCHAR(16),IN PAssessment_ID INT,IN PAssessment_Details TEXT)
$assessment['adminAssessmentDetailSectionGetList'] = "sAdminAssessmentDetailSectionGetList"; // sAdminAssessmentDetailSectionGetList(IN PWhere VARCHAR(1024)CHARACTER SET UTF8COLLATE utf8_unicode_ci,IN PSort VARCHAR(125),IN PStartRec INT,IN PEndRec INT)

$config['assessment'] = $assessment; // key name must be controller class name in lower case
