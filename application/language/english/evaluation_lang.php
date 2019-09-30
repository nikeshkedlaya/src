<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 *
 * will have same class name as prefix such as group_lang
 */
$langModuleLabel = "Evaluation";
$lang['get_evaluation_list_response_not_found'] = sprintf(THERE_IS_NO_RECORD_FOUND, $langModuleLabel);
$lang['get_evaluation_templates_response_not_found'] = sprintf(THERE_IS_NO_RECORD_FOUND, $langModuleLabel . " Template");
$lang['get_students_evaluation_detail_response_not_found'] = sprintf(THERE_IS_NO_RECORD_FOUND, "Student " . $langModuleLabel . " Details");
$lang['add_evaluation_cudu_changed'] = sprintf(DATA_ADDED, $langModuleLabel);
$lang['add_evaluation_cudu_not_changed'] = sprintf(DATA_NOT_ADDED, $langModuleLabel);

$lang['add_student_evaluation_detail_cudu_changed'] = sprintf(DATA_ADDED, "Student " . $langModuleLabel . " Details");
$lang['add_student_evaluation_detail_cudu_not_changed'] = sprintf(DATA_NOT_ADDED, "Student " . $langModuleLabel . " Details");
