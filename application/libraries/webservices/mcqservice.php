<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mcqservice
 *
 * @author KaHO
 */
class Mcqservice extends Kahoservices
{

    // put your code here
    public function __construct()
    {
        parent::__construct();
        $this->ciLibrary->load->library("processattachmentservice");
    }

    public function getMCQDetailByID()
    {
        $params = $this->getPostParams();
        $conf = array(
            "Question_ID" => Respstructurebuilder::SHOW_ALL_KEY,
            Respstructurebuilder::GROUP_BY_KEY => "Question_ID"
        );
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse($conf, FALSE, TRUE);
    }

    public function getMCQCount()
    {
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $this->getTeacherDairyParams())
            ->sendResponse();
    }

    public function getMCQList()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)->changeAllParamsPosition($params, [
            'Class_Code',
            'Subject_Code',
            'Topic',
            'Concept'
        ], 2);
        $conf = array(
            "TopicQuestion_ID" => "TopicQuestion_ID,Topic,Concept",
            "Question_ID" => "Question_ID,Question_Description,Question_Attachment_XML,Difficulty_Description,Category_Description",
            "Answer_ID" => "Answer_ID,Answer_Description,AnswerAttachment_XML,IsCorrect",
            Respstructurebuilder::GROUP_BY_KEY => "TopicQuestion_ID,Question_ID",
            Respstructurebuilder::CALLBACK_KEY => [
                [
                    $this,
                    "convertMCQAttachnentXMLTOArrayObj"
                ]
            ]
        );
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse($conf, FALSE, TRUE);
    }

    public function getPushedMCQTopicsList()
    {
        $params = $this->getPostParams();
        $this->addAYCodeAsFirstParam($params)->changeAllParamsPosition($params, [
            'Teacher_Code',
            'Class_Code',
            'Subject_Code'
        ], 2);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getMCQBYID()
    {
        $params = $this->getPostParams(); // MCQ_ID
        $conf = array(
            "Question_ID" => "TopicQuestion_ID,Class_Code,Class_Name,Subject_Code,Subject_Name,Topic_Description,Question_ID,Question_Description,Category,Category_Description,Difficulty_Level,Difficulty_Level_Description,Question_Asset_Detail,Question_Asset_ID,Question_Sort_Order,Question_Attachment_XML",
            "Answer_ID" => "Answer_ID,Answer_Description,Answer_Sort_Order,AnswerAttachment_XML,IsCorrect,Answer_Asset_Link,Answer_Asset_Type",
            Respstructurebuilder::GROUP_BY_KEY => "Question_ID,Answer_ID",
            Respstructurebuilder::CALLBACK_KEY => [
                [
                    $this,
                    "convertMCQAttachnentXMLTOArrayObj"
                ]
            ]
        );
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse($conf, FALSE, true);
    }

    public function convertMCQAttachnentXMLTOArrayObj($arrayObj)
    {
        $arrayObj = Kahoutility::parseAttachmentXMLString($arrayObj, $this->controllerName, "Question_Attachment_XML");
        $arrayObj = Kahoutility::parseAttachmentXMLString($arrayObj, $this->controllerName, "AnswerAttachment_XML");
        return $arrayObj;
    }

    public function getQuestionwiseReflection()
    {
        $conf = array(
            "Question_ID" => "Topic_Question_ID,Question_ID,Question_Description,Question_Asset_Detail,Question_Asset_ID",
            "Section_AY_Code" => "Section_AY_Code,Class_Name,Section_Name,Taken_Count,Reflection,Total_Students",
            Respstructurebuilder::GROUP_BY_KEY => "Question_ID,Section_AY_Code"
        );
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $this->getReflectionParams())
            ->sendResponse($conf, FALSE, true);
    }

    // <editor-fold defaultstate="collapsed" desc="getReflectionParams">
    /**
     * description would be used to pass param to methods such as getCategorywiseReflection,getQuestionwiseReflection
     *
     * @return type
     */
    private function getReflectionParams()
    {
        $params = $this->getPostParams(); // Push_By as userCode,TopicQuestion_ID
        $this->addAYCodeAsFirstParam($params)->setDefaultValueIfPostValNotFound($params, "Push_By", $this->userCode, 2);
        return $params;
    }

    // </editor-fold>
    public function getCategorywiseReflection()
    {
        $conf = array(
            "LookUp_Code" => "Description,LookUp_Code,Topic_Question_ID",
            "Section_AY_Code" => "Section_AY_Code,Class_Name,Section_Name,Taken_Count,Reflection,Total_Students",
            Respstructurebuilder::GROUP_BY_KEY => "LookUp_Code,Section_AY_Code"
        );
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $this->getReflectionParams())
            ->sendResponse($conf, FALSE, true);
    }

    public function getMCQStudentsYetToTake()
    {
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $this->getMCQStudentsParams())
            ->sendResponse();
    }

    // <editor-fold defaultstate="collapsed" desc="getMCQStudentsParams">
    /**
     * description would be used as params for getMCQStudentsToWatch,getMCQStudentsYetToTake
     *
     * @return type
     */
    private function getMCQStudentsParams()
    {
        $params = $this->getPostParams(); // TopicQuestion_ID,Push_By as userCode,Section_AY_Code,Question_ID as last parms for getMCQStudentsToWatch
        $this->setDefaultValueIfPostValNotFound($params, "Push_By", $this->userCode)->changeAllParamsPosition($params, [
            'TopicQuestion_ID',
            'Push_By',
            'Section_AY_Code'
        ]);
        return $params;
    }

    // </editor-fold>
    public function getMCQStudentsToWatch()
    {
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $this->getMCQStudentsParams())
            ->sendResponse();
    }

    public function addMCQDraft()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)
            ->processMCQAttachment($params)
            ->changeAllParamsPosition($params, [
            'MCQDraftHeader_ID',
            USER_CODE,
            'Class_Code',
            'Subject_Code',
            'Title',
            'Topic',
            'Concept',
            'Question',
            'Question_Assets',
            'Difficulty_Level',
            'Category',
            'Answer1_Desc',
            'Answer1_Asset',
            'Answer2_Desc',
            'Answer2_Asset',
            'Answer3_Desc',
            'Answer3_Asset',
            'Answer4_Desc',
            'Answer4_Asset',
            'Correct_Answers'
        ]);
        
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    private function processMCQAttachment(&$params)
    {
        $this->processAttachedData($params, $this->ciLibrary->processattachmentservice, null, "Question_Assets")
            ->processAttachedData($params, $this->ciLibrary->processattachmentservice, null, "Answer1_Asset")
            ->processAttachedData($params, $this->ciLibrary->processattachmentservice, null, "Answer2_Asset")
            ->processAttachedData($params, $this->ciLibrary->processattachmentservice, null, "Answer3_Asset")
            ->processAttachedData($params, $this->ciLibrary->processattachmentservice, null, "Answer4_Asset");
        return $this;
    }

    public function updateMCQDraft()
    {
        $params = $this->getPostParams();
        $this->processMCQAttachment($params)->changeAllParamsPosition($params, [
            'MCQDraft_ID',
            'Question',
            'Question_Assets',
            'Difficulty_Level',
            'Category',
            'Answer1_Desc',
            'Answer1_Asset',
            'Answer2_Desc',
            'Answer2_Asset',
            'Answer3_Desc',
            'Answer3_Asset',
            'Answer4_Desc',
            'Answer4_Asset',
            'Correct_Answers'
        ]);
        $this->kahoCrudServices->updateRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function deleteMCQDraft()
    {
        $params = $this->getPostParams(); // MCQDraft_ID
        $this->kahoCrudServices->deleteRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getMCQListForStudentBySubject()
    {
        $params = $this->getPostParams(); // Student_Code
        $this->addAYCodeAsFirstParam($params);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getMCQListForStudent()
    {
        $params = $this->getPostParams();
        $this->addAYCodeAsFirstParam($params)
            ->setDefaultValueIfPostValNotFound($params, "IsCompleted")
            ->changeAllParamsPosition($params, [
            'Student_Code',
            'Subject_Code',
            'IsCompleted'
        ], 2)
            ->mergePaginationParamsToSPParams($params);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getQuestionsForStudent()
    {
        $params = $this->getPostParams(); // Student_MCQ_ID
        $conf = array(
            "Question_ID" => "Title,Student_Answer,Topic,Concept,Topic_Question_ID,No_Of_Retry,Question_Description,Question_ID,Difficulty_Level,Difficulty_Level_Desc,Category,Category_Desc,Question_Asset_Detail,Question_Asset_ID",
            "Answer_ID" => "Answer_ID,IsCorrect,Answer_Description,Answer_Asset_Link,Answer_Asset_Type",
            Respstructurebuilder::GROUP_BY_KEY => "Question_ID,Answer_ID"
        );
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse($conf, FALSE, true);
    }

    public function addMCQStudentAnswer()
    {
        $params = $this->getPostParams();
        $this->changeAllParamsPosition($params, [
            'Student_MCQ_ID',
            'Question_ID',
            'Answer_ID',
            'IsCompleted'
        ])->processInputParams($params, [
            'Answer_ID' => [
                "Kahoutility::splitArrayByDelimiter",
                ","
            ]
        ]);
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getMCQTrend()
    {
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $this->getAnalysisParams(FALSE))
            ->sendResponse();
    }

    public function getMCQTrendForMonth()
    {
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $this->getAnalysisParams())
            ->sendResponse();
    }

    public function getMCQDetailCount()
    {
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $this->getAnalysisParams())
            ->sendResponse();
    }

    public function uploadMCQAttachment()
    {
        $this->uploadAttachment($_FILES, $this->ciLibrary->processattachmentservice);
    }

    public function getMCQQuestionDifficultyLevel()
    {
        $this->getLookUpType("DIFICULTYLEVEL");
    }

    public function getMCQQuestionType()
    {
        $this->getLookUpType("MCQCAT");
    }

    public function getMCQDraftList()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)->changeAllParamsPosition($params, [
            'Class_Code',
            "Subject_Code"
        ], 2);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getMCQDraft()
    {
        $params = $this->getPostParams(); // MCQDraftHeader
        $conf = array(
            "MCQDraftHeader_ID" => "MCQDraftHeader_ID,Class_Code,Subject_Code,Topic,Concept",
            "MCQDraft_ID" => "MCQDraft_ID,Question,formMode,Question_Assets,Difficulty_Level,Category,Answer1_Desc,Answer1_Asset,Answer2_Desc,Answer2_Asset,Answer3_Desc,Answer3_Asset,Answer4_Desc,Answer4_Asset,Correct_Answers,Question_Assets_XML,Answer1_Asset_XML,Answer2_Asset_XML,Answer3_Asset_XML,Answer4_Asset_XML",
            Respstructurebuilder::GROUP_BY_KEY => "MCQDraftHeader_ID,MCQDraft_ID",
            Respstructurebuilder::CALLBACK_KEY => [
                [
                    $this,
                    "processMCQDraftResponse"
                ]
            ]
        );
        $resp = $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse($conf, false, true);
    }

    public function processMCQDraftResponse($arrayObj)
    {
        if (Kahoutility::isStringParamValid($arrayObj['Correct_Answers'])) {
            $currectAnsArr = explode("|", $arrayObj['Correct_Answers']);
            $currectAnsArrObj = [];
            array_map(function ($arrayVal) use (&$currectAnsArrObj) {
                $arrayVal = explode("~", $arrayVal);
                $currectAnsArrObj[current($arrayVal)] = (int) end($arrayVal);
            }, $currectAnsArr);
            $arrayObj['Correct_Answers'] = $currectAnsArrObj;
        }
        $arrayObj = Kahoutility::appendKeyInResponse($arrayObj, "formMode", "edit");
        $arrayObj = Kahoutility::parseAttachmentXMLString($arrayObj, $this->controllerName, "Question_Assets_XML");
        $arrayObj = Kahoutility::parseAttachmentXMLString($arrayObj, $this->controllerName, "Answer1_Asset_XML");
        $arrayObj = Kahoutility::parseAttachmentXMLString($arrayObj, $this->controllerName, "Answer2_Asset_XML");
        $arrayObj = Kahoutility::parseAttachmentXMLString($arrayObj, $this->controllerName, "Answer3_Asset_XML");
        $arrayObj = Kahoutility::parseAttachmentXMLString($arrayObj, $this->controllerName, "Answer4_Asset_XML");
        return $arrayObj;
    }

    public function addMCQFromDraft()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params); // MCQDraftHeader_ID
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }
}
