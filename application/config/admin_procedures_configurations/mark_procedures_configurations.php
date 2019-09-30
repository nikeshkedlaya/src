<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$mark = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */

$mark['downloadMarksTemplate'] = "sDownloadMarksTemplate"; // sDownloadMarksTemplate(IN PAssessment_Detail_Section_ID INT)
$mark['marksUpload'] = "sMarksUpload"; // sMarksUpload(IN PUser_Code VARCHAR(16),IN PAssessment_Detail_Section_ID INT,IN PFile_Name VARCHAR(1024))
$mark['marksForAssessmentDetailGet'] = "sMarksForAssessmentDetailGet"; // sMarksForAssessmentDetailGet(IN PAssessment_Detail_Section_ID INT)
$mark['marksAddOrUpdate'] = "sMarksAddOrUpdate"; // sMarksAddOrUpdate(IN PUser_Code VARCHAR(16),IN PAssessment_Detail_Section_ID INT,IN PMarksDetail TEXT)

$config['mark'] = $mark; // key name must be controller class name in lower case
   