<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$adminsubject = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */

$adminsubject['setupGetClassSubjectList'] = "sSetupGetClassSubjectList"; // sSetupGetClassSubjectList()
$adminsubject['setupAddNewSubject'] = "sSetupAddNewSubject"; // sSetupAddNewSubject(IN PUser_Code VARCHAR(16), IN PSubject_Name VARCHAR(64), IN PShort_Name VARCHAR(64))
$adminsubject['setupGetSubjectList'] = "sSetupGetSubjectList"; // sSetupGetSubjectList()
$adminsubject['setupAddSelectedSubject'] = "sSetupAddSelectedSubject"; // sSetupAddSelectedSubject(IN PUser_Code VARCHAR(16), IN PSubject_Codes TEXT)

$adminsubject['setupDeleteSubject'] = "sSetupDeleteSubject"; // sSetupDeleteSubject(IN PUser_Code VARCHAR(16), IN PSubject_Code VARCHAR(16))
$adminsubject['setupAddClassSubjects'] = "sSetupAddClassSubjects"; // sSetupAddClassSubjects(IN PUser_Code VARCHAR(16), IN PClass_Subjects TEXT, IN PIsOnetime INT )
$adminsubject['subjectAdd'] = "sSubjectAdd"; // sSubjectAdd(IN PUserId VARCHAR(16),IN PSubject_Name VARCHAR(255),IN PSubject_Short_Name VARCHAR(255),IN PParent_Subject_Code VARCHAR(16),IN PIsAcademic BIT(1))

$adminsubject['subjectUpdate'] = "sSubjectUpdate"; // sSubjectUpdate(IN PUserId VARCHAR(16), IN PSubject_Code VARCHAR(16),IN PSubject_Name VARCHAR(255), IN PSubject_Short_Name VARCHAR(255), IN PParent_Subject_Code VARCHAR(16),IN PIsAcademic BIT(1))

$adminsubject['subjectDelete'] = "sSubjectDelete"; // sSubjectDelete(IN PUserId VARCHAR(16), IN PSubject_Code VARCHAR(16))

$adminsubject['adminSubjectGetList'] = "sAdminSubjectGetList"; // sAdminSubjectGetList(IN PWhere VARCHAR(1024)CHARACTER SET UTF8 COLLATE utf8_unicode_ci,IN PSort VARCHAR(125),IN PStartRec INT,IN PEndRec INT)
$adminsubject['subjectAdd'] = "sSubjectAdd"; // sSubjectAdd(IN PUserId VARCHAR(16),IN PSubject_Name VARCHAR(255),IN PSubject_Short_Name VARCHAR(255),IN PParent_Subject_Code VARCHAR(16),IN PIsAcademic BIT(1))
$adminsubject['subjectUpdate'] = "sSubjectUpdate"; // sSubjectUpdate(IN PUserId VARCHAR(16), IN PSubject_Code VARCHAR(16),IN PSubject_Name VARCHAR(255), IN PSubject_Short_Name VARCHAR(255), IN PParent_Subject_Code VARCHAR(16),IN PIsAcademic BIT(1))
$adminsubject['subjectDelete'] = "sSubjectDelete"; // sSubjectDelete(IN PUserId VARCHAR(16), IN PSubject_Code VARCHAR(16))

$config['adminsubject'] = $adminsubject; // key name must be controller class name in lower case
