<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Evalution
 *
 * @author KaHO
 */
class Evaluation extends KaHO_Controller
{

    // put your code here
    public function __construct()
    {
        parent::__construct("evaluationservice");
    }

    public function getEvaluationTemplates()
    {
        $this->evaluationservice->getEvaluationTemplates();
    }

    public function addEvaluation()
    {
        $this->evaluationservice->addEvaluation();
    }

    public function getEvaluationList()
    {
        $this->evaluationservice->getEvaluationList();
    }

    public function getStudentsEvaluationDetail()
    {
        $this->evaluationservice->getStudentsEvaluationDetail();
    }

    public function addStudentEvaluationDetail()
    {
        $this->evaluationservice->addStudentEvaluationDetail();
    }
}
