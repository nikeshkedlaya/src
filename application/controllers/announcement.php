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
class Announcement extends KaHO_Controller {

    public function __construct() {
        parent::__construct("announcement/announcementservice");
    }

    public function getAnnouncement() {
        $this->announcementservice->getAnnouncement();
    }

    public function announcementDetailAdd() {
        $this->announcementservice->announcementDetailAdd();
    }

    public function uploadAnnouncementAttachment() {
        $this->announcementservice->uploadAnnouncementAttachment();
    }

    public function deleteAnnouncement() {
        $this->announcementservice->deleteAnnouncement();
    }

}
