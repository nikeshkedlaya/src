<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Adminsubjectservice extends Kahoadminservices {

    public function __construct() {
        parent::__construct();
    }

    public function setupGetClassSubjectList() {
        $params = $this->getPostParams();
        $params['School_Code'] = Kahoutility::getCISessionValueByKey("School_Code");
        $this->changeAllParamsPosition($params, [
            'AY_Code',
            'School_Code',
                ], 2);

        $conf = [
            'Class_Code' => 'Class_Code,Class_Name',
            'Subject_Code' => 'Subject_Code,Subject_Name',
            Respstructurebuilder::GROUP_BY_KEY => 'Class_Code,Subject_Code'
        ];
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
                ->sendResponse($conf, FALSE, TRUE);
    }

    public function setupAddNewSubject() {
        $params = $this->getPostParams();
        $params['School_Code'] = Kahoutility::getCISessionValueByKey("School_Code");
        $this->addUserCodeAsFirstParam($params)->changeAllParamsPosition($params, [
            'School_Code',
            'Subject_Name',
            'Short_Name'
                ], 2);
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

    public function setupGetSubjectList() {
        $params = array();
        $params['School_Code'] = Kahoutility::getCISessionValueByKey("School_Code");
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

    public function setupAddSelectedSubject() {
        $params = $this->getPostParams();
        $params['School_Code'] = Kahoutility::getCISessionValueByKey("School_Code");
        $this->addUserCodeAsFirstParam($params)->processInputParams($params, [
            'Subject_Codes' => [
                "Kahoutility::splitArrayByDelimiter"
            ]
        ]); // Subject_Codes separated by |
        $this->changeAllParamsPosition($params, [
            'School_Code',
            'Subject_Codes'
                ], 2);
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

    public function setupDeleteSubject() {
        $params = $this->getPostParams();
        $params['School_Code'] = Kahoutility::getCISessionValueByKey("School_Code");
        $this->addUserCodeAsFirstParam($params)->changeAllParamsPosition($params, [
            'School_Code',
            'Subject_Code'
                ], 2);
        $this->kahoCrudServices->deleteRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

    public function setupAddClassSubjects() {
        $params = $this->getPostParams(); // Class_Subjects
        $params['School_Code'] = Kahoutility::getCISessionValueByKey("School_Code");
        $this->addDefaultParamToSPParams($params, USER_CODE, $this->userCode)
                ->addDefaultParamToSPParams($params, "IsOnetime", 1)
                ->changeAllParamsPosition($params, [
                    AY_CODE,
                    USER_CODE,
                    'School_Code',
                    "Class_Subjects",
                    "IsOnetime"
        ]);
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

    public function adminSubjectGetList() {
        $this->callGridListMethod($this->getProcedureName(), $this->processGridListParams(), "Subject_Code");
    }

    public function subjectAdd() {
        $this->kahoCrudServices->addRecord($this->getProcedureName(), $this->subjectAddNUpdateParams())
                ->sendResponse();
    }

    public function subjectUpdate() {
        $params = $this->subjectAddNUpdateParams();
        $this->changeParamsPosition($params, "Subject_Code", 2);
        $this->kahoCrudServices->updateRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

    public function subjectDelete() {
        $params = $this->getPostParams();
        $params['School_Code'] = Kahoutility::getCISessionValueByKey("School_Code");
        $this->addUserCodeAsFirstParam($params)->changeAllParamsPosition($params, [
            'School_Code',
            'Subject_Code'
                ], 2);
        $this->kahoCrudServices->deleteRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

    private function subjectAddNUpdateParams() {
        $params = $this->getPostParams();
        $params['School_Code'] = Kahoutility::getCISessionValueByKey("School_Code");
        $this->addUserCodeAsFirstParam($params)->changeAllParamsPosition($params, [
            'School_Code',
            'Subject_Name',
            'Subject_Short_Name',
            'Parent_Subject_Code',
            'IsAcademic'
                ], 2);
        return $params;
    }

}
