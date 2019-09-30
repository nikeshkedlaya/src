<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Loginservice extends Kahoservices {

    public function __construct() {
        parent::__construct();
    }

//    public function getLoggedIn(): void {
//        Phpsessionservice::getPHPSessionServiceInstance()->unsetPHPSessionValueByKey(DB_SESSION_KEY_NAME); // explicitely unsetting the db name from session as one may logout implicitely for debugging or testing purpose
//        $this->kahoCrudServices->reloadDatabase();
//        $spParams = $this->getPostParams();
//        $this->changeParamsPosition($spParams, "Email", 1);
//        $dbResponse = $this->kahoCrudServices->getRecord($this->getProcedureName(), $spParams)
//                ->getResponse();
//        if (!$this->kahoCrudServices->isDBOperationSuccess()) {
//            $this->kahoCrudServices->printResponse(NULL, FALSE, Kahoutility::getCallieFunctionName(2));
//        } else {
//            if (count($dbResponse) > 1) {
//                $this->appendSchoolIcon($dbResponse);
//                $this->kahoCrudServices->printResponse($dbResponse, FALSE, Kahoutility::getCallieFunctionName(2));
//            } else {
//                $dbName = $dbResponse[0]["DB"];
//                Phpsessionservice::getPHPSessionServiceInstance()->setPHPSessionValueByKey(CUR_DB_SESSION_KEY_NAME, $dbName) ;
//                $this->getUserForAuthentication($dbName);
//            }
//        }
//    }
    
    public function getLoggedIn(): void {
        Phpsessionservice::getPHPSessionServiceInstance()->unsetPHPSessionValueByKey(DB_SESSION_KEY_NAME); // explicitely unsetting the db name from session as one may logout implicitely for debugging or testing purpose
        $this->kahoCrudServices->reloadDatabase();
        $spParams = $this->getPostParams();
        $this->changeParamsPosition($spParams, "Email", 1);
        $this->getUserForAuthentication(null);
        
    }

    private function appendSchoolIcon(&$response) {
        if (Kahoutility::checkArrayParam($response)) {
            foreach ($response as $key => &$val) {
               
            }
        }
    }

    public function getUserForAuthentication($dbName = null): void {
        $postParams = $this->getPostParams();
//        $postParams['School_Code'] = Kahoutility::getCISessionValueByKey("School_Code") ;
//        print_r($postParams); exit ;
//        $databaseName = $dbName ?? array_shift($postParams);
//        $this->setDBNameInPHPSession($databaseName);
        $this->changeParamsPosition($postParams, "Email", 1);
        $this->addDefaultParamToSPParams($postParams, "userAgent", Kahoutility::getUserAgent());
        
        $dbResponse = $this->kahoCrudServices->getRecord($this->getProcedureName(2), $postParams)
                ->getResponse();
        
        if (!$this->kahoCrudServices->isDBOperationSuccess()) {
            $this->kahoCrudServices->printResponse(NULL, FALSE, Kahoutility::getCallieFunctionName(2));
        } else {
            $this->processDBRespAfterAuthentication($dbResponse[0]);
        }
    }

    private function processDBRespAfterAuthentication($dbResponse) {
        $userData = array(
            "Name" => $dbResponse["Name"],
            "Email" => $dbResponse["Email"],
            "User_Id" => $dbResponse["User_Id"],
            "User_Type" => $dbResponse["User_Type"],
            "User_Code" => $dbResponse["User_Code"],
            "User_Photo" => $dbResponse["Photo"],
            "AY_Code" => $dbResponse["AY_Code"],
            "School_Code" => $dbResponse["School_Code"]
        );
        
        $userCode = $dbResponse['User_Code'];
        $loggedInUserInfo = $this->setLoggedinUserInfoInCISession($userData);
        $dbResponse[$userCode] = $loggedInUserInfo[$userCode];
        
//        print_r(Kahoutility::getCISessionValueByKey("School_Code")); exit ;
        
//        print_r($dbResponse); exit ;
        $dbResponse = Kahoutility::appendAbsoluteFilePath($dbResponse, "Photo", Kahoutility::getImageDirNameBasedOnLoggedinUserType($userData['User_Type']), TRUE);
        $this->kahoCrudServices->printResponse($dbResponse, TRUE, Kahoutility::getCallieFunctionName(3));
    }

    private function getLoggedInUserInfoByTeacher(string $userCode) {
        return $this->getLoggedInUserInfoByUserType($this->getProcedureName(2), $userCode);
    }

    private function getLoggedInUserInfoByParent(string $userCode) {
        $loggedInUserInfo = $this->getLoggedInUserInfoByUserType($this->getProcedureName(2), $userCode);
        Kahoutility::setCISessionValueByKey(SELECTED_STUDENT_CODE, current($loggedInUserInfo)[0]['Student_Code']);
        return $loggedInUserInfo;
    }

    private function getLoggedInUserInfoByUserType(string $spName, string $userCode) {
        $spParams = [
            "userCode" => $userCode
        ];
        $userInfo = $this->kahoCrudServices->getRecord($spName, $spParams)->getResponse();
        $buildLoggedinUserDataStructure = $this->buildLoggedinUserDataStructure($userInfo, $userCode);
        return $buildLoggedinUserDataStructure;
    }

    private function setDBNameInPHPSession(string $dbName): void {
        try {
            if (Kahoutility::isStringParamValid($dbName)) {
                Phpsessionservice::getPHPSessionServiceInstance()->setPHPSessionValueByKey(DB_SESSION_KEY_NAME, $dbName);
                $this->kahoCrudServices->reloadDatabase();
            }
        } catch (Exception $exc) {
            
        }
    }

    // <editor-fold defaultstate="collapsed" desc="setLoggedinUserInfoInCISession">
    /**
     * will set the loggedin user data in ci session
     *
     * @param type $loggedinUserData
     */
    private function setLoggedinUserInfoInCISession($userData) {
        Kahoutility::setCISessionValueByKey($userData);
        $isUserTypeParent = Kahoapplicationservice::getKaHOAppSerIns()->isUserTypeParent();
        $loggedInUserInfo = $isUserTypeParent === true ? $this->getLoggedInUserInfoByParent($userData['User_Code']) : $this->getLoggedInUserInfoByTeacher($userData['User_Code']);
        if (Kahoutility::checkArrayParam($loggedInUserInfo) && $isUserTypeParent) {
            foreach ($loggedInUserInfo[$userData['User_Code']] as $key => $val) {
                $loggedInUserInfo[$userData['User_Code']][$key] = Kahoutility::appendAbsoluteFilePath($val, "Photo", STUDENT_IMAGE_PATH);
            }
        }
        Kahoutility::setCISessionValueByKey($loggedInUserInfo);
        return $loggedInUserInfo;
    }

    // </editor-fold>
    private function buildLoggedinUserDataStructure(array $loggedinUserData, string $userCode) { // for storing the kids information inside parent code as an arrayF
        return (function ($loggedinUserData, $userCode) {
                    $myarray = array();
                    array_walk($loggedinUserData, function ($arrayVal) use (&$myarray, $userCode) {
                        $myarray[$userCode][] = $arrayVal;
                    });
                    return $myarray;
                })($loggedinUserData, $userCode);
    }

    public function logout() {
        Phpsessionservice::getPHPSessionServiceInstance()->unsetWholePHPSession();
        Kahoutility::unsetCISessionValueByKey();
        $this->kahoCrudServices->printResponse([
            "logoutSuccess" => "success"
                ], TRUE, Kahoutility::getCallieFunctionName(2), null, Kahocrudservices::RESPONSE_FOUND);
    }

    public function androidLogout() {
        $params = $this->getPostParams();
        $this->setDefaultValueIfPostValNotFound($params, "userID", Kahoapplicationservice::getKaHOAppSerIns()->getUserId())
                ->addDefaultParamToSPParams($params, 'isAdd', 0)
                ->changeAllParamsPosition($params, [
                    'userID',
                    'Device_ID',
                    'Platform_Type',
                    'isAdd'
        ]);
        $this->kahoCrudServices->updateRecord("sRegisterDeviceId", $params);
        $this->logout();
    }

    public function changePassword() {
        $params = $this->getPostParams();
        $this->addDefaultParamToSPParams($params, "userID", Kahoutility::getCISessionValueByKey("User_Id"))->changeAllParamsPosition($params, [
            'userID',
            'OldPassword',
            'NewPassword'
        ]);
        $this->kahoCrudServices->updateRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }
    
    public function setSchoolContext(){
        $params = $this->getPostParams(); /* School Database */
        
        Phpsessionservice::getPHPSessionServiceInstance()->setPHPSessionValueByKey(DB_SESSION_KEY_NAME, $params['School_Database']) ;
        $this->kahoCrudServices->reloadDatabase();
  //       Phpsessionservice::getPHPSessionServiceInstance()->setPHPSessionValueByKey("User_Code", "TEACH0001")  ;
        
        $this->ciLibrary->session->set_userdata('User_Code', "TEACH0001");
        
        $this->kahoCrudServices->printResponse([
            "setSchoolContext" => "success"
                ], TRUE, Kahoutility::getCallieFunctionName(2), null, Kahocrudservices::RESPONSE_FOUND);
        
    }
    
    public function unsetSchoolContext(){
        $params = $this->getPostParams(); /* User_Code */
        $db_name = Phpsessionservice::getPHPSessionServiceInstance()->getPHPSessionValueByKey(CUR_DB_SESSION_KEY_NAME) ;
        Phpsessionservice::getPHPSessionServiceInstance()->setPHPSessionValueByKey(DB_SESSION_KEY_NAME, $db_name) ;
        // Phpsessionservice::getPHPSessionServiceInstance()->setPHPSessionValueByKey("User_Code", $params['User_Code']) ;
        
        $this->ciLibrary->session->set_userdata('User_Code', $params['User_Code']);
        
        $this->kahoCrudServices->reloadDatabase();
        
        $this->kahoCrudServices->printResponse([
            "unsetSchoolContext" => "success"
                ], TRUE, Kahoutility::getCallieFunctionName(2), null, Kahocrudservices::RESPONSE_FOUND);
        
    }

}
