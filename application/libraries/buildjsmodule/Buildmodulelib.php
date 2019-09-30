<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Buildmodulelib
{

    private $jsModuleType;

    private $jsonConf;

    private $jsModuleName;

    private $jsModuleNamePrefix;

    private $jsModuleLCCName;

    private $jsModuleUCCName;

    const CTRL_LABEL = "Controller";

    const SERV_LABEL = "Service";

    const VIEW_LABEL = "View";

    const MOD_LABEL = "module";

    const ROUTER_LABEL = "ui-routes";

    const MODULE_TEMPLATE_NAME = "module_temp";

    const ROUTER_TEMPLATE_NAME = "router_temp";

    const SERVICE_TEMPLATE_NAME = "service_temp";

    const FORM_TEMPLATE_NAME = "form_temp";

    const SERVICE_METHOD_TEMPLATE_NAME = "service_method_temp";

    const STATE_TEMPLATE_NAME = "state_temp";

    /* placeholder const contain in template */
    const MODULE_LCC_NAME_PLACEHOLDER = "module_lcc_name";

    const MODULE_UCC_NAME_PLACEHOLDER = "module_ucc_name";

    const MODULE_NAME_PREFIX_PLACEHOLDER = "module_name_prefix";

    const MODULE_NAME_PLACEHOLDER = "module_name";

    const MODULE_APP_NAME_PLACEHOLDER = "module_app_name";

    const MODULE_TYPE_PLACEHOLDER = "module_type";

    /* service temp placeholder */
    const SERVICE_METHOD_DETAILS_PLACEHOLDER = "service_method_details";

    const WS_ACTION_TYPE_PLACEHOLDER = "ws_action_type";

    const WS_METHOD_URL_PLACEHOLDER = "ws_method_url";

    const WS_METHOD_RESPONSEKEY_PLACEHOLDER = "ws_method_responsekey";

    const METHOD_PARAMS_PLACEHOLDER = "method_params";

    /* router temp placeholder */
    const STATE_CONF_DETAILS_PLACEHOLDER = "state_conf_details";

    const STATE_NAME_PLACEHOLDER = "state_name";

    const METHOD_NAME_PLACEHOLDER = "method_name";

    const VIEW_TYPE_BY_MODULE_TYPE_PLACEHOLDER = "view_type_by_module";

    /* form temp placeholder */
    const NG_MODEL_KEY_PLACEHOLDER = "ng_model_key";

    const FORM_CONFIGURATIONS_DETAILS_PLACEHOLDER = "form_configurations_details";

    const FORM_METHOD_NAMES_PLACEHOLDER = "form_method_names";

    const PRE_SUBMIT_CONF_PLACEHOLDER = "pre_submit_conf";

    const TRUE_GET_LISTENERS_CASES_PLACEHOLDER = "true_get_listeners_cases";

    const FALSE_GET_LISTENERS_CASES_PLACEHOLDER = "false_get_listeners_cases";

    public function __construct($moduleConf)
    {
        $this->jsonConf = $moduleConf[0];
        $this->jsModuleType = $this->jsonConf['moduleType'];
        $this->jsModuleName = $this->jsonConf['moduleName'];
        $this->jsModuleNamePrefix = $this->isKeyExistsInJSONConf("moduleNamePrefix") ? $this->jsonConf['moduleNamePrefix'] . "." : "kaho.";
        $this->buildModuleNameByCamelCaseType();
    }

    public function buildJSModule()
    {
        try {
            if (Kahoutility::isStringParamValid($this->jsModuleType)) {
                $defaultPlaceHolderArray = $this->getDefaultPlaceHolderArray();
                switch ($this->jsModuleType) {
                    case "module":
                        $this->buildModuleJSModule($defaultPlaceHolderArray);
                        break;
                    case "router":
                        $this->buildRouterJSModule($defaultPlaceHolderArray);
                        break;
                    case "service":
                        $this->buildWSServiceJSModule($defaultPlaceHolderArray);
                        break;
                    case "form":
                        $this->buildFormJSModule($defaultPlaceHolderArray);
                        break;
                    case "list":
                        $this->buildListJSModule($defaultPlaceHolderArray);
                        break;
                    case "header":
                        break;
                    default:
                        break;
                }
            }
        } catch (Exception $exc) {}
    }

    private function buildModuleJSModule($defaultPlaceHolderArray)
    {
        $this->writeFile($this->replaceTemplatePlaceHolderWithVal(self::MODULE_TEMPLATE_NAME, $defaultPlaceHolderArray));
    }

    private function buildListJSModule($defaultPlaceHolderArray)
    {
        $this->writeFile($this->replaceTemplatePlaceHolderWithVal(self::MODULE_TEMPLATE_NAME, $defaultPlaceHolderArray));
    }

    // <editor-fold defaultstate="collapsed" desc="getModulePlaceholderVal">
    /**
     * desc will build an array with placeholder as key and relevant value of key by calling the correspondent method * return array
     */
    private function getModulePlaceholderVal(): array
    {
        return $this->getDefaultPlaceHolderArray();
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getDefaultPlaceHolderArray">
    /**
     * desc will return an array which will hold default placeholder val
     */
    private function getDefaultPlaceHolderArray(): array
    {
        $defaultPlaceHolderArray = [
            self::MODULE_APP_NAME_PLACEHOLDER => $this->buildModuleAppName(),
            self::MODULE_LCC_NAME_PLACEHOLDER => $this->jsModuleLCCName
        ];
        return $defaultPlaceHolderArray;
    }

    // </editor-fold>
    private function buildHeaderJSModule()
    {}

    // private function buildListJSModule() {
    //
    // }
    private function buildFormJSModule($defaultPlaceHolderArray)
    {
        $defaultPlaceHolderArray[self::MODULE_UCC_NAME_PLACEHOLDER] = $this->jsModuleUCCName;
        $defaultPlaceHolderArray[self::NG_MODEL_KEY_PLACEHOLDER] = $this->buildNGModelContainer();
        $defaultPlaceHolderArray[self::FORM_CONFIGURATIONS_DETAILS_PLACEHOLDER] = $this->buildFormConf();
        $defaultPlaceHolderArray[self::FORM_METHOD_NAMES_PLACEHOLDER] = "";
        $defaultPlaceHolderArray[self::PRE_SUBMIT_CONF_PLACEHOLDER] = $this->buildPreSubmitConf();
        // $defaultPlaceHolderArray[self::TRUE_GET_LISTENERS_CASES_PLACEHOLDER] = $this->buildTrueGetListener();
        // $defaultPlaceHolderArray[self::FALSE_GET_LISTENERS_CASES_PLACEHOLDER] = $this->buildFalseGetListener();
        $this->writeFile($this->replaceTemplatePlaceHolderWithVal(self::FORM_TEMPLATE_NAME, $defaultPlaceHolderArray));
    }

    private function buildNGModelContainer()
    {
        $builtNGModelContainer = [];
        try {
            $ngModelCont = $this->jsonConf['ngModelCont'];
            foreach ($ngModelCont as $key => $val) {
                switch ($val) {
                    case "chips":
                        array_push($builtNGModelContainer, $key . ":[]");
                        break;
                    case "date":
                        array_push($builtNGModelContainer, $key . ": new Date()");
                        break;
                    case "upload":
                        array_push($builtNGModelContainer, $key . ":[]");
                        break;
                    case "array":
                        array_push($builtNGModelContainer, $key . ":[]");
                        break;
                    default:
                        break;
                }
            }
        } catch (Exception $exc) {} finally {
            return join($builtNGModelContainer, ",");
        }
    }

    private function buildFormConf()
    {
        $builtFormConf = "";
        try {
            $formConf = $this->jsonConf['formConfDetails'];
            foreach ($formConf as $key => $val) {
                $builtFormConf .= "formConfigurations[" . $key . "]=\"" . $val . "\";";
            }
        } catch (Exception $exc) {} finally {
            return $builtFormConf;
        }
    }

    private function buildPreSubmitConf()
    {
        $builtPreSubmitConf = "";
        try {
            $preSubmitConf = $this->isKeyExistsInJSONConf("preSubmitConf") ? $this->jsonConf['preSubmitConf'] : "";
            if (Kahoutility::checkArrayParam($preSubmitConf)) {
                $builtPreSubmitConf = [];
                foreach ($preSubmitConf as $value) {
                    switch ($this->jsonConf['ngModelCont'][$value]) {
                        case "chips":
                            array_push($builtPreSubmitConf, $value . ": NG_MODEL_DATA_TYPE_CHIPS");
                            break;
                        case "date":
                            array_push($builtPreSubmitConf, $value . ": NG_MODEL_DATA_TYPE_DATE");
                            break;
                        case "array":
                            array_push($builtPreSubmitConf, $value . ": NG_MODEL_DATA_TYPE_ARRAY");
                            break;
                        case "object":
                            array_push($builtPreSubmitConf, $value . ": NG_MODEL_DATA_TYPE_SELECT_OBJECT");
                            break;
                        default:
                            break;
                    }
                }
                $builtPreSubmitConf = "var processedFilterNGModelConf = {" . join($builtPreSubmitConf, ",") . "};";
                $builtPreSubmitConf .= "ngModelData = this._kahoFormService.getProcessedNGModelVal(this, processedFilterNGModelConf);";
            }
        } catch (Exception $exc) {} finally {
            return $builtPreSubmitConf;
        }
    }

    private function buildTrueGetListener()
    {}

    private function buildFalseGetListener()
    {}

    private function buildWSServiceJSModule($defaultPlaceHolderArray)
    {
        $defaultPlaceHolderArray[self::MODULE_UCC_NAME_PLACEHOLDER] = $this->jsModuleUCCName;
        $defaultPlaceHolderArray[self::SERVICE_METHOD_DETAILS_PLACEHOLDER] = $this->buildWSServiceMethodString();
        $this->writeFile($this->replaceTemplatePlaceHolderWithVal(self::SERVICE_TEMPLATE_NAME, $defaultPlaceHolderArray));
    }

    private function buildWSServiceMethodString()
    {
        $builtWSServiceMethodString = "";
        try {
            $serviceMethodDetails = $this->jsonConf['serviceMethodDetails'];
            $placeHolderArray = [
                self::MODULE_LCC_NAME_PLACEHOLDER => $this->jsModuleLCCName
            ];
            if (Kahoutility::checkArrayParam($serviceMethodDetails)) {
                foreach ($serviceMethodDetails as $serviceMethodArray) {
                    $placeHolderArray[self::METHOD_NAME_PLACEHOLDER] = $serviceMethodArray['methodName'];
                    $placeHolderArray[self::METHOD_PARAMS_PLACEHOLDER] = $this->isKeyExistsInJSONConf("isParams", $serviceMethodArray) && $serviceMethodArray['isParams'] === true ? ",params" : "";
                    $placeHolderArray[self::WS_ACTION_TYPE_PLACEHOLDER] = $this->getWSActionType($serviceMethodArray['actionType']);
                    $placeHolderArray[self::WS_METHOD_URL_PLACEHOLDER] = $this->getWSURL($serviceMethodArray['methodURLName']);
                    $placeHolderArray[self::WS_METHOD_RESPONSEKEY_PLACEHOLDER] = $this->getWSURLResponseKey($serviceMethodArray['methodResponseKey']);
                    $builtWSServiceMethodString .= $this->replaceTemplatePlaceHolderWithVal(self::SERVICE_METHOD_TEMPLATE_NAME, $placeHolderArray);
                }
            }
        } catch (Exception $exc) {} finally {
            return $builtWSServiceMethodString;
        }
    }

    private function getWSURL($methodURLName)
    {
        $moduleBaseURL = $this->jsonConf['moduleBaseURL'];
        $wsURL = "BASE_URL_CONSTANTS" . "." . $moduleBaseURL . ".url." . $methodURLName;
        return $wsURL;
    }

    private function getWSURLResponseKey($methodURLResponseKey)
    {
        $moduleBaseURL = $this->jsonConf['moduleBaseURL'];
        $wsURLResponseKey = "BASE_URL_CONSTANTS" . "." . $moduleBaseURL . ".responseKey." . $methodURLResponseKey;
        return $wsURLResponseKey;
    }

    private function getWSActionType($actionType)
    {
        $wsActionType = "";
        switch ($actionType) {
            case "list":
                $wsActionType = "getListRecord";
                break;
            case "get":
                $wsActionType = "get";
                break;
            case "post":
                $wsActionType = "getHttpPostRecord";
                break;
            case "add":
                $wsActionType = "addRecord";
                break;
            case "update":
                $wsActionType = "updateRecord";
                break;
            case "delete":
                $wsActionType = "deleteRecord";
                break;
            case "upload":
                $wsActionType = "uploadAttachment";
                break;
            default:
                break;
        }
        return $wsActionType;
    }

    private function buildRouterJSModule($defaultPlaceHolderArray)
    {
        $defaultPlaceHolderArray[self::STATE_CONF_DETAILS_PLACEHOLDER] = $this->buildRouterStateString();
        $this->writeFile($this->replaceTemplatePlaceHolderWithVal(self::ROUTER_TEMPLATE_NAME, $defaultPlaceHolderArray));
    }

    private function buildRouterStateString()
    {
        $builtRouterStateString = "";
        $placeHolderArray = [
            self::MODULE_NAME_PLACEHOLDER => $this->jsModuleName,
            self::STATE_NAME_PLACEHOLDER => ""
        ];
        try {
            // $stateRouterStr = $this->getTemplateCont(self::STATE_TEMPLATE_NAME);
            // $headerIncludeViewPath = $this->isKeyExistsInJSONConf("headerPath") ? $this->jsonConf['headerPath'] : "";
            // $listIncludeViewPath = $this->isKeyExistsInJSONConf("listIncludeViewFileName") ? $this->jsonConf['listIncludeViewFileName'] : "";
            // $formIncludeViewPath = $this->isKeyExistsInJSONConf("formIncludeViewFileName") ? $this->jsonConf['formIncludeViewFileName'] : "";
            // if (Kahoutility::isStringParamValid($headerIncludeViewPath)) {
            $placeHolderArray[self::MODULE_TYPE_PLACEHOLDER] = "header";
            $placeHolderArray[self::VIEW_TYPE_BY_MODULE_TYPE_PLACEHOLDER] = $this->getViewTypeByModuleType("header");
            $builtRouterStateString .= $this->replaceTemplatePlaceHolderWithVal(self::STATE_TEMPLATE_NAME, $placeHolderArray) . "})";
            // }
            // if (Kahoutility::isStringParamValid($listIncludeViewPath)) {
            $placeHolderArray[self::MODULE_TYPE_PLACEHOLDER] = "list";
            $placeHolderArray[self::VIEW_TYPE_BY_MODULE_TYPE_PLACEHOLDER] = $this->getViewTypeByModuleType("list");
            $placeHolderArray[self::STATE_NAME_PLACEHOLDER] = ".detail";
            $builtRouterStateString .= $this->replaceTemplatePlaceHolderWithVal(self::STATE_TEMPLATE_NAME, $placeHolderArray) . "})";
            // }
            // if (Kahoutility::isStringParamValid($formIncludeViewPath)) {
            $placeHolderArray[self::MODULE_TYPE_PLACEHOLDER] = "form";
            $placeHolderArray[self::VIEW_TYPE_BY_MODULE_TYPE_PLACEHOLDER] = $this->getViewTypeByModuleType("form");
            $placeHolderArray[self::STATE_NAME_PLACEHOLDER] = ".detail.compose";
            $builtRouterStateString .= $this->replaceTemplatePlaceHolderWithVal(self::STATE_TEMPLATE_NAME, $placeHolderArray) . "})";
            // }
        } catch (Exception $ex) {} finally {
            return $builtRouterStateString;
        }
    }

    // <editor-fold defaultstate="collapsed" desc="getViewTypeByModuleType">
    /**
     * desc will return the view type like header,list and form view by module type
     * 
     * @return string will return the view type by module type
     */
    private function getViewTypeByModuleType($jsModuleType = null)
    {
        $viewTypeByModuleType = "";
        $jsModuleType = $jsModuleType ?? $this->jsModuleType;
        switch ($jsModuleType) {
            case "form":
                $viewTypeByModuleType = "Compose";
                break;
            case "list":
                $viewTypeByModuleType = "List";
                break;
            case "header":
                $viewTypeByModuleType = "Header";
                break;
        }
        return $viewTypeByModuleType;
    }

    // </editor-fold>
    private function buildModuleNameByCamelCaseType()
    {
        try {
            if (Kahoutility::isStringParamValid($this->jsModuleName)) {
                $moduelNameArray = explode(" ", $this->jsModuleName);
                $jsUCCModuleName = "";
                $jsLCCModuleName = "";
                array_map(function ($moduleName) use (&$jsUCCModuleName, &$jsLCCModuleName) {
                    if (Kahoutility::isStringParamValid($jsUCCModuleName)) {
                        $jsUCCModuleName .= $moduleName;
                    } else {
                        $jsUCCModuleName = $moduleName;
                    }
                    if (Kahoutility::isStringParamValid($jsLCCModuleName)) {
                        $jsLCCModuleName .= $moduleName;
                    } else {
                        $jsLCCModuleName = lcfirst($moduleName);
                    }
                }, $moduelNameArray);
                $this->jsModuleLCCName = $jsLCCModuleName;
                $this->jsModuleUCCName = $jsUCCModuleName;
                $this->jsModuleName = strtolower($jsUCCModuleName);
            } else {}
        } catch (Exception $exc) {}
    }

    private function writeFile($fileContent)
    {
        try {
            $fileName = $this->getFileName() . ".js";
            $filePath = "assets/js_module_upload/" . $fileName;
            $fopen = fopen($filePath, "w+");
            if ($fopen) {
                flock($fopen, LOCK_EX);
                fwrite($fopen, $fileContent);
                flock($fopen, LOCK_UN);
                fclose($fopen);
                chmod($filePath, 0777);
            } else {
                die('could not write the file');
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        } finally {
            Kahoutility::downloadFile($filePath, "");
        }
    }

    // <editor-fold defaultstate="collapsed" desc="getModuleAppName">
    /**
     * desc will return the module app name
     * 
     * @return string
     */
    private function buildModuleAppName(): string
    {
        $builtModuleAppName = $this->jsModuleNamePrefix;
        $builtModuleAppName .= strtolower($this->jsModuleUCCName);
        return $builtModuleAppName;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getFileName">
    /**
     * desc will return the file name based on module type
     */
    private function getFileName()
    {
        $fileName = "";
        try {
            switch ($this->jsModuleType) {
                case "module":
                    $fileName = strtolower($this->jsModuleLCCName) . "." . self::MOD_LABEL;
                    break;
                case "router":
                    $fileName = strtolower($this->jsModuleLCCName) . "." . self::ROUTER_LABEL;
                    break;
                case "form":
                    $fileName = "Compose" . $this->jsModuleUCCName . self::CTRL_LABEL;
                    break;
                case "list":
                    $fileName = $this->jsModuleUCCName . self::CTRL_LABEL;
                    break;
                case "header":
                    $fileName = $this->jsModuleUCCName . "Header" . self::CTRL_LABEL;
                    break;
                case "service":
                    $fileName = $this->jsModuleUCCName . self::SERV_LABEL;
                    break;
            }
        } catch (Exception $exc) {} finally {
            return $fileName;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="replaceTemplatePlaceHolderWithVal">
    /**
     * desc will
     * 
     * @param type $templateName
     * @param type $placeHolderValArray
     */
    private function replaceTemplatePlaceHolderWithVal($templateName, $placeHolderValArray)
    {
        $replaceTemplatePlaceHolderWithVal = NULL;
        try {
            if (Kahoutility::isStringParamValid($templateName) && Kahoutility::checkArrayParam($placeHolderValArray)) {
                $moduleTempCont = $this->getTemplateCont($templateName);
                $replaceTemplatePlaceHolderWithVal = str_replace(array_keys($placeHolderValArray), array_values($placeHolderValArray), $moduleTempCont);
                $replaceTemplatePlaceHolderWithVal = str_replace("%", "", $replaceTemplatePlaceHolderWithVal);
            }
        } catch (Exception $exc) {} finally {
            return $replaceTemplatePlaceHolderWithVal;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getTemplateCont">
    /**
     * desc will return the cont from template
     */
    private function getTemplateCont($templateName)
    {
        $templateBasePath = "application/libraries/buildjsmodule/" . $templateName;
        return file_get_contents($templateBasePath);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="isKeyExistsInJSONConf">
    /**
     * desc will check that key exists in json conf or not
     * 
     * @param string $jsonConfKey
     */
    private function isKeyExistsInJSONConf(string $jsonConfKey, $jsonConf = null): bool
    {
        $isKeyExistsInJSONConf = FALSE;
        $jsonConf = $jsonConf ?? $this->jsonConf;
        try {
            if (Kahoutility::isStringParamValid($jsonConfKey) && array_key_exists($jsonConfKey, $jsonConf)) {
                $isKeyExistsInJSONConf = TRUE;
            }
        } catch (Exception $exc) {} finally {
            return $isKeyExistsInJSONConf;
        }
    }
    
    // </editor-fold>
}
