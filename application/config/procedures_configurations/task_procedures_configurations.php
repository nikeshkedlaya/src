<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$task = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */
$task['getTaskList'] = "sGetTaskList"; // sGetTaskList(IN PAY_Code varchar(16), IN PUser_Code varchar(16), IN PMine int,IN POther int,IN PIsPending int,IN PPageNum int,IN PNumOfRec int)
$task['getTaskHistory'] = "sGetTaskHistory"; // sGetTaskHistory(IN PTicket_ID int)
$task['taskAdd'] = "sTaskAdd"; // sTaskAdd(IN PUser_Code varchar(16),IN PTitle text character set utf8 collate utf8_unicode_ci,IN PDescription text character set utf8 collate utf8_unicode_ci,IN PFinish_By varchar(24), IN PPriority varchar(16),IN PAssigned_To varchar(4028), IN PFollowUp_Date varchar(24), IN PTicket_ID int)
$task['taskEditDetails'] = "sTaskAdd"; // sTaskAdd(IN PUser_Code varchar(16),IN PTitle text character set utf8 collate utf8_unicode_ci,IN PDescription text character set utf8 collate utf8_unicode_ci,IN PFinish_By varchar(24), IN PPriority varchar(16),IN PAssigned_To varchar(4028), IN PFollowUp_Date varchar(24), IN PTicket_ID int )
$task['taskDelete'] = "sTaskDelete"; // sTaskDelete(IN PUser_Code varchar(16), IN PTicket_ID int)
$task['taskUpdate'] = "sTaskUpdate"; // sTaskUpdate(IN PUser_Code varchar(16),IN PTicket_ID int,IN PDetailRemarks text character set utf8 collate utf8_unicode_ci,IN PStatus_Value int)

$config['task'] = $task; // key name must be controller class name in lower case
