<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of parentdashboardservice
 *
 * @author KaHO
 */
class parentdashboardservice extends Kahoservices
{

    // put your code here
    public function __construct()
    {
        parent::__construct();
        $this->ciLibrary->load->library("processattachmentservice");
    }

    public function getParentDashboardSummary()
    {
        $params = $this->getPostParams();
        $this->mergeAYNStudentCodeToSPParams($params)->changeAllParamsPosition($params, [
            'Time',
            NO_OF_RECORD_KEY
        ], 3); // Time
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse([
            Respstructurebuilder::CALLBACK_KEY => [
                [
                    $this,
                    "appendLabelForParentDashboardSummary"
                ]
            ]
        ]);
    }

    public function appendLabelForParentDashboardSummary($arrayVal)
    {
        $objectLabel = "";
        if (isset($arrayVal['Object_Type'])) {
            switch ($arrayVal['Object_Type']) {
                case "OBJANNOUNCEMENT":
                    $objectLabel = "Announcement";
                    break;
                case "OBJOBSERVATION":
                    $objectLabel = "Observation";
                    break;
                case "OBJMAIL":
                    $objectLabel = "Mail";
                    break;
                case "OBJGALLERY":
                    $objectLabel = "Gallery";
                    break;
                case "OBJENGAGEMENT":
                    $objectLabel = "Engagement";
                    break;
                case "OBJHW":
                    $objectLabel = "Homework";
                    break;
                case "OBJCOMPLIMENT":
                    $objectLabel = "Compliment";
                    break;
                case "OBJMCQ":
                    $objectLabel = "MCQ";
                    break;
                case "OBJLRNGRESC":
                    $objectLabel = "Learning Resources";
                    break;
            }
        }
        $arrayVal['Object_Label'] = $objectLabel;
        return $arrayVal;
    }

    public function getParentProfile()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params);
        $conf = array(
            Respstructurebuilder::CALLBACK_KEY => array(
                "Kahoutility::appendAbsoluteFilePath",
                "Photo",
                PARENTS_IMAGE_PATH,
                TRUE
            )
        );
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse($conf);
    }

    public function updateParentProfile()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)->changeAllParamsPosition($params, [
            'Parent_Name',
            'Phone',
            'Email',
            'Parent_Occupation',
            'Permanent_Address',
            'Local_Address',
            'Photo',
            'Bio',
            'Fav_Colour',
            'Fav_Restaurant',
            'Fav_Drink',
            'Fav_Hobby',
            'Fav_Store',
            'Fav_Books',
            'Fav_Movies',
            'About_Parent',
            'LinkedIn_Profile',
            'Facebook_Profile'
        ], 2);
        $this->kahoCrudServices->updateRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function updateParentProfilePic()
    {
        $this->uploadAttachment($_FILES, $this->ciLibrary->processattachmentservice, PARENTS_IMAGE_PATH);
    }
}
