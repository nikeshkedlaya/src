<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Learningresourceservice
 *
 * @author KaHO
 */
class Learningresourceservice extends Kahoservices {

    // put your code here
    public function __construct() {
        parent::__construct();
        $this->ciLibrary->load->library("processattachmentservice");
    }

    private function getListenerClassPath() {
        return $this->getListenerClassBasePath() . "learningresource/Learningresourcenotificationlistener";
    }

    // <editor-fold defaultstate="collapsed" desc="addLearningResource">
    /**
     * will share the leaning resource repo
     */
    public function addLearningResource() {
        $arrayParams = $this->getPostParams();
        $this->addUserCodeAsFirstParam($arrayParams)
                ->processInputParams($arrayParams, [
                    'Users' => [
                        'Kahoutility::splitArrayByDelimiter'
                    ],
                    'FileIDs' => [
                        'Kahoutility::splitArrayByDelimiter'
                    ]
                ])
                ->changeAllParamsPosition($arrayParams, [
                    "Title",
                    "Description",
                    "Users",
                    "FileIDs"
                        ], 2);
        Facadelistener::getFacadeListenerIns()->registerNotificationListener($this->getListenerClassPath(), "sendSharedLearningResourceNotification", $arrayParams);
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $arrayParams)
                ->sendResponse();
    }

    // </editor-fold>
    public function addLearningResourceRepo() {
        $arrayParams = $this->getPostParams();
        $this->addUserCodeAsFirstParam($arrayParams)
                ->processInputParams($arrayParams, [
                    'Class_Code' => [
                        "Kahoutility::splitArrayByDelimiter"
                    ],
                    'Subject_Code' => [
                        "Kahoutility::splitArrayByDelimiter"
                    ]
                ])
                ->processUploadedAttachmentByGivenKeys($arrayParams, [
                    'Name',
                    'File_Original_Name',
                    'Name_Path',
                    'Type'
                ])
                ->changeAllParamsPosition($arrayParams, [
                    "File_Title",
                    "File_Description",
                    "Name",
                    "File_Original_Name",
                    "Name_Path",
                    "Type",
                    "Is_Private",
                    "Class_Code",
                    "Subject_Code"
                        ], 2)
                ->mergeTagsToLastSPParams($arrayParams);
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $arrayParams)
                ->sendResponse();
    }

    public function getMediaTypeFromFileExtension($fileType) {
        if (Kahoutility::isStringParamValid($fileType)) {
            return $this->ciLibrary->processattachmentservice->getMediaTypeFromFileExtension($this->ciLibrary->processattachmentservice->getAttachedFileExtention($fileType));
        }
        return;
    }

    // public function shareLearningResource()
    // {
    // $params = $this->getPostParams();
    // $this->addUserCodeAsFirstParam($params)
    // ->changeParamsPosition($params, "Title", 2)
    // ->changeParamsPosition($params, "FileIDs", 5);
    //
    // $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
    // ->sendResponse();
    // }
    public function getLearningResourcesFromRepo() {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
                ->sendResponse(Kahoutility::getBaseUrlAttachementConfiguration($this->controllerName));
    }

    // <editor-fold defaultstate="collapsed" desc="getProcessInputParamsForSplitting">
    /**
     * will return the params would be used in processinput params inside method getAllResourcesFromRepo, for splitting the input val
     *
     * @return array
     */
    public function getProcessInputParamsForSplitting() {
        $processInputParamsForSplitting = [
            "Class_Code" => [
                "Kahoutility::splitArrayByDelimiter"
            ],
            "Subject_Code" => [
                "Kahoutility::splitArrayByDelimiter"
            ],
            "Tags" => [
                "Kahoutility::splitArrayByDelimiter"
            ]
        ];
        return $processInputParamsForSplitting;
    }

    // </editor-fold>
    public function getAllResourcesFromRepo() {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)
                ->setDefaultValueIfPostValNotFound($params, "Tags")
                ->changeAllParamsPosition($params, [
                    "Class_Code",
                    "Subject_Code",
                    "Media_Type",
                    "Tags"
                        ], 2)
                ->mergePaginationParamsToSPParams($params)
                ->processInputParams($params, $this->getProcessInputParamsForSplitting());
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
                ->sendResponse(Kahoutility::getBaseUrlAttachementConfiguration($this->controllerName));
    }

    // private function getAttachementConfiguration() {
    // $conf = array(Respstructurebuilder::CALLBACK_KEY => array("Kahoutility::appendAbsoluteFilePath", "File_Name", $this->controllerName));
    // return $conf;
    // }
    public function getSharedResources() {
        $params = $this->getPostParams();
        $this->setDefaultValueIfPostValNotFound($params, "Student_Code", $this->userCode, 1)
                ->setDefaultValueIfPostValNotFound($params, "Tags")
                ->processInputParams($params, [
                    "Tags" => [
                        "Kahoutility::splitArrayByDelimiter"
                    ]
                ])
                ->mergePaginationParamsToSPParams($params)
                ->changeAllParamsPosition($params, [
                    "From_Date",
                    "To_Date",
                    "Media_Type",
                    "Tags",
                    "IsCreatedByMe",
                        ], 2);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
                ->sendResponse(Kahoutility::getBaseUrlAttachementConfiguration($this->controllerName));
    }

    public function addLearningResourceFileView() {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

    public function getMediaType() {
        $mediaType = [
            [
                "Option_Text" => "AUDIO",
                "Option_Value" => MEDIA_TYPE_AUDIO
            ],
            [
                "Option_Text" => "VIDEO",
                "Option_Value" => MEDIA_TYPE_VIDEO
            ],
            [
                "Option_Text" => "DOCS",
                "Option_Value" => MEDIA_TYPE_DOCS
            ],
            [
                "Option_Text" => "IMAGE",
                "Option_Value" => MEDIA_TYPE_IMAGE
            ]
        ];
        $this->kahoCrudServices->printResponse($mediaType, FALSE, "getMediaType", "", Kahocrudservices::RESPONSE_FOUND);
    }

    public function uploadLearningResourcesAttachment() {
        $this->uploadAttachment($_FILES, $this->ciLibrary->processattachmentservice);
    }

    public function getFilesFromRepoById() {
        $params = $this->getPostParams(); // Repo_ID
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
                ->sendResponse(Kahoutility::getBaseUrlAttachementConfiguration($this->controllerName));
    }

    public function getLRCount() {
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $this->getTeacherDairyParams())
                ->sendResponse();
    }

}
