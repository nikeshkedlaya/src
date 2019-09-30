<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * * will contain the global level email notification 
 */

$email_notification_configuration = array();
$email_notification_configuration['email_notification_enabled'] = TRUE; // is notification enabled
$email_notification_configuration['email_notification_title'] = "KaHO Email Notification"; // email_notification default   title
$email_notification_configuration['email_notification_db_tracking_enabled'] = false; // is notification db tracked

$config['email_notification_configuration'] = $email_notification_configuration;