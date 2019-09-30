<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$traction= [];
/* groups procedures */
/* method name would be key name and value would be procedure name */
$traction['tractionUserLoginCountGet'] = "sTractionUserLoginCountGet"; //  
/* Login */
//sTractionUserLoginCountGet
//  (
//    IN PSchool_DB VARCHAR(264),
//    IN PFrom_Date VARCHAR(16),
//    IN PTo_Date   VARCHAR(16)
//  )

$traction['tractionTeacherAndParentCountGet'] = "sTractionTeacherAndParentCountGet"; 
//sTractionTeacherAndParentCountGet
//  (
//    IN PSchool_Database VARCHAR(264),
//    IN PFrom_Date       VARCHAR(16),
//    IN PTo_Date         VARCHAR(16)
//  )

$traction['tractionUserLoginDetailGet'] = "sTractionUserLoginDetailGet";
//sTractionUserLoginDetailGet
//  (
//    IN PSchool_Database VARCHAR(264),
//    IN PFrom_Date       VARCHAR(16),
//    IN PTo_Date         VARCHAR(16),
//    IN PType            VARCHAR(64)
//  )

/* Not Login */

$traction['tractionUsersNotLoggedInCount'] = "sTractionUsersNotLoggedInCount";
//sTractionUsersNotLoggedInCount
//  (
//    IN PSchool_Database VARCHAR(264),
//    IN PDays            INT
//  )

$traction['tractionUsersNotLoggedInUserTypeCountGet'] = "sTractionUsersNotLoggedInUserTypeCountGet";
//sTractionUsersNotLoggedInUserTypeCountGet
//  (
//    IN PSchool_Database VARCHAR(264),
//    IN PDays            INT
//  )

$traction['tractionUsersNotLoggedDetailGet'] = "sTractionUsersNotLoggedDetailGet";
//sTractionUsersNotLoggedDetailGet
//  (
//    IN PSchool_Database VARCHAR(264),
//    IN PDays            INT,
//    IN PType            VARCHAR(64)
//  )

/* Transaction Log */

$traction['tractionTransactionLogGet'] = "sTractionTransactionLogGet";
//sTractionTransactionLogGet
//  (
//    IN PSchool_Database VARCHAR(264),
//    IN PFrom_Date       VARCHAR(16),
//    IN PTo_Date         VARCHAR(16)
//  )

$traction['tractionTransactionLogDetail'] = "sTractionTransactionLogDetail";
//sTractionTransactionLogDetail
//  (
//    IN PSchool_Database VARCHAR(264),
//    IN PFrom_Date       VARCHAR(16),
//    IN PTo_Date         VARCHAR(16)
//  )

$traction['tractionTransactionUsersCountByTypeGet'] = "sTractionTransactionUsersCountByTypeGet";
//sTractionTransactionUsersCountByTypeGet
//  (
//    IN PSchool_Database VARCHAR(264),
//    IN PFrom_Date       VARCHAR(16),
//    IN PTo_Date         VARCHAR(16),
//    IN PType            VARCHAR(1024)
//  )



/* Inputs */
$traction['tractionInputsCountGet'] = "sTractionInputsCountGet";
//sTractionInputsCountGet
//  (
//    IN PSchool_Database VARCHAR(264),
//    IN PFrom_Date       VARCHAR(16),
//    IN PTo_Date         VARCHAR(16)
//  )

$traction['tractionInputsCountByTypeGet'] = "sTractionInputsCountByTypeGet";
//sTractionInputsCountByTypeGet
//  (
//    IN PSchool_Database VARCHAR(264),
//    IN PFrom_Date       VARCHAR(16),
//    IN PTo_Date         VARCHAR(16)
//  )

$traction['tractionInputsCountByTypeAndTeacher'] = "sTractionInputsCountByTypeAndTeacher";
//sTractionInputsCountByTypeAndTeacher
//  (
//    IN PSchool_Database VARCHAR(264),
//    IN PFrom_Date       VARCHAR(16),
//    IN PTo_Date         VARCHAR(16),
//    IN PType            VARCHAR(64)
//  )

$traction['tractionInputsCountByTypeAndStudent'] = "sTractionInputsCountByTypeAndStudent";
//sTractionInputsCountByTypeAndStudent
//  (
//    IN PSchool_Database VARCHAR(264),
//    IN PFrom_Date       VARCHAR(16),
//    IN PTo_Date         VARCHAR(16),
//    IN PType            VARCHAR(64)
//  )

/* Engagement */

$traction['tractionUserEngagementcDetailCount'] = "sTractionUserEngagementcDetailCount";
//sTractionUserEngagementcDetailCount
//  (
//    IN PSchool_Database VARCHAR(264),
//    IN PFrom_Date       VARCHAR(16),
//    IN PTo_Date         VARCHAR(16)
//  )

/* MCQ */

$traction['tractionStudentMCQCount'] = "sTractionStudentMCQCount";
//sTractionStudentMCQCount
//  (
//    IN PSchool_Database VARCHAR(264),
//    IN PFrom_Date       VARCHAR(16),
//    IN PTo_Date         VARCHAR(16)
//  )

$traction['tractionStudentMCQDetailCount'] = "sTractionStudentMCQDetailCount";
//sTractionStudentMCQDetailCount
//  (
//    IN PSchool_Database VARCHAR(264),
//    IN PFrom_Date       VARCHAR(16),
//    IN PTo_Date         VARCHAR(16)
//  )

/* Teacher Observation */

$traction['tractionClassRoomObsCountGet'] = "sTractionClassRoomObsCountGet";
//sTractionClassRoomObsCountGet
//  (
//    IN PSchool_Database VARCHAR(264),
//    IN PFrom_Date       VARCHAR(16),
//    IN PTo_Date         VARCHAR(16)
//  )

$traction['tractionClassRoomObsDetailGet'] = "sTractionClassRoomObsDetailGet";
//sTractionClassRoomObsDetailGet
//  (
//    IN PSchool_Database VARCHAR(264),
//    IN PFrom_Date       VARCHAR(16),
//    IN PTo_Date         VARCHAR(16)
//  )

$traction['getTractionMenu'] = "sGetTractionMenu"; //sGetTractionMenu(IN PUser_Code VARCHAR(16))

$config['traction'] = $traction; // key name must be controller class name in lower case
