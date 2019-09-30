<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Engagementservice
 *
 * @author KaHO
 */
class Engagementservice extends Kahoservices
{

    // put your code here
    public function __construct()
    {
        parent::__construct();
    }

    public function getEngagementList()
    {
        $params = $this->getPostParams();
        $this->addAYCodeAsFirstParam($params)
            ->setDefaultValueIfPostValNotFound($params, "Push_By", $this->userCode, 2)
            ->changeAllParamsPosition($params, [
            'Class_Code',
            'Subject_Code'
        ], 3)
            ->mergePaginationParamsToSPParams($params);
        $conf = [
            Respstructurebuilder::CALLBACK_KEY => [
                [
                    $this,
                    "appendEngagementCompletionRate"
                ]
            ]
        ];
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse($conf);
    }

    public function appendEngagementCompletionRate($arrayObj)
    {
        $arrayObj['Engagement_Completion_Rate'] = Kahoutility::getPercent($arrayObj['Total_Taken'], $arrayObj['Total_Pushed']);
        return $arrayObj;
    }

    public function getEngagementComments()
    {
        $params = $this->getPostParams();
        $this->setDefaultValueIfPostValNotFound($params, "Push_By", $this->userCode)
            ->changeAllParamsPosition($params, [
            'TopicEngagement_ID',
            'Push_By'
        ])
            ->mergePaginationParamsToSPParams($params);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getEngagementDetail()
    {
        $params = $this->getPostParams(); // TopicEngagement_ID
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getEngagementListForParent()
    {
        $params = $this->getPostParams();
        $this->addAYCodeAsFirstParam($params)
            ->changeAllParamsPosition($params, [
            'Student_Code',
            'IsCompleted'
        ], 2)
            ->mergePaginationParamsToSPParams($params);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getEngagementDetailForParent()
    {
        $params = $this->getPostParams();
        $this->changeAllParamsPosition($params, [
            'UserEngagement_ID',
            'IsCompleted'
        ]);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function addUserEngagement()
    {
        $params = $this->getPostParams();
        $this->changeAllParamsPosition($params, [
            'UserEngagement_ID',
            'Engagement_ID',
            'Opt_ID',
            'IsLiked',
            'Comments',
            'IsCompleted'
        ]);
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getEngagementLogin()
    {
        $params = $this->getPostParams();
        $this->changeAllParamsPosition($params, [
            'UserEngagement_ID',
            'IsCompleted'
        ]);
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getEngagementObjectives()
    {
        $params = $this->getPostParams();
        $this->changeAllParamsPosition($params, [
            'Class_Code',
            'Section_AY_Code',
            'Subject_Code'
        ]);
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function addEngagementObjectives()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)->changeAllParamsPosition($params, [
            'Objective_ID',
            'Board_Code',
            'Class_Code',
            'Subject_Code',
            'Topic',
            'Objective'
        ], 2);
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getEngagementObjectiveList()
    {
        $params = $this->getPostParams();
        $this->changeAllParamsPosition($params, [
            'Class_Code',
            'Subject_Code',
            'ObjectiveContains'
        ], 2)->mergePaginationParamsToSPParams($params);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }
}
