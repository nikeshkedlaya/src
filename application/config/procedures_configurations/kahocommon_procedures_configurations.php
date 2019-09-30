<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$kahocommon = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */
$kahocommon['getLookUpType'] = "sLookUpGetList"; // sLookUpGetList(IN PType_Code varchar(16))
$kahocommon['getUserList'] = "sGetUsersList"; // sGetUsersList(IN PAY_Code varchar(16), IN PUser_Code varchar(16), IN PUser_Type varchar(16), IN PIsHierarchy int)
$kahocommon['getAcademicYearList'] = "sAcademicYearGetList";
$kahocommon['getClassSectionList'] = "sClassGetListByAY";
$kahocommon['getAllUserListWithGroup'] = "sGetUsersWithGroup";
$kahocommon['getTeachersWithGroup'] = "sGetTeachersWithGroup"; // sGetTeachersWithGroup(IN PUser_Code varchar(16))
$kahocommon['getCharacteristics'] = "sGetCharacteristics"; // sGetCharacteristics(IN PType varchar(16))
$kahocommon['getTags'] = "sGetTags"; // sGetTags(IN PTag_Type varchar(16))
$kahocommon['getConfig'] = "sConfigGet";
// $kahocommon['getFeeMode'] = "sFeeModeGet";
// $kahocommon['getReportsTo'] = "sReportsToGet";
// $kahocommon['getAssignedUser'] = "sGetTicketAssignedUser";
// $kahocommon['getUserCodeBySectionAYCode'] = "sGetUserCodeBySectionAYCode";
// $kahocommon['getUserCodeByGroupId'] = "sGetUserCodeByGroupId";
$kahocommon['getMonths'] = "sMonthsGet";
// $kahocommon['getSchoolList'] = "sUserDropdownGet";
// $kahocommon['getCacheConfiguration'] = "sCacheConfigurationGet";
// $kahocommon['getHierarchicalFollowTeachers'] = "sGetReportsToUsers";
// $kahocommon['getCategoryList'] = "sCasteCategoryGet";
// $kahocommon['getStateList'] = "sStateGet";
// $kahocommon['getReligionList'] = "sReligionGet";
// $kahocommon['getTags'] = "sGetTags";
// $kahocommon['getAllUsersWithGroup'] = "sGetAllUsersWithGroup";
// $kahocommon['checkAccess'] = "sCheckAccess";
// $kahocommon['getCharacteristics'] = "sGetCharacteristics";
// $kahocommon['getReport'] = "sGetReportsList";
$kahocommon['getUsersWithGroup'] = "sGetUsersWithGroup"; // sGetUsersWithGroup(IN PAY_Code varchar(16), IN PUser_Code varchar(16), IN PUser_Type varchar(16), IN PIsHierarchy int)
$kahocommon['getLPFormat'] = "sConfigGet";
$kahocommon['getAcademicYearList'] = "sGetAcademicYearList"; // sGetAcademicYearList
$kahocommon['getCharacteristicsList'] = "sGetCharacteristicList"; // sGetAcademicYearList
$kahocommon['addUserFollowUp'] = "sAddUserFollowUp"; // sAddUserFollowUp(IN PUser_Code VARCHAR(16), IN PUser_Type VARCHAR(24), IN PObject_Type VARCHAR(64), IN PTransaction_ID int)
$kahocommon['getGrades'] = "sGetGrades"; // sGetGrades()
$kahocommon['getMDMReasons'] = "sGetMDMReasons"; // sGetMDMReasons()


$config['kahocommon'] = $kahocommon; // key name must be controller class name in lower case
