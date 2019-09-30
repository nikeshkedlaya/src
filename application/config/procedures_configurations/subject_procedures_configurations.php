<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$subject = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */
$subject['getSubjectListByUser'] = "sGetSubjectListByUser"; // sGetSubjectListByUser(IN PAY_Code varchar(16), IN PSAY_Code int , IN PTeacher_Code varchar(16), IN IsHierarchy int(1))
$subject['getSubjectList'] = "sGetSubjectList"; // sGetSubjectList(IN PAY_Code varchar(16), IN PUser_Code varchar(16), IN PIsAll int, IN PIsHierarchy int)
$subject['getSubjectListByClass'] = "sGetSubjectListByClass"; // sGetSubjectListByClass(IN PAY_Code VARCHAR(16), IN PUser_Code VARCHAR(16), IN PClass_Code VARCHAR(16), IN PIsMine int)
$subject['getSubjectListBySAY'] = "sGetSubjectListBySAY"; // sGetSubjectListBySAY(IN PAY_Code VARCHAR(16), IN PUser_Code VARCHAR(16), IN PSection_AY_Code INT, IN PIsMine INT)

$config['subject'] = $subject; // key name must be controller class name in lower case
