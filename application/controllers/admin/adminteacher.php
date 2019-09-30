<?php

/**
 * @created by Sandeep kosta <sandeep@kaholabs.com> on 2 Dec, 2014 12:44:04 PM
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

class Adminteacher extends Kahoadmincontroller
{

    // public static $imagename;
    public function __construct()
    {
        parent::__construct("adminteacherservice");
    }

    public function adminTeacherGetList($pageNo = 1, $noOfRecordPerPage = 10, $sorting = "1")
    {
        $this->adminteacherservice->adminTeacherGetList();
    }

    public function teacherImportData()
    {
        $this->adminteacherservice->teacherImportData();
    }

    public function teacherAdd()
    {
        $this->adminteacherservice->teacherAdd();
    }

    public function teacherUpdate()
    {
        $this->adminteacherservice->teacherUpdate();
    }

    public function teacherDelete()
    {
        $this->adminteacherservice->teacherDelete();
    }

    public function uploadTeacherPicsAttachment()
    {
        $this->adminteacherservice->uploadTeacherPicsAttachment();
    }

    public function designationGet()
    {
        $this->adminteacherservice->designationGet();
    }

    public function downloadTeacherCSVTemplate()
    {
        $this->adminteacherservice->downloadTeacherCSVTemplate();
    }
}
