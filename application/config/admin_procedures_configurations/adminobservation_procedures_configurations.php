<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$adminobservation = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */

$adminobservation['addObservation'] = "sObservationAdd";
$adminobservation['deleteObservation'] = "sObservationDelete";
$adminobservation['updateObservation'] = "sObservationUpdate";
$adminobservation['getObservationForEditRecord'] = "sObservationGet";
$adminobservation['getObservationList'] = "sAdminObservationGetList";

$config['adminobservation'] = $adminobservation; // key name must be controller class name in lower case
