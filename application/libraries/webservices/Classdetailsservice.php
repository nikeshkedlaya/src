<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Classdetailsservice
 *
 * @author KaHO
 */
class Classdetailsservice extends Kahoservices {

    // put your code here
    public function __construct() {
        parent::__construct();
    }

    public function classSectionListByUser() {
        $params = $this->getPostParams();
        $params['School_Code'] = Kahoutility::getCISessionValueByKey("School_Code");

        $this->mergeAYNUserCodeToSPParams($params)
                ->changeParamsPosition($params, "School_Code", 3)
                ->setDefaultValueIfPostValNotFound($params, MINE, "1", 4)
                ->setDefaultValueIfPostValNotFound($params, "heirarchy", "0", 5);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

    public function getClassSectionList() {
        $params = [];
        $params['School_Code'] = Kahoutility::getCISessionValueByKey("School_Code");
        $this->addDefaultParamToSPParams($params, "ayCode", Kahoapplicationservice::getKaHOAppSerIns()->getAYCode());
        $this->changeParamsPosition($params, "School_Code", 2);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

    public function getClassList() {
        $params = $this->getPostParams();
        $params['School_Code'] = Kahoutility::getCISessionValueByKey("School_Code");
        $this->addAYCodeAsFirstParam($params)
                ->setDefaultValueIfPostValNotFound($params, "userCode", $this->userCode, 2)
                ->setDefaultValueIfPostValNotFound($params, "School_Code", 0, 3)
                ->setDefaultValueIfPostValNotFound($params, "IsAll", 0, 4)
                ->setDefaultValueIfPostValNotFound($params, "heirarchy", 0, 5);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

}
