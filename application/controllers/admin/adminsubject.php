<?php

/**
 * @created by Nikesh<nikesh@kaholabs.com> on 12 Dec, 2014 10:55:28 AM
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
include_once 'kahoadmincontroller.php';

class Adminsubject extends Kahoadmincontroller
{

    /*
     * Constructor
     */
    public function __construct()
    {
        parent::__construct("adminsubjectservice");
    }

    public function setupGetClassSubjectList()
    {
        $this->adminsubjectservice->setupGetClassSubjectList();
    }

    public function setupAddNewSubject()
    {
        $this->adminsubjectservice->setupAddNewSubject();
    }

    public function setupGetSubjectList()
    {
        $this->adminsubjectservice->setupGetSubjectList();
    }

    public function setupAddSelectedSubject()
    {
        $this->adminsubjectservice->setupAddSelectedSubject();
    }

    public function setupDeleteSubject()
    {
        $this->adminsubjectservice->setupDeleteSubject();
    }

    public function setupAddClassSubjects()
    {
        $this->adminsubjectservice->setupAddClassSubjects();
    }

    public function adminSubjectGetList($pageNo = 1, $noOfRecordPerPage = 10, $sorting = "1")
    {
        $this->adminsubjectservice->adminSubjectGetList();
    }

    public function subjectAdd()
    {
        $this->adminsubjectservice->subjectAdd();
    }

    public function subjectUpdate()
    {
        $this->adminsubjectservice->subjectUpdate();
    }

    public function subjectDelete()
    {
        $this->adminsubjectservice->subjectDelete();
    }
}
