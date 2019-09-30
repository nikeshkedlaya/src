<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 *
 * will have same class name as prefix such as group_lang
 */
// response_not_found cudu_changed cudu_not_changed
$langModuleLabel = "gallery";

$lang['get_files_to_share_response_not_found'] = sprintf(THERE_IS_NO_RECORD_FOUND_FOR, " files", "sharing");
$lang['get_gallery_repo_list_response_not_found'] = sprintf(THERE_IS_NO_RECORD_FOUND_FOR, "repo", $langModuleLabel);
$lang['get_gallery_shared_with_me_response_not_found'] = sprintf(THERE_IS_NO_RECORD_FOUND, " gallery shared with you");
$lang['add_gallery_repo_cudu_changed'] = "Files added successfully to gallery";
$lang['add_gallery_repo_cudu_not_changed'] = sprintf(THERE_IS_AN_ERROR, " adding files to gallery");

$lang['add_gallery_file_share_cudu_changed'] = "Files shared successfully ";
$lang['add_gallery_file_share_cudu_not_changed'] = sprintf(THERE_IS_AN_ERROR, " sharing  ", $langModuleLabel . " files");
$lang['update_gallery_file_view_count_cudu_changed'] = sprintf(DATA_UPDATED_SUCCESSFULLY, "gallery view count");
$lang['update_gallery_file_view_count_cudu_not_changed'] = sprintf(DATA_NOT_UPDATED, "gallery view count");

$lang['upload_gallery_attachment_response_not_found'] = sprintf(DATA_NOT_UPLOADED, "Gallery attachment");


