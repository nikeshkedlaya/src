<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$group = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */
$group['getGroupList'] = "sGetGroupList"; // sGetGroupList(IN PAY_Code varchar(16), IN PUser_Code varchar(16), IN PPageNum int, IN PNumOfRec int)
$group['getGroups'] = "sGetGroups"; // sGetGroups(IN PUser_Code varchar(16), IN PMine int(1))
$group['getGroupDetails'] = "sGetGroupDetail"; // sGetGroupDetail(IN PAY_Code varchar(16), IN PUser_Code varchar(16), IN PGroup_ID int, IN PIsHierarchy int)
$group['deleteGroup'] = "sGroupDelete"; // sGroupDelete (IN PUser_Code varchar(16), IN PGroup_ID int)
$group['addGroup'] = "sGroupDetailAdd"; // sGroupDetailAdd (IN PCreated_By varchar(16), IN PUser text, IN PGroup_Name text CHARACTER set utf8 COLLATE utf8_unicode_ci, IN PGroup_ID int)
$group['updateGroup'] = "sGroupDetailAdd"; // sGroupDetailAdd (IN PCreated_By varchar(16), IN PUser text, IN PGroup_Name text CHARACTER set utf8 COLLATE utf8_unicode_ci, IN PGroup_ID int)

$config['group'] = $group; // key name must be controller class name in lower case
