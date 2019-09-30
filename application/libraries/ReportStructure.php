<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ReportStructure
 * will build the report structure coming from database
 * 
 * @author KaHO
 */
class Reportstructure
{

    // private $reportBodyData; // will assign the db response which would be actually a report data to be shown on view;
    private $reportData;
 // will hold the all result set response coming from db including configuration and body data
    private $ciLibrary;

    // private $reportConfiguration; // will store the report configuration which is usually a first db result set, will contain the many configuration such as column_name,max row,min row
    private $reportDataContainer = array();
 // will contain the data which holds multiple object based on configuration such as column_details object,max row object,min row object and report body object and so on
    
    /* configuration key names coming frm db */
    const COLUMN_CONF = "Column_Conf";

    const REPORT_BODY_STRUCT_CONF = "Report_Body_Struct_Conf";

    /* report data container key names for built object */
    const COLUMN_OBJECT_KEY_NAME = "column_details";

    const REPORT_BODY_KEY_NAME = "report_details";

    public function __construct()
    {
        $this->ciLibrary = GetCILibrary();
        $this->ciLibrary->load->library("respstructurebuilder", NULL, "respBuilder");
    }

    private function getReportConfiguration()
    {
        return (isset($this->reportData[0][0]) && ! empty($this->reportData[0][0])) ? $this->reportData[0][0] : []; // will return the all configuration column value coming from db response such as table column, max row,min row
    }

    private function getReportBodyData()
    { // will return the get report body data coming from db
        return (isset($this->reportData[1]) && ! empty($this->reportData[1])) ? $this->reportData[1] : [];
    }

    public function buildReportStructure($reportData)
    { // is a gateway method for callie to call and pass the report data came from db
        $this->reportData = $reportData;
        $this->reportTemplateMethod();
        return $this;
    }

    public function getBuiltReportStructure()
    {
        return $this->reportDataContainer;
    }

    private function reportTemplateMethod()
    { // is template method pattern as behavioral design pattern
        $this->buildConfigurationObject();
        $this->buildReportBodyObject();
    }

    private function buildConfigurationObject()
    { // will build the as many array object as many column found inside configuration db response which would be usually first result set
        $this->buildColumnObject();
    }

    private function buildColumnObject()
    { // will build the column array object that used to used to build the column name at client side such as column name,is column sortable,what value should be assigned inside column
        $columnConf = NULL;
        try {
            if (! empty($columnConf = $this->getReportConfByKey(self::COLUMN_CONF))) {
                $columnConfArray = ! empty($this->convertXMLTOArray($columnConf)) ? $this->convertXMLTOArray($columnConf)["columnDetails"] : "";
                $columnArrayObj = $this->buildArrayStructure(convertObjToArray($columnConfArray));
                $this->putInReportDataContainer(self::COLUMN_OBJECT_KEY_NAME, $columnArrayObj);
            } else {
                throw new Exception("there is no column configuration found");
            }
        } catch (Exception $ex) {}
    }

    private function putInReportDataContainer($key, $arrayData = [])
    { // will store the built object like column obj,max object,min object in reportDataContainer $key would be the array key in report data container prop and $arrayData would be value of respective key
        try {
            if (! empty($key)) {
                $this->reportDataContainer[$key] = $arrayData;
            } else {
                throw new Exception("key is empty,can't store in array data container");
            }
        } catch (Exception $ex) {}
    }

    private function getReportConfByKey($confKey)
    { // will return the conf column which is coming from db based on $confKey which is actually a column key
        $columnConf;
        try {
            if (! empty($confKey)) {
                if (! empty($columnConf = $this->getReportConfiguration())) {
                    $columnConf = (isset($columnConf[$confKey]) && ! empty($columnConf[$confKey])) ? $columnConf[$confKey] : "";
                } else {
                    throw new Exception("no column conf found");
                }
            } else {
                throw new Exception("column conf key name not found");
            }
        } catch (Exception $ex) {} finally {
            return $columnConf;
        }
    }

    private function buildReportBodyObject()
    { // will build the report body object using respstructure builder and based on report body struct conf
        try {
            $reportBodyResp = $this->getReportBodyData();
            if (! empty($reportBodyResp)) {
                $reportBodyConfig = []; // $this->getReportConfByKey(self::REPORT_BODY_STRUCT_CONF);
                $builtBodyArray = $this->buildArrayStructure($reportBodyResp, $reportBodyConfig);
                $this->putInReportDataContainer(self::REPORT_BODY_KEY_NAME, $builtBodyArray);
            } else {
                throw new Exception("there is no body data found");
            }
        } catch (Exception $ex) {}
    }

    private function convertXMLTOArray($xmlData)
    {
        $arrayData = "";
        try {
            if (! empty($xmlData)) {
                $arrayData = convertXMLToArray($xmlData);
            }
        } catch (Exception $ex) {} finally {
            return $arrayData;
        }
    }

    private function buildArrayStructure($arrayData, $configuration = [])
    { // will use the respstructurebuild class to build the report body
        return $this->ciLibrary->respBuilder->buildResponse($arrayData, $configuration)->getBuiltResponse();
    }
}
