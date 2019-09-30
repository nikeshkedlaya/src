<?php

// if (!defined('BASEPATH')) exit('No direct script access allowed to access the utility helper');

/**
 * @created by Sandeep<sandeep@kaholabs.com> on 14 Nov, 2014 4:51:41 PM
 * 
 * Descripion: 
 * 
 * Security : 
 * 
 * Change History :-
 * 1) created ValidateUploadedFile function to validate the content of bulk uploading in csv format
 * 2) 
 * 
 * 
 * 
 * @Audited by :-
 */
/* all global properties that would be used throught whole script */

$GLOBALS['GLOBALS_GetCILibrary'] = null;
$GLOBALS['GLOBALS_GetBaseURI'] = null;
$GLOBALS['GLOBALS_GetIncludedJS'] = null;
$GLOBALS['GLOBALS_GetIncludedCSS'] = null;

function GetDebugItem() {
    return GetCILibrary()->config->item("debug");
}

function GetCILibrary() { // it will load the ci library
    return is_null($GLOBALS['GLOBALS_GetCILibrary']) ? $GLOBALS['GLOBALS_GetCILibrary'] = & get_instance() : $GLOBALS['GLOBALS_GetCILibrary'];
}

function DownloadTemplate($filename, $configPathName) {
    GetCILibrary()->load->helper("download");
    $downloadablePath = GetConfigItem($configPathName) . $filename;
    if (file_exists($downloadablePath)) {
        $data = file_get_contents($downloadablePath);
        force_download($filename, $data);
    } else {
        show_404($downloadablePath);
    }
}

function SwitchDatabase($DB_Name) {
    GetCILibrary()->load->library("session");
    GetCILibrary()->session->set_userdata('instance_key', base64_encode($DB_Name));
}

function GetDebugBacktrace($index) { // will use the debug backtrace function and return the previous last two method
    $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 4)[$index]; // returning the last 3 backtrace
    return $trace['class'] . "::" . $trace['function'];
}

function GetConfigItem($itemname) {
    return GetCILibrary()->config->item($itemname);
}

function GetBaseURI() { // will return the complete uri
    $getBaseURI = strtolower(current(explode("/", $_SERVER['SERVER_PROTOCOL']))) . "://" . $_SERVER['HTTP_HOST'] . "/";
    return is_null($GLOBALS['GLOBALS_GetBaseURI']) ? $GLOBALS['GLOBALS_GetBaseURI'] = $getBaseURI : $GLOBALS['GLOBALS_GetBaseURI'];
}

function GetRequestedHostSubDomainName() { // will return the request host sub domain name
    $host = $_SERVER['HTTP_HOST'];
    $getRequestedHostName = current(explode(".", $host));
    $getRequestedHostName = $getRequestedHostName === "192" ? "development" : $getRequestedHostName;
    return $getRequestedHostName;
}

function GetMemcachedPrefixForKey() { // would be used as a prefix for every memcached key based on client url and db name
    GetCILibrary()->load->library("session");
    $currentDB = base64_decode(GetCILibrary()->session->userdata('instance_key'));
    return GetRequestedHostSubDomainName() . "_" . $currentDB . "_";
}

function GetRequestedClientConfigurations($itemName, $ciLibrary = NULL) { // will return the client specific configurations based on request hostF
    if (is_null($ciLibrary)) {
        $configItem = GetCILibrary();
    }
    $configItem = $ciLibrary->config->item("client_specific_configuration")[GetRequestedHostSubDomainName()][$itemName];
    return $configItem;
}

function GetClientWD($wdKey = "webwd", $folderName = NULL, $ciLibrary = NULL) { // will return the client working directory
    if (is_null($ciLibrary)) {
        $ciLibrary = GetCILibrary();
    }
    $wdPath = GetRequestedClientConfigurations($wdKey, $ciLibrary);
    $wdPath .= is_null($folderName) ? "" : $folderName;
    $absPath = getcwd() . "/" . $wdPath;
    if (!is_dir($absPath)) {
        @mkdir($absPath, 0777, TRUE);
        @chmod($absPath, 0777);
    }
    return $wdPath;
}

//function getUploadedBasePath($modulePathKey, $curObj = NULL) {
//    return GetBaseURI() . GetClientWD("webwd", GetConfigItem($modulePathKey), $curObj) . "/";
//}

function getUploadedBasePath($modulePathKey, $curObj = NULL) {
    return GetBaseURI() . GetClientWD("webwd",$modulePathKey , $curObj) . "/";
}

function GetCustomConfigItem($customConfigName, $itemname = NULL) { // is loading the custom config file and returning the vals
    GetCILibrary()->config->load($customConfigName);
    if (isStringParamValid($itemname) && isset(GetCILibrary()->config->item($customConfigName)[$itemname])) {
        return GetCILibrary()->config->item($customConfigName)[$itemname];
    }
    return GetCILibrary()->config->item($customConfigName);
}

function ObjectToString($InputParamObject, $Delimiter = ":", $Seperator = ",", $withKey = FALSE) { // convert the object to array and use it as an naming placeholder with delimiter
    try {
        if (empty($InputParamObject) === TRUE) {
            throw new TransactionException(__FUNCTION__ . " 's Param must be an object");
        } else {
            settype($InputParamObject, "array");
            $InputParamArray = (array) current($InputParamObject);
            $ProcessPlaceholder = function($InputParamArray, $Delimiter, $withKey) {
                return array_map(function($val) use($Delimiter, $InputParamArray, $withKey) {
                    return $Delimiter . trim($val) . ($withKey === TRUE ? " with value " . $InputParamArray[$val] : "");
                }, array_keys(($InputParamArray)));
            };
            $ConcatInputAndOutput = implode($Seperator, $ProcessPlaceholder($InputParamArray, $Delimiter, $withKey));
            return $ConcatInputAndOutput;
        }
    } catch (TransactionException $param) {
        WriteLogMessage($param->GetTransactionErrException());
    }
}

function ArrayToString($InputParamArray, $Delimiter = "@", $Seperator = ",") {
    try {
        if (empty($InputParamArray) === TRUE) {
            throw new TransactionException(__FUNCTION__ . " 's Param must be an array");
        } else {
            $ProcessPlaceholder = function($InputParamArray, $Delimiter) {
                return array_map(function($val) use($Delimiter) {
                    return $Delimiter . trim($val);
                }, (($InputParamArray)));
            };
            $ConcatInputAndOutput = implode($Seperator, $ProcessPlaceholder($InputParamArray, $Delimiter));
//                if (GetDebugItem() === TRUE)
//                {
//                    debug_log_message(__METHOD__ . " is returning " . $ConcatInputAndOutput);
//                }
            return $ConcatInputAndOutput;
        }
    } catch (TransactionException $param) {
        WriteLogMessage($param->GetTransactionErrException());
    }
}

function ProcessOutputParam($OutputParamArray) { // process output param for select stmt while getting output param's val
    try {
        if (!is_array($OutputParamArray)) {
            throw new TransactionException(__FUNCTION__ . "param must be an array");
        } else {
            $ProcessPlaceholder = function($OutputParamArray) {
                return "SELECT" . implode(", ", array_map(function($val1) {
                                    return "@" . $val1 . " AS " . $val1;
                                }, ($OutputParamArray)));
            };
            $SelectOutputStmt = $ProcessPlaceholder($OutputParamArray);
            return $SelectOutputStmt;
        }
    } catch (TransactionException $param) {
        WriteLogMessage($param->GetTransactionErrException());
    }
}

function WriteLogMessage($expObjMessage) { // writing the log message from specific exception object
    log_message("error", $expObjMessage);
}

function GetObjectAsAnArray($ObjectParam) {
    settype($ObjectParam, "array");
    $ParamArray = current($ObjectParam);
    if (GetDebugItem() === TRUE) {
        debug_log_message(__METHOD__ . " is returning " . ArrayToString($ParamArray));
    }
    return $ParamArray;
}

function uploadMedia($path, $fileName) {
    if (isset($fileName) && empty($fileName['name']) === false) {
        $mediaFileName = basename($fileName['name']);
        $targetPath = $path . $mediaFileName;
        if (!move_uploaded_file($fileName['tmp_name'], $targetPath)) {
            return false;
        } else {
            return $mediaFileName;
        }
    } else {
        return false;
    }
}

function GetSuccessMessage($jsonData = "", $key, $User = "", $escapeHTML = FALSE, $message = "Successfull", $succcode = "SUC001") {
    $json = array();
    $json['msg'] = "Success";
    $json['code'] = $succcode;
    $json['cusmsg'] = $message;
    if ($User === "" || $User === NULL) {
        $json['user'] = "NoUser";
    } else {
        $json['user'] = $User;
    }
    $jsonData !== "" ? $json[$key] = $jsonData : null;

    $jsonEncode = $escapeHTML ? escapeHTMLInJSON($json) : json_encode($json, JSON_UNESCAPED_UNICODE);
    echo $jsonEncode;
}

function escapeHTMLInJSON($json) {
    if (!empty($json)) {
        return html_entity_decode(json_encode($json, JSON_UNESCAPED_UNICODE));
    }
}

function GetSuccessMessageWithPreDefinedStructure($jsonData, $key = null, $message = "Successfull", $succcode = "SUC001") {
    $json = array();
    $json['msg'] = "Success";
    $json['code'] = $succcode;
    $json['cusmsg'] = $message;
    if (!is_null($key) && !empty($key)) {
        if (is_array($key)) {
            $json[current($key)][] = $jsonData;
        } else {
            $json[$key] = $jsonData;
        }
    } else {
        $json = array_merge($json, $jsonData);
    }
    $jsonEncode = json_encode($json, JSON_UNESCAPED_UNICODE);
    echo $jsonEncode;
}

function GetSuccessMessageWithDictionaryWithLoop($jsonData = "", $key, $myarray, $message = "Successfull", $succcode = "SUC001") { // for creating the structure for graph with do-while loop
    $json = array();
    $json['msg'] = "Success";
    $json['code'] = $succcode;
    $json['cusmsg'] = $message;
    $j = 0;
    do {
        foreach ($jsonData[$key . "_" . $j] as $keys => $val) {
            $vals = array_values(array_diff(array_keys($val), $myarray));
            for ($i = 0; $i < count($vals); $i++) {
                $json[$key . "_" . $j][$val['Labels']][][$vals[$i]] = $val[$vals[$i]];
            }
        }
        $j++;
    } while ($j < count($jsonData));
    $jsonEncode = json_encode($json, JSON_UNESCAPED_UNICODE);
    echo $jsonEncode;
}

function GetSuccessMessageWithDictionary($jsonData, $key, $myarray, $message = "Successfull", $succcode = "SUC001") { // for creating the structure for graph
    $json = array();
    $json['msg'] = "Success";
    $json['code'] = $succcode;
    $json['cusmsg'] = $message;
    $j = 0;

    foreach ($jsonData as $keys => $val) {
        $vals = array_values(array_diff(array_keys($val), $myarray));
        for ($i = 0; $i < count($vals); $i++) {
            $json[$key][$val['Labels']][][$vals[$i]] = $val[$vals[$i]];
        }
    }
    $jsonEncode = json_encode($json, JSON_UNESCAPED_UNICODE);
    echo $jsonEncode;
}

function GetSuccessMessageWithDictionaryByKey($jsonData, $key, $parentKey = "", $isSort = TRUE, $message = "Successfull", $succcode = "SUC001") { // for creating the structure for meter graph with key array structure  // to know the structure please refer to GetAssessmentDetails method of marks module
    $json = array();
    $json['msg'] = "Success";
    $json['code'] = $succcode;
    $json['cusmsg'] = $message;

    foreach ($jsonData as $keys => $val) {

        $json[$key][$val[$parentKey]][] = $val;
    }
    if ($isSort) {
        sort($json[$key], SORT_NUMERIC);
    }
    $jsonEncode = json_encode($json, JSON_UNESCAPED_UNICODE);
    echo $jsonEncode;
}

function GetSuccessMessageWithDictionaryByKey1($jsonData, $key, $parentKey = "", $Param = "", $message = "Successfull", $succcode = "SUC001") { // for creating the structure for meter graph with key array structure  // to know the structure please refer to GetAssessmentDetails method of marks module
    $json = array();
    $json['msg'] = "Success";
    $json['code'] = $succcode;
    $json['cusmsg'] = $message;
    $i = 0;
    foreach ($jsonData as $keys => $val) {
        $json[$key][$val[$parentKey]]["Assessment_Name"] = $val['Assessment_Name'];

        $json[$key][$val[$parentKey]][] = $val;
    }
    //        echo '<pre>';
    //        print_r($json);
    //        exit;
    $jsonEncode = json_encode($json, JSON_UNESCAPED_UNICODE);
    echo $jsonEncode;
}

function GetSuccessMessageWithCodeDictionary($jsonData, $key, $myarray, $message = "Successfull", $succcode = "SUC001") { // for creating the structure for graph
    $json = array();
    $json['msg'] = "Success";
    $json['code'] = $succcode;
    $json['cusmsg'] = $message;
    $j = 0;
    foreach ($jsonData as $keys => $val) {
        $vals = array_values(array_diff(array_keys($val), $myarray));
        for ($i = 0; $i < count($vals); $i++) {
            $json[$key][$val['Labels']][][$vals[$i]] = $val[$vals[$i]];
        }
    }
    $jsonEncode = json_encode($json, JSON_UNESCAPED_UNICODE);
    echo $jsonEncode;
}

function GetErrorMessage($message, $errcode = "ERR001") {
    $json = array();
    $json['msg'] = "Error";
    $json['code'] = $errcode;
    $json['cusmsg'] = $message;
    $jsonEncode = json_encode($json);
    echo $jsonEncode;
}

function GetSuccessMessageWithParentAndChild($jsonData, $key, $parentKey = "", $ChildKey = "", $User = "", $message = "Successfull", $succcode = "SUC001") {
    $json = array();
    $json['msg'] = "Success";
    $json['code'] = $succcode;
    $json['cusmsg'] = $message;
    if ($User === "" || $User === NULL) {
        $json['user'] = "NoUser";
    } else {
        $json['user'] = $User;
    }

    foreach ($jsonData as $keys => $val) {
        $json[$key][$val[$parentKey]][$val[$ChildKey]] = $val;
    }
    $jsonEncode = json_encode($json, JSON_UNESCAPED_UNICODE);
    echo $jsonEncode;
}

function ValidateImportedString($Importedobject, $data) {
    $config = & get_instance();
    $config->config->load("validation_configuration");
    $vals = $config->config->item('validation_configuration')[$Importedobject];
}

function ValidateUploadedFile($objImport, $csvData) { // going to validate csv,excel file // first param is validation config and second is csv data
    $myvals = function($objImport, $csvData) {
        $errorArray = array();
        array_map(function($val, $objKey, $objPostion) use($csvData, &$errorArray) {
            array_walk($val, function ($arrayval, $arraykey) use($csvData, $objKey, $objPostion, &$errorArray) {
                $vals = "";
                if ($arraykey === "required") {
                    $errorArray[$objKey] = array_map(function($val) use($arrayval, $arraykey) {
                        $error = "";
                        if ($arrayval($val) === true) {
                            $error = "Please enter value";
                        }
                        return $error;
                    }, array_column($csvData, $objPostion));
                }
                if ($arraykey === "alpha") {
                    $errorArray[$objKey] = array_map(function($val) use($arrayval, $arraykey) {
                        $error = "";
                        if ($arrayval($val) === FALSE) {
                            $error = "Please enter valid value";
                        }
                        return $error;
                    }, array_column($csvData, $objPostion));
                }
                if ($arraykey === "stringswithspace") {
                    $errorArray[$objKey] = array_map(function($val) use($arrayval, $arraykey) {
                        $error = "";
                        if ($arrayval($val) === FALSE) {
                            $error = "Please enter valid value";
                        }
                        return $error;
                    }, array_column($csvData, $objPostion));
                }
                if ($arraykey === "alphanumeric") {
                    $errorArray[$objKey] = array_map(function($val) use($arrayval, $arraykey) {
                        $error = "";
                        if ($arrayval($val) === FALSE) {
                            $error = "Please enter valid value";
                        }
                        return $error;
                    }, array_column($csvData, $objPostion));
                }
                if ($arraykey === "email") {
                    $errorArray[$objKey] = array_map(function($val) use($arrayval, $arraykey) {
                        $error = "";
                        if ($arrayval($val) === FALSE) {
                            $error = "Please enter valid Email";
                        }
                        return $error;
                    }, array_column($csvData, $objPostion));
                }
                if ($arraykey === "bit") {
                    $errorArray[$objKey] = array_map(function($val) use($arrayval, $arraykey) {
                        $error = "";
                        if ($arrayval($val) !== true) {
                            $error = "Please enter valid value";
                        }
                        return $error;
                    }, array_column($csvData, $objPostion));
                }
                if ($arraykey === "bitoralpha") {
                    $errorArray[$objKey] = array_map(function($val) use($arrayval, $arraykey) {
                        $error = "";

                        if ($arrayval($val) !== true) {
                            $error = "Please enter valid value(ex: yes or no)";
                        }
                        return $error;
                    }, array_column($csvData, $objPostion));
                }
                if ($arraykey === "designation") { // for teacher designation
                    $errorArray[$objKey] = array_map(function($val) use($arrayval, $arraykey) {
                        $error = "";
                        if ($arrayval($val) === false) {
                            $error = "Please enter valid Desigation Code";
                        }
                        return $error;
                    }, array_column($csvData, $objPostion));
                }
                if ($arraykey === "type") { // for teacher type 
                    $errorArray[$objKey] = array_map(function($val) use($arrayval, $arraykey) {
                        $error = "";
                        if ($arrayval($val) === false) {
                            $error = "Please enter valid Type";
                        }
                        return $error;
                    }, array_column($csvData, $objPostion));
                }
                if ($arraykey === "date") {
                    $errorArray[$objKey] = array_map(function($val) use($arrayval, $arraykey) {
                        $error = "";
                        if ($arrayval($val) === FALSE) {
                            $error = "Please enter valid date format";
                        }
                        return $error;
                    }, array_column($csvData, $objPostion));
                }

                if ($arraykey === "num") {
                    $errorArray[$objKey] = array_map(function($val) use($arrayval, $arraykey) {
                        $error = "";
                        if ($arrayval($val) !== true) {
                            $error = "Please enter only Numbers";
                        }
                        return $error;
                    }, array_column($csvData, $objPostion));
                }
                //                    print_r($vals);
                //                    if ($arraykey === "alpha")
                //                    {
                //                        print_r(array_map(function($val) use($arrayval, $arraykey)
                //                                    {
                //                                        global $error;
                //                                        if ($arrayval($val) === FALSE)
                //                                        {
                //                                            $error[$arraykey][] = "Please enter valid value";
                //                                        }
                //                                        return $error;
                //                                    }, array_column($csvData, 1)));
                //                    }

                /* else if ($arraykey === "alpha_numeric")
                  {
                  return array_map(function($val)
                  {
                  if ($val === "" && is_null($val))
                  {
                  $error[] = "Please enter valid value";
                  }
                  }, array_column($dataArray, 2));
                  } */
                //                    print_r($error);
            });
        }, $objImport, array_keys($objImport), array_keys(array_keys($objImport)));
        return DisplayBulkErrorMessage($errorArray);
    };
    return $myvals($objImport, $csvData);
}

function validateUploadedMasterDataCSV($attachedFileData, $concernImportConfiguration) {
    $instanceLib = GetCILibrary();
    $instanceLib->load->helper(array("validation/validation"));
    $TempPath = $attachedFileData['tmp_name'][0];
    $csvContent = file($TempPath);
    array_shift($csvContent); // removing  the first element because its is heading for column
    $csvData = array_map('str_getcsv', $csvContent);

    $FileName = $attachedFileData['name'][0];
    $Ext = GetExtention($FileName);
    $FileNameWithoutExt = GetFileName($FileName); // file name without ext
    $new_filename = ValidFileName($FileNameWithoutExt) . time() . "." . $Ext; // creating the new file name 
    $uploading_csv_path = GetConfigItem("uploading_csv_path");
    $instanceLib->load->library("session");
    $instanceLib->session->set_userdata("UploadedCSVFileName", $new_filename); // storing the file name in session so that controller can access the file name and pass to the derived manager class
    move_uploaded_file($TempPath, $uploading_csv_path . $new_filename);
    if (sizeof($csvData) > 0) {
        $errorsMessage = ValidateUploadedFile($concernImportConfiguration, $csvData); // validating data and returning error message if any ;
        if (empty($errorsMessage) === FALSE) {
            return $errorsMessage;
        }
    } else {
        return "It seems file is empty! Check your file before uploading";
    }
}

//function validateUploadedMasterDataCSV($attachedFileData, $concernImportConfiguration) {
//    $instanceLib = GetCILibrary();
//    $instanceLib->load->helper(array("validation/validation"));
//    $TempPath = $attachedFileData['tmp_name'][0];
//    $csvContent = file($TempPath);
//    array_shift($csvContent); // removing  the first element because its is heading for column
//    $csvData = array_map('str_getcsv', $csvContent);
//    $errorsMessage = ValidateUploadedFile($concernImportConfiguration, $csvData); // validating data and returning error message if any ;
//    if (empty($errorsMessage) === true) {
//        $FileName = $attachedFileData['name'][0];
//        $Ext = GetExtention($FileName);
//        $FileNameWithoutExt = GetFileName($FileName); // file name without ext
//        $new_filename = ValidFileName($FileNameWithoutExt) . time() . "." . $Ext; // creating the new file name 
//        $uploading_csv_path = GetConfigItem("uploading_csv_path");
//        if (!move_uploaded_file($TempPath, $uploading_csv_path . $new_filename)) {
//            $errorsMessage = "there is an error while uploading";
//            return $errorsMessage;
//        } else {
//            $instanceLib->load->library("session");
//            $instanceLib->session->set_userdata("UploadedCSVFileName", $new_filename); // storing the file name in session so that controller can access the file name and pass to the derived manager class
//        }
//    } else {
//        return $errorsMessage;
//    }
//}

function SessionDataStructure($SessionData, $UserCode) { // for storing the kids information inside parent code as an arrayF
    $myfunc = function ($SessionData, $UserCode) {
        $myarray = array();
        array_walk($SessionData, function ($ArrayVal, $ArrayKey) use(&$myarray, $UserCode) {
            $myarray[$UserCode][] = $ArrayVal;
        });
        return $myarray;
    };
    return $myfunc($SessionData, $UserCode);
}

function DisplayBulkErrorMessage($errorMessage) {
    $errorMes = "";
    foreach ($errorMessage as $key => $val) {
        array_walk($val, function($vals, $keys) use($key, &$errorMes) {
            if (empty($vals) === FALSE) {
                $errorMes .= $vals . " on line no " . ($keys + 1) . " on column name " . $key . "<br/>\n";
            }
        });
    }
    return $errorMes;
}

function Search($ColumnName, $Operator, $Keyword) {
    $Condition = "";

    switch ($Operator) {
        case "contains":

            $Condition = "$ColumnName LIKE (^%$Keyword%^)";
            break;

        case "starts":
            $Condition = "$ColumnName LIKE ^$Keyword%^";
            break;

        case "ends":
            $Condition = "$ColumnName LIKE ^%$Keyword^";
            break;

        case "greater":
            $Condition = "$ColumnName > $Keyword";
            break;

        case "lesser":
            $Condition = "$ColumnName < $Keyword";
            break;

        case "greaterthanequal":
            $Condition = "$ColumnName >= $Keyword";
            break;

        case "lesserthanequal":
            $Condition = "$ColumnName <= $Keyword";
            break;

        default:
            break;
    }

    return $Condition;
}

function IncludeJS($jsfiles) {
    $jsfiles = isset(GetConfigItem("include_js")[$jsfiles]) ? GetConfigItem("include_js")[$jsfiles] : "";
    if (empty($jsfiles) === FALSE && is_array($jsfiles) === TRUE) {
        $queryStr = "";
        $lastElem = (int) end($jsfiles);
        if (is_numeric($lastElem) === true && $lastElem > 0) {
            $queryStr .= "?v=" . end($jsfiles);
            array_pop($jsfiles);
        }
        array_walk($jsfiles, function($val, $key) use($queryStr) {
            $url = strpos($val, "http") === FALSE ? GetBaseURI() . $val . ".js" : $val;
            echo ("<script type=\"text/javascript\" src=\"{$url}{$queryStr}\"></script>");
        });
    }
}

function IncludeCSS($cssfiles) {
    $cssfiles = isset(GetConfigItem("include_css")[$cssfiles]) ? GetConfigItem("include_css")[$cssfiles] : "";
    if (empty($cssfiles) === FALSE && is_array($cssfiles) === TRUE) {
        $queryStr = "";
        $lastElem = (int) end($cssfiles);
        if (is_numeric($lastElem) === true && $lastElem > 0) {
            $queryStr .= "?v=" . end($cssfiles);
            array_pop($cssfiles);
        }
        array_walk($cssfiles, function($val, $key) use($queryStr) {
            $url = strpos($val, "http") === FALSE ? GetBaseURI() . $val . ".css" : $val;
            echo ("<link rel=\"stylesheet\" type=\"text/css\" href=\"{$url}{$queryStr}\" ./>");
        });
    }
}

//This function use for return valid file extation
function GetExtention($FileName) {
    $extation = substr(strrchr($FileName, "."), 1);
    return $extation;
}

//This function use for return valid file extation
function GetFileName($FileName) {
    $extation = substr(strrchr($FileName, "."), 1);
    $name = str_replace($extation, '', $FileName);
    return $name;
}

function ValidFileName($string) {
    // Replace other special chars
    $specialCharacters = array(
        '%' => '',
        '?' => '',
        '.' => '',
        '@' => '',
        '+' => '',
        '=' => '',
        ' ' => '',
        '\\' => '',
        '/' => '',
        '~' => '',
        '`' => '',
        '^' => '',
        '\'' => '',
        '\"' => '',
        '*' => '',
        '!' => '',
        ':' => '',
        '<' => '',
        '>' => '',
        '|' => '',
        '#' => '',
    );

    while (list($character, $replacement) = each($specialCharacters)) {
        $string = str_replace($character, '' . $replacement . '', $string);
    }
    $string = strtr($string, "ÀÁÂÃÄÅáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ", "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn"
    );
    return $string;
}

function ValidAttachment($ImageName) {
    $ext = array("jpg", "JPG", "jpeg", "JPEG", "gif", "GIF", "png", "PNG", "pjpeg", "PJPEG", "TTIF", "ttif", "PDF", "pdf", "DOC", "doc", "DOCX", "docx", "XLS", "xls", "XLSX", "xlsx", "CSV", "csv", "txt", "rtf", "TXT", "RTF", "mp4", "MP4", "Mp4", "mkv", "3gp", "avi", "m4a", "flv", "mov", "mp3", "MP3", "Mp3", "aac", "ogg", "wav", "wma");
    $ImageExt = substr(strrchr($ImageName, "."), 1);
    if (in_array($ImageExt, $ext)) {
        return true;
    } else {
        return false;
    }
}

function ProcessedImage($ImageName, $ImageSize, $ImageTempPath) {
    if ($ImageName != "") {
        if (ValidAttachment($ImageName)) {
            ini_set('max_execution_time', '999999');
            $orgfile_name = $ImageName;
            $ext1 = GetExtention($orgfile_name);
            $file_name = GetFileName($orgfile_name);
            $new_filename = ValidFileName($file_name);
            $tmp_file = $ImageTempPath;
            $newImageName = $new_filename . time() . "." . $ext1;
            $original = ""; // GetConfigItem("uploading_csv_path") . $newImageName;
            //                $product_logo = GetConfigItem("uploading_img_thumb") . $newImageName;
            $counter = 0;
            foreach ($ImageSize as $key => $val) {
                if ($counter === 0) {
                    $original = $key . $newImageName;
                    if (!move_uploaded_file($tmp_file, $original)) {
                        die("File not uploaded");
                    } else {
                        //                            $thumblib = & get_instance();
                        //                            $thumblib->load->library("thumbnail");
                        //                            $thumblib->thumbnail->load($original);
                        //                            $thumblib->thumbnail->resize(50, 50);
                        //                            $thumblib->thumbnail->save($product_logo);
                    }
                } else {
                    $thumblib = & get_instance();
                    $thumblib->load->library("thumbnail");
                    $thumblib->thumbnail->load($original);
                    $thumblib->thumbnail->resize($val, $val);
                    $thumblib->thumbnail->save($key . $newImageName);
                }
                $counter++;
            }

            //                if (!move_uploaded_file($tmp_file, $original))
            //                {
            //                    echo $Messages = "File not uploaded";
            //                    exit;
            //                } else
            //                {
            //                    $thumblib = & get_instance();
            //                    $thumblib->load->library("thumbnail");
            //                    $thumblib->thumbnail->load($original);
            //                    $thumblib->thumbnail->resize(50, 50);
            //                    $thumblib->thumbnail->save($product_logo);
            //                }
        }
    }
    //        else
    //        {
    //            $SiteLogo = $_POST[$hdn_image];
    //        }
    return $newImageName;
}

function GetProcessedSingleAttachment($AttachmentName, $AttachmentSize, $AttachmentTempPath, $AttachmentUploadingPath) {
    if ($AttachmentName != "") {
        if (ValidAttachment($AttachmentName)) {
            $orgfile_name = $AttachmentName;
            $ext1 = GetExtention($orgfile_name);
            $file_name = GetFileName($orgfile_name);
            $new_filename = ValidFileName($file_name);
            $tmp_file = $AttachmentTempPath;
            $newAttachmentName = $new_filename . time() . "." . $ext1;
            $original = GetClientWD("webwd", $AttachmentUploadingPath) . $newAttachmentName;
            if (!move_uploaded_file($tmp_file, $original)) {
                echo $Messages = "File not uploaded at " . $original . " from tmp path" . $tmp_file;
                exit;
            }
            return $newAttachmentName;
        }
    } else {
        return FALSE;
    }
}

function processAttachmentNUpload($filesArray, $attachmentUploadingPath, $filesArrayName = "attachment") {
    if (checkArrayParam($filesArray)) {
        $attachmentName = $filesArray[$filesArrayName]['name'];
        if (ValidAttachment($attachmentName)) {
            $orgfile_name = $attachmentName;
            $ext1 = GetExtention($orgfile_name);
            $file_name = GetFileName($orgfile_name);
            $new_filename = ValidFileName($file_name);
            $tmp_file = $filesArray[$filesArrayName]['tmp_name'];
            $newAttachmentName = $new_filename . time() . "." . $ext1;
            $original = GetClientWD("webwd", $attachmentUploadingPath . "/") . $newAttachmentName;
            if (!move_uploaded_file($tmp_file, $original)) {
                echo $Messages = "File not uploaded at " . $original . " from tmp path" . $tmp_file;
                exit;
            }
            return $newAttachmentName;
        }
    } else {
        return FALSE;
    }
}

function GetObjectValue($Object) {
    $ObjectAsAnArray = GetObjectAsAnArray($Object);
    if (is_array($ObjectAsAnArray) === TRUE && empty($ObjectAsAnArray) === FALSE) {
        return implode("_", array_values($ObjectAsAnArray));
    } else {
        return FALSE;
    }
}

function GetUserCodeCSV($data) { // processing the user code with comma separated string
    if (strcspn($data, "|") > 0) {
        $strings = str_replace("|", ",", $data);
    } else {
        $strings = $data;
    }
    // $array = array($key=>$strings); // method name would be ket and value would be method's param
    return $strings;
}

function GetAssignedUser($Ticket_ID) { // will return the user code who assigned the task as string
    // $assignedUserStr = json_decode(file_get_contents(GetBaseURI()."kahocommon/getAssignedUser/".$Ticket_ID),true);
    $assignedUserStr = CallHTTPURL("kahocommon/getAssignedUser/" . $Ticket_ID, getStreamContextForHTTP());
    if (empty($assignedUserStr['getTicketForToday']) === false) {
        return $assignedUserStr['getTicketForToday']['0']['Created_By'];
    }
}

function GetLoggedInUserDetailsByKey($keyName = "Name") { // by default it will return the key
    GetCILibrary()->load->library("session");
    $LoggedInUserName = GetCILibrary()->session->userdata($keyName);
    return $LoggedInUserName;
}

function GetReportsTo() { // will return the immediate reporting hod user code
    GetCILibrary()->load->library("session");
    $GetSessionData = GetCILibrary()->session->all_userdata();
    $ReportsTo = isset($GetSessionData[GetCILibrary()->session->userdata("User_Code")][0]['ReportsTo']) ? $GetSessionData[GetCILibrary()->session->userdata("User_Code")][0]['ReportsTo'] : NULL;
    return $ReportsTo;
}

function getLanguageKey($keyName) { // will return the language key name
    GetCILibrary()->lang->load("notification");
    $langKey = GetCILibrary()->lang->line($keyName);
    return $langKey;
}

function getTextmessage($textMessage, $array) { // will return the string format 
    $message = "";
    if (is_array($array) === true) {
        $message = vsprintf($textMessage, $array);
    } else {
        settype($array, "array");
        $message = vsprintf($textMessage, $array);
    }
    return $message;
}

function replaceUserType($userCode) { // will be user id with user type in strings that would be removed
    $groupArr = array("Staff", "Student", "TEACH", "PRINCIPAL", "Group");
    $data = explode("|", $userCode);
    $replaceStr = array();
    array_map(function($val) use($groupArr, &$replaceStr) {
        if (array_search(strstr(",", $val), $groupArr, true) === false) {
            $replaceStr[] = current(explode(",", $val));
        }
    }, $data);
    return implode("|", $replaceStr);
}

function GetUserCodeBySectionAYCode($Section_AY_Code) { // will return the user code who assigned the task as string
    $assignedUserStr = CallHTTPURL("kahocommon/getUserCodeBySectionAYCode/" . $Section_AY_Code, getStreamContextForHTTP()); //json_decode(file_get_contents(GetBaseURI()."kahocommon/getUserCodeBySectionAYCode/".$Section_AY_Code),true);
    if (empty($assignedUserStr['getUserCodeBySectionAYCode']) === false) {
        return $assignedUserStr['getUserCodeBySectionAYCode']['0']['User_Code'];
    }
}

function CallHTTPURL($url, $streamContext = null) { // passing the sub url just like controller with method name and params
    $fileGetContents = null; //@file_get_contents(GetBaseURI() . $url);
    if (is_null($streamContext)) {
        $fileGetContents = @file_get_contents(GetBaseURI() . $url);
    } else {
        $fileGetContents = @file_get_contents(GetBaseURI() . $url, false, $streamContext);
    }
    $result = json_decode($fileGetContents, true);
    return $result;
}

function getStreamContextForHTTP() {
    $opts = array('http' => array('method' => "GET", 'header' => getRequestedHeadersDetail()));
    $context = stream_context_create($opts);
    return $context;
}

function getRequestedHeadersDetail() {
    $headerDetails = getallheaders();
    $header = "User-Agent: " . $headerDetails['User-Agent'] . "\r\nCookie: " . $headerDetails['Cookie'];
    return $header;
}

function getRawCookie() {
    return $_SERVER['HTTP_COOKIE'];
}

function GetGroupIdFromStr($selectedIds) { // would be used when user will select the group with other user code and need to figure out that is group id get selected or not
    $array = explode("|", $selectedIds);
    $groupdIds = array_filter($array, function($vals) {
        if (strpos($vals, "Group") !== false) {
            return $vals;
        }
    });
    return str_replace(",Group", "", implode("-", array_unique($groupdIds))); // using dash because when will call the http request from bmail then "|" chars not allowed so used dash
}

function GetUserCodeByGroupId($GroupId) {
    $userCode = callHTTPURL("kahocommon/getUserCodeByGroupId/" . $GroupId, getStreamContextForHTTP());
    if (empty($userCode['getUserCodeByGroupId']) === false) {
        return $userCode['getUserCodeByGroupId']['0']['User_Code'];
    }
}

function WriteErrorLog($msg) { // would be used in gearmanworker and push notification library
    $filepath = getcwd() . "/" . GetConfigItem("root_directory") . "/application/logs/error_log.txt";
    if (!$fp = @fopen($filepath, "a+")) {
        return FALSE;
    }
    $message = "ERROR " . '- ' . date("Y-m-d H:i:s") . ' --> ' . $msg . "\n" . PHP_EOL;

    flock($fp, LOCK_EX);
    fwrite($fp, $message);
    flock($fp, LOCK_UN);
    fclose($fp);
    return TRUE;
}

function WriteDebugLog($msg) { // would be used in gearmanworker and push notification library
    $filepath = getcwd() . "/" . GetConfigItem("root_directory") . "/application/logs/debug_log.txt";
    if (!$fp = @fopen($filepath, "a+")) {
        return FALSE;
    }

    $message = "DEBUG " . '- ' . date("Y-m-d H:i:s") . ' --> ' . $msg . "\n" . PHP_EOL;

    flock($fp, LOCK_EX);
    fwrite($fp, $message);
    flock($fp, LOCK_UN);
    fclose($fp);
    return TRUE;
}

function GetFilteredStudentSessionData($sessionData, $studentCode) { // would be used to get some student info from session
    debug_log_message(__METHOD__ . " is initialized with session data " . print_r($sessionData, true) . " with studentCode " . $studentCode);
    try {
        if (!empty($sessionData) && is_array($sessionData)) {
            if (!empty($studentCode) && is_null($studentCode) === false) {
                foreach ($sessionData as $key => $value) {
                    if ($value['Student_Code'] == $studentCode) {
                        return $value;
                    }
                }
            } else {
                return $sessionData[0];
                //throw new Exception("student code is empty is empty");
            }
        } else {
            throw new Exception("session data is empty");
        }
    } catch (Exception $ex) {
        debug_log_message("session data is empty at " . $ex->getLine() . $ex->getMessage());
    }
}

function getExportedDataasExcel($exportData, $fileName) {
    try {
        if (is_array($exportData) && !empty($exportData)) {
            array_unshift($exportData, (str_replace("_", " ", array_keys($exportData[0]))));
            header('Content-Type: application/excel');
            header("Content-Disposition: attachment; filename={$fileName}.csv");
            $file = fopen('php://output', 'w');
            foreach ($exportData as $row) {
                fputcsv($file, $row);
            }
        } else {
            throw new Exception("exportData data is empty at ");
        }
    } catch (Exception $ex) {
        debug_log_message($ex->getMessage() . " on line no " . $ex->getLine());
    }
}

function convertXMLToArray($XMLData) {
    try {
        if (!empty($XMLData)) {
            $xml = simplexml_load_string($XMLData);
            settype($xml, "array");
            return $xml;
        } else {
            throw new Exception("either xml data is null or empty");
        }
    } catch (Exception $ex) {
        debug_log_message($ex->getMessage() . " on line no " . $ex->getLine());
    }
}

function convertXMLToArrayCallback($arrayData, $keyName, $isSorting = TRUE) {
    if (checkArrayParam($arrayData)) {
        if (isset($arrayData[$keyName]) && isStringParamValid($arrayData[$keyName])) {
            $arrayData[$keyName] = convertXMLToArray($arrayData[$keyName]);
            $isSorting === TRUE ? sort($arrayData[$keyName]) : "";
        }
    }
    return $arrayData;
}

function dateCompare($date1, $date2) {
    $date1 = explode("/", $date1);
    $date2 = explode("/", $date2);
    $datediff1 = date_create($date1['2'] . "-" . $date1['1'] . "-" . $date1['0']);
    $datediff2 = date_create($date2['2'] . "-" . $date2['1'] . "-" . $date2['0']);
    $dateDiff = date_diff($datediff2, $datediff1, true);
    return $dateDiff;
}

function getControllerClassNMethodName() {
    $debug = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT | DEBUG_BACKTRACE_IGNORE_ARGS, 4);
    $segmentUrl = $debug['0']['object']->library->uri->segments;
    return $segmentUrl;
}

function getCacheConfigurationArrayStructure($response) { // cache configuration structure
    if (empty($response) === FALSE) {
        $json = array();
        $cnt = 0;
        foreach ($response as $keys => $val) {
            $json[$val['Cache_Class_Name']][$val['Dependent_Class_Name']][$cnt]['Method_Name'] = $val['Cache_Class_Method_Name'];
            $json[$val['Cache_Class_Name']][$val['Dependent_Class_Name']][$cnt]['Expiration_Time'] = $val['Expiration_Time'];
            $cnt++;
            sort($json[$val['Cache_Class_Name']][$val['Dependent_Class_Name']]);
        }
        return $json;
    }
    return FALSE;
}

function getEmptyArray($count) {
    $emptyArray = array();
    for ($i = 0; $i < $count; $i++) {
        array_push($emptyArray, "");
    }
    return $emptyArray;
}

function createAnonymousObject($values) { // would be useful to have an object using stdClass when pass as an object on the fly for dmanager from any library class
    $object = new stdClass();
    $object->properties = $values;
    return $object;
}

function arrayToXML($array, &$xml) {
    foreach ($array as $key => $val) {
        if (!is_array($val)) {
            $xml->addChild($key, $val);
        } else {
            $nodeKey = "";
            if (strpos($key, "Field") === 0) {
                $nodeKey = "Field";
            } else {
                $nodeKey = "School_Specific";
            }
            $subnode = $xml->addChild($nodeKey);
            arrayToXML($val, $subnode);
        }
    }
}

function convertObjToArray($array) {
    return json_decode(json_encode($array), true);
}

function checkArrayParam($param) {
    $isArrayParamValid = FALSE;
    if (!empty($param) && is_array($param)) {
        $isArrayParamValid = TRUE;
    }
    return $isArrayParamValid;
}

function isStringParamValid($param) {
    $isStringParamValid = FALSE;
    if (!empty($param) && strlen($param) > 0) {
        $isStringParamValid = TRUE;
    }
    return $isStringParamValid;
}

function isParamValid($param) {
    $isParamValid = FALSE;
    if (!empty($param)) {
        $isParamValid = TRUE;
    }
    return $isParamValid;
}



function sendResponse($response, $respKeyName, $callback = NULL) {
    if (empty($response)) {
        GetErrorMessage("fail");
    } else {
        if (is_callable($callback)) {
            call_user_func_array($callback, array($response, $respKeyName));
//            GetSuccessMessage();
        } else {
            GetSuccessMessage($response, $respKeyName);
        }
    }
}

//function writeUploadError($validateMsg) {
//    $my_file = 'uploaderror.txt';
//    $handle = fopen($my_file, 'a+') or die('Cannot open file:  ' . $my_file);
//    fwrite($handle, $validateMsg);
//    flock($handle, LOCK_SH);
//    fclose($handle);
//    $src = realpath($my_file);
//    $pa = GetConfigItem("upload_error_files_path") . $my_file;
//    if (copy($src, $pa)) {
//        unlink($src);
//        force_download($pa);
//    }
//}
