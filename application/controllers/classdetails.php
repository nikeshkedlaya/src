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
class Classdetails extends KaHO_Controller
{

    public function __construct()
    {
        parent::__construct("classdetailsservice");
    }

    public function classSectionListByUser()
    {
        $this->classdetailsservice->classSectionListByUser();
    }

    public function getClassSectionList()
    {
        $this->classdetailsservice->getClassSectionList();
    }

    public function getClassList()
    {
        $this->classdetailsservice->getClassList();
    }
}
