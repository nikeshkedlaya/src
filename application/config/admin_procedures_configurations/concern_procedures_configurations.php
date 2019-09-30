<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$concern = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */

$concern['addConcern'] = "sConcernAdd";
$concern['deleteConcern'] = "sConcernDelete";
$concern['updateConcern'] = "sConcernUpdate";
$concern['getConcernForEditRecord'] = "sConcernGet";
$concern['getConcernList'] = "sAdminConcernGetList";

$config['concern'] = $concern; // key name must be controller class name in lower case
