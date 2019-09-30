<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once getcwd() . '/application/libraries/Kahoxmlprocessor.php';

class Lessonplanservice extends Kahoservices
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAccessList()
    {
        $param = [];
        $this->addUserCodeAsFirstParam($param);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $param)
            ->sendResponse();
    }

    public function getLearningActivity()
    {
        $this->kahoCrudServices->getRecord($this->getProcedureName())
            ->sendResponse();
    }

    public function createLessonPlanDraft()
    {
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $this->getLessonPlanParamsForDrafting())
            ->sendResponse();
    }

    private function getLessonPlanParamsForDrafting()
    { // Draft_ID would be header_id in case of add,otherwise Unique_ID
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)->setDefaultValueIfPostValNotFound($params, "Draft_ID");
        $this->changeAllParamsPosition($params, [
            "Draft_ID",
            "userCode",
            "Class_Code",
            "Subject_Code",
            "FromDate",
            "ToDate",
            "Topic",
            "SubTopic",
            "Resources",
            "LearningOutCome",
            "Pedagogy",
            "AssetID",
            "AssetName",
            "MCQ_ID",
            "MCQ_Name",
            "Periods",
            "AssessmentStrategy",
            "RemedialStrategy",
            "HomeWork",
            "Activity",
            "School_Specific"
        ], 2)->processInputParams($params, [
            'Pedagogy' => [
                "Kahoutility::splitArrayByDelimiter",
                ","
            ],
            "AssetID" => [
                "Kahoutility::splitArrayByDelimiter",
                ","
            ],
            "AssetName" => [
                "Kahoutility::splitArrayByDelimiter",
                ","
            ],
            "School_Specific" => [
                "Kahoxmlprocessor::convertJSONStringToXML",
                [
                    'Label',
                    'Control',
                    'Items',
                    'Value',
                    'Key'
                ]
            ]
        ]);
        return $params;
    }

    public function updateLessonPlanDraft()
    {
        $this->kahoCrudServices->updateRecord($this->getProcedureName(), $this->getLessonPlanParamsForDrafting())
            ->sendResponse();
    }

    public function deleteLessonPlanDraft()
    {
        $this->kahoCrudServices->deleteRecord($this->getProcedureName(), $this->getPostParams())
            ->sendResponse();
    }

    public function getLessonPlanLog()
    {
        $params = $this->getPostParams();
        $this->addAYCodeAsFirstParam($params)
            ->setDefaultValueIfPostValNotFound($params, "userCode", $this->userCode, 2)
            ->changeAllParamsPosition($params, [
            "Teacher_Code",
            "Class_Code",
            "Subject_Code",
            "FromDate",
            "ToDate",
            "Contains"
        ], 3);
        $conf = array(
            "Class_Code" => "Class_Code",
            "Subject_Code" => Respstructurebuilder::SHOW_ALL_KEY,
            Respstructurebuilder::GROUP_BY_KEY => "Subject_Code"
        );
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse($conf, FALSE, TRUE);
    }

    public function getLessonPlanDetail()
    {
        $params = $this->getPostParams();
        $this->addAYCodeAsFirstParam($params)->changeParamsPosition($params, "Header_ID", 3);
        $conf = [
            "Plan_ID" => "Plan_ID,Attached_MCQ,MCQ_ID,Media_ID,File_Titles,Attached_Homework,Class_Code,Section_Code,formMode,NumPeriods,Whats_Being_Taught,Description,Activity,Resources,Learning_OutCome,Learning_Activity,Learning_Activity_Detail,Assessment_Strategy,Remedial_Strategy,School_Specific",
            "Period_ID" => "Media_ID,Period_ID,DailyPlan_Date,DayNumber,HW_ID,Attached_Homework,MCQ_ID,Attached_MCQ,Engagement_ID,Attached_Engagement",
            "Section_AY_Code" => "Subject_Name,Section_Name,Class_Name,Given_Homework,IsFullyCompleted,Task_Date,Teacher_Task_Id,IsFullyCompleted,Remaining_Topic,Completed_topic,Reason_For_Not_Completion,PeriodNumber,Smartboard_Usage,Feedback,Smartboard_Usage_Detail,Comments,Parental_Interactions,Refection",
            Respstructurebuilder::GROUP_BY_KEY => "Plan_ID,Period_ID,Section_AY_Code",
            Respstructurebuilder::CALLBACK_KEY => [
                [
                    $this,
                    "lessonPlanDetailRespCallback"
                ]
            ],
            Respstructurebuilder::SORT_BY_KEY => [
                "Plan_ID" => Respstructurebuilder::SORT_BY_INTEGER
            ]
        ];
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse($conf, FALSE, true);
    }

    public function lessonPlanDetailRespCallback($vals)
    {
        $vals = Kahoutility::convertXMLToArrayCallback($vals, "School_Specific", FALSE);
        $vals = Kahoutility::appendKeyInResponse($vals, "formMode", "edit");
        return $vals;
    }

    public function createLessonPlanFromDraft()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)->changeAllParamsPosition($params, [
            'Class_Code',
            'Subject_Code',
            'FromDate',
            'ToDate',
            'Approve_By',
            'Draft_ID'
        ], 2);
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getLPDraftList()
    {
        $params = [];
        $this->addUserCodeAsFirstParam($params);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getLPDraftDetail()
    {
        $params = $this->getPostParams(); // Header_ID
        $conf = array(
            "LPDraftHeader_ID" => "LPDraftHeader_ID,Class_Code,Subject_Code,FromDate,ToDate",
            "LPDraft_ID" => "LPDraft_ID,Topic,TopicContentID,SubTopic,Resources,LearningOutCome,Pedagogy,AssetID,AssetName,MCQ_ID,MCQ_Name,Periods,AssessmentStrategy,RemedialStrategy,HomeWork,Activity,School_Specific,formMode",
            Respstructurebuilder::CALLBACK_KEY => [
                [
                    $this,
                    "lessonPlanDetailRespCallback"
                ]
            ]
        );
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse($conf, FALSE, TRUE);
    }

    public function editLessonPlan()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)
            ->changeAllParamsPosition($params, [
            'Plan_ID',
            'Topic',
            'SubTopic',
            'LearningOutCome',
            'Pedagogy',
            'Resources',
            'Activity',
            'AssessmentStrategy',
            'RemedialStrategy',
            'HomeWork',
            'MCQ_ID',
            'AssetID',
            'School_Specific'
        ], 2)
            ->processInputParams($params, [
            'Pedagogy' => [
                "Kahoutility::splitArrayByDelimiter",
                ","
            ],
            "AssetID" => [
                "Kahoutility::splitArrayByDelimiter",
                ","
            ],
            "School_Specific" => [
                "Kahoxmlprocessor::convertJSONStringToXML",
                [
                    'Label',
                    'Control',
                    'Items',
                    'Value',
                    'Key'
                ]
            ]
        ]);
        // print_r($params);exit;
        $this->kahoCrudServices->updateRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function deleteDailyPlan()
    {
        // Plan_ID
        $this->kahoCrudServices->deleteRecord($this->getProcedureName(), $this->getPostParams())
            ->sendResponse();
    }

    public function copyLessonPlan()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)
            ->processInputParams($params, [
            'Subject_Codes' => [
                "Kahoutility::splitArrayByDelimiter",
                MULTIPLE_ATTACHMENT_DELIMITER
            ]
        ])
            ->changeAllParamsPosition($params, [
            'Header_ID',
            'Subject_Codes'
        ]);
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }
}
