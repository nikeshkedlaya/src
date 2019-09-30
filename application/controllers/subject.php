<?php

/**
 * @created by Nikesh<nikesh@kaholabs.com> on 15 Nov, 2014 11:40:50 AM
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
// namespace kaholabs
class Subject extends KaHO_Controller
{

    public function __construct()
    {
        parent::__construct("subjectservice");
    }

    public function getSubjectListByUser()
    {
        $this->subjectservice->getSubjectListByUser();
    }

    public function getSubjectList()
    {
        $this->subjectservice->getSubjectList();
    }

    public function getSubjectListByClass()
    {
        $this->subjectservice->getSubjectListByClass();
    }

    public function getSubjectListBySAY()
    {
        $this->subjectservice->getSubjectListBySAY();
    }
}
