<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Eventservice extends Kahoadminservices
{

    public function __construct()
    {
        parent::__construct();
    }

    public function addEvent()
    {
        $postParams = $this->getPostParams();
        $this->addUserCodeAsFirstParam($postParams)->changeAllParamsPosition($postParams, [
            'Title',
            'Description',
            'Start_Date',
            'End_Date',
            'IsHoliday'
        ], 2);
        $this->callKahoCrudServicesMethod("addRecord", $this->getProcedureName(), $postParams);
    }

    public function deleteEvent()
    {
        $params = $this->getUriSegments();
        $this->addUserCodeAsFirstParam($params);
        $this->callKahoCrudServicesMethod("deleteRecord", $this->getProcedureName(), $params);
    }

    public function updateCalendarEvent()
    {
        $postParams = $this->getPostParams();
        $this->addUserCodeAsFirstParam($postParams)->changeAllParamsPosition($postParams, [
            'Title',
            'Description',
            'Start_Date',
            'End_Date',
            'IsHoliday'
        ], 2);
        $this->callKahoCrudServicesMethod("updateRecord", $this->getProcedureName(), $postParams);
    }

    public function getEventForEditRecord()
    {
        $params = $this->getUriSegments();
        $this->callKahoCrudServicesMethod("getRecord", $this->getProcedureName(), $params);
    }

    public function getEventList()
    {
        $params = $this->processGridListParams();
        $this->callKahoCrudServicesMethod("getRecord", $this->getProcedureName(), $params);
    }
}
