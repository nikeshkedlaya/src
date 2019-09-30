<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$admincommon = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */

$admincommon['getLookUpList'] = "sLookUpGetList";
$admincommon['getAcademicYearList'] = "sGetAcademicYearList";
$admincommon['getConfig'] = "sConfigGet";

$config['admincommon'] = $admincommon; // key name must be controller class name in lower case
