<?php

/**
 * @created by Nikesh<nikesh@kaholabs.com> on 15 Nov, 2014 11:40:50 AM
 * 
 * Descripion: 
 * 
 * Security : 
 * 
 * Change History :-
 * 
 * 
 * 
 * 
 * @Audited by :-
 */
// namespace kaholabs
class Teacher extends KaHO_Controller
{

    public function __construct()
    {
        parent::__construct("teacher/teacherservice");
    }

    public function getTeacherTaskForWeek()
    {
        $this->teacherservice->getTeacherTaskForWeek();
    }

    public function kaHOPointsGet()
    {
        $this->teacherservice->kaHOPointsGet();
    }

    public function getDashboardNotifications()
    {
        $this->teacherservice->getDashboardNotifications();
    }

    public function addTeacherTaskComment()
    {
        $this->teacherservice->addTeacherTaskComment();
    }

    public function updateTeacherTask()
    {
        $this->teacherservice->updateTeacherTask();
    }

    public function GetSuccessMessageForTask($jsonData = "", $key, $message = "Successfull", $succcode = "SUC001")
    {
        $json = array();
        $json['msg'] = "Success";
        $json['code'] = $succcode;
        $json['cusmsg'] = $message;
        $i = 0;
        foreach ($jsonData as $keys => $val) {
            $json[$key][0]['Teacher_Code'] = $val['Teacher_Code'];
            $json[$key][0]['Plan_ID'] = $val['Plan_ID'];
            $json[$key][0]['Section_AY_Code'] = $val['Section_AY_Code'];
            $json[$key][0]['Subject_Name'] = $val['Subject_Name'];
            $json[$key][0]['Class_Name'] = $val['Class_Name'];
            $json[$key][0]['Section_Name'] = $val['Section_Name'];
            $json[$key][0]['Whats_Being_Taught'] = $val['Whats_Being_Taught'];
            $json[$key][0]['Description'] = $val['Description'];
            $json[$key][0]['Topic'] = $val['Topic'];
            $json[$key][0]['Chapter_Section_Name'] = $val['Chapter_Section_Name'];
            $json[$key][0]['DailyPlan_Date'] = $val['DailyPlan_Date'];
            $json[$key][0]['Display_Date'] = $val['Display_Date'];
            $json[$key][0]['Activity_Name'] = $val['Activity_Name'];
            $json[$key][0]['Chapter_Name'] = $val['Chapter_Name'];
            $json[$key][0]['HW_ID'] = $val['HW_ID'];
            $json[$key][0]['MCQ_ID'] = $val['MCQ_ID'];
            $json[$key][0]['Engagement_ID'] = $val['Engagement_ID'];
            $json[$key][0]['Subject_Code'] = $val['Subject_Code'];
            $json[$key][0]['Learning_OutCome'] = $val['Learning_OutCome'];
            $json[$key][0]['Resources'] = $val['Resources'];
            $json[$key][0]['Assessment_Strategy'] = $val['Assessment_Strategy'];
            $json[$key][0]['Remedial_Strategy'] = $val['Remedial_Strategy'];
            $json[$key][0]['Learning_Activity'] = $val['Learning_Activity'];
            $json[$key][0]['HomeWork'] = $val['HomeWork'];
            $json[$key][0]['Feedback'] = $val['Feedback'];
            $json[$key][0]['Smartboard_Usage'] = $val['Smartboard_Usage'];
            $json[$key][0]['Smartboard_Usage_Detail'] = $val['Smartboard_Usage_Detail'];
            $json[$key][0]['Anecdotal_Record'] = $val['Anecdotal_Record'];
            $json[$key][0]['Completed_Topic'] = $val['Completed_Topic'];
            $json[$key][0]['Remaining_Topic'] = $val['Remaining_Topic'];
            $json[$key][0]['IsCompleted'] = $val['IsCompleted'];
            $json[$key][0]['Comments'] = $val['Comments'];
            $xmlArray = ! empty($val['School_Specific']) ? (array) simplexml_load_string("<root>{$val['School_Specific']}</root>") : "";
            $xmlArrayObj = ! empty($xmlArray['School_Specific']) ? $xmlArray['School_Specific'] : "";
            $json[$key][0]['School_Specific'] = ! empty($xmlArrayObj) ? array(
                $xmlArrayObj[0]
            ) : "";
        }
        $jsonEncode = json_encode($json, JSON_UNESCAPED_UNICODE);
        echo $jsonEncode;
    }

    public function getTeacherOtherTask()
    {
        $this->teacherservice->getTeacherOtherTask();
    }

    public function getClassForTask()
    {
        $this->teacherservice->getClassForTask();
    }

    public function getTeacherTask()
    {
        $this->teacherservice->getTeacherTask();
    }

    public function addFreePeriodDetail()
    {
        $this->teacherservice->addFreePeriodDetail();
    }

    public function getFreePeriodDetail()
    {
        $this->teacherservice->getFreePeriodDetail();
    }

    public function getFreePeriods()
    {
        $this->teacherservice->getFreePeriods();
    }

    public function getAvgKaHOPoints()
    {
        $this->teacherservice->getAvgKaHOPoints();
    }

    public function getAssessmentForTeacher()
    {
        $this->teacherservice->getAssessmentForTeacher();
    }

    public function getTeacherClassGraph()
    {
        $this->teacherservice->getTeacherClassGraph();
    }

    public function getTeacherSubjectGraph()
    {
        $this->teacherservice->getTeacherSubjectGraph();
    }

    public function getTeacherClassGraphBC()
    {
        $this->teacherservice->getTeacherClassGraphBC();
    }

    public function getTeacherClassGraphStudent()
    {
        $this->teacherservice->getTeacherClassGraphStudent();
    }

    public function getTeacherSubjectGraphSection()
    {
        $this->teacherservice->getTeacherSubjectGraphSection();
    }

    public function teacherSubjectGraphSectionBC()
    {
        $this->teacherservice->teacherSubjectGraphSectionBC();
    }

    public function teacherSubjectGraphStudent()
    {
        $this->teacherservice->teacherSubjectGraphStudent();
    }

    public function getTeachersList()
    {
        $this->teacherservice->getTeachersList();
    }

    public function updateTeacherProfilePic()
    {
        $this->teacherservice->updateTeacherProfilePic();
    }

    public function updateTeacherProfile()
    {
        $this->teacherservice->updateTeacherProfile();
    }

    public function getTeacherProfile()
    {
        $this->teacherservice->getTeacherProfile();
    }

    public function getTeacherDairy()
    {
        $this->teacherservice->getTeacherDairy();
    }

    public function getMyInputCount()
    {
        $this->teacherservice->getMyInputCount();
    }

    public function getComments()
    {
        $this->teacherservice->getComments();
    }

    public function getKaHOPointsForToday()
    {
        $this->teacherservice->getKaHOPointsForToday();
    }

    public function getTeacherPerformance()
    {
        $this->teacherservice->getTeacherPerformance();
    }
}
