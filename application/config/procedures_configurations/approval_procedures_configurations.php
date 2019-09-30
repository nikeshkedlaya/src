<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$approval = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */
$approval['getAnnouncementWorkFlow'] = "sGetAnnouncementWorkflow"; // sGetAnnouncementWorkflow(IN PWorkflow_ID int)
$approval['getApprovalList'] = "sGetApprovalList"; // sGetApprovalList(IN PUser_Code VARCHAR(16), IN PStstus VARCHAR(64), IN PPage_Num int, IN PNumOfRec int)
$approval['addAnnouncementWorkflow'] = "sAddAnnouncementWorkflow"; // sAddAnnouncementWorkflow(IN PUser_Code VARCHAR(16), IN PWorkflow_ID INT, IN PRef_ID INT, IN PAnnouncement_Subject TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci,PAnnouncement_Message TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci,PAnnouncement_Attachment TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci,PIs_Ack_Required INT(1), PAnnouncement_To TEXT, IN PTag_IDs TEXT, IN PStatus VARCHAR(64),IN PCommnents TEXT)

$config['approval'] = $approval; // key name must be controller class name in lower case
