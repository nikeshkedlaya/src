<?php

/**
 * @created by Karthik <karthik@kaholabs.com> on 21-Jan-2015 09:18:42
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

class Compliment extends Kahoadmincontroller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library("compliment/bcompliment", NULL, "bManagerObj");
        $this->load->library("compliment/ccompliment", NULL, "object");
    }

    // public function index($Insertedcount = 0) {
    // $data['filename'] = __CLASS__;
    // $data['title'] = "Compliment";
    // $data['includejs'] = "listcompliment";
    // $data['includecss'] = "listcompliment";
    // $data['Name'] = $this->session->userdata("Name");
    // $data['SuccessMessage'] = (int) $Insertedcount > 0 ? $Insertedcount . " rows inserted successfully" : ( $Insertedcount === "0" ? "There was an error while uploading" : FALSE);
    //
    // $this->load->view("html_temp/html_header", $data);
    // $this->load->view("html_temp/html_sidemenu", $data);
    // $this->load->view("admin/compliment/complimentlist", $data);
    // $this->load->view("html_temp/html_footer", $data);
    // }
    
    /*
     * AddCompliment() function add's the compliment data to the databae.
     * it requires compliment code and compliment name
     * it returs success or failure meesage to the ajax request
     */
    public function AddCompliment()
    {
        $this->object->UserId = $this->session->userdata("User_Code");
        $this->object->Compliment_Text = $this->input->post("Compliment_Text");
        $this->kahocrudservice->addRecord($this);
        // $OutputParam = array("Result"); // Result keyword must be same as we setting the object id when inserting
        //
        // $res = $this->bcompliment->Insert($this->object, $OutputParam);
        //
        // if ((int) $res['Result'] > 0) {
        // GetSuccessMessage($res, "ComplimentInsert", " ", "Compliment Added Successfully");
        // } else {
        // GetErrorMessage("There is an error while adding concern");
        // }
    }

    /*
     * DeleteCompliment() function wii delete the compliment information (mark as deleted) from the database
     * This function requires compliment code
     * it returns success or failure message to the ajax
     */
    public function DeleteCompliment($ComplimentCode)
    {
        $this->object->UserId = $this->session->userdata("User_Code");
        $this->object->DeleteComplimentCode = $ComplimentCode;
        $this->kahocrudservice->deleteRecord($this);
        // $OutputParam = array("Result");
        // $res = $this->bcompliment->Delete($this->object, $OutputParam);
        // if ((int) $res['Result'] > 0) {
        // GetSuccessMessage($res, "deletecompliment", " ", "Compliment deleted Successfully");
        // } else {
        // GetErrorMessage("There is an error while deleting concern");
        // }
    }

    /*
     * UpdateCompliment() function wii update the compliment information
     * This function requires compliment code, new compliment code, and compliment name
     * it returns success or failure message to the ajax
     */
    public function UpdateCompliment()
    {
        $this->object->UserId = $this->session->userdata("User_Code");
        $this->object->Compliment_Code = $this->input->post("objectid");
        $this->object->Compliment_Text = $this->input->post("Compliment_Text");
        $this->kahocrudservice->updateRecord($this);
        // $OutputParam = array("Result");
        //
        // $res = $this->bcompliment->Update($this->object, $OutputParam);
        // (int) $res['Result'] > 0 ? GetSuccessMessage($res, "updatecompliment", " ", "Compliment Updated Successfully") : GetErrorMessage("There is an error while updating compliment");
    }

    public function getComplimentForEditRecord()
    {
        $this->object->complimentCode = $this->input->post("Compliment_Code");
        $this->kahocrudservice->getEditRecord($this);
    }

    public function getComplimentList($pageNo = 1, $noOfRecordPerPage = 10, $sorting = "")
    {
        $conf = $this->getGridListRespConf();
        $conf[$this->gridListKey] = array(
            "Compliment_Code" => "Compliment_Text"
        );
        $this->kahocrudservice->getGridList($this, $conf, $pageNo, $noOfRecordPerPage, $sorting);
    }
    
    /*
     * GetComplimentList() function Lists out all the compliment information
     */
    
    // public function GetCompliment($id = null) {
    // $id !== NULL ? $this->object->Compliment_Code = $id : $this->object->Compliment_Code = null;
    // $res = $this->bcompliment->Get($this->object);
    // if (empty($res)) {
    // GetErrorMessage("No Compliments Found");
    // } else {
    // GetSuccessMessage($res, "GetCompliment");
    // }
    // }
    
    /*
     * SearchCompliment() is to search items in the compliment
     */
    
    // public function SearchCompliment() {
    //
    // $ComplimentObj = $this->object;
    //
    // $ColumnName = $this->input->post("column_name");
    // $Operator = $this->input->post("operator");
    // $keyword = $this->input->post("keyword");
    // $ComplimentObj->UserId = $this->session->userdata("User_Code");
    // $ComplimentObj->TableName = "tCompliment";
    // $ComplimentObj->Codition = Search($ColumnName, $Operator, $keyword);
    // $ComplimentObj->PageNo = "";
    // $ComplimentObj->RecordCount = "";
    // $SearchResult = $this->bcompliment->GetObjectReportWithCache("sGetListByPage", $ComplimentObj);
    // if ($SearchResult !== NULL) {
    // GetSuccessMessage($SearchResult, "GetComplimentList");
    // } else {
    // GetErrorMessage("fail");
    // }
    // }
    // public function uploadCSVFile() { // would be used to upload csv file and insert the data
    // $attachedFileData = $_FILES['csvattachment'];
    // $this->config->load("validation_configuration"); // loading the validation configuration library
    // $complimentImportConfiguration = $this->config->item("validation_configuration")['complimentimport'];
    // $validateMsg = validateUploadedMasterDataCSV($attachedFileData, $complimentImportConfiguration); // validate the uploaded csv data and will return the error if any.... first param would be attachement data and second param would be validation config keys name
    // /* move uploaded file */
    // $fileName = $this->session->userdata("UploadedCSVFileName");
    // $Source = GetConfigItem("uploading_csv_path") . $fileName;
    // $Path = GetClientWD("adminwd", GetConfigItem("compliment_csv_path"), $this) . $fileName;
    // copy($Source, $Path);
    //
    //
    // if (empty($validateMsg) === true) {
    // $this->load->library(array("compliment/bcompliment", "compliment/object"));
    // $this->object->UserCode = $this->session->userdata("User_Code");
    // $this->object->filename = $this->session->userdata("UploadedCSVFileName");
    //
    // $OutPutParam = array("insertedcount", "ErrorMsg");
    // $datas = $this->bcompliment->QueryBuilder($this->object, $OutPutParam);
    // if (isset($datas['insertedcount']) && (int) $datas['insertedcount'] > 0) {
    // unlink($Source);
    // $this->session->unset_userdata("UploadedCSVFileName"); // need to free the key
    // GetSuccessMessage($datas, "GetUploadedCSVCount");
    // } else {
    // $this->session->unset_userdata("UploadedCSVFileName"); // need to free the key
    // $err = $datas["ErrorMsg"];
    // if (empty($err) == true) {
    // GetErrorMessage("There is some problem while uploading");
    // } else {
    // GetErrorMessage($err);
    // }
    // }
    // } else {
    // $this->session->unset_userdata("UploadedCSVFileName");
    // GetErrorMessage($validateMsg);
    // }
    // }
    // public function DownloadComplimentTemplate() {
    // DownloadTemplate("compliment.csv", "download_template");
    // }
}
