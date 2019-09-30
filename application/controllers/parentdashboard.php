<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of parentdashboard
 *
 * @author KaHO
 */
class Parentdashboard extends KaHO_Controller
{

    // put your code here
    public function __construct()
    {
        parent::__construct("parentdashboardservice");
    }

    public function getParentDashboardSummary()
    {
        $this->parentdashboardservice->getParentDashboardSummary();
    }

    public function getParentProfile()
    {
        $this->parentdashboardservice->getParentProfile();
    }

    public function updateParentProfile()
    {
        $this->parentdashboardservice->updateParentProfile();
    }

    public function updateParentProfilePic()
    {
        $this->parentdashboardservice->updateParentProfilePic();
    }
}
