<?php

/**
 * @created by Karthik <karthik@kaholabs.com> on 31-Jan-2015 20:29:59
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

class Assessment extends Kahoadmincontroller
{

    public function __construct()
    {
        parent::__construct("assessmentservice");
    }

    public function asssessmentAdd()
    {
        $this->assessmentservice->asssessmentAdd();
    }

    public function asssessmentUpdate()
    {
        $this->assessmentservice->asssessmentUpdate();
    }

    public function assessmentDelete()
    {
        $this->assessmentservice->assessmentDelete();
    }

    public function assessmentCreatedGetList()
    {
        $this->assessmentservice->assessmentCreatedGetList();
    }

    public function assessmentDetailGetList()
    {
        $this->assessmentservice->assessmentDetailGetList();
    }

    public function asssessmentDetailUpdate()
    {
        $this->assessmentservice->asssessmentDetailUpdate();
    }

    public function asssessmentDetailAdd()
    {
        $this->assessmentservice->asssessmentDetailAdd();
    }

    public function asssessmentDetailDelete()
    {
        $this->assessmentservice->asssessmentDetailDelete();
    }
    
    public function getClassSectionListForAssessment()
    {
        $this->assessmentservice->getClassSectionListForAssessment();
    }
    
    public function getClassSubjectListForAssessment()
    {
        $this->assessmentservice->getClassSubjectListForAssessment();
    }

    public function adminAssessmentDetailSectionGetList($pageNo = 1, $noOfRecordPerPage = 10, $sorting = "1")
    {
        $this->assessmentservice->adminAssessmentDetailSectionGetList();
    }
}
