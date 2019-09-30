<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$lessonplan = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */

$lessonplan['getLessonPlanDetails'] = "sLessonPlanDetailGet";
$lessonplan['getLessonPlan'] = "sLessonPlanGet";

$config['lessonplan'] = $lessonplan; // key name must be controller class name in lower case
