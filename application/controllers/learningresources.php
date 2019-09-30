<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of learningresources
 *
 * @author KaHO PC-1
 */
class Learningresources extends KaHO_Controller
{

    public function __construct()
    {
        parent::__construct("learningresource/learningresourceservice");
    }

    public function addLearningResource()
    {
        $this->learningresourceservice->addLearningResource();
    }

    public function addLearningResourceRepo()
    {
        $this->learningresourceservice->addLearningResourceRepo();
    }

    public function getLearningResourcesFromRepo()
    {
        $this->learningresourceservice->getLearningResourcesFromRepo();
    }

    public function getAllResourcesFromRepo()
    {
        $this->learningresourceservice->getAllResourcesFromRepo();
    }

    public function getSharedResources()
    {
        $this->learningresourceservice->getSharedResources();
    }

    public function addLearningResourceFileView()
    {
        $this->learningresourceservice->addLearningResourceFileView();
    }

    public function getMediaType()
    {
        $this->learningresourceservice->getMediaType();
    }

    public function uploadLearningResourcesAttachment()
    {
        $this->learningresourceservice->uploadLearningResourcesAttachment();
    }

    public function getFilesFromRepoById()
    {
        $this->learningresourceservice->getFilesFromRepoById();
    }

    public function getLRCount()
    {
        $this->learningresourceservice->getLRCount();
    }
}
