<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$engagement = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */
$engagement['getEngagementList'] = "sGetEngagementList"; /*
                                                          * sGetEngagementList(IN PAY_Code VARCHAR(16), IN PPush_By VARCHAR(16), IN PClass_Code VARCHAR(16), IN PSubject_Code VARCHAR(16), IN PPageNum int, IN PNumOfRec int)
                                                          */
$engagement['getEngagementDetail'] = "sGetEngagementDetail"; /* sGetEngagementDetail(IN PTopicEngagement_ID INT) */
$engagement['getEngagementComments'] = "sGetEngagementComments"; /* sGetEngagementComments(IN PTopic_Engagement_ID INT, IN PPush_By VARCHAR(16), IN PPageNum int, IN PNumOfRec int) */

$engagement['getEngagementListForParent'] = "sGetEngagementListForParent"; // sGetEngagementListForParent(IN PAY_Code VARCHAR(16), IN PStudent_Code VARCHAR(16), IN PIsCompleted INT, IN PPageNum int, IN PNumOfRec int)

$engagement['getEngagementDetailForParent'] = "sGetEngagementDetailForParent"; // sGetEngagementDetailForParent(IN PUserEngagement_ID INT, IN PIsCompleted INT)

$engagement['addUserEngagement'] = "sAddUserEngagement"; // sAddUserEngagement(IN PUserEngagement_ID INT, IN PEngagement_ID INT, IN POpt_ID INT, IN PIsLiked INT, IN PComments TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci, IN PIsCompleted INT)

$engagement['getEngagementLogin'] = "sGetEngagementLogin"; // sGetEngagementLogin(IN PAY_Code VARCHAR(16), IN PStudent_Code VARCHAR(16))
$engagement['getEngagementObjectives'] = "sGetEngagementObjectives"; // sGetEngagementObjectives(IN PClass_Code VARCHAR(16), IN PSection_AY_Code INT, IN PSubject_Code VARCHAR(16))
$engagement['addEngagementObjectives'] = "sAddEngagementObjectives"; // sAddEngagementObjectives(IN PUser_Code VARCHAR(16), IN PObjective_ID INT, IN PBoard_Code VARCHAR(16), IN PClass_Code VARCHAR(16), IN PSubject_Code VARCHAR(16), IN PTopic TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci, IN PObjective TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci)
$engagement['getEngagementObjectiveList'] = "sGetEngagementObjectiveList"; // sGetEngagementObjectiveList(IN PClass_Code VARCHAR(16), IN PSubject_Code VARCHAR(16), IN PObjectiveContains TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci, IN PPageNum int, IN PNumOfRec int)

$config['engagement'] = $engagement; // key name must be controller class name in lower case
