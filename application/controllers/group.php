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
class Group extends KaHO_Controller
{

    public function __construct()
    {
        parent::__construct("group/groupservice");
    }

    public function getGroupList()
    {
        $this->groupservice->getGroupList();
    }

    public function getGroups()
    {
        $this->groupservice->getGroups();
    }

    public function getGroupDetails()
    {
        $this->groupservice->getGroupDetails();
    }

    public function addGroup()
    {
        $this->groupservice->addGroup();
    }

    public function updateGroup()
    {
        $this->groupservice->updateGroup();
    }

    public function deleteGroup()
    {
        $this->groupservice->deleteGroup();
    }
}
