<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 *
 * will have same class name as prefix such as group_lang
 */
$langModuleLabel = "Lesson Plan";
$lang['get_learning_activity_response_not_found'] = sprintf(THERE_IS_NO_RECORD_FOUND, "Learning Activity");
$lang['get_l_p_draft_list_response_not_found'] = sprintf(DATA_NOT_FOUND, $langModuleLabel . " Draft");
$lang['get_lesson_plan_log_response_not_found'] = sprintf(DATA_NOT_FOUND, $langModuleLabel . " Log");
$lang['get_lesson_plan_detail_response_not_found'] = sprintf(THERE_IS_NO_RECORD_FOUND, $langModuleLabel . " Detail");
$lang['get_l_p_draft_detail_response_not_found'] = sprintf(DATA_NOT_FOUND, $langModuleLabel . " Draft Detail");

$lang['create_lesson_plan_draft_cudu_changed'] = sprintf(DATA_ADDED, $langModuleLabel . " Draft");
$lang['create_lesson_plan_draft_cudu_not_changed'] = sprintf(DATA_NOT_ADDED, $langModuleLabel . " Draft");

$lang['update_lesson_plan_draft_cudu_changed'] = sprintf(DATA_UPDATED_SUCCESSFULLY, $langModuleLabel . " Draft");
$lang['update_lesson_plan_draft_cudu_not_changed'] = sprintf(DATA_NOT_UPDATED, $langModuleLabel . " Draft");

$lang['create_lesson_plan_from_draft_cudu_changed'] = sprintf(DATA_ADDED, $langModuleLabel);
$lang['create_lesson_plan_from_draft_cudu_not_changed'] = sprintf(DATA_NOT_ADDED, $langModuleLabel);

$lang['copy_lesson_plan_cudu_changed'] = $langModuleLabel . " copied successfully";
$lang['copy_lesson_plan_cudu_not_changed'] = sprintf(THERE_IS_AN_ERROR, " coping the " . $langModuleLabel);

$lang['edit_lesson_plan_cudu_changed'] = sprintf(DATA_UPDATED_SUCCESSFULLY, $langModuleLabel);
$lang['edit_lesson_plan_cudu_not_changed'] = sprintf(DATA_NOT_UPDATED, $langModuleLabel);

$lang['delete_lesson_plan_draft_cudu_changed'] = sprintf(DATA_DELETED_SUCCESSFULLY, $langModuleLabel . " Draft");
$lang['delete_lesson_plan_draft_cudu_not_changed'] = sprintf(DATA_NOT_DELETED, $langModuleLabel . " Draft");

$lang['delete_daily_plan_cudu_changed'] = sprintf(DATA_DELETED_SUCCESSFULLY, "Daily Plan");
$lang['delete_daily_plan_cudu_not_changed'] = sprintf(THERE_IS_AN_ERROR, "deleting the Daily Plan");


