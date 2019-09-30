<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$tags = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */

$tags['addTags'] = "sTagAdd";
$tags['deleteTags'] = "sTagDelete";
$tags['updateTags'] = "sTagUpdate";
$tags['getTagForEditRecord'] = "sTagGet";
$tags['getTagsList'] = "sAdminTagGetList";

$config['tags'] = $tags; // key name must be controller class name in lower case
