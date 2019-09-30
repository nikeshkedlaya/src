<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of howschooldoing
 *
 * @author KaHO
 */
class Howschooldoing extends KaHO_Controller
{

    // put your code here
    public function __construct()
    {
        parent::__construct("howschooldoingservice");
    }

    public function getAssessmentList()
    {
        $this->howschooldoingservice->getAssessmentList();
    }

    public function getGrades()
    {
        $this->howschooldoingservice->getGrades();
    }

    public function getClasswiseGraph()
    {
        $this->howschooldoingservice->getClasswiseGraph();
    }

    public function getClassSectionwiseGraph()
    {
        $this->howschooldoingservice->getClassSectionwiseGraph();
    }

    public function getClassSectionSubjectwiseGraph()
    {
        $this->howschooldoingservice->getClassSectionSubjectwiseGraph();
    }

    public function getClassSectionStudentGraph()
    {
        $this->howschooldoingservice->getClassSectionStudentGraph();
    }

    public function getTeacherSubjectwiseGraph()
    {
        $this->howschooldoingservice->getTeacherSubjectwiseGraph();
    }

    public function getTeacherSubjectClasswiseGraph()
    {
        $this->howschooldoingservice->getTeacherSubjectClasswiseGraph();
    }

    public function getTeacherSubjectClassSectionwiseGraph()
    {
        $this->howschooldoingservice->getTeacherSubjectClassSectionwiseGraph();
    }

    public function getTeacherSubjectClassSectionStudentGraph()
    {
        $this->howschooldoingservice->getTeacherSubjectClassSectionStudentGraph();
    }
}
