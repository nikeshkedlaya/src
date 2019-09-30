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
class Timetable extends KaHO_Controller
{

    public function __construct()
    {
        parent::__construct("timetableservice");
    }

    public function getTimeTable()
    {
        $this->timetableservice->getTimeTable();
    }

    public function getTeacherTimeTable()
    {
        $this->timetableservice->getTeacherTimeTable();
    }

    public function addOrUpdateTeacherTimeTable()
    {
        $this->timetableservice->addOrUpdateTeacherTimeTable();
    }
}
