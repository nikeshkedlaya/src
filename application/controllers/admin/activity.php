<?php

/**
 * @created by Karthik <karthik@kaholabs.com> on 20-Jan-2015 18:56:43
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

class Activity extends Kahoadmincontroller
{

    public function __construct()
    {
        parent::__construct("activityservice");
    }

    /*
     * AddActivity() function add's the activity data to the databae.
     * it requires activity code and activity name
     * it returs success or failure meesage to the ajax request
     */
    public function addActivity()
    {
        $this->activityservice->addRecord();
    }

    /*
     * DeleteActivity() function wii delete the activity information (mark as deleted) from the database
     * This function requires activity code
     * it returns success or failure message to the ajax
     */
    public function deleteActivity()
    {
        $this->activityservice->deleteActivity();
    }

    /*
     * UpdateActivity() function wii update the activity information
     * This function requires activity code, new activity code, and activity name
     * it returns success or failure message to the ajax
     */
    public function updateActivity()
    {
        $this->activityservice->update();
    }

    public function getActivityForEditRecord()
    {
        $this->activityservice->getEditRecord($this);
    }

    public function getActivityList($pageNo = 1, $noOfRecordPerPage = 10, $sorting = "1")
    {
        $this->activityservice->getActivityList();
    }

    public function getActivityType()
    {
        $this->activityservice->getActivityType();
    }

    public function uploadActivityCSVFile()
    {
        // $this->uploadCSVFile($this,$_FILES,NULL,)
    }

    public function uploadCSVFile()
    { // would be used to upload csv file and insert the data
        $attachedFileData = $_FILES['csvattachment'];
        // $this->config->load("validation_configuration"); // loading the validation configuration library
        // $teacherImportConfiguration = $this->config->item("validation_configuration")['activityimport'];
        // $validateMsg = validateUploadedMasterDataCSV($attachedFileData, $teacherImportConfiguration); // validate the uploaded csv data and will return the error if any.... first param would be attachement data and second param would be validation config keys name
        
        /* move uploaded file */
        // $fileName = $this->session->userdata("UploadedCSVFileName");
        // $Source = GetConfigItem("uploading_csv_path") . $fileName;
        // $Path = GetClientWD("adminwd", GetConfigItem("activity_csv_path"), $this) . $fileName;
        // copy($Source, $Path);
        
        if (empty($validateMsg) === true) {
            // $this->load->library(array("activity/bactivity", "activity/cactivity"));
            $this->cactivity->usercode = $this->session->userdata("User_Code");
            $this->cactivity->filename = $this->session->userdata("UploadedCSVFileName"); // getting the filename by session because
            
            $OutPutParam = array(
                "insertedcount",
                "ErrorMsg"
            );
            $datas = $this->bactivity->QueryBuilder($this->cactivity, $OutPutParam);
            if (isset($datas['insertedcount']) && (int) $datas['insertedcount'] > 0) {
                unlink($Source);
                $this->session->unset_userdata("UploadedCSVFileName"); // need to free the key
                GetSuccessMessage($datas, "GetUploadedCSVCount");
            } else {
                $this->session->unset_userdata("UploadedCSVFileName"); // need to free the key
                $err = isset($datas["ErrorMsg"]) ? $datas["ErrorMsg"] : "";
                if (empty($err) == true) {
                    GetErrorMessage("There is some problem while uploading");
                } else {
                    GetErrorMessage($err);
                }
            }
        } else {
            $this->session->unset_userdata("UploadedCSVFileName");
            GetErrorMessage($validateMsg);
        }
    }
}
