<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Classroomobservationservice
 *
 * @author KaHO
 */
class Classroomobservationservice extends Kahoservices
{

    // put your code here
    public function __construct()
    {
        parent::__construct();
    }

    public function getClassRoomObservationList()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)->mergePaginationParamsToSPParams($params);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function addClassRoomObservation()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)->changeAllParamsPosition($params, [
            "Survey_ID",
            "Teacher_Code",
            "Section_AY_Code",
            "Subject_Code",
            "Topic",
            "PeriodNum",
            "User_Input",
            "Observer_Comment",
            "Obtained_Grade",
            "Max_Grade"
        ], 2);
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function addClassRoomObservationComment()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)->changeAllParamsPosition($params, [
            "IsObserver",
            "Observation_ID",
            "Comments",
            "IsOthers"
        ], 2);
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getMyClassRoomObservation()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)->mergePaginationParamsToSPParams($params);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getClassRoomObservationComments()
    {
        $params = $this->getPostParams(); // Observation_ID
        $this->addUserCodeAsFirstParam($params);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getUserInput()
    {
        $params = $this->getUriSegments();
        $conf = [
            Respstructurebuilder::CALLBACK_KEY => [
                "Kahoutility::convertXMLToArrayCallback",
                "XMLData"
            ]
        ];
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse($conf);
    }

    public function getTeacherObservationCount()
    {
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $this->getTeacherDairyParams())
            ->sendResponse();
    }
}
