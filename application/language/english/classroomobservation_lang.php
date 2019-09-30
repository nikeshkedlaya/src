<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 *
 * will have same class name as prefix such as group_lang
 */
// response_not_found cudu_changed cudu_not_changed
$langModuleLabel = "Classroom Observation";

$lang['get_class_room_observation_list_response_not_found'] = sprintf(THERE_IS_NO_RECORD_FOUND, $langModuleLabel);
$lang['get_my_class_room_observation_response_not_found'] = sprintf(THERE_IS_NO_RECORD_FOUND, "my " . $langModuleLabel);
$lang['get_class_room_observation_comments_response_not_found'] = sprintf(THERE_IS_NO_RECORD_FOUND, $langModuleLabel . " Comment");
$lang['get_user_input_response_not_found'] = sprintf(THERE_IS_NO_RECORD_FOUND, "user input");
$lang['get_teacher_observation_count_response_not_found'] = sprintf(THERE_IS_NO_RECORD_FOUND, "Teacher Observation Count");
$lang['add_class_room_observation_cudu_changed'] = sprintf(DATA_ADDED, $langModuleLabel);
$lang['add_class_room_observation_cudu_not_changed'] = sprintf(DATA_NOT_ADDED, $langModuleLabel);
$lang['add_class_room_observation_comment_cudu_changed'] = sprintf(DATA_ADDED, $langModuleLabel . " Comment");
$lang['add_class_room_observation_comment_cudu_not_changed'] = sprintf(DATA_NOT_ADDED, $langModuleLabel . " Comment");