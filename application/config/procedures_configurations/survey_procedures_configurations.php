<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$survey = [];
/* method name would be key name and value would be procedure name */
$survey['getSurveyList'] = "sGetSurveyList"; /* sGetSurveyList(IN PAY_Code varchar(16), IN PUser_Code varchar(16), IN PPageNum int, IN PNumOfRec int) */
$survey['getSurveyDetail'] = "sGetSurveyDetail"; /* sGetSurveyDetail(IN PSurvey_ID int); */
$survey['addSurveyInstance'] = "sAddSurveyInstance"; /* sAddSurveyInstance(IN PUser_Code varchar(16),IN PSurvey_ID int,IN PTitle varchar(255),IN PExpiry_Date varchar(24),IN PTrigger_Date varchar(24),IN PTrigger_Time varchar(24),IN PMembers varchar(1024))
                                                      */
$survey['getSurveyTemplateForUser'] = "sGetSurveyTemplateForUser"; /*
                                                                    * sGetSurveyTemplateForUser(IN PUser_Code varchar(16), IN PSurvey_Instance_ID int, IN PIsTaken int)
                                                                    */
$survey['addSurveyUserInput'] = "sAddSurveyUserInput"; /* sAddSurveyUserInput(IN PSurvey_Instance_ID int,IN PUser_Code varchar(16),IN PInput Text)
                                                        */
$survey['getSurveyListForUser'] = "sGetSurveyListForUser"; /* sGetSurveyListForUser(IN PAY_Code varchar(16), IN PUser_Code varchar(16), IN PUser_Type varchar(24), PIsTaken int, IN PPageNum int, IN PNumOfRec int) */

$survey['getSurveyInstanceList'] = "sGetSurveyInstanceList"; /* sGetSurveyInstanceList(IN PAY_Code VARCHAR(16), IN PUser_Code VARCHAR(16), IN PSurvey_ID INT) */
$survey['getSurveyUserInputList'] = "sGetSurveyUserInputList"; /* sGetSurveyUserInputList(IN PSurvey_Instance_ID INT,IN PPageNum int,IN PNumOfRec int) */
$config['survey'] = $survey; // key name must be controller class name in lower case
