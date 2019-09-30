<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Studentservice
 *
 * @author Rakshith B.K<rakshith@kaholabs.com>
 */
class Studentservice extends Kahoservices
{

    // put your code here
    public function __construct()
    {
        parent::__construct();
        $this->ciLibrary->load->library("processattachmentservice");
    }

    private function getListenerClassPath()
    {
        return parent::getListenerClassBasePath() . "student/Myinputnotificationlistner";
    }

    public function getStudentsList()
    {
        $params = $this->getPostParams();
        $this->addDefaultParamToSPParams($params, "ayCode", $this->ayCode, 1)
            ->mergePaginationParamsToSPParams($params)
            ->changeParamsPosition($params, "SAYCode", 2); // ->addDefaultParamToSPParams($params, "sddffd");
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse(Kahoutility::getStudentImageConfForAppend());
    }

    public function getHomeworkListForStudent()
    {
        $params = $this->getPostParams();
        $this->mergePaginationParamsToSPParams($params)->changeParamsPosition($params, "StudentCode", 1);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getStudentProfile()
    {
        $params = $this->getPostParams();
        $studentProfileConf = Kahoutility::getStudentImageConfForAppend();
        $studentProfileConf["Student_Code"] = Respstructurebuilder::SHOW_ALL_KEY;
        $conf = array(
            "Student_Profile" => $studentProfileConf,
            "Teachers_List" => [
                "Teacher_Code" => Respstructurebuilder::SHOW_ALL_KEY
            ]
        );
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse($conf, TRUE, TRUE);
    }

    public function getStudentsListByClasses()
    {
        $params = $this->getPostParams(); // Section_AY_Codes
        $this->processInputParams($params, [
            'Section_AY_Codes' => [
                "Kahoutility::splitArrayByDelimiter"
            ]
        ]);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function observationDetailAdd()
    {
        $params = $this->getPostParamsForObsNCom();
        Facadelistener::getFacadeListenerIns()->registerNotificationListener($this->getListenerClassPath(), "sendAddObservationNotification", $params);
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    // <editor-fold defaultstate="collapsed" desc="getPostParamsForObsNCom">
    /**
     * will return the post params for observation and compliment
     *
     * @return type
     */
    private function getPostParamsForObsNCom()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)
            ->processAttachedData($params, $this->ciLibrary->processattachmentservice)
            ->changeAllParamsPosition($params, [
            "Remarks",
            "Likes",
            "DisLikes",
            "StudentCodes",
            "Ratings",
            "Parent_Visibility",
            "Tags"
        ], 2)
            ->processInputParams($params, [
            'StudentCodes' => [
                "Kahoutility::splitArrayByDelimiter"
            ],
            'Ratings' => [
                "Kahoutility::splitArrayByDelimiter"
            ]
        ])
            ->mergeTagsToLastSPParams($params)
            ->changeParamsPosition($params, UPLOADED_ATTACHMENT, 10);
        return $params;
    }

    // </editor-fold>
    public function complimentDetailAdd()
    {
        $params = $this->getPostParamsForObsNCom();
        Facadelistener::getFacadeListenerIns()->registerNotificationListener($this->getListenerClassPath(), "sendAddComplimentNotification", $params);
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function concernAdd()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)
            ->changeAllParamsPosition($params, [
            "Concern",
            "Description",
            "Student_Codes",
            "IsResolved",
            "Resolution",
            "Assign_To",
            "Comments",
            "Share_To"
        ], 2)
            ->processInputParams($params, [
            'Student_Codes' => [
                "Kahoutility::splitArrayByDelimiter"
            ],
            'Share_To' => [
                "Kahoutility::splitArrayByDelimiter"
            ]
        ])
            ->mergeTagsToLastSPParams($params);
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getStudentMyInputs()
    {
        $params = $this->getPostParams();
        $this->addDefaultParamToSPParams($params, "userType", $this->userType, 1)
            ->changeAllParamsPosition($params, [
            "StudentCode",
            "Type"
        ], 2)
            ->mergePaginationParamsToSPParams($params);
        $conf = array(
            Respstructurebuilder::CALLBACK_KEY => [
                [
                    $this,
                    "processStudentMyInputsResp"
                ]
            ]
        );
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse($conf);
    }

    public function processStudentMyInputsResp(array $arrayData)
    {
        $arrayData = Kahoutility::convertXMLToArrayCallback($arrayData, "Characteristic_Detail");
        $arrayData['Characteristic_Detail'] = Kahoutility::checkArrayParam($arrayData['Characteristic_Detail']) ? ($arrayData['Characteristic_Detail'][0] instanceof SimpleXMLElement ? [
            convertObjToArray($arrayData['Characteristic_Detail'][0])
        ] : $arrayData['Characteristic_Detail'][0]) : "";
        $arrayData['Characteristic_Detail'] = isset($arrayData['Characteristic_Detail']['Name']) ? [
            $arrayData['Characteristic_Detail']
        ] : $arrayData['Characteristic_Detail'];
        $arrayData['Input_By'] = $this->getInputLabel($arrayData);
        $arrayData = Kahoutility::parseAttachmentXMLString($arrayData, STUDENT_INPUT_IMAGE_PATH, ATTACHMENT_XML);
        return $arrayData;
    }

    private function getInputLabel(array $arrayData): ?string
    {
        $inputLabel = null;
        if (isset($arrayData['Object_Type'])) {
            switch ($arrayData['Object_Type']) {
                case "OBJCOMPLIMENT":
                    $inputLabel = "Complimented";
                    break;
                case "OBJOBSERVATION":
                    $inputLabel = "Observed";
                    break;
                case "OBJCONCERN":
                    $inputLabel = "Concerned";
                    break;
                default:
                    $inputLabel = NULL;
                    break;
            }
        }
        return $inputLabel;
    }

    public function getAssessmentListForStudent()
    {
        $params = $this->getPostParams();
        $this->addDefaultParamToSPParams($params, "ayCode", NULL, 1)->changeParamsPosition($params, "StudentCode", 2);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getStudentAssessmentGraph()
    {
        $params = $this->getPostParams(); // StudentCode,AssessmentID
        $this->changeParamsPosition($params, "AssessmentID", 2);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getStudentSubjectTrend()
    {
        $params = $this->getPostParams();
        $this->addAYCodeAsFirstParam($params)
            ->setDefaultValueIfPostValNotFound($params, "AssessmentID", null)
            ->changeAllParamsPosition($params, [
            'Student_Code',
            'AssessmentID',
            'Subject_Code'
        ], 2);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getStudentLatestAssessmentGraph()
    {
        $params = $this->getPostParams(); // Student_Code
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getSharedUsersComment()
    {
        $params = $this->getPostParams();
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getConcernHistory()
    {
        $params = $this->getPostParams();
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getConcernFlow()
    {
        $params = $this->getPostParams();
        $this->mergePaginationParamsToSPParams($params);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getConcernsList()
    {
        $params = $this->getPostParams();
        $this->mergeAYNUserCodeToSPParams($params)
            ->changeParamsPosition($params, "Is_Resolved", 3)
            ->mergePaginationParamsToSPParams($params);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getConcernShareList()
    {
        $params = $this->getPostParams();
        $this->mergeAYNUserCodeToSPParams($params)->mergePaginationParamsToSPParams($params);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getConcernStudents()
    {
        $params = $this->getPostParams();
        $conf = Kahoutility::getStudentImageConfForAppend();
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse($conf);
    }

    public function updateConcern()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)
            ->processInputParams($params, [
            'Concern_Detail_ID' => [
                "Kahoutility::splitArrayByDelimiter"
            ],
            'Assigned_To' => [
                "Kahoutility::splitArrayByDelimiter"
            ]
        ])
            ->changeAllParamsPosition($params, [
            "Concern_ID",
            "Concern_Detail_ID",
            "Action_Taken",
            "IsResolved",
            "Assigned_To",
            "Assign_Remarks"
        ], 2);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function addSharedUserComment()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)
            ->processInputParams($params, [
            'Concern_Detail_ID' => [
                "Kahoutility::splitArrayByDelimiter"
            ]
        ])
            ->changeAllParamsPosition($params, [
            "Share_ID",
            "Concern_Detail_ID",
            "Comments"
        ], 2);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getMyInputsList()
    {
        $params = $this->getPostParams();
        $this->mergeAYNUserCodeToSPParams($params)
            ->mergePaginationParamsToSPParams($params)
            ->changeParamsPosition($params, "Section_AY_Code", 3);
        $conf = array(
            Respstructurebuilder::CALLBACK_KEY => [
                [
                    $this,
                    "processStudentMyInputsResp"
                ]
            ]
        );
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse($conf);
    }

    public function updateStudentProfile()
    {
        $params = $this->getPostParams();
        $this->addDefaultParamToSPParams($params, SELECTED_STUDENT_CODE, Kahoutility::getSelectedStudentCode(), 1)->changeAllParamsPosition($params, [
            'Pet_Name',
            'Photo',
            'Special_Notes',
            'Allergic_To',
            'First_Name',
            'Middle_Name',
            'Last_Name',
            'Father_Name',
            'Mother_Name'
        ], 2);
        $this->kahoCrudServices->updateRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function uploadStudentProfilePics()
    {
        $this->uploadAttachment($_FILES, $this->ciLibrary->processattachmentservice, STUDENT_IMAGE_PATH);
    }

    public function uploadStudentInputAttachment()
    {
        $this->uploadAttachment($_FILES, $this->ciLibrary->processattachmentservice, STUDENT_INPUT_IMAGE_PATH);
    }

    public function getAssessmentListByClass()
    {
        $params = $this->getPostParams();
        $this->addAYCodeAsFirstParam($params)->changeAllParamsPosition($params, [
            'Section_AY_Code',
            'Class_Code'
        ], 2)->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }
}
