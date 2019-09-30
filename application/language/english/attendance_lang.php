<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 *
 * will have same class name as prefix such as group_lang
 */
$langModuleLabel = "Attendance";
$lang['attendance_add_cudu_changed'] = sprintf(DATA_ADDED, $langModuleLabel);
$lang['attendance_add_cudu_not_changed'] = sprintf(DATA_NOT_ADDED, $langModuleLabel);

$lang['update_student_attendance_cudu_changed'] = sprintf(DATA_UPDATED_SUCCESSFULLY, $langModuleLabel);
$lang['update_student_attendance_cudu_not_changed'] = sprintf(DATA_NOT_UPDATED, $langModuleLabel);

$lang['get_attendance_period_list_response_not_found'] = sprintf(DATA_NOT_FOUND, $langModuleLabel);
$lang['get_attendance_count_response_not_found'] = sprintf(DATA_NOT_FOUND, $langModuleLabel . " Count");
$lang['get_attendance_not_taken_detail_response_not_found'] = sprintf(DATA_NOT_FOUND, $langModuleLabel . " not taken");
$lang['get_students_for_attendance_response_not_found'] = sprintf(THERE_IS_NO_RECORD_FOUND_FOR, "Student ", "Attendance");
