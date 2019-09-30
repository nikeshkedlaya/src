<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$notification = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */
$notification['registerDeviceId'] = "sRegisterDeviceId"; // sRegisterDeviceId(IN PUser_ID int,in PDevice_ID varchar(255),IN PPlatform_Type varchar(64))
$notification['unRegisterDeviceId'] = "sRegisterDeviceId";
 
$notification['getNotificationSettingsList'] = "sGetNotificationSettingsList"; 
/*sGetNotificationSettingsList(IN PUser_ID INT)*/

$notification['updateNotificationSettings'] = "sUpdateNotificationSettings"; 
/*sUpdateNotificationSettings(IN PUser_ID INT, IN PSettings_ID INT, IN PState INT)*/

$notification['getNotificationList'] = "sGetNotificationList";
/*sGetNotificationList(IN PUser_ID   INT, IN PPlatform_Type varchar(64), IN PEvent_Type VARCHAR(1024),IN PFrom_Date VARCHAR(24), IN PTo_Date VARCHAR(24), IN PPageNum INT,IN PNumOfRec  INT)*/

$config['notification'] = $notification; // key name must be controller class name in lower case
