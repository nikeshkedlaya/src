<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$knps = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */
$knps['generateTeacherDairySubmissionReport'] = "sGenerateTeacherDairySubmissionReport"; /* sGenerateTeacherDairySubmissionReport(IN PDate VARCHAR(64)) */
$knps['generateAttenanceReport'] = "sGenerateAttenanceReport"; /* sGenerateAttenanceReport(IN PDate VARCHAR(64)) */
$config['knps'] = $knps; // key name must be controller class name in lower case
