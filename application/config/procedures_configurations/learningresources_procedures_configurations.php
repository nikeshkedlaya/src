<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$learningresources = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */
$learningresources['addLearningResourceRepo'] = "sAddLearningResourceRepo"; // sAddLearningResourceRepo(IN PUser_Code varchar(16), IN PFile_Title text character set utf8 collate utf8_unicode_ci, IN PFile_Description text character set utf8 collate utf8_unicode_ci, IN PFile_Name text character set utf8 collate utf8_unicode_ci, IN PFile_Type varchar(64), IN PIs_Private int(1), IN PClass_Codes text, IN PSubject_Codes text, IN PTags text)

$learningresources['addLearningResource'] = "sAddLearningResource"; // sAddLearningResource(IN PUser_Code varchar(16), IN PTitle text character set utf8 collate utf8_unicode_ci, IN PDescription text character set utf8 collate utf8_unicode_ci, IN PUsers text, IN PFile_IDs text)

$learningresources['getLearningResourcesFromRepo'] = "sGetLearningResourcesFromRepo"; // sGetLearningResourcesFromRepo(IN PUser_Code varchar(16), IN PClass_Codes text, IN PSubject_Codes text, IN PTags text)

$learningresources['getAllResourcesFromRepo'] = "sGetAllResourcesFromRepo"; // sGetAllResourcesFromRepo(IN PUser_Code varchar(16), IN PClass_Code text, PSubject_Codes text, IN PType varchar(16), IN PTags text, IN PPageNum int, IN PNumOfRec int)
$learningresources['getSharedResources'] = "sGetSharedResources"; // sGetSharedResources(IN PUser_Code varchar(16), IN PFrom_Date varchar(24), IN PTo_Date varchar(16), IN PType varchar(16), IN PTags text, IN PIsCreatedByMe int, IN PPageNum int, IN PNumOfRec int)
$learningresources['addLearningResourceFileView'] = "sAddLearningResourceFileView"; // sAddLearningResourceFileView(IN PUser_Code varchar(16), IN PRepo_ID int)
$learningresources['getFilesFromRepoById'] = "sGetFilesFromRepoById"; // sGetFilesFromRepoById(IN PRepo_IDs text)
$learningresources['getLRCount'] = "sGetLRCount"; // sGetLRCount(IN PUser_Code varchar(16), IN PDate varchar(24))

$config['learningresources'] = $learningresources; // key name must be controller class name in lower case
