<?php

/**
 * @created by Karthik <karthik@kaholabs.com> on 21-Jan-2015 09:59:31
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

class Concern extends Kahoadmincontroller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library("concern/bconcern", NULL, "bManagerObj");
        $this->load->library("concern/cconcern", NULL, "object");
    }

    /*
     * AddConcern() function add's the concern data to the databae.
     * it requires concern code and concern name
     * it returs success or failure meesage to the ajax request
     */
    public function AddConcern()
    {
        $this->cconcern->UserId = $this->session->userdata("User_Code");
        $this->cconcern->Concern_Text = $this->input->post("Concern_Text");
        $this->kahocrudservice->addRecord($this);
        // $OutputParam = array("Result"); // TransStatus keyword must be same as we setting the object id when inserting
        //
        // $res = $this->bconcern->Insert($this->cconcern, $OutputParam);
        //
        // if ((int) $res['Result'] > 0) {
        // GetSuccessMessage($res, "ConcernInsert", " ", "Concern added successfully");
        // } else {
        // GetErrorMessage("there was an error to add the concern");
        // }
    }

    /*
     * DeleteConcern() function wii delete the concern information (mark as deleted) from the database
     * This function requires concern code
     * it returns success or failure message to the ajax
     */
    public function DeleteConcern($ConcernCode)
    {
        $this->cconcern->UserId = $this->session->userdata("User_Code");
        $this->cconcern->DeleteConcernCode = $ConcernCode;
        $this->kahocrudservice->deleteRecord($this);
        // $OutputParam = array("Result");
        // $res = $this->bconcern->Delete($this->cconcern, $OutputParam);
        // if ((int) $res['Result'] > 0) {
        // GetSuccessMessage($res, "deleteconcern", "", "Concern deleted successfully");
        // } else {
        // GetErrorMessage("there was an error while deleting the concern");
        // }
    }

    /*
     * UpdateConcern() function wii update the concern information
     * This function requires concern code, new concern code, and concern name
     * it returns success or failure message to the ajax
     */
    public function UpdateConcern()
    {
        $this->cconcern->UserId = $this->session->userdata("User_Code");
        $this->cconcern->Concern_Code = $this->input->post("objectid");
        $this->cconcern->Concern_Text = $this->input->post("Concern_Text");
        $this->kahocrudservice->updateRecord($this);
        // $OutputParam = array("Result");
        //
        // $res = $this->bconcern->Update($this->cconcern, $OutputParam);
        // (int) $res['Result'] > 0 ? GetSuccessMessage($res, "updateconcern", "", "Concern updated successfully") : GetErrorMessage("there was an error while updating the concern");
    }

    public function getConcernForEditRecord()
    {
        $this->object->concernCode = $this->input->post("Concern_Code");
        $this->kahocrudservice->getEditRecord($this);
    }

    public function getConcernList($pageNo = 1, $noOfRecordPerPage = 10, $sorting = "")
    {
        $conf = $this->getGridListRespConf();
        $conf[$this->gridListKey] = array(
            "Concern_Code" => "Concern_Text"
        );
        $this->kahocrudservice->getGridList($this, $conf, $pageNo, $noOfRecordPerPage, $sorting);
    }
}
