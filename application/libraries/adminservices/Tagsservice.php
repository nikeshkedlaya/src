<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Tagsservice extends Kahoadminservices
{

    public function __construct()
    {
        parent::__construct();
    }

    public function addTags()
    {
        $postParams = $this->getPostParams();
        $this->addUserCodeAsFirstParam($postParams)->changeAllParamsPosition($postParams, [
            'Tags_Name',
            'Tag_Type'
        ], 2);
        $this->callKahoCrudServicesMethod("addRecord", $this->getProcedureName(), $postParams);
    }

    public function deleteTags()
    {
        $params = $this->getUriSegments();
        $this->addUserCodeAsFirstParam($params);
        $this->callKahoCrudServicesMethod("deleteRecord", $this->getProcedureName(), $params);
    }

    public function updateTags()
    {
        $postParams = $this->getPostParams();
        $this->addUserCodeAsFirstParam($postParams)->changeAllParamsPosition($postParams, [
            'Tags_Code',
            'Tags_Name',
            'Tag_Type'
        ], 2);
        $this->callKahoCrudServicesMethod("updateRecord", $this->getProcedureName(), $postParams);
    }

    public function getTagForEditRecord()
    {
        $params = $this->getUriSegments();
        $this->callKahoCrudServicesMethod("getRecord", $this->getProcedureName(), $params);
    }

    public function getTagsList()
    {
        $params = $this->processGridListParams();
        $this->callKahoCrudServicesMethod("getRecord", $this->getProcedureName(), $params);
    }
}
