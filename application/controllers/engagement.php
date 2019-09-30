<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Engagement extends KaHO_Controller
{

    public function __construct()
    {
        parent::__construct("engagementservice");
    }

    public function getEngagementList()
    {
        $this->engagementservice->getEngagementList();
    }

    public function getEngagementComments()
    {
        $this->engagementservice->getEngagementComments();
    }

    public function getEngagementDetail()
    {
        $this->engagementservice->getEngagementDetail();
    }

    public function getEngagementListForParent()
    {
        $this->engagementservice->getEngagementListForParent();
    }

    public function getEngagementDetailForParent()
    {
        $this->engagementservice->getEngagementDetailForParent();
    }

    public function addUserEngagement()
    {
        $this->engagementservice->addUserEngagement();
    }

    public function getEngagementLogin()
    {
        $this->engagementservice->getEngagementLogin();
    }

    public function getEngagementObjectives()
    {
        $this->engagementservice->getEngagementObjectives();
    }

    public function addEngagementObjectives()
    {
        $this->engagementservice->addEngagementObjectives();
    }

    public function getEngagementObjectiveList()
    {
        $this->engagementservice->getEngagementObjectiveList();
    }
}
