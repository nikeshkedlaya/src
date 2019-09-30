<?php

/**
 * @created by Sandeep kosta <sandeep@kaholabs.com> on 11 Apr, 2015 4:33:43 PM
 * 
 * Descripion: 
 * 
 * Security : 
 * 
 * Change History :-
 * 
 * 
 * 
 * 
 * @Audited by :-
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class KaHO_Controller extends CI_Controller {

    public function __construct($serviceName = null) {
        parent::__construct();
        date_default_timezone_set("Asia/Kolkata");
        include_once getcwd() . '/application/config/include_files.php';
        $this->checkSessionSet();
        $this->loadServiceLibrary($serviceName);
    }

    protected function loadServiceLibrary($serviceName = null) {
        if (Kahoutility::isStringParamValid($serviceName)) {
            $this->load->library("webservices/" . $serviceName);
        }
    }

    protected function checkSessionSet() {
        Kahoutility::getCILibrary()->writelog->writeInitiatedDebugLog(__METHOD__, getallheaders());
        switch (Kahoapplicationservice::getKaHOAppSerIns()->getUserType()) {
            case USER_TYPE_TEACH:
                break;
            case USER_TYPE_PARENT:
                break;
            case USER_TYPE_PRINCIPAL:
                break;
            case USER_TYPE_MANAGEMENT:
                break;
            default:
                $this->redirectLogin();
        }
    }

    private function redirectLogin() {
//        Phpsessionservice::getPHPSessionServiceInstance()->unsetWholePHPSession();
        $sessionExpiredResp = [
            "response_code" => SESSION_EXPIRED_CODE,
            "response_msg" => SESSION_EXPIRED_MESSAGE
        ];
        echo Kahoutility::convertInJSON($sessionExpiredResp);
        exit();
    }

}
