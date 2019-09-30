<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 *
 * will have same class name as prefix such as group_lang
 */
$langModuleLabel = "Mark";
$lang['marks_add_or_update_cudu_changed'] = sprintf(DATA_UPDATED_SUCCESSFULLY, $langModuleLabel);
$lang['marks_add_or_update_cudu_not_changed'] = sprintf(DATA_NOT_UPDATED, $langModuleLabel);

$lang['marks_upload_cudu_changed'] = sprintf(CSV_DATA_UPLOADED, $langModuleLabel);
$lang['marks_upload_cudu_not_changed'] = sprintf(CSV_DATA_NOT_UPLOADED, $langModuleLabel);

$lang['download_marks_template_response_not_found'] = "There is an error while downloading the Mark Template";
$lang['marks_for_assessment_detail_get_response_not_found'] = sprintf(THERE_IS_NO_RECORD_FOUND_FOR, "Mark", "Assessment");