<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Markservice extends Kahoadminservices
{

    public function __construct()
    {
        parent::__construct();
    }

    public function downloadMarksTemplate()
    {
        $params = array_values($this->getUriSegments());
        $studentResp = $this->getStudentListForMarkByAssessmentDetailSection(current($params));
        if (! $this->kahoCrudServices->isDBOperationSuccess()) {
            $this->kahoCrudServices->printResponse(NULL, FALSE, Kahoutility::getCallieFunctionName(2));
        } else {
            $fileName = "mark_template_" . end($params) . "_" . time() . ".csv";
            $file = fopen(getcwd() . "/assets/site/csv_template/" . $fileName, "w");
            foreach ($studentResp as $val) {
                fputcsv($file, $val);
            }
            $this->downloadTemplate($fileName);
        }
    }

    private function getStudentListForMarkByAssessmentDetailSection($assessmentDetailSectionID)
    {
        $studentResp = $this->kahoCrudServices->getRecord($this->getProcedureName(), [
            "id" => $assessmentDetailSectionID
        ])
            ->getResponse();
        return $studentResp;
    }

    public function marksUpload()
    {
        $this->ciLibrary->load->library("uploadcsvdataprocessor");
        $processedResp = $this->ciLibrary->uploadcsvdataprocessor->processCSV($this->controllerName, $this->kahoCrudServices);
        if ($this->ciLibrary->uploadcsvdataprocessor->isProcessedCSVSuccessful()) {
            $params = [];
            $fileName = $processedResp[ATTACHMENT_FILE_ORIGINAL_NAME_KEY];
            $assessmentDetailSectionID = explode("_", $fileName)[8];
            $this->addUserCodeAsFirstParam($params)
                ->addDefaultParamToSPParams($params, "Assessment_Detail_Section_ID", $assessmentDetailSectionID, 2)
                ->addDefaultParamToSPParams($params, "Path", $fileName, 3);
            $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
                ->sendResponse();
        } else {
            $processedResp = [
                'err_mes' => $processedResp
            ];
            $this->kahoCrudServices->printResponse($processedResp, TRUE, Kahoutility::getCallieFunctionName(2), NULL, Kahocrudservices::RESPONSE_FOUND);
        }
    }

    public function marksForAssessmentDetailGet()
    {
        $params = $this->getPostParams(); // Assessment_Detail_Section_ID
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function marksAddOrUpdate()
    {
        $params = $this->getPostParams();
        $params['MarksDetail'] = $this->buildMarkDetailStructure($params['MarksDetail']);
        $this->addUserCodeAsFirstParam($params)->changeAllParamsPosition($params, [
            "Assessment_Detail_Section_ID",
            "MarksDetail"
        ], 2);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    private function buildMarkDetailStructure($marksDetail): string
    {
        $builtMarkDetailStructure = "";
        if (Kahoutility::checkArrayParam($marksDetail)) {
            foreach ($marksDetail as $key => $val) {
                if (Kahoutility::isStringParamValid($builtMarkDetailStructure)) {
                    $builtMarkDetailStructure .= "|" . $key . "~" . $val;
                } else {
                    $builtMarkDetailStructure = $key . "~" . $val;
                }
            }
        }
        return $builtMarkDetailStructure;
    }
}