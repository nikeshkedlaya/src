<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of schoolinfo
 *
 * @author KaHO
 */
include_once 'kahoadmincontroller.php';

class Schoolinfo extends kahoadmincontroller
{

    // put your code here
    public function __construct()
    {
        parent::__construct("schoolinfoservice");
    }

    public function addSchoolInfo()
    {
        $this->schoolinfoservice->addSchoolInfo();
    }

    public function uploadSchoolLogo()
    {
        $this->schoolinfoservice->uploadSchoolLogo();
    }

    public function updateSchoolInfo()
    {
        $this->schoolinfoservice->updateSchoolInfo();
    }

    public function getHouseList()
    {
        $this->schoolinfoservice->getHouseList();
    }

    public function getSchoolInfo()
    {
        $this->schoolinfoservice->getSchoolInfo();
    }
}
