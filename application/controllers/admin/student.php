<?php

/**
 * @created by Karthik <karthik@kaholabs.com> on 03-Dec-2014 15:15:31
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

class Student extends Kahoadmincontroller
{

    /*
     * Constructor
     */
    public function __construct()
    {
        parent::__construct("studentservice");
    }

    public function studentImportData()
    {
        $this->studentservice->studentImportData();
    }

    public function studentAdd()
    {
        $this->studentservice->studentAdd();
    }

    public function getAdminStudentList($pageNo = 1, $noOfRecordPerPage = 10, $sorting = "1")
    {
        $this->studentservice->getAdminStudentList();
    }

    public function uploadStudentPicsAttachment()
    {
        $this->studentservice->uploadStudentPicsAttachment();
    }

    public function studentUpdate()
    {
        $this->studentservice->studentUpdate();
    }

    public function studentDelete()
    {
        $this->studentservice->studentDelete();
    }

    public function downloadStudentCSVTemplate()
    {
        $this->studentservice->downloadStudentCSVTemplate();
    }
}
