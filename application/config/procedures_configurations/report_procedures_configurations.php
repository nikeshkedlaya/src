<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$report = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */
$report['getAttendanceSummary'] = "sGetAttendanceSummary"; /* sGetAttendanceSummary(IN PUser_Code VARCHAR(16), IN PType VARCHAR(16), IN PDate VARCHAR(24)) */

$report['getCalendarEventsForADay'] = "sGetCalendarEventsForADay"; /* sGetCalendarEventsForADay(IN PUser_Code VARCHAR(16), IN PDate VARCHAR(24)) */

$report['getInspectionSummary'] = "sGetInspectionSummary"; /* sGetInspectionSummary(IN PUser_Code VARCHAR(16))
 */

$report['getOverallSummary'] = "sGetOverallSummary"; /* sGetOverallSummary(IN PUser_Code VARCHAR(16)) */

$report['getAttendanceSummaryBlockwise'] = "sGetAttendanceSummaryBlockwise"; /* sGetAttendanceSummaryBlockwise(IN PUser_Code VARCHAR(16), IN PType VARCHAR(16), IN PDate VARCHAR(24)) */

$report['getAttendanceDetailBlockwise'] = "sGetAttendanceDetailBlockwise"; /* sGetAttendanceDetailBlockwise(IN PUser_Code VARCHAR(16), IN PType VARCHAR(16), IN PDate VARCHAR(24),
                                               IN PBlock_ID  INT) */

$report['getMDMSummary'] = "sGetMDMSummary"; /* sGetMDMSummary(IN PUser_Code VARCHAR(16), IN PDate VARCHAR(24)) */

$report['getMDMSummaryBlockwise'] = "sGetMDMSummaryBlockwise"; /* sGetMDMSummaryBlockwise(IN PUser_Code VARCHAR(16), IN PDate VARCHAR(24)) */

$report['getMDMReasonSummary'] = "sGetMDMReasonSummary"; /* sGetMDMReasonSummary(IN PUser_Code VARCHAR(16), IN PDate VARCHAR(24)) */

$report['getMDMReasonSummaryBlockwise'] = "sGetMDMReasonSummaryBlockwise"; /* sGetMDMReasonSummaryBlockwise(IN PUser_Code VARCHAR(16), IN PDate VARCHAR(24)) */

$report['getFacilityDetail'] = "sGetFacilityDetail"; /* sGetFacilityDetail(IN PUser_Code VARCHAR(16), IN PSearch_Keyword VARCHAR(16)) */

$report['getSchoolsList'] = "sGetSchoolsList"; /* sGetSchoolsList(IN PUser_Code VARCHAR(16), IN PBlock_ID INT, IN PSearch_Keyword VARCHAR(1024)) */

$report['getFacilityDetailBySchool'] = "sGetFacilityDetailBySchool"; /* sGetFacilityBySchool(IN PSchool_Code VARCHAR(128) */

$report['getFacilitySummary'] = "sGetFacilitySummary"; /* sGetFacilitySummary(IN PUser_Code VARCHAR(16))
 */

$report['getFacilitySummaryDetail'] = "sGetFacilitySummaryDetail"; /* sGetFacilitySummaryDetail(IN PUser_Code VARCHAR(16), IN PFacility_ID INT, IN PType      INT)
 */

$report['getMDMDetailSchoolList'] = "sGetMDMDetailSchoolList"; /* sGetMDMDetailSchoolList(IN PUser_Code VARCHAR(16), IN PDate VARCHAR(24), IN PBlock_ID INT, IN PIs_Served INT)
 */

$report['rptAnnouncementDetailAdd'] = "sRptAnnouncementDetailAdd"; /*  */

$report['getAnnouncements'] = "sGetAnnouncements"; /*  */


$config['report'] = $report; // key name must be controller class name in lower case

