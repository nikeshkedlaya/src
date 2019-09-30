<?php

/**
 * @created by Nikesh<nikesh@kaholabs.com> on 21 Jan, 2015 3:58:51 PM
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
class Kahocommon extends KaHO_Controller
{

    public function __construct()
    {
        parent::__construct("kahocommonservice");
    }

    public function getLookUpType($typeCode)
    {
        $this->kahocommonservice->getLookUpType();
    }

    public function getUserList()
    {
        $this->kahocommonservice->getUserList();
    }

    public function deleteAttachment()
    {
        $this->kahocommonservice->deleteAttachment();
    }

    public function getAcademicYearList()
    {
        $this->kahocommonservice->getAcademicYearList();
    }

    public function getClassSectionList($ayCode)
    {
        $this->kahocommonservice->getClassSectionList();
        // $this->ckahocommon->Ay_Code = $AyCode;
        // $ClassSection = $this->bkahocommon->GetObjectReportWithCache("sClassGetListByAY", $this->ckahocommon);
        //
        // if (empty($ClassSection)) {
        // GetErrorMessage("fail");
        // } else {
        // GetSuccessMessage($ClassSection, "GetClassSectionList");
        // }
    }

    public function getMonths()
    {
        $this->kahocommonservice->getMonths();
        // $Result = $this->bkahocommon->GetObjectReportWithCache("sMonthsGet");
        // if (empty($Result) === TRUE) {
        // GetErrorMessage("There is no user code found");
        // } else {
        // GetSuccessMessage($Result, "GetMonths");
        // }
    }

    public function getAllUserListWithGroup()
    {
        $this->kahocommonservice->getAllUserListWithGroup();
    }

    public function getUsersWithGroup()
    {
        $this->kahocommonservice->getUsersWithGroup();
    }

    public function getTeachersWithGroup()
    {
        $this->kahocommonservice->getTeachersWithGroup();
    }

    public function getCharacteristics($type = null)
    {
        $this->kahocommonservice->getCharacteristics();
    }

    public function getCharacteristicsList()
    {
        $this->kahocommonservice->getCharacteristicsList();
    }

    public function getTags()
    {
        $this->kahocommonservice->getTags();
    }

    public function getLPFormat()
    {
        $this->kahocommonservice->getLPFormat();
    }

    public function getConfig()
    {
        $this->kahocommonservice->getConfig();
    }

    public function changeAYCode()
    {
        $this->kahocommonservice->changeAYCode();
    }

    public function switchStudentInSession()
    {
        $this->kahocommonservice->switchStudentInSession();
    }

    public function getGrades()
    {
        $this->kahocommonservice->getGrades();
    }

    // public function GetUserType() { // to know the logged user type
    // $this->kahocommonservice->
    // // $this->load->library("session");
    // // $UserType = $this->session->userdata($this->session->userdata("User_Code"));
    // // echo json_encode($UserType[0]);
    // }
    // public function GetConfig() {
    // $result = $this->bkahocommon->GetObjectReport("sConfigGet");
    // if (empty($result)) {
    // GetErrorMessage("No data found");
    // } else {
    // GetSuccessMessage($result, "GetConfig");
    // }
    // }
    // public function GetFeeMode($feeOrder = 1) {
    // $this->ckahocommon->FeeOrder = $feeOrder;
    // $result = $this->bkahocommon->GetObjectReport("sFeeModeGet", $this->ckahocommon);
    // if (empty($result)) {
    // GetErrorMessage("There is no fee mode found");
    // } else {
    // GetSuccessMessage($result, "GetFeeMode");
    // }
    // }
    // public function getReportsTo($Teacher_Code) {
    // $this->ckahocommon->Teacher_Code = $Teacher_Code;
    // $Result = $this->bkahocommon->GetObjectReportWithCache("sReportsToGet", $this->ckahocommon);
    // if (empty($Result) === TRUE) {
    // GetErrorMessage("There is not user to report to");
    // } else {
    // GetSuccessMessage($Result, "getReportsTo");
    // }
    // }
    // public function getAssignedUser($Ticket_ID) {
    // $this->ckahocommon->Ticket_ID = $Ticket_ID;
    // $Result = $this->bkahocommon->GetObjectReport("sGetTicketAssignedUser", $this->ckahocommon);
    // if (empty($Result) === TRUE) {
    // GetErrorMessage("There are no tasks");
    // } else {
    // GetSuccessMessage($Result, "getTicketForToday");
    // }
    // }
    // public function getUserCodeBySectionAYCode($Section_AY_Code) {
    // $this->ckahocommon->Section_AY_Code = $Section_AY_Code;
    // $Result = $this->bkahocommon->GetObjectReportWithCache("sGetUserCodeBySectionAYCode", $this->ckahocommon);
    // if (empty($Result) === TRUE) {
    // GetErrorMessage("There is no student code found");
    // } else {
    // GetSuccessMessage($Result, "getUserCodeBySectionAYCode");
    // }
    // }
    // public function getUserCodeByGroupId($GroupId) {
    // $this->ckahocommon->Group_Id = str_replace("-", "|", $GroupId); //relacing here because | chars not allowed in http url by ci
    // $Result = $this->bkahocommon->GetObjectReport("sGetUserCodeByGroupId", $this->ckahocommon);
    // if (empty($Result) === TRUE) {
    // GetErrorMessage("There is no user code found");
    // } else {
    // GetSuccessMessage($Result, "getUserCodeByGroupId");
    // }
    // }
    // public function UploadMedia() {
    //
    // $photoName = uploadMedia($this->config->item("teachers_image_path"), $_FILES['media']);
    // if ($photoName !== false) {
    // GetSuccessMessage($photoName, "UploadMedia");
    // } else {
    // GetErrorMessage("there is an error while uploading media files");
    // }
    // }
    // public function getSchoolList() {
    // $getSchoolSelectionMode = GetRequestedClientConfigurations("school_selection_mode", $this);
    // if ($getSchoolSelectionMode === "dropdown") {
    // $schoolList = $this->bkahocommon->GetObjectReportWithCache("sUserDropdownGet");
    // } else {
    // $schoolList = "";
    // }
    //
    // if (!empty($schoolList)) {
    // GetSuccessMessage($schoolList, "GetSchoolList");
    // } else {
    // GetErrorMessage("there is an error", "ERR003");
    // }
    // }
    // public function getCacheConfiguration() {
    // $cacheConfiguration = $this->bkahocommon->GetObjectReportWithCache("sCacheConfigurationGet");
    // if (!empty($cacheConfiguration)) {
    // GetSuccessMessageWithPreDefinedStructure(getCacheConfigurationArrayStructure($cacheConfiguration), "GetCacheConfiguration");
    // } else {
    // GetErrorMessage("there is no cache configuration found");
    // }
    // }
    // public function getHierarchicalFollowTeachers($Teacher_Code) {
    // $this->ckahocommon->Teacher_Codes = $Teacher_Code;
    // $hierarchicalFollowTeachers = $this->bkahocommon->GetObjectReportWithCache("sGetReportsToUsers", $this->ckahocommon);
    // if (!empty($hierarchicalFollowTeachers)) {
    // GetSuccessMessage($hierarchicalFollowTeachers, "GetHierarchicalFollowTeachers");
    // } else {
    // GetErrorMessage("there is no followed teachers found");
    // }
    // }
    // public function GetCategoryList() {
    // $res = $this->bkahocommon->GetObjectReport("sCasteCategoryGet", null);
    // if (!empty($res)) {
    // GetSuccessMessage($res, "GetCategoryList");
    // } else {
    // GetErrorMessage("No data found");
    // }
    // }
    public function getSlugName($string)
    {
        echo Kahoutility::convertStringToSlugName($string);
    }

    public function addUserFollowUp()
    {
        $this->kahocommonservice->addUserFollowUp();
    }

    public function getMenuList()
    {
        $this->kahocommonservice->getMenuList();
    }

    // public function getTest() {
    // $ciLibrary = Kahoutility::getCILibrary();
    // $ciLibrary->load->library(["processattachmentservice", "thumbnailbuilder"]);
    // $dir = getcwd() . "/" . Kahoutility::getClientWD(WORKING_DIRECTORY_WEB_KEY);
    // $thumbnailbuilder = $ciLibrary->thumbnailbuilder;
    // $scandir = scandir($dir);
    // foreach ($scandir as $val) {
    // if ($val !== "." && $val !== "..") {
    // if ((is_dir($dir . "/" . $val))) {
    // if ($openDir = opendir($dir . "/" . $val)) {
    // while (($file = readdir($openDir)) !== false) {
    // if ($file !== "." && $file !== "..") {
    // $this->processImage($dir . "/" . $val . "/" . $file, $thumbnailbuilder);
    // }
    // }
    // closedir($openDir);
    // }
    // }
    // }
    // }
    // }
    private function processImage($fileName, $thumbnailbuilder)
    {
        $attachmentType = Processattachmentservice::getMediaTypeFromFileExtension(Processattachmentservice::getAttachedFileExtention($fileName));
        switch ($attachmentType) {
            case MEDIA_TYPE_VIDEO:
                $thumbnailbuilder->buildVideoThumbnail($fileName);
                break;
            case MEDIA_TYPE_IMAGE:
                $thumbnailbuilder->buildImageThumbnail($fileName);
                break;
        }
    } 
    
    public function getMDMReasons()
    {
        $this->kahocommonservice->getMDMReasons();
    }
}
