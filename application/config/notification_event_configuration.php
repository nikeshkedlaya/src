<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 *
 * will contain the event level configuration
 * event configuration will be registered here for any kind of notification like push,sms and email
 *
 */
$notification_event_configuration = array();

// <editor-fold defaultstate="collapsed" desc="event_level_configuration">
// <editor-fold defaultstate="collapsed" desc="mail_created_event_level_configuration">
// <editor-fold defaultstate="collapsed" desc="mail_created_event_push_notification_level_configuration">

$notification_event_configuration['mail_created']['push_notification']['is_enabled'] = true;
$notification_event_configuration['mail_created']['push_notification']['push_notification_type'] = GetCustomConfigItem("push_notification_configuration", "push_notification_type")['push_notification_type_buzz'];
$notification_event_configuration['mail_created']['push_notification']['redirect_to'] = true;
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="mail_event_sms_notification_level_configuration">
$notification_event_configuration['mail_created']['sms_notificationd']['is_enabled'] = true;
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="mail_event_email_notification_level_configuration">
$notification_event_configuration['mail_created']['email_notification']['is_enabled'] = true;
// </editor-fold>
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="meeting_request_event_push_notification_level_configuration">

$notification_event_configuration['add_meeting_request']['push_notification']['is_enabled'] = true;
$notification_event_configuration['add_meeting_request']['push_notification']['push_notification_type'] = GetCustomConfigItem("push_notification_configuration", "push_notification_type")['push_notification_type_buzz'];
$notification_event_configuration['add_meeting_request']['push_notification']['redirect_to'] = true;
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="meeting_request_event_sms_notification_level_configuration">
$notification_event_configuration['add_meeting_request']['sms_notification']['is_enabled'] = true;
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="meeting_request_event_email_notification_level_configuration">
$notification_event_configuration['add_meeting_request']['email_notification']['is_enabled'] = true;
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="hw_update_event_push_notification_level_configuration">

$notification_event_configuration['hw_update']['push_notification']['is_enabled'] = true;
$notification_event_configuration['hw_update']['push_notification']['push_notification_type'] = GetCustomConfigItem("push_notification_configuration", "push_notification_type")['push_notification_type_buzz'];
$notification_event_configuration['hw_update']['push_notification']['redirect_to'] = true;
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="hw_update_event_sms_notification_level_configuration">
$notification_event_configuration['hw_update']['sms_notification']['is_enabled'] = true;
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="hw_update_event_email_notification_level_configuration">
$notification_event_configuration['hw_update']['email_notification']['is_enabled'] = true;
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="student_attendance_add_event_push_notification_level_configuration">

$notification_event_configuration['student_attendance_add']['push_notification']['is_enabled'] = true;
$notification_event_configuration['student_attendance_add']['push_notification']['push_notification_type'] = GetCustomConfigItem("push_notification_configuration", "push_notification_type")['push_notification_type_buzz'];
$notification_event_configuration['student_attendance_add']['push_notification']['redirect_to'] = true;

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="attendance_add_event_sms_notification_level_configuration">
$notification_event_configuration['student_attendance_add']['sms_notification']['is_enabled'] = true;
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="attendance_add_event_email_notification_level_configuration">
$notification_event_configuration['student_attendance_add']['email_notification']['is_enabled'] = true;
// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="student_attendance_update_event_push_notification_level_configuration">

$notification_event_configuration['student_attendance_update']['push_notification']['is_enabled'] = true;
$notification_event_configuration['student_attendance_update']['push_notification']['push_notification_type'] = GetCustomConfigItem("push_notification_configuration", "push_notification_type")['push_notification_type_buzz'];
$notification_event_configuration['student_attendance_update']['push_notification']['redirect_to'] = true;

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="attendance_add_event_sms_notification_level_configuration">
$notification_event_configuration['student_attendance_update']['sms_notification']['is_enabled'] = true;
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="attendance_add_event_email_notification_level_configuration">
$notification_event_configuration['student_attendance_update']['email_notification']['is_enabled'] = true;
// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="add_compliments_event_push_notification_level_configuration">

$notification_event_configuration['add_compliments']['push_notification']['is_enabled'] = true;
$notification_event_configuration['add_compliments']['push_notification']['push_notification_type'] = GetCustomConfigItem("push_notification_configuration", "push_notification_type")['push_notification_type_buzz'];
$notification_event_configuration['add_compliments']['push_notification']['redirect_to'] = true;

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="add_compliments_event_sms_notification_level_configuration">
$notification_event_configuration['add_compliments']['sms_notification']['is_enabled'] = true;
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="add_compliments_event_email_notification_level_configuration">
$notification_event_configuration['add_compliments']['email_notification']['is_enabled'] = true;
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="add_observation_event_push_notification_level_configuration">

$notification_event_configuration['add_observation']['push_notification']['is_enabled'] = true;
$notification_event_configuration['add_observation']['push_notification']['push_notification_type'] = GetCustomConfigItem("push_notification_configuration", "push_notification_type")['push_notification_type_buzz'];
$notification_event_configuration['add_observation']['push_notification']['redirect_to'] = true;

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="add_observation_event_sms_notification_level_configuration">
$notification_event_configuration['add_observation']['sms_notification']['is_enabled'] = true;
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="add_observation_event_email_notification_level_configuration">
$notification_event_configuration['add_observation']['email_notification']['is_enabled'] = true;
// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="add_hw_details_event_level_configuration">

$notification_event_configuration['add_hw_details']['push_notification']['is_enabled'] = true;
$notification_event_configuration['add_hw_details']['push_notification']['push_notification_type'] = GetCustomConfigItem("push_notification_configuration", "push_notification_type")['push_notification_type_buzz'];
$notification_event_configuration['add_hw_details']['push_notification']['redirect_to'] = true;

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="add_hw_details_event_sms_notification_level_configuration">
$notification_event_configuration['add_hw_details']['sms_notification']['is_enabled'] = true;
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="add_hw_details_event_email_notification_level_configuration">
$notification_event_configuration['add_hw_details']['email_notification']['is_enabled'] = true;
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="add_announcement_event_level_configuration">

$notification_event_configuration['add_announcement']['push_notification']['is_enabled'] = true;
$notification_event_configuration['add_announcement']['push_notification']['push_notification_type'] = GetCustomConfigItem("push_notification_configuration", "push_notification_type")['push_notification_type_buzz'];
$notification_event_configuration['add_announcement']['push_notification']['redirect_to'] = true;

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="add_announcement_event_sms_notification_level_configuration">
$notification_event_configuration['add_announcement']['sms_notification']['is_enabled'] = true;
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="add_announcement_event_email_notification_level_configuration">
$notification_event_configuration['add_announcement']['email_notification']['is_enabled'] = true;
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="substitute_create_event_level_configuration">
// <editor-fold defaultstate="collapsed" desc="substitute_create_event_push_notification_level_configuration">

$notification_event_configuration['substitute_create']['push_notification']['is_enabled'] = true;
$notification_event_configuration['substitute_create']['push_notification']['push_notification_type'] = GetCustomConfigItem("push_notification_configuration", "push_notification_type")['push_notification_type_buzz'];
$notification_event_configuration['substitute_create']['push_notification']['redirect_to'] = true;
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="substitute_create_event_sms_notification_level_configuration">
$notification_event_configuration['substitute_create']['sms_notification']['is_enabled'] = true;
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="substitute_create_event_email_notification_level_configuration">
$notification_event_configuration['substitute_create']['email_notification']['is_enabled'] = true;
// </editor-fold>
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="calender_event_create_event_level_configuration">
// <editor-fold defaultstate="collapsed" desc="calender_event_create_event_push_notification_level_configuration">

$notification_event_configuration['calender_event_create']['push_notification']['is_enabled'] = true;
$notification_event_configuration['calender_event_create']['push_notification']['push_notification_type'] = GetCustomConfigItem("push_notification_configuration", "push_notification_type")['push_notification_type_buzz'];
$notification_event_configuration['calender_event_create']['push_notification']['redirect_to'] = true;
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="substitute_create_event_sms_notification_level_configuration">
$notification_event_configuration['calender_event_create']['sms_notification']['is_enabled'] = true;
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="substitute_create_event_email_notification_level_configuration">
$notification_event_configuration['calender_event_create']['email_notification']['is_enabled'] = true;
// </editor-fold>
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="add_group_event_level_configuration">
// <editor-fold defaultstate="collapsed" desc="add_group_event_push_notification_level_configuration">

$notification_event_configuration['add_group']['push_notification']['is_enabled'] = true;
$notification_event_configuration['add_group']['push_notification']['push_notification_type'] = GetCustomConfigItem("push_notification_configuration", "push_notification_type")['push_notification_type_buzz'];
$notification_event_configuration['add_group']['push_notification']['redirect_to'] = true;
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="add_group_event_sms_notification_level_configuration">
$notification_event_configuration['add_group']['sms_notification']['is_enabled'] = true;
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="add_group_event_email_notification_level_configuration">
$notification_event_configuration['add_group']['email_notification']['is_enabled'] = true;
// </editor-fold>
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="share_learning_resource_event_level_configuration">
// <editor-fold defaultstate="collapsed" desc="share_learning_resource_event_level_configuration">
// <editor-fold defaultstate="collapsed" desc="share_learning_resource_event_push_notification_level_configuration">

$notification_event_configuration['share_learning_resource']['push_notification']['is_enabled'] = true;
$notification_event_configuration['share_learning_resource']['push_notification']['push_notification_type'] = GetCustomConfigItem("push_notification_configuration", "push_notification_type")['push_notification_type_buzz'];
$notification_event_configuration['share_learning_resource']['push_notification']['redirect_to'] = true;
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="share_learning_resource_event_sms_notification_level_configuration">
$notification_event_configuration['share_learning_resource']['sms_notification']['is_enabled'] = true;
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="share_learning_resource_event_email_notification_level_configuration">
$notification_event_configuration['share_learning_resource']['email_notification']['is_enabled'] = true;
// </editor-fold>
// </editor-fold>
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="add_teacher_task_event_level_configuration">
// <editor-fold defaultstate="collapsed" desc="add_teacher_task_event_level_configuration">
// <editor-fold defaultstate="collapsed" desc="add_teacher_task_event_push_notification_level_configuration">

$notification_event_configuration['add_teacher_task']['push_notification']['is_enabled'] = true;
$notification_event_configuration['add_teacher_task']['push_notification']['push_notification_type'] = GetCustomConfigItem("push_notification_configuration", "push_notification_type")['push_notification_type_buzz'];
$notification_event_configuration['add_teacher_task']['push_notification']['redirect_to'] = true;
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="add_task_event_sms_notification_level_configuration">
$notification_event_configuration['add_teacher_task']['sms_notification']['is_enabled'] = true;
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="add_task_event_email_notification_level_configuration">
$notification_event_configuration['add_teacher_task']['email_notification']['is_enabled'] = true;
// </editor-fold>
// </editor-fold>
// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="update_teacher_task_event_level_configuration">
// <editor-fold defaultstate="collapsed" desc="update_teacher_task_event_level_configuration">

// <editor-fold defaultstate="collapsed" desc="update_teacher_task_event_push_notification_level_configuration">

$notification_event_configuration['update_teacher_task']['push_notification']['is_enabled'] = true;
$notification_event_configuration['update_teacher_task']['push_notification']['push_notification_type'] = GetCustomConfigItem("push_notification_configuration", "push_notification_type")['push_notification_type_buzz'];
$notification_event_configuration['update_teacher_task']['push_notification']['redirect_to'] = true;

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="update_teacher_task_event_sms_notification_level_configuration">
$notification_event_configuration['update_teacher_task']['sms_notification']['is_enabled'] = true;
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="update_teacher_task_event_email_notification_level_configuration">
$notification_event_configuration['update_teacher_task']['email_notification']['is_enabled'] = true;
// </editor-fold>
// </editor-fold>
// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="daily_plan_update_event_push_notification_level_configuration">

$notification_event_configuration['daily_plan_update']['push_notification']['is_enabled'] = true;
$notification_event_configuration['daily_plan_update']['push_notification']['push_notification_type'] = GetCustomConfigItem("push_notification_configuration", "push_notification_type")['push_notification_type_buzz'];
$notification_event_configuration['daily_plan_update']['push_notification']['redirect_to'] = true;

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="daily_plan_update_event_sms_notification_level_configuration">
$notification_event_configuration['daily_plan_update']['sms_notification']['is_enabled'] = true;
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="daily_plan_update_event_email_notification_level_configuration">
$notification_event_configuration['daily_plan_update']['email_notification']['is_enabled'] = true;
// </editor-fold>
// </editor-fold>
// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="sharing_gallery_event_level_configuration">
// <editor-fold defaultstate="collapsed" desc="sharing_gallery_event_level_configuration">

// <editor-fold defaultstate="collapsed" desc="sharing_gallery_event_push_notification_level_configuration">

$notification_event_configuration['sharing_gallery']['push_notification']['is_enabled'] = true;
$notification_event_configuration['sharing_gallery']['push_notification']['push_notification_type'] = GetCustomConfigItem("push_notification_configuration", "push_notification_type")['push_notification_type_buzz'];
$notification_event_configuration['sharing_gallery']['push_notification']['redirect_to'] = true;

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="sharing_gallery_event_sms_notification_level_configuration">
$notification_event_configuration['sharing_gallery']['sms_notification']['is_enabled'] = true;
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="sharing_gallery_event_email_notification_level_configuration">
$notification_event_configuration['sharing_gallery']['email_notification']['is_enabled'] = true;
// </editor-fold>
// </editor-fold>
// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="free_period_update_event_level_configuration">
// <editor-fold defaultstate="collapsed" desc="free_period_update_event_level_configuration">

// <editor-fold defaultstate="collapsed" desc="free_period_update_event_push_notification_level_configuration">

$notification_event_configuration['free_period_update']['push_notification']['is_enabled'] = true;
$notification_event_configuration['free_period_update']['push_notification']['push_notification_type'] = GetCustomConfigItem("push_notification_configuration", "push_notification_type")['push_notification_type_buzz'];
$notification_event_configuration['free_period_update']['push_notification']['redirect_to'] = true;

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="free_period_update_event_sms_notification_level_configuration">
$notification_event_configuration['free_period_update']['sms_notification']['is_enabled'] = true;
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="free_period_update_event_email_notification_level_configuration">
$notification_event_configuration['free_period_update']['email_notification']['is_enabled'] = true;
// </editor-fold>
// </editor-fold>
// </editor-fold>




// </editor-fold>

$config['notification_event_configuration'] = $notification_event_configuration;
