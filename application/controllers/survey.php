<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of survey
 *
 * @author KaHO
 */
class survey extends KaHO_Controller
{

    // put your code here
    public function __construct()
    {
        parent::__construct("surveyservice");
    }

    public function getSurveyList()
    {
        $this->surveyservice->getSurveyList();
    }

    public function getSurveyDetail()
    {
        $this->surveyservice->getSurveyDetail();
    }

    public function addSurveyInstance()
    {
        $this->surveyservice->addSurveyInstance();
    }

    public function getSurveyTemplateForUser()
    {
        $this->surveyservice->getSurveyTemplateForUser();
    }

    public function addSurveyUserInput()
    {
        $this->surveyservice->addSurveyUserInput();
    }

    public function getSurveyListForUser()
    {
        $this->surveyservice->getSurveyListForUser();
    }

    public function getSurveyInstanceList()
    {
        $this->surveyservice->getSurveyInstanceList();
    }

    public function getSurveyUserInputList()
    {
        $this->surveyservice->getSurveyUserInputList();
    }
}
