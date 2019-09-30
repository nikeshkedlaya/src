<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Notificationservice
 *
 * @author KaHO
 */
class Notificationservice extends Kahoservices {

    //put your code here

    public function __construct() {
        parent::__construct();
    }

    public function registerDeviceId() {
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $this->getRegisterNUnregisterParams())->sendResponse();
    }

    public function unRegisterDeviceId() {
        $params = $this->getRegisterNUnregisterParams();
        $params['isAdd'] = 0;
        $this->kahoCrudServices->updateRecord($this->getProcedureName(), $params)->sendResponse();
    }

    private function getRegisterNUnregisterParams() {
        $params = $this->getPostParams();
        $this->setDefaultValueIfPostValNotFound($params, "userID", Kahoapplicationservice::getKaHOAppSerIns()->getUserId())->addDefaultParamToSPParams($params, 'isAdd', 1)->changeAllParamsPosition($params, ['userID', 'Device_ID', 'Platform_Type', 'isAdd']);
        return $params;
    }

    public function getNotificationSettingsList() {
        $params = ["userId" => Kahoapplicationservice::getKaHOAppSerIns()->getUserId()]; // User_ID 
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)->sendResponse();
    }

    public function updateNotificationSettings() {
        $params = $this->getPostParams();
        $params['userId'] = Kahoapplicationservice::getKaHOAppSerIns()->getUserId();
        $this->changeAllParamsPosition($params, ['userId', 'Settings_ID', 'State']);
        $this->kahoCrudServices->updateRecord($this->getProcedureName(), $params)->sendResponse();
    }

    public function getNotificationList() {
        $params = $this->getPostParams();
        $params['userId'] = Kahoapplicationservice::getKaHOAppSerIns()->getUserId();
        $this->changeAllParamsPosition($params, ['userId', 'Platform_Type', 'Event_Type', 'From_Date', 'To_Date', 'PageNum', 'NumOfRec'])->mergePaginationParamsToSPParams($params);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)->sendResponse();
    }

}
