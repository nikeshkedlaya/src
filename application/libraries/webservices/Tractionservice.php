<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Timetableservice
 *
 * @author KaHO
 */
class Tractionservice extends Kahoservices {

    // put your code here
    public function __construct() {
        parent::__construct();
    }

    private function appendDBNameToSPParams(&$spParams) {
        $this->setDefaultValueIfPostValNotFound($spParams, 'School_DB', Phpsessionservice::getPHPSessionServiceInstance()->getPHPSessionValueByKey(DB_SESSION_KEY_NAME), 1);
        return $this;
    }

    private function appendDateRangeToSPParams(&$spParams) {
        $this->setDefaultValueIfPostValNotFound($spParams, "From_Date", null, count($spParams) + 1)->setDefaultValueIfPostValNotFound($spParams, "To_Date", null, count($spParams) + 2);
        return $this;
    }

    private function mergeDBAndDateRange() {
        $params = $this->getPostParams();
        $this->appendDBNameToSPParams($params)->appendDateRangeToSPParams($params);
        return $params;
    }

    private function mergeTypeToSPParams(&$spParams, $pos = 4) {
        $this->changeParamsPosition($spParams, USER_TYPE, $pos);
        return $this;
    }

    public function tractionUserLoginCountGet() {
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $this->mergeDBAndDateRange())->sendResponse();
    }

    public function tractionTeacherAndParentCountGet() {
        $param = $this->mergeDBAndDateRange();
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $param)->sendResponse();
    }

    public function tractionUserLoginDetailGet() {
        $params = $this->mergeDBAndDateRange();
        $this->mergeTypeToSPParams($params);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)->sendResponse();
    }

    public function tractionUsersNotLoggedInCount() {
        $params = $this->getPostParams();
        $this->appendDBNameToSPParams($params);
        $this->changeParamsPosition($params, 'Days', 2);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)->sendResponse();
    }

    public function tractionUsersNotLoggedInUserTypeCountGet() {
        $params = $this->getPostParams();
        $this->appendDBNameToSPParams($params);
        $this->changeParamsPosition($params, 'Days', 2);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)->sendResponse();
    }

    public function tractionUsersNotLoggedDetailGet() {
        $params = $this->getPostParams();
        $this->appendDBNameToSPParams($params);
        $this->mergePaginationParamsToSPParams($params)->changeAllParamsPosition($params, [
            'Days',
            USER_TYPE,], 2);
        $path = $params[USER_TYPE] === USER_TYPE_PARENT ? PARENTS_IMAGE_PATH : TEACHERS_IMAGE_PATH;
        $conf = ['Total_Records' => ['Total_Records' => Respstructurebuilder::SHOW_ALL_KEY], "Not_LoggedIn_Detail_User" => ['User_Id' => Respstructurebuilder::SHOW_ALL_KEY, Respstructurebuilder::CALLBACK_KEY => ["kahoutility::appendAbsoluteFilePath", "Photo", $path, true]]];
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)->sendResponse($conf, true, true);
    }

    public function tractionTransactionLogGet() {
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $this->mergeDBAndDateRange())->sendResponse();
    }

    public function tractionTransactionLogDetail() {
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $this->mergeDBAndDateRange())->sendResponse();
    }

    public function tractionTransactionUsersCountByTypeGet() {
        $params = $this->mergeDBAndDateRange();
        $this->changeParamsPosition($params, "Transaction_Type", 4);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)->sendResponse();
    }

    public function tractionInputsCountGet() {
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $this->mergeDBAndDateRange())->sendResponse();
    }

    public function tractionInputsCountByTypeGet() {
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $this->mergeDBAndDateRange())->sendResponse();
    }

    public function tractionInputsCountByTypeAndTeacher() {
        $params = $this->mergeDBAndDateRange();
        $this->changeParamsPosition($params, "Type", 4);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)->sendResponse();
    }

    public function tractionInputsCountByTypeAndStudent() {
        $params = $this->mergeDBAndDateRange();
        $this->changeParamsPosition($params, "Type", 4);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)->sendResponse();
    }

    public function tractionUserEngagementcDetailCount() {
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $this->mergeDBAndDateRange())->sendResponse();
    }

    public function tractionStudentMCQCount() {
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $this->mergeDBAndDateRange())->sendResponse();
    }

    public function tractionStudentMCQDetailCount() {
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $this->mergeDBAndDateRange())->sendResponse();
    }

    public function tractionClassRoomObsCountGet() {
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $this->mergeDBAndDateRange())->sendResponse();
    }

    public function tractionClassRoomObsDetailGet() {
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $this->mergeDBAndDateRange())->sendResponse();
    }

    public function getTractionMenu() {
        $params = [];
        $this->addUserCodeAsFirstParam($params);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)->sendResponse();
    }

}
