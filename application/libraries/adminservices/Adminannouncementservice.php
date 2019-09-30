<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Adminannouncementservice extends Kahoadminservices
{

    public function __construct()
    {
        parent::__construct();
    }

    public function addAnnouncement()
    {
        $postParams = $this->getPostParams();
        $this->addUserCodeAsFirstParam($postParams)->changeAllParamsPosition($postParams, [
            'Subject_Code',
            'Message_Code',
            'Homework_Attachment_Name'
        ], 2);
        $this->callKahoCrudServicesMethod("addRecord", $this->getProcedureName(), $postParams);
    }

    public function updateAnnouncement()
    {
        $postParams = $this->getPostParams();
        $this->addUserCodeAsFirstParam($postParams)->changeAllParamsPosition($postParams, [
            'Announcement_Id',
            'Subject_Code',
            'Message_Code',
            'Homework_Attachment_Name'
        ], 2);
        $this->callKahoCrudServicesMethod("updateRecord", $this->getProcedureName(), $postParams);
    }

    public function deleteAnnouncement()
    {
        $params = $this->getUriSegments();
        $this->addUserCodeAsFirstParam($params);
        $this->callKahoCrudServicesMethod("deleteRecord", $this->getProcedureName(), $params);
    }

    public function getAnnouncementForEditRecord()
    {
        $params = $this->getUriSegments();
        $this->callKahoCrudServicesMethod("getRecord", $this->getProcedureName(), $params);
    }

    public function getAnnouncementList()
    {
        $params = $this->processGridListParams();
        $this->callKahoCrudServicesMethod("getRecord", $this->getProcedureName(), $params);
    }
}
