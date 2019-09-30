<?php

/**
 * @created by Karthik <karthik@kaholabs.com> on 18-Aug-2015 14:13:54
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

class Adminannouncement extends Kahoadmincontroller
{

    public function __construct()
    {
        parent::__construct("adminannouncementservice");
    }

    public function addAnnouncement()
    {
        $this->adminannouncementservice->addAnnouncement();
    }

    public function updateAnnouncement()
    {
        $this->adminannouncementservice->updateAnnouncement();
    }

    public function deleteAnnouncement($userCode)
    {
        $this->adminannouncementservice->deleteAnnouncement();
    }

    public function getAnnouncementForEditRecord($announcementCode)
    {
        $this->adminannouncementservice->getAnnouncementForEditRecord();
    }

    public function getAnnouncementList($pageNo = 1, $noOfRecordPerPage = 10, $sorting = "1")
    {
        $this->adminannouncementservice->getAnnouncementList();
    }

    public function DownloadAnnouncementTemplate()
    {
        DownloadTemplate("announcement.csv", "download_template");
    }
}
