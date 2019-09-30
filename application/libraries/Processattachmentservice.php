<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Processattachmentservice {

    public function __construct() {
        
    }

    // <editor-fold defaultstate="collapsed" desc="processAttachment">
    /**
     * will process the attachment and upload it to server
     *
     * @param array $attachmentArray
     *            would be file data |array
     * @param string $attachmentUploadingPath
     *            | either would be explicit path otherwise will take callie class name
     * @param string $filesArrayName
     *            would be the field name of file array
     * @param string $clientWDKey
     *            | would be client wd
     * @return string|null
     */
    public function processAttachment(array $attachmentArray, $attachmentUploadingPath = null, string $filesArrayName, string $clientWDKey) {
        $uploadedFileDetails = NULL;
        try {
            if (!$this->isAttachmentEmpty($attachmentArray) && isset($attachmentArray[$filesArrayName])) {
                $attachmentUploadingPath = strtolower($attachmentUploadingPath ?? Kahoutility::getCallieClassName(4));
                $newFileName = $this->processAttachmentNUpload($attachmentArray[$filesArrayName], $attachmentUploadingPath, $clientWDKey);
                if (Kahoutility::isStringParamValid($newFileName)) {
                    $originalFileName = $this->getAttachedFileProp($attachmentArray[$filesArrayName], 'name');
                    $uploadedFileDetails = $this->buildUploadedAttachmentDetailObj($originalFileName, $newFileName, $attachmentUploadingPath, $clientWDKey);
                    $this->setUploadedAttachmentInSession($uploadedFileDetails);
                    $this->buildThumbnail($uploadedFileDetails, $attachmentUploadingPath, $clientWDKey);
                }
            }
        } catch (Exception $exc) {
            
        } finally {
            return $uploadedFileDetails;
        }
    }

    private function buildThumbnail(array $attachmentDetails, string $attachmentUploadingPath, string $clientWDKey): void {
        if (Kahoutility::checkArrayParam($attachmentDetails)) {
            $attachmentType = $attachmentDetails[ATTACHMENT_TYPE_KEY];
            $attachmentPath = Kahoutility::getClientWD($clientWDKey, $attachmentUploadingPath) . "/" . $attachmentDetails[ATTACHMENT_NAME_KEY];
            $ciLibrary = Kahoutility::getCILibrary();
            $ciLibrary->load->library("thumbnailbuilder");
            switch ($attachmentType) {
                case MEDIA_TYPE_VIDEO:
                    $ciLibrary->thumbnailbuilder->buildVideoThumbnail($attachmentPath);
                    break;
                case MEDIA_TYPE_IMAGE:
                    $ciLibrary->thumbnailbuilder->buildImageThumbnail($attachmentPath);
                    break;
            }
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="processAttachmentNUpload">
    /**
     * will process the attachment and upload
     *
     * @param array $attachmentArray
     * @param string $attachmentUploadingPath
     * @param string $clientWDKey
     * @return boolean
     */
    private function processAttachmentNUpload(array $attachmentArray, string $attachmentUploadingPath, string $clientWDKey) {
        if (!$this->isAttachmentEmpty($attachmentArray)) {
            if ($this->isAttachmentValid($attachmentName = $this->getAttachedFileProp($attachmentArray, 'name'))) {
                $extension = self::getAttachedFileExtention($attachmentName);
                $attachedFileNameWithoutExt = self::getAttachedFileNameWithoutExt($attachmentName);
                $newAttachedFileName = $this->buildNewFileName($attachedFileNameWithoutExt, $extension);
                if ($this->moveAttachedFile($attachmentArray, $clientWDKey, $newAttachedFileName, $attachmentUploadingPath)) {
                    return $newAttachedFileName;
                }
            }
        } else {
            return FALSE;
        }
    }

    // </editor-fold>
    /**
     * will return bool val to check that is attachment valid
     *
     * @param string $attachementName
     * @return bool
     */
    private function isAttachmentValid(string $attachementName): bool {
        $isAttachmentValid = TRUE;
        try {
            $ext = array(
                "jpg",
                "JPG",
                "jpeg",
                "JPEG",
                "gif",
                "GIF",
                "png",
                "PNG",
                "pjpeg",
                "PJPEG",
                "TTIF",
                "ttif",
                "PDF",
                "pdf",
                "PPT",
                "ppt",
                "PPTX",
                "pptx",
                "DOC",
                "doc",
                "DOCX",
                "docx",
                "XLS",
                "xls",
                "XLSX",
                "xlsx",
                "CSV",
                "csv",
                "txt",
                "rtf",
                "TXT",
                "RTF",
                "mp4",
                "MP4",
                "Mp4",
                "mkv",
                "3gp",
                "avi",
                "m4a",
                "flv",
                "mov",
                "mp3",
                "MP3",
                "Mp3",
                "aac",
                "ogg",
                "wav",
                "wma",
                "mid",
                "MID"
            );
            $imageExt = substr(strrchr($attachementName, "."), 1);
            if (!in_array($imageExt, $ext)) {
                $isAttachmentValid = FALSE;
            }
        } catch (Exception $exc) {
            
        } finally {
            return $isAttachmentValid;
        }
    }

    // <editor-fold defaultstate="collapsed" desc="isAttachmentEmpty">
    /**
     * will check that is attachment empty or not
     *
     * @param array $attachmentArray
     * @return boolean
     */
    private function isAttachmentEmpty(array $attachmentArray): bool {
        $isAttachmentEmpty = TRUE;
        try {
            if (Kahoutility::checkArrayParam($attachmentArray)) {
                $isAttachmentEmpty = FALSE;
            }
        } catch (Exception $exc) {
            
        } finally {
            return $isAttachmentEmpty;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getAttachedFileProp">
    /**
     * will return the attached file prop like name,size,tmp path
     *
     * @param array $attachmentArray
     * @return array
     */
    private function getAttachedFileProp(array $attachmentArray, string $attachedFileProp) {
        $attachmentFilePropVal = NULL;
        try {
            if (Kahoutility::checkArrayParam($attachmentArray) && Kahoutility::isStringParamValid($attachedFileProp) && isset($attachmentArray[$attachedFileProp])) {
                $attachmentFilePropVal = $attachmentArray[$attachedFileProp];
            }
        } catch (Exception $exc) {
            
        } finally {
            return $attachmentFilePropVal;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getAttachedFileExtention">
    /**
     * will return the attache file extention name
     *
     * @param string $attachedFileName
     * @return string|null
     */
    public static function getAttachedFileExtention(string $attachedFileName): ?string {
        $attachedFileExtention = NULL;
        try {
            if (Kahoutility::isStringParamValid($attachedFileName)) {
                $attachedFileExtention = substr(strrchr($attachedFileName, "."), 1);
            }
        } catch (Exception $exc) {
            
        } finally {
            return $attachedFileExtention;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getMediaTypeFromFileExtension">
    /**
     * will send the file extension
     *
     * @param type $fileExtension
     */
    public static function getMediaTypeFromFileExtension(string $fileExtension) {
        $mediaType = [
            MEDIA_TYPE_IMAGE => [
                "jpg",
                "JPG",
                "jpeg",
                "JPEG",
                "gif",
                "GIF",
                "png",
                "PNG",
                "pjpeg",
                "PJPEG"
            ],
            MEDIA_TYPE_AUDIO => [
                "mp3",
                "MP3",
                "Mp3",
                "aac",
                "ogg",
                "wav",
                "wma",
                "mid",
                "MID"
            ],
            MEDIA_TYPE_VIDEO => [
                "mp4",
                "MP4",
                "Mp4",
                "mkv",
                "3gp",
                "avi",
                "m4a",
                "flv",
                "mov"
            ],
            MEDIA_TYPE_DOCS => [
                "TTIF",
                "ttif",
                "PDF",
                "pdf",
                "DOC",
                "doc",
                "DOCX",
                "docx",
                "XLS",
                "xls",
                "XLSX",
                "xlsx",
                "CSV",
                "csv",
                "txt",
                "rtf",
                "TXT",
                "RTF",
                "PPT",
                "ppt",
                "PPTX",
                "pptx",
            ]
        ];

        if (Kahoutility::isStringParamValid($fileExtension)) {
            foreach ($mediaType as $key => $val) {
                if (in_array($fileExtension, $val)) {
                    return $key;
                }
            }
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getAttachedFileNameWithoutExt">
    /**
     * will return the attached file name
     *
     * @param string $attachedFileName
     * @return void
     */
    public static function getAttachedFileNameWithoutExt(string $attachedFileName) {
        $attachedFileNameWithoutExt = NULL;
        try {
            if (Kahoutility::isStringParamValid($attachedFileName)) {
                $attachedFileNameWithoutExt = substr($attachedFileName, 0, strrpos($attachedFileName, "."));
                // $extensionName = substr(strrchr($attachedFileName, "."), 1);
                // $attachedFileNameWithoutExt = str_replace($extensionName, '', $attachedFileName);
            }
        } catch (Exception $exc) {
            
        } finally {
            return $attachedFileNameWithoutExt;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="buildNewFileName">
    /**
     * will build the new file name by using the time function
     *
     * @param string $oldFileName
     * @param string $extension
     * @return string
     */
    public function buildNewFileName(string $oldFileName, string $extension) {
        $newFileName = NULL;
        try {
            if (Kahoutility::isStringParamValid($oldFileName) && Kahoutility::isStringParamValid($extension)) {
                $newFileName = $oldFileName . time() . "." . $extension;
            }
        } catch (Exception $exc) {
            
        } finally {
            return $newFileName;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="moveAttachedFile">
    /**
     *
     * @param array $attachmentArray
     * @param string $clientWD
     * @param string $newAttachedFileName
     * @param type $attachmentUploadingPath
     * @return boolean
     */
    private function moveAttachedFile(array $attachmentArray, string $clientWDKey, string $newAttachedFileName, string $attachmentUploadingPath): bool {
        try {
            $isMoved = true;
            $destPath = Kahoutility::getClientWD($clientWDKey, $attachmentUploadingPath) . "/" . $newAttachedFileName;
            if (!move_uploaded_file($this->getAttachedFileProp($attachmentArray, "tmp_name"), $destPath)) {
                $isMoved = FALSE;
            }
        } catch (Exception $exc) {
            
        } finally {
            return $isMoved;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="processAttachedData">
    /**
     * desc will iterate through uploaded attachment data obj and process over it
     */
    public function processAttachedData(array &$postArrayData, string $uploadedAttachmentKey, string $sharedAttachmentKey, $attachmentType = null) {
        try {
            $attachmentData = [];
            $uploadedAttachmentArray = NULL;
            if (array_key_exists($sharedAttachmentKey, $postArrayData)) {
                if (Kahoutility::checkArrayParam($uploadedAttachmentArray = $postArrayData[$sharedAttachmentKey]) || Kahoutility::checkArrayParam($uploadedAttachmentArray = Kahoutility::convertJSONStrToArray($postArrayData[$sharedAttachmentKey]))) {
                    $attachmentData = $uploadedAttachmentArray;
                }
                unset($postArrayData[$sharedAttachmentKey]);
            }

            if (array_key_exists($uploadedAttachmentKey, $postArrayData) && (Kahoutility::checkArrayParam($uploadedAttachmentArray = $postArrayData[$uploadedAttachmentKey]) || Kahoutility::checkArrayParam($uploadedAttachmentArray = Kahoutility::convertJSONStrToArray($postArrayData[$uploadedAttachmentKey])))) {
                $attachmentData = array_merge($attachmentData, $uploadedAttachmentArray);
                // will delete attachment item from session as it is guarantted that uploaded attachment would be inserted in db
            }
            $builtUploadedAttachmentStructure = $this->buildUploadedAttachmentStructure($attachmentData, $attachmentType);
            $postArrayData[$uploadedAttachmentKey] = $builtUploadedAttachmentStructure;
        } catch (Exception $exc) {
            
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="buildUploadedAttachmentStructure">
    /**
     * desc will build the structure for multiple upload
     *
     * @param type $attachmentData
     */
    private function buildUploadedAttachmentStructure($attachmentData, $attachmentType) {
        $builtUploadedAttachmentStructure = "";
        try {
            if (Kahoutility::checkArrayParam($attachmentData)) {
                foreach ($attachmentData as $uploadedAttachmentDataObj) {
                    if (!Kahoutility::isStringParamValid($builtUploadedAttachmentStructure) || $builtUploadedAttachmentStructure .= MULTIPLE_ATTACHMENT_DELIMITER) {
                        $builtUploadedAttachmentStructure .= $this->processUploadedNSharedAttachmentDataKeys($uploadedAttachmentDataObj, $attachmentType);
                    }
                }
            }
        } catch (Exception $exc) {
            
        } finally {
            return $builtUploadedAttachmentStructure;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="processUploadedAttachmentDataKeys">
    /**
     * desc will process the uploaded or shared attachment
     *
     * @param array $uploadedAttachmentDataArr
     */
    private function processUploadedNSharedAttachmentDataKeys(array $uploadedAttachmentDataArr, $attachmentType) {
        $processedUploadedNSharedAttachmentDataArray = [];
        try {
            $attachmentKeysByType = $this->getAttachmentKeysByType($attachmentType ?? $uploadedAttachmentDataArr[ATTACHMENT_SOURCE_TYPE_KEY]);
            foreach ($attachmentKeysByType as $value) {
                if (array_key_exists($value, $uploadedAttachmentDataArr)) {
                    $processedUploadedNSharedAttachmentDataArray[$value] = $uploadedAttachmentDataArr[$value];
                } else {
                    $processedUploadedNSharedAttachmentDataArray[$value] = "";
                }
            }
            $processedUploadedNSharedAttachmentDataArray = join("~", array_values($processedUploadedNSharedAttachmentDataArray));
        } catch (Exception $exc) {
            
        } finally {
            return $processedUploadedNSharedAttachmentDataArray;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="filterKeysFromAttachmentObj">
    /**
     * desc will filter the required keys from array
     */
    private function filterKeysFromAttachmentObj(array $attachmentObj, $filterKey = null) {
        $filterArray = [];
        try {
            if (Kahoutility::checkArrayParam($attachmentObj)) {
                $filterKey = $filterKey ?? $this->getAttachmentKeysByType();
                array_walk($attachmentObj, function ($val, $key) use ($filterArray, $filterKey) {
                    if (array_key_exists($key, $filterKey)) {
                        $filterArray[$key] = $val;
                    }
                });
            }
        } catch (Exception $exc) {
            
        } finally {
            return $filterArray;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="setUploadedAttachmentInSession">
    /**
     * desc will
     *
     * @param array $fileDetails
     */
    private function setUploadedAttachmentInSession($fileDetails) {
        $uploadedAttachmentContainer = NULL;
        $uploadedAttachmentSessionKey = $fileDetails[ATTACHMENT_NAME_KEY];
        if (Kahoutility::checkArrayParam($uploadedAttachmentContainer = $this->getUploadedAttachmentInSession())) {
            $uploadedAttachmentContainer[UPLOADED_ATTACHMENT_CONTAINER_SESSION_KEY][$uploadedAttachmentSessionKey] = $fileDetails;
        } else {
            $uploadedAttachmentContainer = [
                UPLOADED_ATTACHMENT_CONTAINER_SESSION_KEY => [
                    $uploadedAttachmentSessionKey => $fileDetails
                ]
            ];
        }
        Phpsessionservice::getPHPSessionServiceInstance()->setPHPSessionValueByKey(UPLOADED_ATTACHMENT_CONTAINER_SESSION_KEY, $uploadedAttachmentContainer);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="markUploadedAttachmentStaleInSession">
    private function markUploadedAttachmentStaleInSession($uploadedAttachmentArray) {
        try {
            $uploadedAttachmentContainer = NULL;
            if (Kahoutility::checkArrayParam($uploadedAttachmentArray) && Kahoutility::checkArrayParam($uploadedAttachmentContainer = $this->getUploadedAttachmentInSession())) {
                array_map(function ($uploadedAttachmentArrObj) use (&$uploadedAttachmentContainer) {
                    // if(array_key_exists($uploadedAttachmentArrObj[ATTACHMENT_NAME_KEY], $uploadedAttachmentContainer[UPLOADED_ATTACHMENT_CONTAINER_SESSION_KEY])) {
                    // $uploadedAttachmentArrObj[ATTACHMENT_IS_ADDED_KEY] = TRUE;
                    // $uploadedAttachmentContainer[UPLOADED_ATTACHMENT_CONTAINER_SESSION_KEY][$uploadedAttachmentArrObj[ATTACHMENT_NAME_KEY]] = $uploadedAttachmentArrObj;
                    // }
                }, $uploadedAttachmentArray);
                Phpsessionservice::getPHPSessionServiceInstance()->setPHPSessionValueByKey(UPLOADED_ATTACHMENT_CONTAINER_SESSION_KEY, $uploadedAttachmentContainer);
            }
        } catch (Exception $exc) {
            
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getUploadedAttachmentInSession">
    /**
     * desc will return the uploaded data session data from
     *
     * @return type
     */
    private function getUploadedAttachmentInSession() {
        $uploadedAttachmentInSession = Phpsessionservice::getPHPSessionServiceInstance()->getPHPSessionValueByKey(UPLOADED_ATTACHMENT_CONTAINER_SESSION_KEY);
        return $uploadedAttachmentInSession;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="buildUploadedAttachmentDetailObj">
    /**
     * desc will build the uploaded attachment detail obj for storing in session as well as in returing to client
     *
     * @return array
     */
    private function buildUploadedAttachmentDetailObj(string $originalFileName, string $newFileName, string $attachmentUploadingPath, string $wdKey): array {
        $uploadedFileDetails = [];
        $uploadedFileDetails[ATTACHMENT_TITLE_KEY] = "";
        $uploadedFileDetails[ATTACHMENT_NAME_KEY] = $newFileName;
        $uploadedFileDetails[ATTACHMENT_FILE_ORIGINAL_NAME_KEY] = $originalFileName;
        $uploadedFileDetails = Kahoutility::appendAbsoluteFilePath($uploadedFileDetails, ATTACHMENT_NAME_KEY, $attachmentUploadingPath, FALSE, $wdKey);
        $uploadedFileDetails[ATTACHMENT_TYPE_KEY] = self::getMediaTypeFromFileExtension(self::getAttachedFileExtention($uploadedFileDetails[ATTACHMENT_FILE_ORIGINAL_NAME_KEY]));
        switch ($attachmentUploadingPath) {
            case ATTACHMENT_TYPE_KAHO_GALLERY:
                $uploadedFileDetails[ATTACHMENT_DESCRIPTION_KEY] = "";
                $uploadedFileDetails[ATTACHMENT_IS_PRIVATE_KEY] = "";
                break;
            default:
                $uploadedFileDetails[ATTACHMENT_SOURCE_TYPE_KEY] = "";
                $uploadedFileDetails[ATTACHMENT_ID_KEY] = "";
                break;
        }
        return $uploadedFileDetails;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getAttachmentKeysByType">
    /**
     * desc will return the key which would be used to extracted out the value from object
     *
     * @param type $attachmentType
     * @return type
     */
    private function getAttachmentKeysByType($attachmentType = null) {
        $attachmentKeys = NULL;
        try {
            switch ($attachmentType) {
                case ATTACHMENT_TYPE_KAHO_GALLERY:
                    $attachmentKeys = [
                        ATTACHMENT_NAME_KEY,
                        ATTACHMENT_FILE_ORIGINAL_NAME_KEY,
                        ATTACHMENT_TITLE_KEY,
                        ATTACHMENT_DESCRIPTION_KEY,
                        ATTACHMENT_NAME_PATH_KEY,
                        ATTACHMENT_TYPE_KEY,
                        ATTACHMENT_IS_PRIVATE_KEY
                    ];
                    break;
                case ATTACHMENT_TYPE_SHARED_GALLERY:
                    $attachmentKeys = [
                        "Gallery_Repo_ID",
                        "File_Title",
                        "File_Name",
                        ATTACHMENT_FILE_ORIGINAL_NAME_KEY,
                        "File_Name_Path",
                        "File_Type",
                        ATTACHMENT_SOURCE_TYPE_KEY
                    ];
                    break;
                case ATTACHMENT_TYPE_SHARED_LR:
                    $attachmentKeys = [
                        "Repo_ID",
                        "File_Title",
                        "File_Name",
                        ATTACHMENT_FILE_ORIGINAL_NAME_KEY,
                        "File_Name_Path",
                        "File_Type",
                        ATTACHMENT_SOURCE_TYPE_KEY
                    ];
                    break;
                default: // / uploaded using attachment module
                    $attachmentKeys = [
                        ATTACHMENT_ID_KEY,
                        ATTACHMENT_TITLE_KEY,
                        ATTACHMENT_NAME_KEY,
                        ATTACHMENT_FILE_ORIGINAL_NAME_KEY,
                        ATTACHMENT_NAME_PATH_KEY,
                        ATTACHMENT_TYPE_KEY,
                        ATTACHMENT_SOURCE_TYPE_KEY
                    ];
                    break;
            }
        } catch (Exception $exc) {
            
        } finally {
            return $attachmentKeys;
        }
    }

    // </editor-fold>
}
