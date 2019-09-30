<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Kahoadminservices
 *
 * ***** KaHO Services *****
 * 1) would be abstract level service class to get extended by child service class like teacherservice and student service
 *
 *
 * ***** kaho magic crud operation rule for admin crud operation
 * 1) can perform the crud operation without adding the explicit service method
 * 2) controller method just have to call the predefined key as method see ACTION_TYPE for more info
 * 3) magic method __call will invoke the crud method like addRecord,updateRecord,deleteRecord
 * 4)
 */
include_once APPPATH . "libraries/Kahoservices.php";

class Kahoadminservices extends Kahoservices {

    public function __construct() {
        parent::__construct();
    }

    // <editor-fold defaultstate="collapsed" desc="loadLanguageFile">
    /**
     * will load the language file
     */
    // public function loadLanguageFile(): void {
    //
    // }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getControllerName">
    public function getControllerName($stackTraceIndex = 10) {
        return parent::getControllerName($stackTraceIndex);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="loadProceduresConfiguration">
    /**
     * @overridden
     */
    public function loadProceduresConfiguration(string $adminProceduresDirectory = ADMIN_PROCEDURES_CONFIGURTIONS_KEYWORD): void {
        parent::loadProceduresConfiguration($adminProceduresDirectory);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getGridListConfForProcessingDBResponse">
    /**
     * will return the configuration to process the db response, would be usuually used for multiple result set
     *
     * @param string $columnCode
     * @return array
     */
    protected function getGridListConfForProcessingDBResponse(string $columnCode): array {
        $conf = array(
            "row_count" => NULL,
            "column_configuration" => array(
                Respstructurebuilder::CALLBACK_KEY => array(
                    "convertXMLToArrayCallback",
                    "Column_Conf",
                    true
                )
            )
        );
        $conf["grid_list"] = array(
            $columnCode => Respstructurebuilder::SHOW_ALL_KEY
        );
        return $conf;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="processGridListParams">
    /**
     * will build the typical grid list, would be used specially for admin grid request, will add the param if value exists
     */
    protected function processGridListParams() {
        $gridListParams = [];
        $gridListParams['School_Code'] = Kahoutility::getCISessionValueByKey("School_Code");
        if (checkArrayParam($whereClause = $this->getPostParams())) {
            $gridListParams['whereClause'] = $this->buildWildCardSearchingStr($whereClause);
        }
        $getData = $this->getUriSegments();
        $from = (int) current($getData);
        $to = (int) next($getData);
        $sortData = end($getData);
        $gridListParams['sort_data'] = $this->buildSortParams($sortData);
        $gridListParams['from'] = $this->getRecordLimitRange($from, $to);
        $gridListParams['to'] = $to;
        // print_r($gridListParams);
        return $gridListParams;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="buildSortParams">
    protected function buildSortParams($sortData) {
        $sortParams = "";
        if (isStringParamValid($sortData)) {
            if (!$sortData === "1") {
                $sortParams = $this->buildSortingByStr($sortData);
            } else {
                $sortParams = "";
            }
        }
        return $sortParams;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getRecordLimitRange">
    /**
     * will return the from value
     *
     * @param type $pageNo
     * @param type $noOfRecordPerPage
     * @return type
     */
    protected function getRecordLimitRange($pageNo = 1, $noOfRecordPerPage = 10) {
        $from = $pageNo === 1 ? 1 : (($pageNo - 1) * $noOfRecordPerPage);
        return $from;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="buildSortingByStr">
    /**
     * will build the soring str as procedure is expecting
     *
     * @param string $sortingVal
     * @return string
     */
    protected function buildSortingByStr(string $sortingVal): string {
        $sortingStr = "";
        if (isStringParamValid($sortingVal)) {
            $sortingStr = current(str_replace(array(
                "-",
                "~"
                            ), array(
                " ",
                ","
                            ), array(
                $sortingVal
            )));
        }
        return $sortingStr;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="buildWildCardSearchingStr">
    /**
     * will build the wild card searching str
     *
     * @param type $data
     * @return type
     */
    protected function buildWildCardSearchingStr($data) {
        $wildCardSearchingStr = "";
        if (Kahoutility::checkArrayParam($data) && Kahoutility::isStringParamValid($data['search_column_name_list']) && Kahoutility::isStringParamValid($data['wild_card_name_list'])) {
            $wildCardSearchingStr .= $data['search_column_name_list'] . " like ";
            $wildCardSearchingStr .= $data['wild_card_name_list'] === "starts" ? "'" . $data['search_text'] . "%'" : ($data['wild_card_name_list'] === "ends" ? "'%" . $data['search_text'] . "'" : "'%" . $data['search_text'] . "%'");
        }
        return $wildCardSearchingStr;
    }

    // </editor-fold>
    public function getUriSegments(int $segmentCnt = 4): array {
        return parent::getUriSegments($segmentCnt);
    }

    protected function callGridListMethod($spName, $spParams, $columnCode) {
        $this->kahoCrudServices->getRecord($spName, $spParams)->sendResponse($this->getGridListConfForProcessingDBResponse($columnCode), true, true);
    }

    protected function processUploadedCSV() {
        $this->ciLibrary->load->library("uploadcsvdataprocessor");
        $processedResp = $this->ciLibrary->uploadcsvdataprocessor->processCSV($this->controllerName, $this->kahoCrudServices);
        if ($this->ciLibrary->uploadcsvdataprocessor->isProcessedCSVSuccessful()) {
            $params = [];
            $params['School_Code'] = Kahoutility::getCISessionValueByKey("School_Code");
            $this->addUserCodeAsFirstParam($params)->addDefaultParamToSPParams($params, "Path", $processedResp[ATTACHMENT_FILE_ORIGINAL_NAME_KEY])
                    ->addDefaultParamToSPParams($params, "School_Code", "", 3);
            $this->kahoCrudServices->addRecord($this->getProcedureName(4), $params)
                    ->sendResponse();
        } else {
            $this->kahoCrudServices->printResponse($processedResp, TRUE, Kahoutility::getCallieFunctionName(3), NULL, Kahocrudservices::RESPONSE_FOUND);
        }
    }

    protected function downloadTemplate(string $fileName = NULL) {
        Kahoutility::getCILibrary()->load->helper("download");
        $fileName = ($fileName ?? ($this->getControllerName() . ".csv"));
        $downloadableCSVFilePath = getcwd() . "/assets/site/csv_template/" . $fileName;
        if (file_exists($downloadableCSVFilePath)) {
            $data = file_get_contents($downloadableCSVFilePath);
            force_download($fileName, $data);
        } else {
            show_404($downloadableCSVFilePath);
        }
    }

}
