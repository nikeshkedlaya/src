<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of rosterduty
 *
 * @author KaHO
 */
class Rosterduty extends KaHO_Controller
{

    // put your code here
    public function __construct()
    {
        parent::__construct("rosterdutyservice");
    }

    public function addRosterDuty()
    {
        $this->rosterdutyservice->addRosterDuty();
    }

    public function addTeacherRosterDutyUpdate()
    {
        $this->rosterdutyservice->addTeacherRosterDutyUpdate();
    }

    public function getRosterDuty()
    {
        $this->rosterdutyservice->getRosterDuty();
    }

    public function getRosterDutyList()
    {
        $this->rosterdutyservice->getRosterDutyList();
    }

    public function getRosterType()
    {
        $this->rosterdutyservice->getRosterType();
    }
}
