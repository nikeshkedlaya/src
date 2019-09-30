<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$sectionacademicyear = [];

$sectionacademicyear['setupGetClassLevel'] = "sSetupGetClassLevel";
$sectionacademicyear['setupGetSelectedClasses'] = "sSetupGetSelectedClasses"; // sSetupGetSelectedClasses(in PAY_Code VARCHAR(16))
$sectionacademicyear['setupAddClasses'] = "sSetupAddClasses"; // sSetupAddClasses(IN PUser_Code VARCHAR(16), IN PClass_Codes VARCHAR(1024))
$sectionacademicyear['setupGetSectionList'] = "sSetupGetSectionList"; // sSetupGetSectionList
$sectionacademicyear['setupGetSelectedSections'] = "sSetupGetSelectedSections"; // sSetupGetSelectedSections
$sectionacademicyear['setupAddNewSection'] = "sSetupAddNewSection"; // sSetupAddNewSection(IN PUser_Code VARCHAR(16), IN PSection_Name VARCHAR(64))
$sectionacademicyear['setupAddSections'] = "sSetupAddSections"; // sSetupAddSections(IN PUser_Code VARCHAR(16), IN PSection_Codes TEXT)
$sectionacademicyear['getSelectedClassSections'] = "sGetSelectedClassSections"; // sGetSelectedClassSections(IN PAY_Code VARCHAR(16))
$sectionacademicyear['setupAddClassSections'] = "sSetupAddClassSections"; // sSetupAddClassSections(IN PAY_Code VARCHAR(16), IN PUser_Code VARCHAR(16), IN PClassSection TEXT, IN pIsOneTime INT)
$sectionacademicyear['setupDeleteSection'] = "sSetupDeleteSection"; // sSetupDeleteSection(IN PUser_Code VARCHAR(16), IN PSection_Code VARCHAR(16))
$sectionacademicyear['getClassSectionList'] = "sGetClassSectionList"; // sSetupDeleteSection(IN PUser_Code VARCHAR(16), IN PSection_Code VARCHAR(16))
$sectionacademicyear['sectionAcademicYearAdd'] = "sSectionAcademicYearAdd"; // sSectionAcademicYearAdd(IN PUserId VARCHAR(16),IN PAY_Code YEAR,IN PClass_Code VARCHAR(16),IN PSection_Code VARCHAR(16))

$sectionacademicyear['sectionAcademicYearUpdate'] = "sSectionAcademicYearUpdate"; // sSectionAcademicYearUpdate(IN PUserId VARCHAR(16),IN PSection_AY_Code INT,IN PClass_Code VARCHAR(16),IN PSection_Code VARCHAR(16),IN PAY_Code YEAR)
$sectionacademicyear['sectionAcademicYearDelete'] = "sSectionAcademicYearDelete"; // sSectionAcademicYearDelete(IN PUser_ID VARCHAR(16), IN PSection_AY_Code INT)
$sectionacademicyear['adminSectionAcademicYearGetList'] = "sAdminSectionAcademicYearGetList"; // sAdminSectionAcademicYearGetList(IN PWhere VARCHAR(1024)CHARACTER SET UTF8COLLATE utf8_unicode_ci,IN PSort VARCHAR(125),IN PStartRec INT,IN PEndRec INT)

$config['sectionacademicyear'] = $sectionacademicyear; // key name must be controller class name in lower case
