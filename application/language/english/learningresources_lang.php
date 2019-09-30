<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 *
 * will have same class name as prefix such as group_lang
 */
$langModuleLabel = "learning resources";
$lang['add_learning_resource_cudu_changed'] = "Learning resources shared successfully";
$lang['add_learning_resource_cudu_not_changed'] = sprintf(THERE_IS_AN_ERROR, "sharing the learning resources");

$lang['add_learning_resource_repo_cudu_changed'] = sprintf(DATA_ADDED, $langModuleLabel);
$lang['add_learning_resource_repo_cudu_not_changed'] = sprintf(DATA_NOT_ADDED, $langModuleLabel);

$lang['add_learning_resource_file_view_cudu_changed'] = sprintf(DATA_ADDED, $langModuleLabel . " file view");
$lang['add_learning_resource_file_view_cudu_not_changed'] = sprintf(DATA_NOT_ADDED, "Learning resources");

$lang['get_learning_resources_from_repo_response_not_found'] = sprintf(THERE_IS_NO_RECORD_FOUND_FOR, $langModuleLabel, "repo");
$lang['get_files_from_repo_by_id_response_not_found'] = sprintf(THERE_IS_NO_RECORD_FOUND, $langModuleLabel . " repo files");
$lang['get_all_resources_from_repo_response_not_found'] = sprintf(DATA_NOT_FOUND, $langModuleLabel);
$lang['get_shared_resources_response_not_found'] = sprintf(THERE_IS_NO_RECORD_FOUND, "Shared resources");
