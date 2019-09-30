<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of general
 *
 * @author KaHO
 */
class General extends KaHO_Controller{
    public function __construct() {
        parent::__construct("generalservice");
    }
    
    public function updateMDM(){
        $this->generalservice->updateMDM();
    }
    
    public function updateFacility(){
        $this->generalservice->updateFacility();
    }
    
    public function getFacilities(){
        $this->generalservice->getFacilities();
    }
    
    public function getMDMUpdates(){
        $this->generalservice->getMDMUpdates();
    }
}
