<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$adminteacher = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */

$adminteacher['getTeachersList'] = "sGetTeachersList"; // sGetTeachersList(IN PUser_Code varchar(16),in PIsHierarchy)
$adminteacher['teacherImportData'] = "sTeacherImportData"; // sTeacherImportData(IN PUser_Code varchar(16),in PFile_Name varchar(255))
$adminteacher['teacherAdd'] = "sTeacherAdd"; // sTeacherAdd(IN PUserID VARCHAR(16),IN PFirst_Name VARCHAR(64),IN PMiddle_Name VARCHAR(64),IN PLast_Name VARCHAR(64),IN PEmail VARCHAR(255),IN PPhone VARCHAR(64),IN PGender TINYINT,IN PDOB VARCHAR(24),IN PDOJ VARCHAR(24),IN PQualification VARCHAR(64),IN PAddress VARCHAR(255),IN PReportsTo VARCHAR(16),IN PDesignation_Code INT(11),IN PPhoto VARCHAR(255),in PIs_Active
$adminteacher['teacherUpdate'] = "sTeacherUpdate"; // sTeacherUpdate(IN PUserID VARCHAR(16),IN PTeacher_Code VARCHAR(16),IN PFirst_Name VARCHAR(64),IN PMiddle_Name VARCHAR(64),IN PLast_Name VARCHAR(64),IN PEmail VARCHAR(255),IN PPhone VARCHAR(64),IN PGender TINYINT,IN PDOB VARCHAR(24),IN PDOJ VARCHAR(24),IN PQualification VARCHAR(64),IN PAddress VARCHAR(255),IN PReportsTo VARCHAR(16),IN PDesignation_Code INT(11),IN PPhoto VARCHAR(255),
$adminteacher['teacherDelete'] = "sTeacherDelete"; // sTeacherDelete(IN PUserID VARCHAR(16), IN PTeacher_Code VARCHAR(16))
$adminteacher['adminTeacherGetList'] = "sAdminTeacherGetList"; // sAdminTeacherGetList(IN PWhere VARCHAR(1024)CHARACTER SET UTF8COLLATE utf8_unicode_ci,IN PSort VARCHAR(125),IN PStartRec INT,IN PEndRec INT)
$adminteacher['designationGet'] = "sDesignationGet";
$config['adminteacher'] = $adminteacher; // key name must be controller class name in lower case
