<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ApprovalService
 *
 * @author KaHO
 */
class Approvalservice extends Kahoservices
{

    // put your code here
    public function __construct()
    {
        parent::__construct();
    }

    public function getAnnouncementWorkFlow()
    {
        $params = $this->getPostParams();
        $conf = array(
            Respstructurebuilder::CALLBACK_KEY => array(
                "Kahoutility::appendAbsoluteFilePath",
                "Announcement_Attachment",
                ANNOUNCEMENT_IMAGE_PATH
            )
        );
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse($conf);
    }

    public function addAnnouncementWorkflow()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)
            ->changeAllParamsPosition($params, [
            'Workflow_ID',
            'Ref_ID',
            'Announcement_Subject',
            'Announcement_Message',
            'Announcement_Attachment',
            'Is_Ack_Required',
            'Announcement_To',
            'Tags',
            'Status',
            'Comments'
        ], 2)
            ->processInputParams($params, [
            'Tags' => [
                "Kahoutility::splitArrayByDelimiter"
            ],
            'Announcement_To' => [
                "Kahoutility::splitArrayByDelimiter"
            ]
        ]);
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getApprovalList()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)
            ->changeParamsPosition($params, "Status", 2)
            ->mergePaginationParamsToSPParams($params);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }
}
