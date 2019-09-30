<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Calendarservice
 *
 * @author KaHO
 */
class Calendarservice extends Kahoservices {

    // put your code here
    public function __construct() {
        parent::__construct();
        $this->ciLibrary->load->library("processattachmentservice");
    }

    public function getListenerClassPath() {
        return parent::getListenerClassBasePath() . "calendar/Calendarnotificationlistener";
    }

    public function getEvents() {
        $postParams = $this->getPostParams();
        $postParams['User_Type'] = Kahoutility::getCISessionValueByKey("User_Type");
        $this->addUserCodeAsFirstParam($postParams);
        $conf = array(
            "Calendar_Event_Details" => array(
                "Event_ID" => Respstructurebuilder::SHOW_ALL_KEY,
                Respstructurebuilder::CALLBACK_KEY => [
                    [
                        $this,
                        "processGetEventResponseForEvents"
                    ]
                ]
            ),
            "Meeting_Request_Details" => array(
                "Meeting_Request_ID" => Respstructurebuilder::SHOW_ALL_KEY,
                Respstructurebuilder::CALLBACK_KEY => [
                    [
                        $this,
                        "processGetEventResponseForMeetingRequest"
                    ]
                ]
            )
        );

        $this->changeAllParamsPosition($postParams, [
            "User_Type",
            "Month",
            "Year"
                ], 2);

        $this->kahoCrudServices->getRecord($this->getProcedureName(), $postParams)
                ->sendResponse($conf, true, true);
    }

    public function processGetEventResponseForEvents($arrayVal) {
        $arrayVal = Kahoutility::parseAttachmentXMLString($arrayVal, $this->controllerName, ATTACHMENT_XML);
        $arrayVal['Event_Type_Name'] = "event";
        return $arrayVal;
    }

    public function processGetEventResponseForMeetingRequest($arrayVal) {
        $arrayVal['Event_Type_Name'] = "meeting";
        $arrayVal['Start_Date'] = $arrayVal['Meeting_From_Date'];
        $arrayVal['End_Date'] = $arrayVal['Meeting_To_Date'];
        return $arrayVal;
    }

    public function addMeetingRequest() {
        $postParams = $this->getPostParams();
        $this->addUserCodeAsFirstParam($postParams)
                ->processInputParams($postParams, [
                    "Attendees" => [
                        "Kahoutility::splitArrayByDelimiter"
                    ]
                ])
                ->changeAllParamsPosition($postParams, [
                    "Attendees",
                    "Subject",
                    "Desc",
                    "Meeting_From",
                    "Meeting_To",
                    "Location"
                        ], 2)
                ->mergeTagsToLastSPParams($postParams);
        Facadelistener::getFacadeListenerIns()->registerNotificationListener($this->getListenerClassPath(), "sendMeetingRequestNotification", $postParams);
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $postParams)
                ->sendResponse();
    }

    public function addCalendarEvent() {
        $postParams = $this->getPostParams();
        $postParams['User_Type'] = Kahoutility::getCISessionValueByKey("User_Type");
        $this->addUserCodeAsFirstParam($postParams)
                ->processInputParams($postParams, [
                    "Group_IDs" => [
                        "Kahoutility::splitArrayByDelimiter"
                    ]
                ])
                ->changeAllParamsPosition($postParams, [
                    "User_Type",
                    "Group_IDs",
                    "Short_Desc",
                    "Desc",
                    "Start_Date",
                    "End_Date",
                    "IsHoliday",
                    UPLOADED_ATTACHMENT
                        // "Is_Offline"
                        ], 2)
                ->mergeTagsToLastSPParams($postParams)
                ->processAttachedData($postParams, $this->ciLibrary->processattachmentservice);

//        print_r($postParams); exit ;

        Facadelistener::getFacadeListenerIns()->registerNotificationListener($this->getListenerClassPath(), "sendAddCalendarEventNotification", $postParams);
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $postParams)
                ->sendResponse();
    }

    public function uploadEventAttachment() {
        $this->uploadAttachment($_FILES, $this->ciLibrary->processattachmentservice);
    }

    public function getUpComingEvents() {
        $params = $this->getPostParams();
        $this->addAYCodeAsFirstParam($params)
                ->addUserCodeOrStudentCodeToParams($params, 2)
                ->addDefaultParamToSPParams($params, USER_TYPE, $this->userType, 3);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

}
