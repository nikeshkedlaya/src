<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Communicationservice extends Kahoservices
{

    public function __construct()
    {
        parent::__construct();
        $this->ciLibrary->load->library("processattachmentservice");
    }

    public function getInboxMail()
    {
        $this->processInboxOrSentParams($this->getProcedureName());
    }

    private function processInboxOrSentParams(string $spName, int $isInbox = 1)
    {
        $spParams = $this->getPostParams();
        $this->addUserCodeAsFirstParam($spParams)
            ->addDefaultParamToSPParams($spParams, "isInbox", $isInbox, 2)
            ->mergePaginationParamsToSPParams($spParams);
        $dbResponse = $this->kahoCrudServices->getRecord($spName, $spParams)->getResponse();
        if ($this->kahoCrudServices->isDBOperationSuccess()) {
            $processedResponse = $this->kahoCrudServices->buildRespStructure($dbResponse);
            $this->kahoCrudServices->printResponse($processedResponse, FALSE, Kahoutility::getCallieFunctionName(3));
        } else {
            $this->kahoCrudServices->printResponse(NULL, FALSE, Kahoutility::getCallieFunctionName(3));
        }
    }

    public function getSentMail()
    {
        $this->processInboxOrSentParams($this->getProcedureName(), 0);
    }

    public function getConversationMail()
    {
        $spParams = $this->getPostParams();
        $this->addUserCodeAsFirstParam($spParams)->changeAllParamsPosition($spParams, [
            'Mail_Id',
            USER_CODE,
            "To_Mail_Ids"
        ]);
        $conf = [
            Respstructurebuilder::CALLBACK_KEY => [
                [
                    $this,
                    "appendAttachmentsPathToConversation"
                ]
            ]
        ];
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $spParams)
            ->sendResponse($conf);
    }

    public function appendAttachmentsPathToConversation($array)
    {
        $attachedPathArray = Kahoutility::appendAbsoluteFilePath($array, "Photo", $this->controllerName, TRUE);
        $attachedPathArray = Kahoutility::parseAttachmentXMLString($attachedPathArray, $this->controllerName, "Attachment_XML");
        return $attachedPathArray;
    }

    // <editor-fold defaultstate="collapsed" desc="uploadMailAttachment">
    /**
     *
     * @param array $fileDataArray
     */
    public function uploadMailAttachment()
    {
        $this->uploadAttachment($_FILES, $this->ciLibrary->processattachmentservice);
    }

    // </editor-fold>
    public function addMailDetail()
    {
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $this->getMailComposeNReplyParams())
            ->sendResponse();
    }

    private function getMailComposeNReplyParams()
    {
        $spParams = $this->getPostParams();
        $this->addUserCodeAsFirstParam($spParams)
            ->processInputParams($spParams, [
            "Selected_User_Code" => [
                "Kahoutility::splitArrayByDelimiter"
            ]
        ])
            ->setDefaultValueIfPostValNotFound($spParams, "Reply_Parent_Code")
            ->processAttachedData($spParams, $this->ciLibrary->processattachmentservice)
            ->changeAllParamsPosition($spParams, [
            'Selected_User_Code',
            'Email_Subject',
            'Email_Message',
            UPLOADED_ATTACHMENT,
            'Reply_Parent_Code'
        ], 2);
        return $spParams;
    }

    public function replyMail()
    {
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $this->getMailComposeNReplyParams())
            ->sendResponse();
    }

    public function addUserType($userCode)
    {
        return Kahoutility::splitArrayByDelimiter($userCode);
    }

    public function getMailRecipients()
    {
        $params = $this->getPostParams();
        $this->mergeAYNUserCodeToSPParams($params)
            ->addDefaultParamToSPParams($params, USER_TYPE, $this->userType, 3)
            ->addDefaultParamToSPParams($params, IS_HIERARCHY, 1, 4);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }
}
