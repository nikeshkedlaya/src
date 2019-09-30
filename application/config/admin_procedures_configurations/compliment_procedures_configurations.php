<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$compliment = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */

$compliment['addCompliment'] = "sComplimentAdd";
$compliment['deleteCompliment'] = "sComplimentDelete";
$compliment['updateCompliment'] = "sComplimentUpdate";
$compliment['getComplimentForEditRecord'] = "sComplimentGet";
$compliment['getComplimentList'] = "sAdminComplimentGetList";

$config['compliment'] = $compliment; // key name must be controller class name in lower case
