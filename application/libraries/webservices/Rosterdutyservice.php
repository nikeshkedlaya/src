<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Rosterdutyservice
 *
 * @author KaHO
 */
class Rosterdutyservice extends Kahoservices
{

    // put your code here
    public function __construct()
    {
        parent::__construct();
    }

    public function addRosterDuty()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)
            ->changeAllParamsPosition($params, [
            'Roster_Header_ID',
            'From_Date',
            'To_Date',
            'Type',
            'Type_Detail',
            'Duty_Detail'
        ], 2)
            ->processInputParams($params, [
            'Duty_Detail' => [
                "Kahoutility::splitArrayByDelimiter",
                MULTIPLE_ATTACHMENT_DELIMITER
            ]
        ]);
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function addTeacherRosterDutyUpdate()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)->changeAllParamsPosition($params, [
            'Roster_Allocation_ID',
            'Duty_Date',
            'Comments'
        ], 2);
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getRosterDuty()
    {
        $params = $this->getPostParams(); // Action_Date
        $this->mergeAYNUserCodeToSPParams($params);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getRosterDutyList()
    {
        $this->kahoCrudServices->getRecord($this->getProcedureName())
            ->sendResponse();
    }

    public function getRosterType()
    {
        $this->getLookUpType("ROSTERTYPE");
    }
}
