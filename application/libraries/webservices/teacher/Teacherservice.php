<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Teacherservice
 *
 * @author KaHO
 */
class Teacherservice extends Kahoservices {

    public function __construct() {
        parent::__construct();
        $this->ciLibrary->load->library("processattachmentservice");
    }

    private function getListenerClassPath() {
        return $this->getListenerClassBasePath() . "teacher/Teacherservicenotificationlistener";
    }

    public function getTeacherTaskForWeek() {
        $spParams = $this->getPostParams();
        $this->mergeAYNUserCodeToSPParams($spParams)->setDefaultValueIfPostValNotFound($spParams, "Action_Date", date(DATE_FORMAT), 3);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $spParams)
                ->sendResponse();
    }

    public function kaHOPointsGet() {
        $spParams = $this->getPostParams();
        $this->addAYCodeAsFirstParam($spParams)
                ->setDefaultValueIfPostValNotFound($spParams, TEACHER_CODE, $this->userCode, 2)
                ->setDefaultValueIfPostValNotFound($spParams, "Month_Number", NULL, 3)
                ->setDefaultValueIfPostValNotFound($spParams, IS_HIERARCHY, 0, 4);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $spParams)
                ->sendResponse();
    }

    public function getDashboardNotifications() {
        $spParams = $this->getPostParams();
        $this->mergeAYNUserCodeToSPParams($spParams);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $spParams)
                ->sendResponse();
    }

    public function updateTeacherTask() {
        $spParams = $this->getPostParams();
        $this->addDefaultParamToSPParams($spParams, "User_Code", $this->userCode, 1)
                ->processInputParams($spParams, [
                    "Periods" => [
                        [
                            $this,
                            "processTeacherTaskBeforeUpdate"
                        ]
                    ],
                    "SectionAYCodes" => [
                        "Kahoutility::splitArrayByDelimiter"
                    ]
                ])
                ->setDefaultValueIfPostValNotFound($spParams, "Task_Date", date(DATE_FORMAT))
                ->setDefaultValueIfPostValNotFound($spParams, "HW")
                ->setDefaultValueIfPostValNotFound($spParams, "MCQ")
                ->setDefaultValueIfPostValNotFound($spParams, "Engagement_ID")
                ->setDefaultValueIfPostValNotFound($spParams, "Feedback")
                ->setDefaultValueIfPostValNotFound($spParams, "Periods")
                ->setDefaultValueIfPostValNotFound($spParams, "Smartboard_Usage", "0")
                ->setDefaultValueIfPostValNotFound($spParams, "Smartboard_Usage_Detail")
                ->setDefaultValueIfPostValNotFound($spParams, "ParentInteraction")
                ->setDefaultValueIfPostValNotFound($spParams, "NumPeriods")
                ->changeAllParamsPosition($spParams, [
                    "Task_Date",
                    "PeriodID",
                    "SectionAYCodes",
                    "Class_Code",
                    "Subject_Code",
                    "IsFullyCompleted",
                    "over",
                    "remaining",
                    "ReasonNotCompletion",
                    "HW",
                    "Submit_By",
                    "MCQ",
                    "Engagement_ID",
                    "Student_Homework",
                    "Feedback",
                    "Periods",
                    "Smartboard_Usage",
                    "Smartboard_Usage_Detail",
                    "ParentInteraction",
                    "Comments",
                    "NumPeriods"
                        ], 2)
                ->mergeTagsToLastSPParams($spParams)
                ->changeParamsPosition($spParams, 'Engagement_Objective_ID', 24);
        Facadelistener::getFacadeListenerIns()->registerNotificationListener($this->getListenerClassPath(), "sendUpdateTeacherTaskNotification");
        print_r($spParams);
        exit;
        $this->kahoCrudServices->updateRecord($this->getProcedureName(), $spParams)
                ->sendResponse();
    }

    public function processTeacherTaskBeforeUpdate($val) {
        if (is_array($val)) {
            ksort($val);
            return Kahoutility::splitArrayByDelimiter($val);
        }
    }

    public function getTeacherOtherTask() {
        $spParams = $this->getPostParams();
        $this->addUserCodeAsFirstParam($spParams)->changeAllParamsPosition($spParams, [
            "SubjectCode",
            "SectionAYCode",
            "PeriodID"
                ], 2);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $spParams)
                ->sendResponse();
    }

    public function getClassForTask() {
        $spParams = $this->getPostParams();
        $this->addUserCodeAsFirstParam($spParams)
                ->setDefaultValueIfPostValNotFound($spParams, "Week_Day")
                ->setDefaultValueIfPostValNotFound($spParams, "Action_Date", date(DATE_FORMAT))
                ->changeAllParamsPosition($spParams, [
                    "PeriodID",
                    "Week_Day",
                    "Action_Date"
                        ], 2);
        $conf = [
            Respstructurebuilder::CALLBACK_KEY => [
                [
                    $this,
                    "appendSectionAYCodeWithPeriod"
                ]
            ]
        ];
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $spParams)
                ->sendResponse($conf);
    }

    public function appendSectionAYCodeWithPeriod($obj) {
        $obj['SectionAYCodeWithPeriod'] = $obj['Section_AY_Code'] . "_" . $obj['PeriodNum'];
        return $obj;
    }

    public function getTeacherTask() {
        $spParams = $this->getPostParams();
        $this->mergeAYNUserCodeToSPParams($spParams)
                ->setDefaultValueIfPostValNotFound($spParams, "Trans_ID")
                ->setDefaultValueIfPostValNotFound($spParams, "PeriodID")
                ->changeAllParamsPosition($spParams, [
                    "SubjectCode",
                    "SectionAYCode",
                    "PeriodID",
                    "Trans_ID"
                        ], 3);
        $conf = [
            Respstructurebuilder::CALLBACK_KEY => [
                "Kahoutility::convertXMLToArrayCallback",
                'School_Specific',
                FALSE
            ]
        ];
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $spParams)
                ->sendResponse($conf);
    }

    public function addFreePeriodDetail() {
        $spParams = $this->getPostParams();
        $this->addUserCodeAsFirstParam($spParams)
                ->setDefaultValueIfPostValNotFound($spParams, "Action_Date", date(DATE_FORMAT))
                ->processInputParams($spParams, [
                    'Period_No' => [
                        "Kahoutility::splitArrayByDelimiter"
                    ]
                ])
                ->changeAllParamsPosition($spParams, [
                    "Action_Date",
                    "Period_No",
                    "Comments"
                        ], 2)
                ->mergeTagsToLastSPParams($spParams);
        Facadelistener::getFacadeListenerIns()->registerNotificationListener($this->getListenerClassPath(), "sendFreePeriodUpdateNotification");
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $spParams)
                ->sendResponse();
    }

    public function getFreePeriodDetail() {
        $spParams = $this->getPostParams();
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $spParams)
                ->sendResponse();
    }

    public function getFreePeriods() {
        $spParams = $this->getPostParams();
        $this->addUserCodeAsFirstParam($spParams)->setDefaultValueIfPostValNotFound($spParams, "ActionDate", date(DATE_FORMAT), 3);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $spParams)
                ->sendResponse();
    }

    public function getAvgKaHOPoints() {
        $spParams = [];
        $this->mergeAYNUserCodeToSPParams($spParams);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $spParams)
                ->sendResponse();
    }

    public function getAssessmentForTeacher() {
        $spParams = $this->getPostParams();
        $this->addAYCodeAsFirstParam($spParams)->setDefaultValueIfPostValNotFound($spParams, "User_Code", $this->userCode);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $spParams)
                ->sendResponse();
    }

    public function getTeacherClassGraph() {
        $spParams = $this->getPostParams();
        $this->addUserCodeAsFirstParam($spParams)->changeParamsPosition($spParams, "AssessmentID", 3);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $spParams)
                ->sendResponse();
    }

    public function getTeacherSubjectGraph() {
        $spParams = $this->getPostParams();
        $this->addUserCodeAsFirstParam($spParams)->changeParamsPosition($spParams, "AssessmentID", 4);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $spParams)
                ->sendResponse();
    }

    public function getTeacherClassGraphBC() {
        $spParams = $this->getPostParams();
        $this->changeParamsPosition($spParams, "AssessmentID", 3);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $spParams)
                ->sendResponse();
    }

    public function getTeacherClassGraphStudent() {
        $spParams = $this->getPostParams();
        $this->changeParamsPosition($spParams, "Range", 4)->changeParamsPosition($spParams, "AssessmentID", 2);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $spParams)
                ->sendResponse();
    }

    public function getTeacherSubjectGraphSection() {
        $spParams = $this->getPostParams();
        $this->addUserCodeAsFirstParam($spParams)->changeParamsPosition($spParams, "AssessmentID", 4);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $spParams)
                ->sendResponse();
    }

    public function teacherSubjectGraphSectionBC() {
        $spParams = $this->getPostParams();
        $this->addUserCodeAsFirstParam($spParams)->changeParamsPosition($spParams, "AssessmentID", 4);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $spParams)
                ->sendResponse();
    }

    public function teacherSubjectGraphStudent() {
        $spParams = $this->getPostParams();
        $this->changeParamsPosition($spParams, "Range", 4)->changeParamsPosition($spParams, "AssessmentID", 2);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $spParams)
                ->sendResponse();
    }

    public function getTeachersList() {
        $spParams = $this->getPostParams();
        $spParams['School_Code'] = Kahoutility::getCISessionValueByKey("School_Code");
        $this->addUserCodeAsFirstParam($spParams)->setDefaultValueIfPostValNotFound($spParams, "Is_Heirarchy", "0");
        $this->changeAllParamsPosition($params, [
            'School_Code',
            'Is_Heirarchy'
                ], 2);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $spParams)
                ->sendResponse();
    }

    public function getTeacherProfile() {
        $params = [
            "usercode" => $this->userCode
        ];
        $conf = Kahoutility::getTeacherImageConfForAppend();
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
                ->sendResponse($conf);
    }

    public function updateTeacherProfile() {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)->changeAllParamsPosition($params, [
            "First_Name",
            "Middle_Name",
            "Last_Name",
            "Phone",
            "Qualification",
            "Address",
            "Photo",
            "Bio",
            "Fav_Colour",
            "Fav_Restaurant",
            "Fav_Drink",
            "Fav_Hobby",
            "Fav_Store",
            "Fav_Teaching_Item",
            "Fav_Books",
            "Fav_Movies",
            "About_Teacher",
            "LinkedIn_Profile",
            "Facebook_Profile"
                ], 2);
        $this->kahoCrudServices->updateRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

    public function updateTeacherProfilePic() {
        $this->uploadAttachment($_FILES, $this->ciLibrary->processattachmentservice, TEACHERS_IMAGE_PATH);
    }

    public function getTeacherDairy() {
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $this->getTeacherDairyParams())
                ->sendResponse();
    }

    public function addTeacherTaskComment() {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)->changeAllParamsPosition($params, [
            'Teacher_Code',
            'Date',
            'Comment_Text'
                ], 2);
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

    public function getMyInputCount() {
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $this->getTeacherDairyParams())
                ->sendResponse();
    }

    public function getComments() {
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $this->getTeacherDairyParams())
                ->sendResponse();
    }

    public function getKaHOPointsForToday() {
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $this->getTeacherDairyParams())
                ->sendResponse();
    }

    public function getTeacherPerformance() {
        $params = $this->getPostParams();
        $this->mergeAYNUserCodeToSPParams($params)->changeAllParamsPosition($params, [
            'Teacher_Code',
            'Class_Code',
            'Subject_Code',
            'From_Date',
            'To_Date'
                ], 3);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

}
