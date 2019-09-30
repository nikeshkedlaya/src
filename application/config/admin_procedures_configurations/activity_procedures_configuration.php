<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$activity = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */

$activity['addActivity'] = "sActivityAdd";
$activity['deleteActivity'] = "sActivityDelete"; 
$activity['updateActivity'] = "sActivityUpdate"; 
$activity['getActivityList'] = "sAdminActivityGetList"; 
$activity['getActivityType'] = "sLookUpGetList"; 
$activity['uploadCSVFile'] = "sActivityImportData"; 


$config['activity'] = $activity; // key name must be controller class name in lower case
