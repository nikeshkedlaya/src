<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of acknowledgement
 *
 * @author KaHO
 */
class Kahogallery extends KaHO_Controller
{

    // put your code here
    public function __construct()
    {
        parent::__construct("kahogallery/kahogalleryservice");
    }

    public function getFilesToShare()
    {
        $this->kahogalleryservice->getFilesToShare();
    }

    public function addGalleryRepo()
    {
        $this->kahogalleryservice->addGalleryRepo();
    }

    public function addGalleryFileShare()
    {
        $this->kahogalleryservice->addGalleryFileShare();
    }

    public function getGallerySharedWithMe()
    {
        $this->kahogalleryservice->getGallerySharedWithMe();
    }

    public function updateGalleryFileViewCount()
    {
        $this->kahogalleryservice->updateGalleryFileViewCount();
    }

    public function uploadGalleryAttachment()
    {
        $this->kahogalleryservice->uploadGalleryAttachment();
    }

    public function getGalleryRepoList()
    {
        $this->kahogalleryservice->getGalleryRepoList();
    }
}
