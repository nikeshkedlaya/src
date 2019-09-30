<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// $lang['daily_plan_updated'] = "%s has updated the daily plan"; // first would be teacher name who updated daily task n second would be task name
// $lang['new_task_created'] = "%s has been assigned by %s"; // <task name> has been assigned by <task creator>
// $lang['assigned_task_updated'] = "%s has updated the assigned task"; // teacher name who updated the task
// $lang['homework_update'] = "your kid has not submitted the homework,marked by %s"; // teacher name who updated the hw
// $lang['homework_creation'] = "your kid has been assigned the homework by %s"; // teacher name who created the hw
// $lang['updated_the_attendance'] = "%s has marked your kid as absentee for %s"; // teacher name who took the attendence
// $lang['new_compliment_added'] = "%s has complimented your child"; // teacher name who complimented your child
// $lang['new_observation_added'] = "%s has observed your child"; // teacher name who observed your child
// $lang['new_mail'] = "%s by %s"; // <Email Subject> by <sender>
// //$lang['mail_created_msg'] = "%s by %s"; // <Email Subject> by <sender>
// $lang['new_meeting_request'] = "%s by %s"; // <Subject meeting> by creator
// $lang['new_announcement_made'] =
$lang['mail_created']['title'] = "New Mail Received";
$lang['mail_created']['message'] = "%s send by %s"; // <Email Subject> by <sender>

$lang['add_meeting_request']['title'] = "New Meeting Request";
$lang['add_meeting_request']['message'] = "you have been invited for %s meeting organised by %s,scheduled on %s"; // <Subject meeting> by creator

$lang['hw_update']['title'] = "Homework Update";
$lang['hw_update']['message'] = MESSAGE_FORMATTER_KEYWORD . " has not submitted the homework,marked by %s"; // teacher name who updated the hw

$lang['student_attendance_add']['title'] = "Attendance Taken";
$lang['student_attendance_add']['message'] = MESSAGE_FORMATTER_KEYWORD . " was absent on %s, marked by teacher %s"; // teacher name who took the attendence

$lang['student_attendance_update']['title'] = "Attendance Updated";
$lang['student_attendance_update']['message'] = "%parmas% was marked late by %s"; // teacher name who took the attendence

$lang['add_compliments']['title'] = "New Compliment";
$lang['add_compliments']['message'] = "%s has complimented " . MESSAGE_FORMATTER_KEYWORD; // teacher name who complimented your child

$lang['add_observation']['title'] = "New Observation";
$lang['add_observation']['message'] = "%s has observed " . MESSAGE_FORMATTER_KEYWORD; // teacher name who observed your child

$lang['update_teacher_task']['title'] = "Task Updated";
$lang['update_teacher_task']['message'] = "Task has updated by %s"; // first would be teacher name who updated daily task n second would be task name

$lang['add_teacher_task']['title'] = "New Task Created";
$lang['add_teacher_task']['message'] = "new task %s has been assigned by %s"; // <task name> has been assigned by <task creator>

$lang['add_hw_details']['title'] = "New Homework Given";
$lang['add_hw_details']['message'] = MESSAGE_FORMATTER_KEYWORD . " has been assigned the homework by %s"; // teacher name who assigned the hw

$lang['add_announcement']['title'] = "New Announcement";
$lang['add_announcement']['message'] = "new announcement has been made"; // <announcement made

$lang['substitute_create']['title'] = "Substitute Assigned";
$lang['substitute_create']['message'] = "you have been assigned as a substitute teacher by %s"; // <substitute assigned

$lang['calender_event_create']['title'] = "New Calendar Event Created";
$lang['calender_event_create']['message'] = "Event %s is created by %s starting from %s"; // <substitute assigned

$lang['add_group_event_create']['title'] = "New Group Created";
$lang['add_group_event_create']['message'] = "%s group is created by %s"; // <substitute assigned

$lang['share_learning_resource']['title'] = "Shared Learning Resource";
$lang['share_learning_resource']['message'] = "%s resource has been shared with you by %s";

$lang['daily_plan_update']['title'] = "Daily Plan Updated";
$lang['daily_plan_update']['message'] = "%s has updated the daily plan";

$lang['sharing_gallery']['title'] = "New Gallery Shared";
$lang['sharing_gallery']['message'] = "%s has shared the gallery with you";

$lang['free_period_update']['title'] = "Free Period Updated";
$lang['free_period_update']['message'] = "%s has updated the free period";

