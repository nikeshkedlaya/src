<?php

/**
 * @created by Karthik <karthik@kaholabs.com> on 02-Feb-2015 14:52:33
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

class Mark extends Kahoadmincontroller
{

    /*
     * Constructor
     */
    public function __construct()
    {
        parent::__construct("markservice");
    }

    public function downloadMarksTemplate($assessmentDetailSectionID)
    {
        $this->markservice->downloadMarksTemplate();
    }

    public function marksUpload()
    {
        $this->markservice->marksUpload();
    }

    public function marksForAssessmentDetailGet()
    {
        $this->markservice->marksForAssessmentDetailGet();
    }

    public function marksAddOrUpdate()
    {
        $this->markservice->marksAddOrUpdate();
    }
}
