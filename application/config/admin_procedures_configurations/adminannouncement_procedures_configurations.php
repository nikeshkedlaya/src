<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$adminannouncement = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */

$adminannouncement['addAnnouncement'] = "sAnnouncementAdd";
$adminannouncement['updateAnnouncement'] = "sAnnouncementUpdate";
$adminannouncement['deleteAnnouncement'] = "sAnnouncementDelete";
$adminannouncement['getAnnouncementList'] = "sAdminAnnouncementGetList";
$adminannouncement['getAnnouncementForEditRecord'] = "sAnnouncementGet";

$config['adminannouncement'] = $adminannouncement; // key name must be controller class name in lower case
