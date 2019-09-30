<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of acknowledgement
 *
 * @author KaHO
 */
class Knps extends KaHO_Controller {

    // put your code here
    public function __construct() {
        parent::__construct("knpsservice");
    }

    public function checkSessionSet() {
        
    }

   public function sendEmail() {
       $this->knpsservice->sendEmail();
    }

    public function generateTeacherDairySubmissionReport() {
        $this->knpsservice->generateTeacherDairySubmissionReport();
    }

    public function generateAttenanceReport() {
        $this->knpsservice->generateAttenanceReport();
    }

}
