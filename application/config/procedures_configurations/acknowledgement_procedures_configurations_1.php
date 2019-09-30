<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$acknowledgement = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */
$acknowledgement['getAcknowledgementDetail'] = "sGetAcknowledgementDetail"; /* sGetAcknowledgementDetail(IN PUser_Code VARCHAR(16), IN PObject_Type VARCHAR(64), IN PTransaction_ID INT) */
$acknowledgement['addAcknowledgement'] = "sAddAcknowledgement"; /* sAddAcknowledgement(IN PUser_Code VARCHAR(16), IN PObject_Type VARCHAR(64), IN PTransaction_ID INT, IN PComments TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci) */
$config['acknowledgement'] = $acknowledgement; // key name must be controller class name in lower case
