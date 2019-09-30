<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$classdetails = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */
$classdetails['classSectionListByUser'] = "sClassSectionListByUser"; // sClassSectionListByUser(IN PAY_Code varchar(16), IN PTeacher_Code varchar(16), IN PMine int(1), IN PIsHierarchy int(1))
$classdetails['getClassSectionList'] = "sGetClassSectionList"; // sGetClassSectionList(IN PAY_Code varchar(16))
$classdetails['getClassList'] = "sGetClassList"; // sGetClassList(IN PAY_Code varchar(16), IN PUser_Code varchar(16), IN PIsAll int(1), IN PIsHierarchy int(1))
$config['classdetails'] = $classdetails; // key name must be controller class name in lower case