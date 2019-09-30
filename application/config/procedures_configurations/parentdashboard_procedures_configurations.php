<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$parentdashboard = [];

/* method name would be key name and value would be procedure name */
$parentdashboard['getParentDashboardSummary'] = "sGetParentDashboardSummary"; /* sGetParentDashboardSummary(IN PAY_Code VARCHAR(16), IN PStudent_Code VARCHAR(16), IN PTime VARCHAR(64), IN PNumOfRec INT) */
$parentdashboard['getParentProfile'] = "sGetParentProfile"; /* sGetParentProfile(IN PUser_Code varchar(16)) */
$parentdashboard['updateParentProfile'] = "sUpdateParentProfile"; /*
                                                                   * sUpdateParentProfile(IN PUser_Code varchar(16), -- Parent Code,IN PParent_Name varchar(255),IN PPhone varchar(255),IN PEmail VARCHAR(255),IN PParent_Occupation text CHARACTER set utf8 COLLATE utf8_unicode_ci,IN PPermanent_Address text CHARACTER set utf8 COLLATE utf8_unicode_ci,IN PLocal_Address text CHARACTER set utf8 COLLATE utf8_unicode_ci,IN PPhoto text CHARACTER set utf8 COLLATE utf8_unicode_ci,IN PBio text CHARACTER set utf8 COLLATE utf8_unicode_ci,IN PFav_Colour text CHARACTER set utf8 COLLATE utf8_unicode_ci,IN PFav_Restaurant text CHARACTER set utf8 COLLATE utf8_unicode_ci,IN PFav_Drink text CHARACTER set utf8 COLLATE utf8_unicode_ci,IN PFav_Hobby text CHARACTER set utf8 COLLATE utf8_unicode_ci,IN PFav_Store text CHARACTER set utf8 COLLATE utf8_unicode_ci,IN PFav_Books text CHARACTER set utf8 COLLATE utf8_unicode_ci,IN PFav_Movies text CHARACTER set utf8 COLLATE utf8_unicode_ci,IN PAbout_Parent text CHARACTER set utf8 COLLATE utf8_unicode_ci,IN PLinkedIn_Profile text CHARACTER set utf8 COLLATE utf8_unicode_ci,IN PFacebook_Profile text CHARACTER set utf8 COLLATE utf8_unicode_ci)
                                                                   */
$config['parentdashboard'] = $parentdashboard; // key name must be controller class name in lower case
