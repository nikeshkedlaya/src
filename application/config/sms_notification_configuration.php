<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * * will contain the global level sms notification configuration
 */

$sms_notification_configuration = array();
$sms_notification_configuration['sms_notification_enabled'] = TRUE; // is notification enabled
$sms_notification_configuration['sms_notification_title'] = "KaHO Notification"; // sms_notification default   title
$sms_notification_configuration['sms_notification_db_tracking_enabled'] = false; // is notification db tracked

$config['sms_notification_configuration'] = $sms_notification_configuration;