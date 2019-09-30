<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of classroomobservation
 *
 * @author KaHO
 */
class Classroomobservation extends KaHO_Controller
{

    // put your code here
    public function __construct()
    {
        parent::__construct("classroomobservationservice");
    }

    public function getClassRoomObservationList()
    {
        $this->classroomobservationservice->getClassRoomObservationList();
    }

    public function addClassRoomObservation()
    {
        $this->classroomobservationservice->addClassRoomObservation();
    }

    public function addClassRoomObservationComment()
    {
        $this->classroomobservationservice->addClassRoomObservationComment();
    }

    public function getMyClassRoomObservation()
    {
        $this->classroomobservationservice->getMyClassRoomObservation();
    }

    public function getClassRoomObservationComments()
    {
        $this->classroomobservationservice->getClassRoomObservationComments();
    }

    public function getUserInput()
    {
        $this->classroomobservationservice->getUserInput();
    }

    public function getTeacherObservationCount()
    {
        $this->classroomobservationservice->getTeacherObservationCount();
    }
}
