<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 *
 * will have same class name as prefix such as group_lang
 */
// response_not_found cudu_changed cudu_not_changed
$langModuleLabel = "Engagement";

$lang['get_engagement_list_response_not_found'] = sprintf(THERE_IS_NO_RECORD_FOUND, $langModuleLabel);
$lang['get_engagement_comments_response_not_found'] = sprintf(THERE_IS_NO_RECORD_FOUND, $langModuleLabel . " Comments");
$lang['get_engagement_detail_response_not_found'] = sprintf(THERE_IS_NO_RECORD_FOUND, $langModuleLabel . " details");
$lang['get_engagement_objective_list_response_not_found'] = sprintf(THERE_IS_NO_RECORD_FOUND, $langModuleLabel . " objectives");
$lang['get_engagement_objectives_response_not_found'] = sprintf(THERE_IS_NO_RECORD_FOUND, $langModuleLabel . " objectives");
$lang['get_engagement_list_for_parent_response_not_found'] = sprintf(THERE_IS_NO_RECORD_FOUND_FOR, $langModuleLabel . " list", "Parent");
$lang['get_engagement_detail_for_parent_response_not_found'] = sprintf(THERE_IS_NO_RECORD_FOUND_FOR, $langModuleLabel . " details", "Parent");
$lang['get_engagement_login_response_not_found'] = sprintf(THERE_IS_NO_RECORD_FOUND, $langModuleLabel . " Login");
$lang['add_user_engagement_cudu_changed'] = sprintf(DATA_ADDED, "user " . $langModuleLabel);
$lang['add_user_engagement_cudu_not_changed'] = sprintf(DATA_NOT_ADDED, "user " . $langModuleLabel);

$lang['add_engagement_objectives_cudu_changed'] = sprintf(DATA_ADDED, $langModuleLabel . " Objectives");
$lang['add_engagement_objectives_cudu_not_changed'] = sprintf(DATA_NOT_ADDED, $langModuleLabel . " Objectives");



