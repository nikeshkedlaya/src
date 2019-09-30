<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Kahoadminservices
 *
 * @author KaHO
 */
include_once getcwd() . '/application/libraries/Postparamsbuilder.php';

class Kahoservices {

    use Postparamsbuilder;

    protected $ciLibrary;
    protected $userCode;
    protected $userType;
    protected $kahoCrudServices;
    protected $proceduresConfiguration;
    protected $ayCode;
    protected $controllerName;

    // would be used to retrieve the procedure configuration and lang configuration file
    public function __construct() {
        $this->ciLibrary = Kahoutility::getCILibrary();
        $this->ciLibrary->load->library(array(
            "kahocrudservices",
            "respstructurebuilder"
        ));
        $this->ciLibrary->load->library("databaseservice", NULL, "dbService");
        $this->getControllerName();
        $this->loadLanguageFile();
        $this->userCode = Kahoapplicationservice::getKaHOAppSerIns()->getUserCode();
        $this->userType = Kahoapplicationservice::getKaHOAppSerIns()->getUserType();
        $this->ayCode = Kahoapplicationservice::getKaHOAppSerIns()->getAYCode();
        $this->kahoCrudServices = $this->ciLibrary->kahocrudservices;
        $this->loadProceduresConfiguration();
    }

    // <editor-fold defaultstate="collapsed" desc="getControllerName">
    /**
     * will set the controller name
     * 
     * @param type $stackTraceIndex
     */
    protected function getControllerName($stackTraceIndex = 9) {
        try {
            if (!Kahoutility::isStringParamValid($this->controllerName)) {
                $this->controllerName = strtolower(Kahoutility::getCallieClassName($stackTraceIndex));
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } finally {
            return $this->controllerName;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="loadLanguageFile">
    /**
     * will load the language file
     */
    protected function loadLanguageFile(): void {
        try {
            $controllerName = $this->getControllerName();
            $this->ciLibrary->lang->load($controllerName);
        } catch (Exception $exc) {
            
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="loadProceduresConfiguration">
    /**
     * will load the procedures configuration
     */
    protected function loadProceduresConfiguration(string $proceduresDirectory = PROCEDURES_CONFIGURTIONS_KEYWORD): void {
        $controllerName = $this->getControllerName();
        $this->ciLibrary->config->load($proceduresDirectory . "/" . $controllerName . "_" . PROCEDURES_CONFIGURTIONS_KEYWORD);
        $this->proceduresConfiguration = $this->ciLibrary->config->item($controllerName);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getProcedureName">
    /**
     * will retrieve the procedures name from loaded procedures configuration where callie ctrl method name would be key in most of the case and callie service method name may be the key in some case
     * 
     * @return string
     */
    protected function getProcedureName(int $stackTraceMethodIndex = 3): string {
        $procedureName = NULL;
        $methodName = Kahoutility::getCallieFunctionName($stackTraceMethodIndex);
        try {
            if (Kahoutility::isStringParamValid($methodName) && Kahoutility::checkArrayParam($this->proceduresConfiguration) && isset($this->proceduresConfiguration[$methodName])) {
                $procedureName = $this->proceduresConfiguration[$methodName];
            }
        } catch (Exception $exc) {
            
        } finally {
            return $procedureName;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="uploadAttachment">
    /**
     *
     * @param array|null $filaDataArray
     */
    public function uploadAttachment($fileDataArray, Processattachmentservice $processAttachmentServiceObj, $folderName = null, $filesArrayName = ATTACHMENT_FILE_FIELD_NAME, string $clientWDKey = WORKING_DIRECTORY_WEB_KEY) {
        $fileDetails = $processAttachmentServiceObj->processAttachment($fileDataArray, $folderName, $filesArrayName, $clientWDKey);
        $istomakekeyarray = Kahoutility::checkArrayParam($fileDetails);
        $this->kahoCrudServices->printResponse($fileDetails, $istomakekeyarray, Kahoutility::getCallieFunctionName(3), NULL, $istomakekeyarray ? Kahocrudservices::RESPONSE_FOUND : Kahocrudservices::RESPONSE_NOT_FOUND);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="mergeTagsToLastSPParams">
    /**
     * will add the tags param as last param to $spParams by default
     * 
     * @param array $spParams
     * @param int $position
     */
    protected function mergeTagsToLastSPParams(array &$spParams, int $position = 0) {
        try {
            if (array_key_exists("Tags", $spParams)) {
                $spParams['Tags'] = Kahoutility::splitArrayByDelimiter($spParams['Tags']);
                $position = $position > 0 ? $position : count($spParams) + 1;
                $this->changeParamsPosition($spParams, "Tags", $position);
            }
        } catch (Exception $exc) {
            
        } finally {
            return $this;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getLookUpType">
    /**
     * will return the look up type response
     * 
     * @param type $lookUpType
     */
    protected function getLookUpType($lookUpType = null) {
        $typeCode = Kahoutility::isStringParamValid($lookUpType) ? [
            "lookupType" => $lookUpType
                ] : $this->getUriSegments();
        $this->kahoCrudServices->getRecord("sLookUpGetList", $typeCode)->sendResponse();
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getTeacherDairyParams">
    /**
     * will return the params would be used for teacher dairy
     * 
     * @param type $serviceContext
     *            is service class context
     * @return type
     */
    protected function getTeacherDairyParams() {
        $params = $this->getPostParams();
        $this->setDefaultValueIfPostValNotFound($params, "User_Code", $this->userCode, 1); // User_Code,Date
        return $params;
    }

    // </editor-fold>

    public function processAttachedData(array &$postArrayData, Processattachmentservice $processAttachmentServiceObj, string $attachmentType = null, string $uploadedAttachmentKey = UPLOADED_ATTACHMENT, string $sharedAttachmentKey = SHARED_ATTACHMENT) {
        try {
            $processAttachmentServiceObj->processAttachedData($postArrayData, $uploadedAttachmentKey, $sharedAttachmentKey, $attachmentType);
        } catch (Exception $exc) {
            
        } finally {
            return $this;
        }
    }

    // <editor-fold defaultstate="collapsed" desc="getAnalysisParams">
    /**
     * desc will return the params for anylysis such as homework,attendance and mcq analysis
     */
    public function getAnalysisParams($isMonthNum = true) {
        $params = $this->getPostParams();
        $paramsToChangePos = [
            SELECTED_STUDENT_CODE,
            "Section_AY_Code"
        ];
        $isMonthNum ? array_push($paramsToChangePos, "Month_Number") : "";
        $this->addAYCodeAsFirstParam($params)
                ->setDefaultValueIfPostValNotFound($params, SELECTED_STUDENT_CODE, Kahoutility::getSelectedStudentCode())
                ->changeAllParamsPosition($params, $paramsToChangePos, 2);
        return $params;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="processUploadedAttachmentByGivenKeys">
    /**
     * will process the processUploadedAttachment, may be used for single upload attachment.such as lr and profile image upload and append the $uploadedAttachmentObjKeys to array params to pass to procedures
     */
    public function processUploadedAttachmentByGivenKeys(array &$arrayParams, array $uploadedAttachmentObjKeys) {
        try {
            if (Kahoutility::checkArrayParam($arrayParams) && array_key_exists(UPLOADED_ATTACHMENT, $arrayParams)) {
                $arrayParams[UPLOADED_ATTACHMENT] = Kahoutility::convertJSONStrToArray($arrayParams[UPLOADED_ATTACHMENT]);
                $uploadedParams = array_splice($arrayParams, array_search(UPLOADED_ATTACHMENT, array_keys($arrayParams)), 1);
                $uploadedParams = count($uploadedParams[UPLOADED_ATTACHMENT]) > 1 ? $uploadedParams[UPLOADED_ATTACHMENT] : $uploadedParams[UPLOADED_ATTACHMENT][0];
                if (Kahoutility::checkArrayParam($uploadedAttachmentObjKeys)) {
                    foreach ($uploadedAttachmentObjKeys as $val) {
                        $arrayParams[$val] = $uploadedParams[$val];
                    }
                }
            }
        } catch (Exception $exc) {
            
        } finally {
            return $this;
        }
    }

    // </editor-fold>

    protected function getListenerClassBasePath() {
        return "webservices/";
    }

}
