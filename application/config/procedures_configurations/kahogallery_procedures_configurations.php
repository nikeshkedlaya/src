<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$kahogallery = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */
$kahogallery['addGalleryRepo'] = "sAddGalleryRepo"; /*
                                                     * sAddGalleryRepo(
                                                     * IN PUser_Code VARCHAR(16),
                                                     * IN PFile_Detail TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci
                                                     * /* PFile_Detail: Title~desc~link~type~isprivate§Title~desc~link~type~isprivate
                                                     */
/*
 * PFile_Detail array Seperated by §
 * )
 */
$kahogallery['getFilesToShare'] = "sGetFilesToShare"; /* sGetFilesToShare(IN PAY_Code VARCHAR(16), IN PUser_Code VARCHAR(16), IN PPageNum int, IN PNumOfRec int) */
$kahogallery['addGalleryFileShare'] = "sAddGalleryFileShare"; /* sAddGalleryFileShare(IN PUser_Code VARCHAR(16), IN PComments TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci, IN PFile_IDs VARCHAR(1024), IN PUsers TEXT, IN PSelected_Type int) /*PFile_IDs,PUsers array Seperated by | */
$kahogallery['getGallerySharedWithMe'] = "sGetGallerySharedWithMe"; /* sGetGallerySharedWithMe(IN PAY_Code VARCHAR(16), IN PUser_Code VARCHAR(16), IN PUser_Type VARCHAR(16), IN PPageNum int, IN PNumOfRec int ) */
$kahogallery['updateGalleryFileViewCount'] = "sUpdateGalleryFileViewCount"; /* sUpdateGalleryFileViewCount(IN PGallery_Repo_ID int) */
$kahogallery['getGalleryRepoList'] = "sGetGalleryRepoList"; /* sGetGalleryRepoList(IN PUser_Code VARCHAR(16)) */

$config['kahogallery'] = $kahogallery; // key name must be controller class name in lower case
