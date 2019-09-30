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
include_once 'kahoadmincontroller.php';

class Timetable extends Kahoadmincontroller
{

    public function __construct()
    {
        parent::__construct("timetableservice");
    }

    public function setupAddClassTimeTable()
    {
        $this->timetableservice->setupAddClassTimeTable();
    }

    public function setupGetClassTimeTable()
    {
        $this->timetableservice->setupGetClassTimeTable();
    }

    public function addOrUpdateTeacherTimeTable()
    {
        $this->timetableservice->addOrUpdateTeacherTimeTable();
    }

    public function getTeacherTimeTable()
    {
        $this->timetableservice->getTeacherTimeTable();
    }
}
