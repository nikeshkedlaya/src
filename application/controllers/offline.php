<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of offline
 *
 * @author KaHO
 */
class Offline extends KaHO_Controller {
    public function __construct() {
        parent::__construct("offlineservice");
    }
    
    public function offlineSchoolAttendanceAdd(){
        $this->offlineservice->offlineSchoolAttendanceAdd();
    }
    
    public function offlineUpdateMDM(){
        $this->offlineservice->offlineUpdateMDM();
    }
    
    public function offlineUpdateFacility(){
        $this->offlineservice->offlineUpdateFacility();
    }
    
    public function offlineAddCalendarEvent(){
        $this->offlineservice->offlineAddCalendarEvent();
    }
}
