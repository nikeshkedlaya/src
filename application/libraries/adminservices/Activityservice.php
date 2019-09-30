<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Activityservice extends Kahoadminservices {

    public function __construct() {
        parent::__construct();
    }

    public function addActivity() {
        $postParams = $this->getPostParams();
        $this->addDefaultParamToSPParams($postParams, "userId", $this->userCode, 1);
        $this->callKahoCrudServicesMethod("addRecord", $this->getProcedureName(), $postParams);
        // $this->ciLibrary->kahocrudservices->addRecord($this->getProcedureName(), $postParams)->sendResponse();
    }

    public function updateActivity() {
        $postParams = $this->getPostParams();
        $this->addDefaultParamToSPParams($postParams, "userId", Kahoapplicationservice::getKaHOAppSerIns()->getUserCode(), 1);
        $this->ciLibrary->kahocrudservices->updateRecord("sActivityUpdate", $postParams)->sendResponse();
    }

    public function deleteActivity() {
        $postParams = $this->getPostParams();
        $this->ciLibrary->kahocrudservices->deleteRecord("sActivityDelete", $postParams)->sendResponse();
    }

    public function getActivityForEditRecord() {
        $this->object->activityCode = $this->input->post("Activity_Code");
        $this->kahocrudservice->getEditRecord($this);
    }

    public function getActivityList() {
        $params = $this->processGridListParams();
        $this->callKahoCrudServicesMethod("getRecord", $this->getProcedureName(), $params);
    }

    public function getActivityType() {
        parent::getLookUpType("ACTTYPE");
    }

}
