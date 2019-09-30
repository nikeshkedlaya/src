<?php

/**
 * @created by Karthik <karthik@kaholabs.com> on 02-Jun-2015 11:33:38
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
class lessonplan extends KaHO_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array(
            "lessonplan/blessonplan",
            "lessonplan/clessonplan"
        ));
    }

    public function index()
    {
        $data['filename'] = __CLASS__;
        $data['title'] = "Lesson Plan";
        $data['includejs'] = "listlessonplan";
        $data['includecss'] = "listlessonplan";
        $data['Name'] = $this->session->userdata("Name");
        
        $this->load->view("html_temp/html_header", $data);
        $this->load->view("html_temp/html_sidemenu", $data);
        $this->load->view("admin/lessonplan/lessonplanlist", $data);
        $this->load->view("html_temp/html_footer", $data);
    }

    public function uploadCSVFile()
    { // would be used to upload csv file and insert the data
        $attachedFileData = $_FILES['csvattachment'];
        $FromDate = $_POST["From_Date"];
        $ToDate = $_POST["To_Date"];
        $Description = $_POST["Description"];
        $this->config->load("validation_configuration"); // loading the validation configuration library
        $lessonplanImportConfiguration = $this->config->item("validation_configuration")['lessonplanimport'];
        $validateMsg = validateUploadedMasterDataCSV($attachedFileData, $lessonplanImportConfiguration); // validate the uploaded csv data and will return the error if any.... first param would be attachement data and second param would be validation config keys name
        
        /* move uploaded file */
        $fileName = $this->session->userdata("UploadedCSVFileName");
        $Source = GetConfigItem("uploading_csv_path") . $fileName;
        $Path = GetConfigItem("lessonplan_csv_path") . $fileName;
        copy($Source, $Path);
        
        if (empty($validateMsg) === true) {
            $this->load->library(array(
                "lessonplan/blessonplan",
                "lessonplan/clessonplan"
            ));
            $this->clessonplan->UserCode = $this->session->userdata("User_Code");
            $this->clessonplan->FromDate = trim($FromDate); // str_replace("-", "/", $FromDate);
            $this->clessonplan->ToDate = trim($ToDate); // str_replace("-", "/", $ToDate);
            $this->clessonplan->Description = trim($Description);
            $this->clessonplan->filename = $this->session->userdata("UploadedCSVFileName");
            
            // print_r($this->clessonplan);
            // exit;
            $OutPutParam = array(
                "insertedcount"
            );
            $datas = $this->blessonplan->QueryBuilder($this->clessonplan, $OutPutParam);
            if ((int) $datas['insertedcount'] > 0) {
                unlink($Source);
                $this->session->unset_userdata("UploadedCSVFileName");
                GetSuccessMessage($datas, "GetUploadedCSVCount");
            } else {
                $this->session->unset_userdata("UploadedCSVFileName"); // need to free the key
                GetErrorMessage("There is some error while inserting the data");
            }
        } else {
            $this->session->unset_userdata("UploadedCSVFileName");
            GetErrorMessage($validateMsg);
        }
    }

    public function DownloadLessonplanTemplate()
    {
        // $fileName = $this->config->item("lessonplan_csv_filename");
        // DownloadTemplate($fileName . ".csv", "download_template");
        DownloadTemplate("lessonplan.csv", "download_template");
    }

    public function showLessonPlan()
    {
        $data['title'] = "Lesson Plan Detail";
        $data['filename'] = __CLASS__;
        $data['includejs'] = "showlessonplan";
        $data['includecss'] = "showlessonplan";
        $data['Name'] = $this->session->userdata("Name");
        $this->load->view("html_temp/html_header", $data);
        $this->load->view("html_temp/html_sidemenu", $data);
        $this->load->view("admin/lessonplan/showlessonplan");
        $this->load->view("html_temp/html_footer", $data);
    }

    public function GetLessonPlanDetails()
    {
        $this->clessonplan->AY_Code = $this->input->post("AY_Code");
        $this->clessonplan->Class_Code = $this->input->post("Class_Code");
        $this->clessonplan->Subject_Code = $this->input->post("Subject_Code");
        $lessonplan = $this->blessonplan->GetObjectReport("sLessonPlanDetailGet", $this->clessonplan);
        if (empty($lessonplan)) {
            GetErrorMessage("No data found");
        } else {
            GetSuccessMessage($lessonplan, "GetLessonPlanDetails");
        }
    }

    public function GetLessonPlan()
    {
        $this->clessonplan->Class_Code = $this->input->post("Class_Code");
        $this->clessonplan->Subject_Code = $this->input->post("Subject_Code");
        $this->clessonplan->AY_Code = $this->input->post("AY_Code");
        $result = $this->blessonplan->GetObjectReport("sLessonPlanGet", $this->clessonplan);
        if (empty($result)) {
            GetErrorMessage("No data found");
        } else {
            GetSuccessMessage($result, "GetLessonPlan");
        }
    }

    public function GetUploadFile($Type)
    {
        $data['title'] = "Upload Lesson Plan";
        $data['filename'] = __CLASS__;
        $data['includejs'] = "uploadlessonplan";
        $data['includecss'] = "uploadlessonplan";
        $data['Type'] = $Type;
        $data['Name'] = $this->session->userdata("Name");
        $this->load->view("html_temp/html_header", $data);
        $this->load->view("html_temp/html_sidemenu", $data);
        $this->load->view("admin/lessonplan/uploadlessonplan");
        $this->load->view("html_temp/html_footer", $data);
    }
}
