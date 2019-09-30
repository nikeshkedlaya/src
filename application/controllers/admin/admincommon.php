<?php

/**
 * @created by Nikesh<nikesh@kaholabs.com> on 13 Oct, 2015 5:10:43 PM
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

class Admincommon extends Kahoadmincontroller
{

    public function __construct()
    {
        parent::__construct("admincommonservice");
        // $this->load->library("admincommonservice");
    }

    public function getAdminMenuList()
    {
        $this->admincommonservice->getAdminMenuList();
    }

    public function getLookUpList($lookUpType)
    {
        $this->object->lookUpType = $lookUpType;
        $this->kahocrudservice->getObjectReport($this, "sLookUpGetList");
    }

    public function getAcademicYearList()
    {
        $this->admincommonservice->getAcademicYearList();
    }

    public function getConfig()
    {
        $this->admincommonservice->getConfig();
    }

    public function getBoardList()
    {
        $this->admincommonservice->getBoardList();
    }
}
