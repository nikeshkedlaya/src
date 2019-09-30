<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Uploadcsvdataprocessor
 *
 * @author KaHO
 */
class Uploadcsvdataprocessor
{

    // put your code here
    private $ciLibrary;

    private $moduleName;

    private $csvFilesArray;

    private $isProcessCSVSuccessful;

    private $kahocrudservices;

    const CSV_FILE_ATTACHMENT_KEY = "attachment";

    public function __construct()
    {
        $this->ciLibrary = Kahoutility::getCILibrary();
        $this->csvFilesArray = $_FILES;
        $this->isProcessCSVSuccessful = true;
    }

    public function processCSV(string $moduleName, Kahocrudservices $kahocrudservices)
    {
        $this->moduleName = $moduleName;
        $this->kahocrudservices = $kahocrudservices;
        return $this->validateCSVData();
    }

    public function isProcessedCSVSuccessful()
    {
        return $this->isProcessCSVSuccessful;
    }

    private function uploadCSVFile()
    {
        $this->ciLibrary->load->library("processattachmentservice");
        $uploadedFileDetails = $this->ciLibrary->processattachmentservice->processAttachment($this->csvFilesArray, $this->moduleName, self::CSV_FILE_ATTACHMENT_KEY, WORKING_DIRECTORY_ADMIN_KEY);
        if (Kahoutility::checkArrayParam($uploadedFileDetails)) {
            $this->kahocrudservices->executeInlineQuery($this->buildInlineQuery($uploadedFileDetails));
        } else {
            $uploadedFileDetails = [
                'there is an error to upload'
            ];
        }
        return $uploadedFileDetails;
    }

    private function validateCSVData()
    {
        $errorMessage = [];
        $csvData = $this->getCSVData();
        if (Kahoutility::checkArrayParam($csvData)) {
            $this->ciLibrary->load->library("validatecsvcontent", [
                $this->moduleName,
                $csvData
            ]);
            $errorMessage = $this->ciLibrary->validatecsvcontent->validateCSV();
            if (Kahoutility::checkArrayParam($errorMessage)) {
                $this->isProcessCSVSuccessful = FALSE;
            } else {
                $errorMessage = $this->uploadCSVFile();
            }
        } else {
            array_push($errorMessage, "csv file is either empty or not in right format");
        }
        return $errorMessage;
    }

    // <editor-fold defaultstate="collapsed" desc="buildInlineQuery">
    /**
     *
     * @param string $tableName
     *            is a temp table name
     * @param type $columnDetails
     *            would be $columnDetails
     * @return type
     */
    private function buildInlineQuery($uploadingAttachment)
    {
        $tableName = "temp" . $this->moduleName;
        $uploadingPath = getcwd() . "/" . Kahoutility::getClientWD(WORKING_DIRECTORY_ADMIN_KEY, $this->moduleName) . "/" . $uploadingAttachment[ATTACHMENT_NAME_KEY];
        chmod($uploadingPath, 0777);
        $builtInlineQuery = "truncate {$tableName};";
        $builtInlineQuery .= "LOAD DATA LOCAL INFILE '{$uploadingPath}' INTO TABLE {$tableName} fields terminated by ',' enclosed by '\"' lines terminated by '\r\n' ignore 1 rows";
        return $builtInlineQuery;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="validateCSVContentByRule">
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getBulkErrorMessage">
    /**
     * desc will
     * 
     * @param type $errorMessage
     * @return string
     */
    private function getBulkErrorMessage($errorMessage)
    {
        $errorMes = "";
        foreach ($errorMessage as $key => $val) {
            array_walk($val, function ($vals, $keys) use ($key, &$errorMes) {
                if (empty($vals) === FALSE) {
                    $errorMes .= $vals . " on line no " . ($keys + 1) . " on column name " . $key . "<br/>\n";
                }
            });
        }
        return $errorMes;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getCSVData">
    /**
     * desc will return the csv data
     * 
     * @param type $attachedFileArray
     * @return type
     */
    private function getCSVData()
    {
        $uploadedCSVTempPath = $this->csvFilesArray[self::CSV_FILE_ATTACHMENT_KEY]['tmp_name'];
        $csvContent = file($uploadedCSVTempPath);
        $csvData = Kahoutility::checkArrayParam($csvContent) ? array_map('str_getcsv', $csvContent) : "";
        return $csvData;
    }
    
    // </editor-fold>
}
