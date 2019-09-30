<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admincommonservice
 *
 * @author KaHO
 */
class Admincommonservice extends Kahoadminservices
{

    // put your code here
    public function __construct()
    {
        parent::__construct();
    }

    public function getAdminMenuList()
    {
        $params['userCode'] = Kahoapplicationservice::getKaHOAppSerIns()->getUserCode();
        $conf = array(
            "Menu_ID" => Respstructurebuilder::SHOW_ALL_KEY,
            Respstructurebuilder::CALLBACK_KEY => array(
                "Kahoutility::convertXMLToArrayCallback",
                "Menu_Filter_Elements"
            )
        );
        $this->kahoCrudServices->getRecord("sAdminMenuGet", $params)->sendResponse($conf, FALSE, TRUE);
    }

    public function getAcademicYearList()
    {
        $this->kahoCrudServices->getRecord($this->getProcedureName())
            ->sendResponse();
    }

    public function getConfig()
    {
        $dbResp = $this->kahoCrudServices->getRecord($this->getProcedureName())
            ->getResponse();
        if ($this->kahoCrudServices->isDBOperationSuccess()) {
            $lpDetailsXMLTOArray = Kahoutility::convertXMLToArray($dbResp[0]['LP_Detail']);
            $qualityAspectXMLTOArray = Kahoutility::convertXMLToArray($dbResp[0]['Quality_Aspect']);
            $dbResp[0]['NamingConvention'] = $lpDetailsXMLTOArray;
            $dbResp[0]['Quality_Aspect'] = $qualityAspectXMLTOArray;
            $this->kahoCrudServices->printResponse($dbResp[0], true, "getConfig");
        } else {
            $this->kahoCrudServices->printResponse($dbResp, FALSE, "getConfig");
        }
    }

    public function getBoardList()
    {
        $this->getLookUpType("BOARD");
    }
}
