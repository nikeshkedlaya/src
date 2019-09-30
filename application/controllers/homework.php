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
class Homework extends KaHO_Controller {

    public function __construct() {
        parent::__construct("homework/homeworkservice");
    }

    public function getHomeworkSubmissions() {
        $this->homeworkservice->getHomeworkSubmissions();
    }

    public function getPendingHWStudents() {
        $this->homeworkservice->getPendingHWStudents();
    }

    public function updateHomeWork() {
        $this->homeworkservice->updateHomeWork();
    }

    public function homeWorkListForTeacher() {
        $this->homeworkservice->homeWorkListForTeacher();
    }

    public function assignHomework() {
        $this->homeworkservice->assignHomework();
    }

    public function uploadAttachmentHomework() {
        $this->homeworkservice->uploadAttachmentHomework($_FILES);
    }

    public function getHomeworkCount() {
        $this->homeworkservice->getHomeworkCount();
    }

    public function getHomeWorkUpdateCount() {
        $this->homeworkservice->getHomeWorkUpdateCount();
    }

    public function getHomeWorkTrend() {
        $this->homeworkservice->getHomeWorkTrend();
    }

}
