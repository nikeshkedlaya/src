<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tags
 *
 * @author KaHO
 */
include_once 'kahoadmincontroller.php';

class Tags extends Kahoadmincontroller
{

    public function __construct()
    {
        parent::__construct("tagsservice");
    }

    /*
     * AddTags() function add's the tags data to the databae.
     * it requires tags code and tags name
     * it returs success or failure meesage to the ajax request
     */
    public function addTags()
    {
        $this->tagsservice->addTags();
    }

    /*
     * DeleteTags() function wii delete the tags information (mark as deleted) from the database
     * This function requires tags code
     * it returns success or failure message to the ajax
     */
    public function deleteTags($tagsCode)
    {
        $this->tagsservice->deleteTags();
    }

    /*
     * UpdateTags() function wii update the tags information
     * This function requires tags code, new tags code, and tags name
     * it returns success or failure message to the ajax
     */
    public function updateTags()
    {
        $this->tagsservice->updateTags();
    }

    public function getTagForEditRecord($complimentCode)
    {
        $this->tagsservice->getTagForEditRecord();
    }

    public function getTagsList($pageNo = 1, $noOfRecordPerPage = 10, $sorting = "1")
    {
        $this->tagsservice->getTagsList();
    }
}
