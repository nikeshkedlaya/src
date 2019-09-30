<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$dashboard = [];
/* dashboard procedures */
/* method name would be key name and value would be procedure name */
$dashboard['getDashboardTaskCount'] = "sGetDashboardTaskCount"; /*
                                                                 * sGetDashboardTaskCount(IN PAY_Code VARCHAR(16), IN PUser_Code VARCHAR(16))
                                                                 */
$dashboard['getDashboardTaskFollowUpCount'] = "sGetDashboardTaskFollowUpCount"; /*
                                                                                 * sGetDashboardTaskFollowUpCount(IN PAY_Code VARCHAR(16), IN PUser_Code VARCHAR(16))
                                                                                 */

$dashboard['getDashboardNewMailCount'] = "sGetDashboardNewMailCount"; /*
                                                                       * sGetDashboardNewMailCount(IN PAY_Code VARCHAR(16), IN PUser_Code VARCHAR(16), IN PUser_Type VARCHAR(16))
                                                                       *
                                                                       */
$dashboard['getDashboardMeetingList'] = "sGetDashboardMeetingList"; /*
                                                                     * sGetDashboardMeetingList(IN PAY_Code VARCHAR(16), IN PUser_Code VARCHAR(16), IN PUser_Type VARCHAR(16))
                                                                     *
                                                                     */
$dashboard['getDashboardHWUpdate'] = "sGetDashboardHWUpdate"; /*
                                                               * sGetDashboardHWUpdate(IN PAY_Code VARCHAR(16), IN PUser_Code VARCHAR(16))
                                                               */
$dashboard['getDashboardConcernShareCount'] = "sGetDashboardConcernShareCount"; /*
                                                                                 * sGetDashboardConcernShareCount(IN PAY_Code VARCHAR(16), IN PUser_Code VARCHAR(16))
                                                                                 */
$dashboard['getDashboardRosterDutyList'] = "sGetDashboardRosterDutyList"; /*
                                                                           * sGetDashboardRosterDutyList(IN PAY_Code VARCHAR(16), IN PUser_Code VARCHAR(16))
                                                                           *
                                                                           */
$dashboard['getLogBookDetail'] = "sGetLogBookDetail"; /*
                                                       * sGetLogBookDetail(IN PAY_Code VARCHAR(16), IN PUser_Code VARCHAR(16))
                                                       */
$dashboard['getDashboardTeacherObservationReview'] = "sGetDashboardTeacherObservationReview"; /*
                                                                                               * sGetDashboardTeacherObservationReview(IN PAY_Code VARCHAR(16), IN PUser_Code VARCHAR(16))
                                                                                               */
$dashboard['getDashboardLPApprovals'] = "sGetDashboardLPApprovals"; /* sGetDashboardLPApprovals(IN PAY_Code VARCHAR(16), IN PUser_Code VARCHAR(16)) */

$dashboard['getDashboardAnnouncement'] = "sGetDashboardAnnouncement"; /*
                                                                       * sGetDashboardAnnouncement(IN PAY_Code VARCHAR(16), IN PUser_Code VARCHAR(16), IN PUser_Type VARCHAR(16))
                                                                       */
$dashboard['getDashboardTeacherActivity'] = "sGetDashboardTeacherActivity"; /*
                                                                             * sGetDashboardTeacherActivity(IN PAY_Code VARCHAR(16), IN PTeacher_Code VARCHAR(16))
                                                                             */

$dashboard['getDashboardLeaderList'] = "sGetDashboardLeaderList"; /*
                                                                   * sGetDashboardLeaderList(IN PAY_Code VARCHAR(16), IN PTeacher_Code VARCHAR(16),Month)
                                                                   */
$dashboard['getDashboardImproveList'] = "sGetDashboardImproveList"; /*
                                                                     * sGetDashboardImproveList(IN PAY_Code VARCHAR(16), IN PTeacher_Code VARCHAR(16),Month)
                                                                     */
$dashboard['getDashboardSubstituteDetail'] = "sGetDashboardSubstituteDetail"; /* sGetDashboardSubstituteDetail(IN PAY_Code VARCHAR(16), IN PTeacher_Code VARCHAR(16)) */

$dashboard['getDashboardSubstituteCount'] = "sGetDashboardSubstituteCount"; /* sGetDashboardSubstituteCount(IN PAY_Code VARCHAR(16), IN PTeacher_Code VARCHAR(16)) */

$dashboard['getDashboardRosterDutyTeachersList'] = "sGetDashboardRosterDutyTeachersList"; /* sGetDashboardRosterDutyTeachersList(IN PAY_Code VARCHAR(16), IN PUser_Code VARCHAR(16)) */

$dashboard['getDashboardStudentAttendanceTrend'] = "sGetDashboardStudentAttendanceTrend"; /* sGetDashboardStudentAttendanceTrend(IN PAY_Code VARCHAR(16), IN PUser_Code VARCHAR(16), IN PIsHierarchy INT, IN PIsSchoolwise INT, IN PDays INT) */

$dashboard['getDashboardStudentAttendanceIrregularity'] = "sGetDashboardStudentAttendanceIrregularity"; /* sGetDashboardStudentAttendanceIrregularity(IN PAY_Code VARCHAR(16), IN PUser_Code VARCHAR(16), IN PIsHierarchy INT, IN PIsSchoolwise INT) */

$dashboard['getDashboardConcernList'] = "sGetDashboardConcernList"; /* sGetDashboardConcernList(IN PAY_Code VARCHAR(16), IN PUser_Code VARCHAR(16), IN PFrom_Date VARCHAR(24), IN PTo_Date VARCHAR(24), IN PIsMine INT, IN PIsResolved INT, IN PIsHierarchy INT) */

$dashboard['getDashboardPortionCompletion'] = "sGetDashboardPortionCompletion"; /* sGetDashboardPortionCompletion(IN PAY_Code VARCHAR(16), IN PUser_Code VARCHAR(16), IN PFrom_Date VARCHAR(24), PTo_Date VARCHAR(64), IN PTeacher_Code VARCHAR(16), IN PClass_Code VARCHAR(16), IN PSubject_Code VARCHAR(16)) */

$dashboard['getDashboardTeacherReflection'] = "sGetDashboardTeacherReflection"; /* sGetDashboardTeacherReflection(IN PAY_Code VARCHAR(16), IN PUser_Code VARCHAR(16), IN PFrom_Date VARCHAR(24), IN PTo_Date VARCHAR(24), IN PTeacher_Code VARCHAR(16)) */
$dashboard['getDashboardInputPercentage'] = "sGetDashboardInputPercentage"; /* sGetDashboardInputPercentage(IN PAY_Code VARCHAR(16), IN PUser_Code VARCHAR(16), IN PIsAll INT, IN PIsHierarchy INT, IN PFrom_Date VARCHAR(24), IN PTo_Date VARCHAR(24), IN PFilter_Type VARCHAR(16), IN PInput_Type VARCHAR(64)) */

$dashboard['getDashboardLateComers'] = "sGetDashboardLateComers"; /* sGetDashboardLateComers(IN PAY_Code VARCHAR(16), IN PUser_Code varchar(16), IN PAttendance_Date VARCHAR(24), IN PClass_Code VARCHAR(16), IN PSection_Code VARCHAR(16)) */
$dashboard['getDashboardClassAttendanceCount'] = "sGetDashboardClassAttendanceCount"; /* sGetDashboardClassAttendanceCount(IN PAY_Code VARCHAR(16), IN PUser_Code VARCHAR(16), IN PIsHierarchy INT, IN PIsAsll INT, IN PAttendance_Date VARCHAR(24)) */

$dashboard['getDashboardTeacherTopicNonCoverage'] = "sGetDashboardTeacherTopicNonCoverage"; /* sGetDashboardTeacherTopicNonCoverage(IN PAY_Code VARCHAR(16), IN PUser_Code VARCHAR(16), IN PFrom_Date VARCHAR(24), PTo_Date VARCHAR(64), IN PTeacher_Code VARCHAR(16), IN PClass_Code VARCHAR(16), IN PSection_Code VARCHAR(16), IN PSubject_Code VARCHAR(16)) */

$config['dashboard'] = $dashboard; // key name must be controller class name in lower case
