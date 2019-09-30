<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of lessonplan
 *
 * @author KaHO
 */
class lessonplan extends KaHO_Controller
{

    // put your code here
    public function __construct()
    {
        parent::__construct("lessonplanservice");
    }

    public function getAccessList()
    {
        $this->lessonplanservice->getAccessList();
    }

    public function getLearningActivity()
    {
        $this->lessonplanservice->getLearningActivity();
    }

    public function createLessonPlanDraft()
    {
        $this->lessonplanservice->createLessonPlanDraft();
    }

    public function createLessonPlanFromDraft()
    {
        $this->lessonplanservice->createLessonPlanFromDraft();
    }

    public function getLPDraftList()
    {
        $this->lessonplanservice->getLPDraftList();
    }

    public function updateLessonPlanDraft()
    {
        $this->lessonplanservice->updateLessonPlanDraft();
    }

    public function deleteLessonPlanDraft()
    {
        $this->lessonplanservice->deleteLessonPlanDraft();
    }

    public function getLessonPlanLog()
    {
        $this->lessonplanservice->getLessonPlanLog();
    }

    public function getLessonPlanDetail()
    {
        $this->lessonplanservice->getLessonPlanDetail();
    }

    public function getLPDraftDetail()
    {
        $this->lessonplanservice->getLPDraftDetail();
    }

    public function editLessonPlan()
    {
        $this->lessonplanservice->editLessonPlan();
    }

    public function deleteDailyPlan()
    {
        $this->lessonplanservice->deleteDailyPlan();
    }

    public function copyLessonPlan()
    {
        $this->lessonplanservice->copyLessonPlan();
    }
}
