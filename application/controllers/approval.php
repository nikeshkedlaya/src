<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of approval
 *
 * @author KaHO
 */
class approval extends KaHO_Controller
{

    // put your code here
    public function __construct()
    {
        parent::__construct("approvalservice");
    }

    public function getAnnouncementWorkFlow()
    {
        $this->approvalservice->getAnnouncementWorkFlow();
    }

    public function addAnnouncementWorkflow()
    {
        $this->approvalservice->addAnnouncementWorkflow();
    }

    public function getApprovalList()
    {
        $this->approvalservice->getApprovalList();
    }
}
