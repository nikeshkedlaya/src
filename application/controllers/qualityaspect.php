<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of qualityaspect
 *
 * @author KaHO
 */
class Qualityaspect extends KaHO_Controller
{

    // put your code here
    public function __construct()
    {
        parent::__construct("qualityaspectservice");
    }

    public function getQualityCheckList()
    {
        $this->qualityaspectservice->getQualityCheckList();
    }

    public function getStudentListQuality()
    {
        $this->qualityaspectservice->getStudentListQuality();
    }

    public function qualityDetailAdd()
    {
        $this->qualityaspectservice->qualityDetailAdd();
    }

    public function getQualityListForUser()
    {
        $this->qualityaspectservice->getQualityListForUser();
    }

    public function getQualityDetail()
    {
        $this->qualityaspectservice->getQualityDetail();
    }
}
