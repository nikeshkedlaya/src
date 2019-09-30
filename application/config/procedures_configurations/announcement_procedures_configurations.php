<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$announcement = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */
$announcement['getAnnouncement'] = "sGetAnnouncement"; /* sGetAnnouncement`(IN PAY_Code varchar(16),IN PUser_Code varchar(16),IN PUser_Type varchar(24),IN PPageNum int,IN PNumOfRec int) */
$announcement['announcementDetailAdd'] = "sAnnouncementDetailAdd"; /* `sAnnouncementDetailAdd`(IN PUser_Code varchar(16), IN PAnnouncement_Subject text character set utf8 collate utf8_unicode_ci, IN PAnnouncement_Message text character set utf8 collate utf8_unicode_ci, IN PAnnouncement_Attachment text, IN PIs_Ack_Required int(1), IN PAnnouncement_To text) */
$announcement['deleteAnnouncement'] = "sDeleteAnnouncement"; /* `sAnnouncementDetailAdd`(IN PUser_Code varchar(16), IN PAnnouncement_Subject text character set utf8 collate utf8_unicode_ci, IN PAnnouncement_Message text character set utf8 collate utf8_unicode_ci, IN PAnnouncement_Attachment text, IN PIs_Ack_Required int(1), IN PAnnouncement_To text) */
$config['announcement'] = $announcement; // key name must be controller class name in lower case
