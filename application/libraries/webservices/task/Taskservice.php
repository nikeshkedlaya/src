<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Taskservice
 *
 * @author KaHO
 */
class Taskservice extends Kahoservices
{

    // put your code here
    public function __construct()
    {
        parent::__construct();
    }

    private function getListenerClassPath()
    {
        return parent::getListenerClassBasePath() . "task/Tasknotificationlistner";
    }

    public function getTaskList()
    {
        $params = $this->getPostParams();
        $this->mergeAYNUserCodeToSPParams($params)
            ->setDefaultValueIfPostValNotFound($params, "Mine", 1, 0)
            ->setDefaultValueIfPostValNotFound($params, "Others", 0, 0)
            ->mergePaginationParamsToSPParams($params)
            ->changeAllParamsPosition($params, [
            "Mine",
            "Others",
            "Task_Type"
        ], 3); // 0 = pending,1=compl,2 = to be followed
        $conf = [
            Respstructurebuilder::CALLBACK_KEY => [
                "Kahoutility::appendValueToResponseArrayByCheckingCond",
                "Created_By",
                $this->userCode,
                "Is_Not_Updatable"
            ]
        ];
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse($conf);
    }

    public function getTaskHistory()
    {
        $params = $this->getPostParams();
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function taskAdd()
    {
        $params = $this->getTaskAddNEditDetailsParam();
        Facadelistener::getFacadeListenerIns()->registerNotificationListener($this->getListenerClassPath(), "sendAddTaskNotification", $params);
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    private function getTaskAddNEditDetailsParam()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)
            ->setDefaultValueIfPostValNotFound($params, "TicektID")
            ->changeAllParamsPosition($params, [
            "Title",
            "Description",
            "Finish_By",
            "Priority",
            "Assigned_To",
            "FollowUp_Date",
            "TicektID"
        ], 2)
            ->processInputParams($params, [
            'Assigned_To' => [
                "Kahoutility::splitArrayByDelimiter"
            ]
        ])
            ->mergeTagsToLastSPParams($params);
        return $params;
    }

    public function taskEditDetails()
    {
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $this->getTaskAddNEditDetailsParam())
            ->sendResponse();
    }

    public function taskDelete()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params);
        $this->kahoCrudServices->deleteRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function taskUpdate()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)->changeAllParamsPosition($params, [
            "TicektID",
            "Remarks",
            "Status"
        ], 2);
        Facadelistener::getFacadeListenerIns()->registerNotificationListener($this->getListenerClassPath(), "sendUpdateTaskNotification", $params);
        $this->kahoCrudServices->updateRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getTaskPriorityList()
    {
        $this->getLookUpType("TICKETPRIORITY");
    }
}
