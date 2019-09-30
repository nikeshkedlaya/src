<?php

/**
 * @created by Karthik <karthik@kaholabs.com> on 23-Jan-2015 13:31:15
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

class Sectionacademicyear extends Kahoadmincontroller
{

    public function __construct()
    {
        parent::__construct("sectionacademicyearservice");
    }

    public function setupGetClassLevel()
    {
        $this->sectionacademicyearservice->setupGetClassLevel();
    }

    public function setupGetSelectedClasses()
    {
        $this->sectionacademicyearservice->setupGetSelectedClasses();
    }

    public function setupAddClasses()
    {
        $this->sectionacademicyearservice->setupAddClasses();
    }

    public function setupGetSectionList()
    {
        $this->sectionacademicyearservice->setupGetSectionList();
    }

    public function setupGetSelectedSections()
    {
        $this->sectionacademicyearservice->setupGetSelectedSections();
    }

    public function setupAddNewSection()
    {
        $this->sectionacademicyearservice->setupAddNewSection();
    }

    public function setupAddSections()
    {
        $this->sectionacademicyearservice->setupAddSections();
    }

    public function getSelectedClassSections()
    {
        $this->sectionacademicyearservice->getSelectedClassSections();
    }

    public function setupAddClassSections()
    {
        $this->sectionacademicyearservice->setupAddClassSections();
    }

    public function setupDeleteSection()
    {
        $this->sectionacademicyearservice->setupDeleteSection();
    }

    public function getClassSectionList()
    {
        $this->sectionacademicyearservice->getClassSectionList();
    }

    public function adminSectionAcademicYearGetList($pageNo = 1, $noOfRecordPerPage = 10, $sorting = "1")
    {
        $this->sectionacademicyearservice->adminSectionAcademicYearGetList();
    }

    public function sectionAcademicYearAdd()
    {
        $this->sectionacademicyearservice->sectionAcademicYearAdd();
    }

    public function sectionAcademicYearUpdate()
    {
        $this->sectionacademicyearservice->sectionAcademicYearUpdate();
    }

    public function sectionAcademicYearDelete()
    {
        $this->sectionacademicyearservice->sectionAcademicYearDelete();
    }
}
