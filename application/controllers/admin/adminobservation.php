<?php

/**
 * @created by Karthik <karthik@kaholabs.com> on 21-Jan-2015 18:22:32
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
include_once 'kahoadmincontroller.php';

class Adminobservation extends Kahoadmincontroller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library("adminobservation/badminobservation", NULL, "bManagerObj");
        $this->load->library("adminobservation/cadminobservation", NULL, "object");
    }

    /*
     * AddObservation() function add's the observation data to the databae.
     * it requires observation code and observation name
     * it returs success or failure meesage to the ajax request
     */
    public function AddObservation()
    {
        $this->object->UserId = $this->session->userdata("User_Code");
        $this->object->Observation_Text = $this->input->post("Observation_Text");
        $this->kahocrudservice->addRecord($this);
    }

    /*
     * DeleteObservation() function wii delete the observation information (mark as deleted) from the database
     * This function requires observation code
     * it returns success or failure message to the ajax
     */
    public function DeleteObservation($ObservationCode)
    {
        $this->object->UserId = $this->session->userdata("User_Code");
        $this->object->DeleteObservationCode = $ObservationCode;
        $this->kahocrudservice->deleteRecord($this);
        // $OutputParam = array("Result");
        // $res = $this->bobservation->Delete($this->object, $OutputParam);
        // if ((int) $res['Result'] > 0) {
        // GetSuccessMessage($res, "deleteobservation", " ", "Observation deleted Successfully");
        // } else {
        // GetErrorMessage("There is an error while deleting observation");
        // }
    }

    /*
     * UpdateObservation() function wii update the observation information
     * This function requires observation code, new observation code, and observation name
     * it returns success or failure message to the ajax
     */
    public function UpdateObservation()
    {
        $this->object->UserId = $this->session->userdata("User_Code");
        $this->object->Observation_Code = $this->input->post("objectid");
        $this->object->Observation_Text = $this->input->post("Observation_Text");
        $this->kahocrudservice->updateRecord($this);
        // $OutputParam = array("Result");
        // $res = $this->bobservation->Update($this->object, $OutputParam);
        // (int) $res['Result'] > 0 ? GetSuccessMessage($res, "updateobservation", " ", "Observation Updated Successfully") : GetErrorMessage("There is an error while updating observation");
    }

    public function getObservationForEditRecord()
    {
        $this->object->observationCode = $this->input->post("Observation_Code");
        $this->kahocrudservice->getEditRecord($this);
    }

    public function getObservationList($pageNo = 1, $noOfRecordPerPage = 10, $sorting = "1")
    {
        $conf = $this->getGridListRespConf();
        $conf[$this->gridListKey] = array(
            "Observation_Code" => "Observation_Code,Observation_Text"
        );
        $this->kahocrudservice->getGridList($this, $conf, $pageNo, $noOfRecordPerPage, $sorting);
    }

    public function DownloadObservationTemplate()
    {
        DownloadTemplate("observation.csv", "download_template");
    }
}
