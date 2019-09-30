<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Kahoutility
 *
 * @author KaHO
 */
class Kahoutility
{

    // <editor-fold defaultstate="collapsed" desc="convertStringToSlugName">
    /**
     * will convert the string name to slug name
     *
     * @param string $strVal
     * @return string
     */
    public static function convertStringToSlugName(string $strVal): string
    {
        $processedStr = "";
        try {
            if (isStringParamValid($strVal)) {
                if (checkArrayParam($arrayVal = str_split($strVal))) {
                    foreach ($arrayVal as $val) {
                        if ($val === strtolower($val)) {
                            $processedStr .= $val;
                        } else {
                            $processedStr .= "_" . strtolower($val);
                        }
                    }
                }
            }
        } catch (Exception $exc) {} finally {
            return $processedStr;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getCallieFunctionName">
    /**
     * will return the callie function name
     *
     * @param type $stackTraceIndex
     * @return type
     */
    public static function getCallieFunctionName($stackTraceIndex = 4)
    {
        $debug = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT | DEBUG_BACKTRACE_IGNORE_ARGS, 8);
        $callieFunctionName = $debug[$stackTraceIndex]['function'];
        return $callieFunctionName;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getCallieClassName">
    /**
     * will return the callie class name
     *
     * @return type
     */
    public static function getCallieClassName(int $stackTraceIndex = 4)
    {
        $debug = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT | DEBUG_BACKTRACE_IGNORE_ARGS, 12);
        $callieClassName = $debug[$stackTraceIndex]['class'];
        return $callieClassName;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="convertInJSON">
    /**
     * will convert the array data in json string
     *
     * @param array $data
     * @return string
     */
    public static function convertInJSON(array $data): string
    {
        $jsonData = NULL;
        if (checkArrayParam($data)) {
            $jsonData = json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        return $jsonData;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="checkArrayParam">
    /**
     * will return the bool
     *
     * @param type $param
     * @return boolean
     */
    public static function checkArrayParam($param): bool
    {
        $isArrayParamValid = FALSE;
        if (! empty($param) && is_array($param)) {
            $isArrayParamValid = TRUE;
        }
        return $isArrayParamValid;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="isStringParamValid">
    /**
     * will return true on success or false on failure
     *
     * @param type $param
     * @return boolean
     */
    public static function isStringParamValid($param): bool
    {
        $isStringParamValid = FALSE;
        if (! empty($param) && strlen($param) > 0) {
            $isStringParamValid = TRUE;
        }
        return $isStringParamValid;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="convertXMLToArrayCallback">
    /**
     * will be used as callback to convert the xml data in array, usually would be used while data coming from db
     *
     * @param array $arrayData
     *            $arrayData which holds the xml string
     * @param string $keyName
     *            $arrayData key name which holds the xml string
     * @param bool $isSorting
     *            is to sort or not
     * @return array
     */
    public static function convertXMLToArrayCallback(array $arrayData, string $keyName, bool $isSorting = TRUE): array
    {
        if (self::checkArrayParam($arrayData)) {
            if (isset($arrayData[$keyName]) && self::isStringParamValid($arrayData[$keyName])) {
                $arrayData[$keyName] = self::convertXMLToArray($arrayData[$keyName]);
                $isSorting === TRUE ? sort($arrayData[$keyName]) : "";
            }
        }
        return $arrayData;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="parseAttachmentXMLString">
    /**
     * desc : will convert the attachment xml to
     *
     * @param array $arrayData
     * @param string $directoryPath
     *            // would be controller name as directory name
     * @param string $keyName
     */
    public static function parseAttachmentXMLString(array $arrayData, string $directoryPath, $keyName)
    {
        $parsedData = $arrayData;
        $attachBasePathByAttachmentType = function ($attachmentDetails, &$arrayDataHolder, $directoryPath) {
            if (self::checkArrayParam($attachmentDetails)) {
                switch ($attachmentDetails['Repo']) {
                    case ATTACHMENT_TYPE_SHARED_GALLERY:
                        $arrayDataHolder[] = self::appendAbsoluteFilePath($attachmentDetails, "Name", "kahogallery");
                        break;
                    case ATTACHMENT_TYPE_SHARED_LR:
                        $arrayDataHolder[] = self::appendAbsoluteFilePath($attachmentDetails, "Name", "learningresources");
                        break;
                    default:
                        $arrayDataHolder[] = self::appendAbsoluteFilePath($attachmentDetails, "Name", $directoryPath);
                        break;
                }
            }
        };
        
        if ($arrayData[$keyName] !== "<Root></Root>") {
            $parsedData = self::convertXMLToArrayCallback($arrayData, $keyName);
            if (array_key_exists($keyName, $parsedData) && self::checkArrayParam($parsedData[$keyName])) {
                $attachmentDetails = self::convertObjToArray($parsedData[$keyName][0]);
                $parsedData[$keyName] = [];
                if (! array_key_exists("Name", $attachmentDetails)) { // checking it is array or not
                    foreach ($attachmentDetails as $val) {
                        $attachBasePathByAttachmentType($val, $parsedData[$keyName], $directoryPath);
                    }
                } else {
                    $attachBasePathByAttachmentType($attachmentDetails, $parsedData[$keyName], $directoryPath);
                }
            }
        }
        
        return $parsedData;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="convertXMLToArray">
    /**
     * will take the xml string and convert into an array
     *
     * @param string $XMLData
     * @return array
     */
    public static function convertXMLToArray(string $XMLData): array
    {
        if (! empty($XMLData)) {
            $arrayData = simplexml_load_string($XMLData);
            return self::convertObjToArray($arrayData);
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getCISessionValueByKey">
    /**
     * will return the session value by key
     *
     * @param string $sessionKeyName
     * @return bool|string|array
     */
    public static function getCISessionValueByKey(string $sessionKeyName)
    {
        $sessionVal = FALSE;
        if (self::isStringParamValid($sessionKeyName)) {
            $sessionVal = self::getCILibrary()->session->userdata($sessionKeyName);
        }
        return $sessionVal;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="setCISessionValueByKey">
    /**
     * will return the session value by key
     *
     * @param string $sessionKeyName
     *            | may be an array
     * @return bool|string|array
     */
    public static function setCISessionValueByKey($sessionKeyName, $sessionValue = null): void
    {
        if (! is_array($sessionKeyName) && self::isStringParamValid($sessionKeyName)) {
            self::getCILibrary()->session->set_userdata($sessionKeyName, $sessionValue);
        } else if (self::checkArrayParam($sessionKeyName) && is_null($sessionValue)) {
            self::getCILibrary()->session->set_userdata($sessionKeyName);
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="unsetCISessionValueByKey">
    /**
     * will unset the user data
     *
     * @param string $sessionKeyName
     */
    public static function unsetCISessionValueByKey(string $sessionKeyName=null)
    {
        if (self::isStringParamValid($sessionKeyName)) {
            self::getCILibrary()->session->unset_userdata($sessionKeyName);
        }else
        {
            self::getCILibrary()->session->sess_destroy();
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getCILibrary">
    /**
     * will return the ci library
     *
     * @return type
     */
    public static function getCILibrary()
    {
        $ciLibrary = & get_instance();
        return $ciLibrary;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="invokeCallback">
    /**
     * invokeCallback function will invoke the callback from $callbackContainer where first param would be callable and rest of would be to be invoke function's param
     *
     * @param string|array $methodDefaultValue
     *            would be first param of to be invoked function
     * @param array $callbackContainer
     */
    public static function invokeCallback($methodDefaultValue, array $callbackContainer)
    {
        $invokedMethodReturnedVal = NULL;
        try {
            if (self::checkArrayParam($callbackContainer) && is_callable(current($callbackContainer)) || is_callable($callbackContainer) && $callbackContainer = [
                $callbackContainer
            ]) {
                $callback = array_shift($callbackContainer);
                array_unshift($callbackContainer, $methodDefaultValue);
                $invokedMethodReturnedVal = call_user_func_array($callback, $callbackContainer);
            }
        } catch (Exception $exc) {} finally {
            return $invokedMethodReturnedVal;
        }
    }

    // </editor-fold>
    public static function getClientWD($wdKey = WORKING_DIRECTORY_WEB_KEY, $folderName = NULL)
    { // will return the client working directory
        $wdPath = self::getRequestedClientConfigurationsByKey($wdKey);
        $wdPath .= is_null($folderName) ? "" : $folderName;
        $absPath = getcwd() . "/" . $wdPath;
        if (! is_dir($absPath)) {
            mkdir($absPath, 0777, TRUE);
            chmod($absPath, 0777);
        }
        return $wdPath;
    }

    public static function getRequestedClientConfigurationsByKey(string $keyName)
    { // will return the client specific configurations based on request hostF
        $requestedClientConfigurationsByKey = NULL;
        try {
            if (self::isStringParamValid($keyName)) {
                $requestedClientConfigurationsByKey = self::getCILibrary()->config->item("client_specific_configuration")[self::getRequestedHostSubDomainName()][$keyName];
            }
        } catch (Exception $exc) {} finally {
            return $requestedClientConfigurationsByKey;
        }
    }

    public static function getRequestedHostSubDomainName()
    {
        $host = $_SERVER['HTTP_HOST'];
        $getRequestedHostName = current(explode(".", $host));
        $getRequestedHostName = $getRequestedHostName === "192" ? "development" : $getRequestedHostName;
        return $getRequestedHostName;
    }

    // <editor-fold defaultstate="collapsed" desc="getCallback">
    /**
     * will return the closure callback
     *
     * @param array|string $callback
     * @return type
     */
    public static function getCallback($callback)
    {
        try {
            if (is_callable($callback)) {
                return Closure::fromCallable($callback);
            }
        } catch (Exception $exc) {}
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="splitArrayByDelimiter">
    /**
     * will split the array in str by given delim
     *
     * @param array $arrayToSplit
     * @param string $delimiter
     * @return string
     */
    public static function splitArrayByDelimiter($arrayToSplit, string $delimiter = "|")
    {
        $splitedArrayStr = NULL;
        try {
            if (self::checkArrayParam($arrayToSplit)) {
                $splitedArrayStr = implode($delimiter, $arrayToSplit);
            }
        } catch (Exception $exc) {} finally {
            return $splitedArrayStr;
        }
    }

    // </editor-fold>
    public static function getLangFileRespMessage(string $langFileRespMessageKey)
    {
        $langFileRespMessage = self::getCILibrary()->lang->line($langFileRespMessageKey);
        if ($langFileRespMessage === FALSE) {
            $langFileRespMessage = "";
        }
        return $langFileRespMessage;
    }

    public static function getUserAgent()
    {
        $userAgent = "";
        try {
            self::getCILibrary()->load->library('user_agent');
            $userAgent = self::getCILibrary()->agent->agent_string();
        } catch (Exception $exc) {} finally {
            return $userAgent;
        }
    }

    public static function getRequestedHeaderValueByKey(string $headerKey)
    {
        $headerVal = NULL;
        try {
            $header = getallheaders();
            if (Kahoutility::isStringParamValid($headerKey) && isset($header[$headerKey])) {
                $headerVal = $header[$headerKey];
            }
        } catch (Exception $exc) {} finally {
            return $headerVal;
        }
    }

    // <editor-fold defaultstate="collapsed" desc="appendAbsoluteFilePath">
    /**
     *
     * @param array $arrayVal
     *            would be array of each array dictionary of db response
     * @param string $arrayKey
     *            would be key comes in array of attachedment val
     * @param string $directoryPath
     * @param type $absolutePathKey
     *            would be key name of array to hold the value of absolute file path
     * @return string
     */
    public static function appendAbsoluteFilePath(array $arrayVal, string $arrayKey, string $directoryPath, bool $isNoImageTrue = false, $wdKey = WORKING_DIRECTORY_WEB_KEY)
    {
        try {
            if (Kahoutility::checkArrayParam($arrayVal)) {
                if (array_key_exists($arrayKey, $arrayVal) && self::isStringParamValid($arrayVal[$arrayKey])) {
                    $attachmentKey = $arrayKey . ATTACHMENT_SUFFIXE_KEY_NAME;
                    $arrayVal[$attachmentKey] = self::getUploadedBasePath($directoryPath, $wdKey) . $arrayVal[$arrayKey];
                    $arrayVal[$arrayKey . ATTACHMENT_SUFFIXE_KEY_NAME . "_Thumbnail"] = self::getThumbnail($arrayVal[$attachmentKey]);
                } else {
                    $arrayVal[$arrayKey . ATTACHMENT_SUFFIXE_KEY_NAME] = $isNoImageTrue ? self::getNoImageAbsPath() : "";
                }
            }
        } catch (Exception $exc) {} finally {
            return $arrayVal;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getNoImage">
    /**
     * will return the no image abs http path
     */
    public static function getNoImageAbsPath()
    {
        return self::getSiteDirectoryBasePath(NO_IMAGE_PATH);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getUploadedBasePath">
    /**
     * will add the uploaded base path in case of appending client's attachment
     *
     * @param type $moduleConfigPathKey
     * @return type
     */
    public static function getUploadedBasePath($moduleConfigPathKey, $wdKey = WORKING_DIRECTORY_WEB_KEY)
    {
        return self::getBaseURI() . self::getClientWD($wdKey, $moduleConfigPathKey) . "/";
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getSiteBasePath">
    /**
     * will pass the directory path sitting inside site directory
     *
     * @param string $directoryPath
     *            of directory and file sitting inside site directory
     * @return type
     */
    public static function getSiteDirectoryBasePath(string $directoryPath)
    {
        return self::getBaseURI() . SITE_DIRECTORY_PATH . $directoryPath;
    }

    // </editor-fold>
    public static function getBaseURI()
    { // will return the complete uri
        $getBaseURI = strtolower(current(explode("/", $_SERVER['SERVER_PROTOCOL']))) . "://" . $_SERVER['HTTP_HOST'] . "/";
        return $getBaseURI;
    }

    public static function deleteFile(string $absFilePath, $wdKey = WORKING_DIRECTORY_WEB_KEY)
    {
        $isFileDeleted = FALSE;
        try {
            if (Kahoutility::isStringParamValid($absFilePath)) {
                $absFilePathArr = explode("/", $absFilePath);
                $fileName = implode("/", array_splice($absFilePathArr, count($absFilePathArr) - 2, 2));
                $isFileDeleted = unlink(self::getClientWD($wdKey) . $fileName);
            }
        } catch (Exception $exc) {} finally {
            return $isFileDeleted;
        }
    }

    // <editor-fold defaultstate="collapsed" desc="getFractionVal">
    /**
     * will explode the string by / and get the value
     */
    public static function getFractionVal($value)
    {
        $fractionVal = 0;
        try {
            if (isStringParamValid($value) && strpos($value, "/") !== FALSE) {
                $fractionVal = explode("/", $value);
                array_map(function (&$val) {
                    return (int) $val;
                }, $fractionVal);
            }
        } catch (Exception $exc) {} finally {
            return $fractionVal;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getPercent">
    /**
     * will return the percent value by dividing the numerator from denominator
     *
     * @param type $numerator
     * @param type $denominator
     */
    public static function getPercent($numerator, $denominator)
    {
        $percentVal = 0;
        try {
            $numerator = (int) $numerator;
            $denominator = (int) $denominator;
            $percentVal = round(($numerator / $denominator) * 100);
        } catch (Exception $exc) {} finally {
            return $percentVal;
        }
    }

    // </editor-fold>
    
        // <editor-fold defaultstate="collapsed" desc="getStudentImageConfForAppend">
    /**
     * will return the configuration for appending student images
     *
     * @return array
     */
    public static function getStudentImageConfForAppend()
    {
        $conf = array(
            Respstructurebuilder::CALLBACK_KEY => array(
                "Kahoutility::appendAbsoluteFilePath",
                "Photo",
                STUDENT_IMAGE_PATH,
                TRUE
            )
        );
        return $conf;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getTeacherImageConfForAppend">
    /**
     * will return the configuration for appending teacher images
     *
     * @return array
     */
    public static function getTeacherImageConfForAppend()
    {
        $conf = array(
            Respstructurebuilder::CALLBACK_KEY => array(
                "Kahoutility::appendAbsoluteFilePath",
                "Photo",
                TEACHERS_IMAGE_PATH,
                TRUE
            )
        );
        return $conf;
    }

    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="getBaseUrlAttachementConfiguration">
    /**
     * desc will return the conf for append the base url
     */
    public static function getBaseUrlAttachementConfiguration(string $controllerName, string $keyName = "File_Name"): array
    {
        $conf = array(
            Respstructurebuilder::CALLBACK_KEY => array(
                "Kahoutility::appendAbsoluteFilePath",
                $keyName,
                $controllerName
            )
        );
        return $conf;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getParseAttachmentXMLStringConfiguration">
    /**
     * desc will return the conf for append the base url
     */
    public static function getParseAttachmentXMLStringConfiguration(string $controllerName, string $keyName = ATTACHMENT_XML): array
    {
        $conf = array(
            Respstructurebuilder::CALLBACK_KEY => array(
                "Kahoutility::parseAttachmentXMLString",
                $controllerName,
                $keyName
            )
        );
        return $conf;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="appendValueToResponseArrayByCheckingCond">
    /**
     * will append a new key(flag key) to response array which will help for doing certain action like in task,logged teacher can update the task or not
     *
     * @param array $responseArray
     * @param string $responseArrayKey
     * @param string $valToCompare
     * @param type $responseArrayNewKey
     * @return boolean
     * @throws Exception
     */
    public static function appendValueToResponseArrayByCheckingCond(array $responseArray, string $responseArrayKey, string $valToCompare, $responseArrayNewKey)
    {
        try {
            if (array_key_exists($responseArrayKey, $responseArray)) {
                if ($responseArray[$responseArrayKey] === $valToCompare) {
                    $responseArray[$responseArrayNewKey] = TRUE;
                } else {
                    $responseArray[$responseArrayNewKey] = FALSE;
                }
            } else {
                throw new Exception("responseArrayKey is missing");
            }
        } catch (Exception $exc) {} finally {
            return $responseArray;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="convertObjToArray">
    /**
     * desc will convert the obj to array
     *
     * @param type $array
     * @return type
     */
    public static function convertObjToArray($array)
    {
        return json_decode(json_encode($array), true);
    }

    // </editor-fold>
    public static function getSelectedStudentCode()
    {
        return Kahoutility::getCISessionValueByKey(SELECTED_STUDENT_CODE);
    }

    // <editor-fold defaultstate="collapsed" desc="iterateThroughSessionUploadedAttachement">
    /**
     * desc will iterate through the session obj for uploaded attachment item
     *
     * @param type $callback
     */
    public static function iterateThroughSessionUploadedAttachement($callback)
    {
        $uploadedAttachmentContainer = Phpsessionservice::getPHPSessionServiceInstance()->getPHPSessionValueByKey(UPLOADED_ATTACHMENT_CONTAINER_SESSION_KEY);
        if (Kahoutility::checkArrayParam($uploadedAttachmentContainer)) {
            foreach ($uploadedAttachmentContainer as $key => $value) {
                if (Kahoutility::checkArrayParam($value)) {
                    // foreach ($value as $uploadedAttachmentObj) {
                    Kahoutility::invokeCallback($value, $callback);
                }
                // }
            }
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="convertJSONStrToArray">
    /**
     * desc will convert the json str to array
     *
     * @param type $jsonStr
     * @return type
     */
    public static function convertJSONStrToArray($jsonStr)
    {
        $jsonArray = $jsonStr;
        try {
            if (! self::checkArrayParam($jsonStr) && self::isStringParamValid($jsonStr)) {
                $jsonArray = json_decode($jsonStr, TRUE);
            }
        } catch (Exception $ex) {} finally {
            return $jsonArray;
        }
    }

    // </editor-fold>
    public static function changeArrayParamsPosition(array &$arrayParams, string $arrayParamsKey, int $position)
    {
        try {
            if (is_array($arrayParams) && Kahoutility::isStringParamValid($arrayParamsKey) && array_key_exists($arrayParamsKey, $arrayParams)) {
                $arrayVal = $arrayParams[$arrayParamsKey];
                $arrayParamsKeyCurrentPos = array_search($arrayParamsKey, array_keys($arrayParams)) + 1;
                if ($arrayParamsKeyCurrentPos !== $position) {
                    if ($position > $arrayParamsKeyCurrentPos) {
                        unset($arrayParams[$arrayParamsKey]);
                    }
                    $arrayParams = array_slice($arrayParams, 0, $position - 1, TRUE) + array(
                        $arrayParamsKey => $arrayVal
                    ) + array_slice($arrayParams, $position - 1, count($arrayParams), TRUE);
                }
            }
        } catch (Exception $exc) {}
    }

    public static function changeArrayAllParamsPosition(array &$arrayParams, array $arrayParamsKeyArray, int $startFrom = 1)
    {
        try {
            if (self::checkArrayParam($arrayParams) && self::checkArrayParam($arrayParamsKeyArray)) {
                foreach ($arrayParamsKeyArray as $key => $val) {
                    self::changeArrayParamsPosition($arrayParams, $val, $key + $startFrom);
                }
            }
        } catch (Exception $exc) {}
    }

    public static function getImageDirNameBasedOnLoggedinUserType($userType)
    {
        $userType = $userType ?? Kahoapplicationservice::getKaHOAppSerIns()->getUserType();
        $imageDirNameBasedOnLoggedinUserType = NULL;
        switch ($userType) {
            case USER_TYPE_PARENT:
                $imageDirNameBasedOnLoggedinUserType = PARENTS_IMAGE_PATH;
                break;
            case USER_TYPE_TEACH:
            case USER_TYPE_PRINCIPAL:
            case "MANAGEMENT":
                $imageDirNameBasedOnLoggedinUserType = TEACHERS_IMAGE_PATH;
                break;
            case USER_TYPE_STUDENT:
                $imageDirNameBasedOnLoggedinUserType = STUDENT_IMAGE_PATH;
                break;
        }
        return $imageDirNameBasedOnLoggedinUserType;
    }

    // <editor-fold defaultstate="collapsed" desc="downloadFile">
    /**
     * desc will download the
     *
     * @param string $filename
     * @param string $filePath
     */
    public static function downloadFile($filename, $filePath = ""): void
    {
        self::getCILibrary()->load->helper("download");
        $downloadablePath = $filePath . $filename;
        if (file_exists($downloadablePath)) {
            $data = file_get_contents($downloadablePath);
            force_download($filename, $data);
        } else {
            show_404($downloadablePath);
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="appendKeyInResponse">
    /**
     * desc will append the key
     */
    public static function appendKeyInResponse(array $arrayRespObj, string $key, $val): array
    {
        $arrayRespObj[$key] = $val;
        return $arrayRespObj;
    }

    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="extractAttachmentPath">
    /**
     * desc will extract out the attachment path from attachment str
     */
    public static function extractAttachmentPath(array $arrayRespObj, string $attachmentStrHolderKey): array
    {
        if (Kahoutility::isStringParamValid($arrayRespObj[$attachmentStrHolderKey])) {
            $arrayRespObj[$attachmentStrHolderKey . '_Path'] = explode("~", $arrayRespObj[$attachmentStrHolderKey])[3];
        }
        return $arrayRespObj;
    }

    // </editor-fold>
    /**
     *
     * @param string $filePath
     * @return string|NULL
     */
    public static function getVideoThumbnailImage(string $videofilePath = NULL): ?string
    {
        $videoThumbnailImage = "";
        if (self::isStringParamValid($videofilePath)) {
            $mediaType = Processattachmentservice::getMediaTypeFromFileExtension(Processattachmentservice::getAttachedFileExtention($videofilePath));
            if ($mediaType === MEDIA_TYPE_VIDEO) {
                $thumnailImagePath = Processattachmentservice::getAttachedFileNameWithoutExt($videofilePath);
                $videoThumbnailImage = $thumnailImagePath . Thumbnailbuilder::VIDEO_THUMBNAIL_SUFFIX . Thumbnailbuilder::THUMBNAIL_IMG_EXT;
                if (! file_exists($thumnailImagePath)) {
                    $thumnailImagePath = "";
                }
            }
        }
        return $videoThumbnailImage;
    }

    /**
     *
     * @param string $filePath
     * @return string|NULL
     */
    public static function getImageThumbnailImage(string $filePath = NULL): ?string
    {
        $imageThumbnailImage = "";
        if (self::isStringParamValid($filePath)) {
            $mediaType = Processattachmentservice::getMediaTypeFromFileExtension(Processattachmentservice::getAttachedFileExtention($filePath));
            if ($mediaType === MEDIA_TYPE_IMAGE) {
                $thumnailImagePath = Processattachmentservice::getAttachedFileNameWithoutExt($filePath);
                $imageThumbnailImage = $thumnailImagePath . Thumbnailbuilder::IMAGE_THUMBNAIL_SUFFIX . Thumbnailbuilder::THUMBNAIL_IMG_EXT;
                if (! file_exists($thumnailImagePath)) {
                    $thumnailImagePath = "";
                }
            }
        }
        return $imageThumbnailImage;
    }

    public static function getThumbnail(string $filePath = NULL): ?string
    {
        $thumbnail = "";
        if (self::isStringParamValid($thumbnail = self::getVideoThumbnailImage($filePath)) === false) {
            $thumbnail = self::getImageThumbnailImage($filePath);
        }
        
        return $thumbnail;
    }
}
