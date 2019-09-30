<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Sectionacademicyearservice extends Kahoadminservices {

    public function __construct() {
        parent::__construct();
    }

    public function setupGetClassLevel() { // ayCode
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $this->getPostParams())
                ->sendResponse($this->getClassLevelConf(), FALSE, TRUE);
    }

    public function setupGetSelectedClasses() { // ayCode
        $params = $this->getPostParams();
        $params['School_Code'] = Kahoutility::getCISessionValueByKey("School_Code");
        $this->changeAllParamsPosition($params, [
            'ayCode',
            'School_Code'
                ], 1);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
                ->sendResponse($this->getClassLevelConf(), FALSE, TRUE);
    }

    private function getClassLevelConf() {
        $conf = array(
            "Class_Level_Code" => Respstructurebuilder::SHOW_ALL_KEY,
            Respstructurebuilder::GROUP_BY_KEY => "Class_Level_Code"
        );
        return $conf;
    }

    public function setupAddClasses() { // ayCode
        $params = $this->getPostParams();
        $params['School_Code'] = Kahoutility::getCISessionValueByKey("School_Code");
        $this->addDefaultParamToSPParams($params, USER_CODE, $this->ayCode)
                ->processInputParams($params, [
                    'Class_Codes' => [
                        "Kahoutility::splitArrayByDelimiter"
                    ]
                ])
                ->changeAllParamsPosition($params, [
                    'School_Code',
                    AY_CODE,
                    USER_CODE,
                    "Class_Codes"
        ]);

        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

    public function setupGetSectionList() {
        $this->kahoCrudServices->getRecord($this->getProcedureName())
                ->sendResponse();
    }

    public function setupGetSelectedSections() {
        $params = $this->getPostParams();
        $params['School_Code'] = Kahoutility::getCISessionValueByKey("School_Code");
        $this->changeAllParamsPosition($params, [
            'School_Code'
                ], 1);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

    public function setupAddNewSection() {
        $params = $this->getPostParams();
        $params['School_Code'] = Kahoutility::getCISessionValueByKey("School_Code");
        $this->addUserCodeAsFirstParam($params)
                ->changeAllParamsPosition($params, [
                    'School_Code',
                    'Section_Name'
                        ], 2); // Section_Name
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

    public function setupAddSections() {
        $params = $this->getPostParams();
        $params['School_Code'] = Kahoutility::getCISessionValueByKey("School_Code");
        $this->addUserCodeAsFirstParam($params)->processInputParams($params, [
            'Section_Code' => [
                "Kahoutility::splitArrayByDelimiter"
            ]
        ]); // Section_Codes multiple
        $this->changeAllParamsPosition($params, [
            'School_Code',
            'Section_Code'
                ], 2);
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

    public function getSelectedClassSections() {
        $params = $this->getPostParams(); // ayCode
        $params['School_Code'] = Kahoutility::getCISessionValueByKey("School_Code");
        $this->changeAllParamsPosition($params, [
            'ayCode',
            'School_Code'
                ], 1);
        $conf = [
            'Class_Code' => "Class_Name,Class_Code",
            "Section_Code" => 'Section_Code,Section_Name,Section_AY_Code',
            Respstructurebuilder::GROUP_BY_KEY => "Class_Code,Section_Code"
        ];
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
                ->sendResponse($conf, FALSE, TRUE);
    }

    public function setupAddClassSections() {
        $params = $this->getPostParams();
        $params['School_Code'] = Kahoutility::getCISessionValueByKey("School_Code");
        $this->addUserCodeAsFirstParam($params)
                ->addDefaultParamToSPParams($params, "IsOneTime", 1)
                ->changeAllParamsPosition($params, [
                    AY_CODE,
                    USER_CODE,
                    'School_Code',
                    "ClassSection",
                    "IsOneTime"
        ]);
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

    public function setupDeleteSection() {
        $params = $this->getPostParams(); // Section_Code
        $params['School_Code'] = Kahoutility::getCISessionValueByKey("School_Code");
        $this->addUserCodeAsFirstParam($params)
                ->changeAllParamsPosition($params, [
                    'School_Code',
                    "Section_COde"
                        ], 2);
        $this->kahoCrudServices->deleteRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

    public function getClassSectionList() {
        $params = $this->getPostParams(); // ayCode
        $params['School_Code'] = Kahoutility::getCISessionValueByKey("School_Code");
        $this->setDefaultValueIfPostValNotFound($params, AY_CODE, $this->ayCode, 1);
        $this->changeAllParamsPosition($params, [
            'ayCode',
            "School_COde"
                ], 1);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

    // public function getSectionAcademicYearList() {
    // $this->callGridListMethod($this->getProcedureName(), $this->processGridListParams(), "Section_AY_Code");
    // }\
    public function adminSectionAcademicYearGetList() {
        $this->callGridListMethod($this->getProcedureName(), $this->processGridListParams(), "Section_AY_Code");
    }

    public function sectionAcademicYearAdd() {
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $this->getSectionAcademicYearAddNUpdateParams())
                ->sendResponse();
    }

    public function sectionAcademicYearUpdate() {
        $params = $this->getSectionAcademicYearAddNUpdateParams(); // Section_AY_Code
        $this->changeParamsPosition($params, "Section_AY_Code", 2)->changeParamsPosition($params, AY_CODE, 5);
        $this->kahoCrudServices->updateRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

    private function getSectionAcademicYearAddNUpdateParams() {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params)
                ->setDefaultValueIfPostValNotFound($params, AY_CODE, $this->ayCode, 2)
                ->changeAllParamsPosition($params, [
                    'Class_Code',
                    'Section_Code'
                        ], 3);
        return $params;
    }

    public function sectionAcademicYearDelete() {
        $params = $this->getPostParams();
        $this->addAYCodeAsFirstParam($params); // Section_AY_Code
        $this->kahoCrudServices->deleteRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

}
