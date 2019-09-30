<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$rosterduty = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */
$rosterduty['addRosterDuty'] = "sAddRosterDuty"; /*
                                                  * sAddRosterDuty(IN PUser_Code VARCHAR(16), IN PRoster_Header_ID INT, IN PFrom_Date VARCHAR(16), IN PTo_Date VARCHAR(16),IN PType VARCHAR(64), IN PType_Detail VARCHAR(24), IN PDuty_Detail TEXT)
                                                  */
$rosterduty['addTeacherRosterDutyUpdate'] = "sAddTeacherRosterDutyUpdate"; /*
                                                                            * sAddTeacherRosterDutyUpdate(IN PUser_Code VARCHAR(16), IN PRoster_Allocation_ID INT, PDuty_Date VARCHAR(24), IN PComments TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci)
                                                                            */

$rosterduty['getRosterDuty'] = "sGetRosterDuty"; /* sGetRosterDuty(IN PAY_Code VARCHAR(16), IN PUser_Code VARCHAR(16), IN PAction_Date VARCHAR(24)) */
$rosterduty['getRosterDutyList'] = "sGetRosterDutyList"; /* sGetRosterDutyList */

$config['rosterduty'] = $rosterduty; // key name must be controller class name in lower case
