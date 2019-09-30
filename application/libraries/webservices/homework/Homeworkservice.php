<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Homeworkservice
 *
 * @author KaHO
 */
class Homeworkservice extends Kahoservices
{

    // put your code here
    public function __construct()
    {
        parent::__construct();
        $this->ciLibrary->load->library("processattachmentservice");
    }

    public function getListenerClassPath()
    {
        return parent::getListenerClassBasePath() . "homework/Homeworknotificationlistener";
    }

    public function getHomeworkSubmissions()
    {
        $params = $this->getPostParams();
        $this->mergeAYNUserCodeToSPParams($params)->mergePaginationParamsToSPParams($params);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getPendingHWStudents()
    {
        $params = $this->getPostParams();
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse(Kahoutility::getStudentImageConfForAppend());
    }

    public function updateHomeWork()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)
            ->processInputParams($params, [
            'Pending_Student_Code' => [
                "Kahoutility::splitArrayByDelimiter"
            ]
        ])
            ->changeParamsPosition($params, 'HW_ID', 2);
        Facadelistener::getFacadeListenerIns()->registerNotificationListener($this->getListenerClassPath(), "sendUpdateHomeworkNotification", $params);
        $this->kahoCrudServices->updateRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function homeWorkListForTeacher()
    {
        $params = $this->getPostParams();
        $this->mergeAYNUserCodeToSPParams($params)
            ->mergePaginationParamsToSPParams($params)
            ->changeParamsPosition($params, "SAYCode", 3);
        $conf = [
            Respstructurebuilder::CALLBACK_KEY => [
                [
                    $this,
                    "appendIsHomeworkDoneKey"
                ]
            ]
        ];
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse($conf);
    }

    public function appendIsHomeworkDoneKey($arrayObj)
    {
        $arrayElem = Kahoutility::getFractionVal($arrayObj['Taken_Count']);
        $numerator = current($arrayElem);
        $denominator = end($arrayElem);
        if ($numerator === $denominator) {
            $arrayObj['isHWFinished'] = true;
        } else {
            $arrayObj['isHWFinished'] = FALSE;
        }
        $arrayObj['HW_Completion_Rate'] = Kahoutility::getPercent($numerator, $denominator);
        $arrayObj = Kahoutility::parseAttachmentXMLString($arrayObj, $this->controllerName, ATTACHMENT_XML);
        return $arrayObj;
    }

    public function assignHomework()
    {
        $params = $this->getPostParams();
        $this->addDefaultParamToSPParams($params, "userCode", $this->userCode, 1)
            ->changeAllParamsPosition($params, [
            "SAYCode",
            "Subject_Code",
            "Remarks",
            "Submit_By",
            UPLOADED_ATTACHMENT
        ], 2)
            ->processAttachedData($params, $this->ciLibrary->processattachmentservice)
            ->mergeTagsToLastSPParams($params);
        Facadelistener::getFacadeListenerIns()->registerNotificationListener($this->getListenerClassPath(), "sendAssignHomeworkNotification", $params);
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function uploadAttachmentHomework()
    {
        $this->uploadAttachment($_FILES, $this->ciLibrary->processattachmentservice);
    }

    public function getHomeworkCount()
    {
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $this->getTeacherDairyParams())
            ->sendResponse();
    }

    public function getHomeWorkUpdateCount()
    {
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $this->getAnalysisParams(FALSE))
            ->sendResponse();
    }

    public function getHomeWorkTrend()
    {
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $this->getAnalysisParams(FALSE))
            ->sendResponse();
    }
}
