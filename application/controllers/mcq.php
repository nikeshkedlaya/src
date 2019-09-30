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
class Mcq extends KaHO_Controller
{

    public function __construct()
    {
        parent::__construct("mcqservice");
    }

    public function getMCQDetailByID()
    {
        $this->mcqservice->getMCQDetailByID();
    }

    public function getMCQCount()
    {
        $this->mcqservice->getMCQCount();
    }

    public function getMCQList()
    {
        $this->mcqservice->getMCQList();
    }

    public function getPushedMCQTopicsList()
    {
        $this->mcqservice->getPushedMCQTopicsList();
    }

    public function getMCQBYID()
    {
        $this->mcqservice->getMCQBYID();
    }

    public function getQuestionwiseReflection()
    {
        $this->mcqservice->getQuestionwiseReflection();
    }

    public function getCategorywiseReflection()
    {
        $this->mcqservice->getCategorywiseReflection();
    }

    public function getMCQStudentsYetToTake()
    {
        $this->mcqservice->getMCQStudentsYetToTake();
    }

    public function getMCQStudentsToWatch()
    {
        $this->mcqservice->getMCQStudentsToWatch();
    }

    public function addMCQDraft()
    {
        $this->mcqservice->addMCQDraft();
    }

    public function updateMCQDraft()
    {
        $this->mcqservice->updateMCQDraft();
    }

    public function deleteMCQDraft()
    {
        $this->mcqservice->deleteMCQDraft();
    }

    // public function getMCQDraft()
    // {
    // $this->mcqservice->getMCQDraft();
    // }
    public function getMCQListForStudentBySubject()
    {
        $this->mcqservice->getMCQListForStudentBySubject();
    }

    public function getMCQListForStudent()
    {
        $this->mcqservice->getMCQListForStudent();
    }

    public function getQuestionsForStudent()
    {
        $this->mcqservice->getQuestionsForStudent();
    }

    public function addMCQStudentAnswer()
    {
        $this->mcqservice->addMCQStudentAnswer();
    }

    public function getMCQTrend()
    {
        $this->mcqservice->getMCQTrend();
    }

    public function getMCQTrendForMonth()
    {
        $this->mcqservice->getMCQTrendForMonth();
    }

    public function getMCQDetailCount()
    {
        $this->mcqservice->getMCQDetailCount();
    }

    public function getMCQQuestionDifficultyLevel()
    {
        $this->mcqservice->getMCQQuestionDifficultyLevel();
    }

    public function getMCQQuestionType()
    {
        $this->mcqservice->getMCQQuestionType();
    }

    public function getMCQDraftList()
    {
        $this->mcqservice->getMCQDraftList();
    }

    public function getMCQDraft()
    {
        $this->mcqservice->getMCQDraft();
    }

    public function addMCQFromDraft()
    {
        $this->mcqservice->addMCQFromDraft();
    }

    public function uploadMCQAttachment()
    {
        $this->mcqservice->uploadMCQAttachment();
    }
}
