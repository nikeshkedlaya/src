<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Kahogalleryservice
 *
 * @author KaHO
 */
class Kahogalleryservice extends Kahoservices
{

    // put your code here
    public function __construct()
    {
        parent::__construct();
        $this->ciLibrary->load->library("processattachmentservice");
    }

    public function getListenerClassPath()
    {
        return parent::getListenerClassBasePath() . "kahogallery/Kahogallerynotificationlistener";
    }

    public function getFilesToShare()
    {
        $params = $this->getPostParams();
        $this->mergeAYNUserCodeToSPParams($params)->mergePaginationParamsToSPParams($params);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse([
            Respstructurebuilder::CALLBACK_KEY => [
                [
                    $this,
                    "attachFilePath"
                ]
            ]
        ]);
    }

    // for temporary purpose
    public function attachFilePath($val)
    {
        $val = Kahoutility::appendAbsoluteFilePath($val, "File_Name", $this->controllerName);
        return $val;
    }

    public function addGalleryRepo()
    {
        $params = $this->getPostParams(); // File_Detail
        $this->addUserCodeAsFirstParam($params)->processAttachedData($params, $this->ciLibrary->processattachmentservice, ATTACHMENT_TYPE_KAHO_GALLERY, "File_Detail");
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function addGalleryFileShare()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)
            ->changeAllParamsPosition($params, [
            'Comments',
            'File_IDs',
            'Users'
        ], 2)
            ->processInputParams($params, [
            'File_IDs' => [
                "Kahoutility::splitArrayByDelimiter"
            ],
            'Users' => [
                "Kahoutility::splitArrayByDelimiter"
            ]
        ]);
        Facadelistener::getFacadeListenerIns()->registerNotificationListener($this->getListenerClassPath(), "sendSharedGalleryNotification", $params);
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getGallerySharedWithMe()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)
            ->setDefaultValueIfPostValNotFound($params, USER_CODE, $this->userCode, 2)
            ->addDefaultParamToSPParams($params, USER_TYPE, $this->userType)
            ->mergePaginationParamsToSPParams($params);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse(Kahoutility::getBaseUrlAttachementConfiguration($this->controllerName));
    }

    public function updateGalleryFileViewCount()
    {
        $params = $this->getPostParams(); // Gallery_Repo_ID
        $this->kahoCrudServices->updateRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function uploadGalleryAttachment()
    {
        $this->uploadAttachment($_FILES, $this->ciLibrary->processattachmentservice);
    }

    public function getGalleryRepoList()
    {
        $params = $this->getPostParams();
        $this->setDefaultValueIfPostValNotFound($params, USER_CODE, $this->userCode);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse(Kahoutility::getBaseUrlAttachementConfiguration($this->controllerName));
    }
}
