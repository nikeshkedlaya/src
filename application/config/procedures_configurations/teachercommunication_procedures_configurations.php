<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$teachercommunication = [];
/* teachercommunication procedures */
/* method name would be key name and value would be procedure name */
$teachercommunication['getTeacherInboxMail'] = "sGetMailList"; // sGetMailList(IN PUser_Code varchar(16), IN PIsInbox int, IN PPageNum int, IN PNumOfRec int)
$teachercommunication['getTeacherSentMail'] = "sGetMailList"; // sGetMailList(IN PUser_Code varchar(16), IN PIsInbox int, IN PPageNum int, IN PNumOfRec int)
$teachercommunication['getTeacherConversationMail'] = "sMailTeacherConversationGet"; // sMailTeacherConversationGet(IN PParent_Mail_Id int, IN PFrom_Email varchar(16), IN PTo_Email varchar(16))
$teachercommunication['addMailDetail'] = "sMailDetailAdd"; // sMailDetailAdd(IN PUser_Code varchar(16),IN PTo_Mail text,IN PMail_Subject text CHARACTER set utf8 COLLATE utf8_unicode_ci, IN PDescription text CHARACTER set utf8 COLLATE utf8_unicode_ci,IN PEmail_Attachment text, IN PReply_Parent_Code int)
$teachercommunication['replyMail'] = "sMailDetailAdd"; // sMailDetailAdd(User_Code,To_Mail,Subject,Message,Attachment,Reply_Parent_Code)

$teachercommunication['getMailRecipients'] = "sGetMailRecipients"; // sGetMailRecipients(IN PAY_Code VARCHAR(16),IN PUser_Code VARCHAR(16),IN PUser_Type VARCHAR(64),IN PIsHierarchy INT)

//$teachercommunication['getMailRecipients'] = "sGetMailRecipients"; // sGetMailRecipients(0IN PAY_Code VARCHAR(16),IN PUser_Code VARCHAR(16),IN PUser_Type VARCHAR(64),IN PIsHierarchy INT)

$config['teachercommunication'] = $teachercommunication; // key name must be controller class name in lower case
