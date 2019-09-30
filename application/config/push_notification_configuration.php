<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * will contain the global level push notification configuration
 * 
 */
$push_notification_configuration = array();
$push_notification_configuration['push_notification_enabled'] = TRUE; // is notification enabled
//$push_notification_configuration['is_anonymous_event_allowed'] = false; // is anonymous event allowed means, callie can send the push notification without prior registering event in notification_event_configuration  enabled
$push_notification_configuration['push_notification_title'] = "KaHO Notification"; // push_notification default   title
$push_notification_configuration['push_notification_db_tracking_enabled'] = TRUE; // is notification db tracked

$push_notification_configuration['push_notification_type'] = array("push_notification_type_silent" => "silent", "push_notification_type_buzz" => "buzz"); // either silent = user won't be notified,or buzz =user will be notified
// <editor-fold defaultstate="collapsed" desc="notification_platform_name">

$push_notification_configuration['push_notification_platform_type'] = array("push_notification_platform_android" => "android", "push_notification_platform_windows" => "windows", "push_notification_platform_web" => "web", "push_notification_platform_iphone" => "iphone"); // platform type notification
// </editor-fold>

$push_notification_configuration['push_notification_platform_configuration'] = array();

// <editor-fold defaultstate="collapsed" desc="android_level_conf">

$push_notification_configuration['push_notification_platform_configuration']['android']['is_enabled'] = TRUE;
$push_notification_configuration['push_notification_platform_configuration']['android']['google_api_key'] = "AIzaSyCnO0A3Lwf42iDpBHlEW_gIUJQWFsPzTNU";
$push_notification_configuration['push_notification_platform_configuration']['android']['google_gcm_server_url'] = "https://android.googleapis.com/gcm/send";
$push_notification_configuration['push_notification_platform_configuration']['android']['class_name'] = "Androidnotification";

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="window_level_conf">

$push_notification_configuration['push_notification_platform_configuration']['windows']['is_enabled'] = TRUE;
$push_notification_configuration['push_notification_platform_configuration']['windows']['connection_string'] = "Endpoint=sb://windows-push-notification.servicebus.windows.net/;SharedAccessKeyName=DefaultFullSharedAccessSignature;SharedAccessKey=dc3MRNkf29hMcGPhN9m/gNzRIEpLzFxu+76hyCV0gGM=";
$push_notification_configuration['push_notification_platform_configuration']['windows']['hub_path'] = "windows-push-notification";
$push_notification_configuration['push_notification_platform_configuration']['windows']['class_name'] = "Windowsnotification";

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="web_level_configuration">
$push_notification_configuration['push_notification_platform_configuration']['web']['is_enabled'] = TRUE;
$push_notification_configuration['push_notification_platform_configuration']['web']['class_name'] = "Webnotification";
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="iphone_level_configuration">
$push_notification_configuration['push_notification_platform_configuration']['iphone']['is_enabled'] = TRUE;
$push_notification_configuration['push_notification_platform_configuration']['iphone']['class_name'] = "Iphonenotification";
// </editor-fold>


$config['push_notification_configuration'] = $push_notification_configuration;
