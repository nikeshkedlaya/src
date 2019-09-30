<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Subjectservice
 *
 * @author KaHO
 */
class Subjectservice extends Kahoservices
{

    // put your code here
    public function __construct()
    {
        parent::__construct();
    }

    public function getSubjectListByUser()
    {
        $params = $this->getPostParams();
        $this->mergeAYNUserCodeToSPParams($params)
            ->changeParamsPosition($params, "SAY_Code", 2)
            ->setDefaultValueIfPostValNotFound($params, "heirarchy", 0, 4);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getSubjectList()
    {
        $params = $this->getPostParams();
        $this->mergeAYNUserCodeToSPParams($params)
            ->setDefaultValueIfPostValNotFound($params, "IsAll", 1, 3)
            ->setDefaultValueIfPostValNotFound($params, "heirarchy", 0, 4);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getSubjectListByClass()
    {
        $params = $this->getPostParams(); // Class_Code
        $this->addAYCodeAsFirstParam($params)
            ->setDefaultValueIfPostValNotFound($params, USER_CODE, $this->userCode, 2)
            ->setDefaultValueIfPostValNotFound($params, MINE, 1, 4);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getSubjectListBySAY()
    {
        $params = $this->getPostParams();
        $this->mergeAYNUserCodeToSPParams($params)
            ->addDefaultParamToSPParams($params, 0)
            ->changeAllParamsPosition($params, [
            SECTION_AY_CODE,
            MINE
        ], 3);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }
}
