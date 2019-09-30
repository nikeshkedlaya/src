<?php

/**
 * @created by Karthik <karthik@kaholabs.com> on 28-Jan-2015 10:12:13
 * 
 * Descripion: 
 * 
 * Security : 
 * 
 * Change History :-
 * 
 * 
 * 
 * 
 * @Audited by :-
 */
class Traction extends KaHO_Controller {

    public function __construct() {
        parent::__construct("tractionservice");
    }

    public function tractionUserLoginCountGet() {
        $this->tractionservice->tractionUserLoginCountGet();
    }

    public function tractionTeacherAndParentCountGet() {
        $this->tractionservice->tractionTeacherAndParentCountGet();
    }

    public function tractionUserLoginDetailGet() {
        $this->tractionservice->tractionUserLoginDetailGet();
    }

    public function tractionUsersNotLoggedInCount() {
        $this->tractionservice->tractionUsersNotLoggedInCount();
    }

    public function tractionUsersNotLoggedInUserTypeCountGet() {
        $this->tractionservice->tractionUsersNotLoggedInUserTypeCountGet();
    }

    public function tractionUsersNotLoggedDetailGet() {
        $this->tractionservice->tractionUsersNotLoggedDetailGet();
    }

    public function tractionTransactionLogGet() {
        $this->tractionservice->tractionTransactionLogGet();
    }

    public function tractionTransactionLogDetail() {
        $this->tractionservice->tractionTransactionLogDetail();
    }

    public function tractionTransactionUsersCountByTypeGet() {
        $this->tractionservice->tractionTransactionUsersCountByTypeGet();
    }

    public function tractionInputsCountGet() {
        $this->tractionservice->tractionInputsCountGet();
    }

    public function tractionInputsCountByTypeGet() {
        $this->tractionservice->tractionInputsCountByTypeGet();
    }

    public function tractionInputsCountByTypeAndTeacher() {
        $this->tractionservice->tractionInputsCountByTypeAndTeacher();
    }

    public function tractionInputsCountByTypeAndStudent() {
        $this->tractionservice->tractionInputsCountByTypeAndStudent();
    }

    public function tractionUserEngagementcDetailCount() {
        $this->tractionservice->tractionUserEngagementcDetailCount();
    }

    public function tractionStudentMCQCount() {
        $this->tractionservice->tractionStudentMCQCount();
    }

    public function tractionStudentMCQDetailCount() {
        $this->tractionservice->tractionStudentMCQDetailCount();
    }

    public function tractionClassRoomObsCountGet() {
        $this->tractionservice->tractionClassRoomObsCountGet();
    }

    public function tractionClassRoomObsDetailGet() {
        $this->tractionservice->tractionClassRoomObsDetailGet();
    }
    
    public function getTractionMenu() {
        $this->tractionservice->getTractionMenu();
    }

}
