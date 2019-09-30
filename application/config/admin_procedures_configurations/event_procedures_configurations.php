<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$event = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */

$event['addEvent'] = "sCalendarAdd";
$event['updateCalendarEvent'] = "sCalendarupdate";
$event['deleteEvent'] = "sCalendarDelete";
$event['getEventForEditRecord'] = "";
$event['getEventList'] = "sAdminEventGetList";

$config['event'] = $event; // key name must be controller class name in lower case
