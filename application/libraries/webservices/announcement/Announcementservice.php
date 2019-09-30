<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Announcementservice
 *
 * @author KaHO
 */
class Announcementservice extends Kahoservices {

    // put your code here
    public function __construct() {
        parent::__construct();
        $this->ciLibrary->load->library("processattachmentservice");
    }

    private function getListenerClassPath() {
        return parent::getListenerClassBasePath() . "announcement/Announcementnotificationlistener";
    }

    public function getAnnouncement() {
        $params = $this->getPostParams();
        $this->mergeAYNUserCodeToSPParams($params)
                ->addDefaultParamToSPParams($params, "userType", $this->userType, 3)
                ->mergePaginationParamsToSPParams($params);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
                ->sendResponse(Kahoutility::getParseAttachmentXMLStringConfiguration($this->controllerName));
    }

    public function announcementDetailAdd() {
        $params = $this->getPostParams();
        $params['User_Type'] = Kahoutility::getCISessionValueByKey("User_Type");
        $this->addUserCodeAsFirstParam($params)
                ->processInputParams($params, [
                    "Announce_To" => [
                        "Kahoutility::splitArrayByDelimiter"
                    ]
                ])
                ->changeAllParamsPosition($params, [
                    "User_Type",
                    "Subject",
                    "Message",
                    UPLOADED_ATTACHMENT,
                    "Ack",
                    "Announce_To",
                    'Tags',
                    'ApprovedBy'
                        ], 2)
                ->processAttachedData($params, $this->ciLibrary->processattachmentservice);

//        print_r($params);
//        exit;

        Facadelistener::getFacadeListenerIns()->registerNotificationListener($this->getListenerClassPath(), "sendAddAnnouncementNotification", $params);
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

    // public function postAnnouncementDetailAdd($dbResponse, $postParams) {
    // $this->ciLibrary->notificationbuilder
    // ->setUserCode($postParams->Announcement_To)
    // ->setEventType("add_announcement")
    // ->setMessageFormatterValue("here is the notificatoin")
    // ->build()->sendNotification();
    // }
    public function uploadAnnouncementAttachment() {
        $this->uploadAttachment($_FILES, $this->ciLibrary->processattachmentservice);
    }

    public function deleteAnnouncement() {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)
                ->changeAllParamsPosition($params, [
                    "Announcement_ID"
                        ], 2);
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

}
