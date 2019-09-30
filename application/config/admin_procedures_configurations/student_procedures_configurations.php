<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$student = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */

$student['studentImportData'] = "sStudentImportData"; // sStudentImportData(IN PUser_Code varchar(16),in PFile_Name varchar(255))
$student['getAdminStudentList'] = "sAdminStudentGetList"; // sGetAdminStudentList(IN PAY_Code VARCHAR(16))

$student['studentAdd'] = "sStudentAdd"; // sStudentAdd(IN PUserId VARCHAR(16),IN PAdmission_No VARCHAR(264),IN PRoll_No INT,IN PStudent_First_Name VARCHAR(255),IN PStudent_Middle_Name VARCHAR(255),IN PStudent_Last_Name VARCHAR(255),IN PStudent_Gender TINYINT(1), -- 1 or 0IN PStudent_DOB VARCHAR(24), -- dd/mm/yyyyIN PStudent_Admission_Date VARCHAR(24), -- dd/mm/yyyy,IN PSAY_Code INT,-- Father DetailsIN PFather_Name VARCHAR(255),IN PFather_Email VARCHAR(64),IN PFather_Phone VARCHAR(64),IN PFather_Occupation VARCHAR(255),-- Mother DetailsIN PMother_Name VARCHAR(255),IN PMother_Email VARCHAR(64),IN PMother_Phone VARCHAR(64),IN PMother_Occupation VARCHAR(255),IN PLocal_Address VARCHAR(255),IN PPermanent_Address VARCHAR(255),IN PStudent_Special_Notes VARCHAR(255),IN PStudent_Allergic_To VARCHAR(255),IN PStudent_Photo VARCHAR(255))

$student['studentUpdate'] = "sStudentUpdate"; // sStudentUpdate(IN PUserId VARCHAR(16),IN PStudent_Code VARCHAR(64),IN PAdmission_No VARCHAR(264),IN PRoll_No INT,IN PStudent_First_Name VARCHAR(255),IN PStudent_Middle_Name VARCHAR(255),IN PStudent_Last_Name VARCHAR(255),IN PStudent_Gender TINYINT(1), -- 1 or 0IN PStudent_DOB VARCHAR(24), -- dd/mm/yyyyIN PStudent_Admission_Date VARCHAR(24), -- dd/mm/yyyy,IN PSAY_Code INT,-- Father DetailsIN PFather_Name VARCHAR(255),IN PFather_Email VARCHAR(64),IN PFather_Phone VARCHAR(64),IN PFather_Occupation VARCHAR(255),-- Mother DetailsIN PMother_Name VARCHAR(255),IN PMother_Email VARCHAR(64),IN PMother_Phone VARCHAR(64),IN PMother_Occupation VARCHAR(255),IN PLocal_Address VARCHAR(255),IN PPermanent_Address VARCHAR(255),IN PStudent_Special_Notes VARCHAR(255),IN PStudent_Allergic_To VARCHAR(255),IN PStudent_Photo VARCHAR(255))

$student['studentDelete'] = "sStudentDelete"; // sStudentDelete(IN PUser_Code VARCHAR(16), IN PStudent_Code VARCHAR(16))

$config['student'] = $student; // key name must be controller class name in lower case
