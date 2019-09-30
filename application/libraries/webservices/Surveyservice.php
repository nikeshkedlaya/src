<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Announcementservice
 *
 * @author KaHO
 */
class Surveyservice extends Kahoservices
{

    // put your code here
    public function __construct()
    {
        parent::__construct();
    }

    public function getSurveyList()
    {
        $params = $this->getPostParams();
        $this->addAYCodeAsFirstParam($params)
            ->setDefaultValueIfPostValNotFound($params, "userCode", $this->userCode, 2)
            ->mergePaginationParamsToSPParams($params);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getSurveyDetail()
    {
        $params = $this->getPostParams(); // Survey_ID
        $dbResponse = $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->getResponse();
        if ($this->kahoCrudServices->isDBOperationSuccess()) {
            $convertXMLTOArray = $this->convertObservationTemplateXMLToArray($dbResponse[0]["XMLData"]);
            $this->kahoCrudServices->printResponse($convertXMLTOArray, true, "getSurveyDetail");
        } else {
            $this->kahoCrudServices->printResponse(NULL, FALSE, "getSurveyDetail");
        }
    }

    private function convertObservationTemplateXMLToArray($XMLData)
    {
        $xml = simplexml_load_string($XMLData);
        settype($xml, "array");
        $json['SurveyForm'] = json_decode(json_encode($xml), true);
        if (isset($json['SurveyForm']['Root']['Heading']) === true) {
            $json['SurveyForm']['Root'][] = $json['SurveyForm']['Root'];
            unset($json['SurveyForm']['Root']['Heading']);
            unset($json['SurveyForm']['Root']['Field']);
        }
        foreach ($json['SurveyForm']['Root'] as &$val) {
            if (key_exists("Description", $val['Field']) === true) {
                $val['Field'] = array(
                    $val['Field']
                );
            }
        }
        return $json;
    }

    public function addSurveyInstance()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)
            ->changeAllParamsPosition($params, [
            'Survey_ID',
            'Title',
            'Expiry_Date',
            'Trigger_Date',
            'Members'
        ], 2)
            ->processInputParams($params, [
            'Members' => [
                "Kahoutility::splitArrayByDelimiter"
            ]
        ]);
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getSurveyTemplateForUser()
    {
        $params = $this->getPostParams();
        $this->setDefaultValueIfPostValNotFound($params, "userCode", $this->userCode, 1)->changeAllParamsPosition($params, [
            'Survey_Instance_ID',
            'IsTaken'
        ], 2);
        $conf = [
            Respstructurebuilder::CALLBACK_KEY => [
                [
                    $this,
                    "convertXML"
                ]
            ]
        ];
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse($conf);
    }

    public function convertXML($resp)
    {
        $resp['User_Input'] = Kahoutility::convertXMLToArrayCallback($resp, "User_Input")['User_Input'];
        $resp['XMLData'] = $this->convertObservationTemplateXMLToArray($resp['XMLData']);
        return $resp;
    }

    public function addSurveyUserInput()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)->changeAllParamsPosition($params, [
            'Survey_Instance_ID',
            'userCode',
            'Input'
        ]);
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getSurveyListForUser()
    {
        $params = $this->getPostParams();
        $this->addAYCodeAsFirstParam($params)
            ->setDefaultValueIfPostValNotFound($params, "userCode", $this->userCode, 2)
            ->setDefaultValueIfPostValNotFound($params, "userType", $this->userType, 3)
            ->mergePaginationParamsToSPParams($params);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getSurveyInstanceList()
    {
        $params = $this->getPostParams(); // Survey_ID
        $this->addAYCodeAsFirstParam($params)->setDefaultValueIfPostValNotFound($params, "userCode", $this->userCode, 2);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getSurveyUserInputList()
    {
        $params = $this->getPostParams();
        $this->mergePaginationParamsToSPParams($params);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }
}
