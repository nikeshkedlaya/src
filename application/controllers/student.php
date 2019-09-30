<?php

/**
 * @created by Nikesh<nikesh@kaholabs.com> on 15 Nov, 2014 11:40:50 AM
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
class Student extends KaHO_Controller
{

    public function __construct()
    {
        parent::__construct("student/studentservice");
    }

    public function getStudentsList()
    {
        $this->studentservice->getStudentsList();
    }

    public function getHomeworkListForStudent()
    {
        $this->studentservice->getHomeworkListForStudent();
    }

    public function getStudentProfile()
    {
        $this->studentservice->getStudentProfile();
    }

    public function getStudentsListByClasses()
    {
        $this->studentservice->getStudentsListByClasses();
    }

    public function observationDetailAdd()
    {
        $this->studentservice->observationDetailAdd();
    }

    public function complimentDetailAdd()
    {
        $this->studentservice->complimentDetailAdd();
    }

    // public function GetStudentsList() {
    // $this->object->ayCode = empty($this->input->post("ayCode")) ? NULL : $this->input->post("ayCode");
    // $this->object->SAYCode = $this->input->post("SAYCode");
    // $this->object->PageNo = $this->input->post("PageNo");
    // $this->object->NoOfRec = $this->input->post("NoOfRec");
    // $classSection = $this->bstudent->GetObjectReportWithCache("sGetStudentsList", $this->object);
    // if (empty($classSection)) {
    // GetErrorMessage("fail");
    // } else {
    // foreach ($classSection as $key => &$val) {
    // if (isset($val['Photo'])) {
    // if (!isStringParamValid($val['Student_Attachment_path'] = $val['Photo'])) {
    // $val['Student_Attachment_path'] = "";
    // } else {
    // $val['Student_Attachment_path'] = getUploadedBasePath($this->config->item("students_image_path"), $this) . $val['Student_Attachment_path'];
    // }
    // } else {
    // $val['Student_Attachment_path'] = "";
    // }
    // }
    // GetSuccessMessage($classSection, "GetStudentsList");
    // }
    // }
    // public function GetHomeworkListForStudent() {
    // $this->object->StudentCode = $this->input->post("StudentCode");
    // $this->object->PageNo = $this->input->post("PageNo");
    // $this->object->NoOfRec = $this->input->post("NoOfRec");
    // $GetHomeworkListForStudent = $this->bstudent->GetObjectReportWithCache("sGetHomeworkListForStudent", $this->object);
    // if (empty($GetHomeworkListForStudent)) {
    // GetErrorMessage("fail");
    // } else {
    // foreach ($GetHomeworkListForStudent as $key => &$val) {
    // if (isset($val['Attachment'])) {
    // if (!isStringParamValid($val['Homework_Attachment_path'] = $val['Attachment'])) {
    // $val['Homework_Attachment_path'] = "";
    // } else {
    // $val['Homework_Attachment_path'] = getUploadedBasePath($this->config->item("homework_attachment_path"), $this) . $val['Homework_Attachment_path'];
    // }
    // } else {
    // $val['Homework_Attachment_path'] = "";
    // }
    // }
    // GetSuccessMessage($GetHomeworkListForStudent, "GetHomeworkListForStudent");
    // }
    // }
    // public function GetStudentProfile() {
    // $this->object->Student_Code = $this->input->post("Student_Code");
    // $GetStudentProfile = $this->bstudent->GetObjectReport("sGetStudentProfile", $this->object);
    // // sendResponse($GetStudentProfile, "GetStudentProfile");
    // if (empty($GetStudentProfile)) {
    // GetErrorMessage("fail");
    // } else {
    // foreach ($GetStudentProfile as $key => &$val) {
    // if (isset($val['Photo'])) {
    // if (!isStringParamValid($val['Student_Attachment_path'] = $val['Photo'])) {
    // $val['Student_Attachment_path'] = "";
    // } else {
    // $val['Student_Attachment_path'] = getUploadedBasePath($this->config->item("students_image_path"), $this) . $val['Student_Attachment_path'];
    // }
    // } else {
    // $val['Student_Attachment_path'] = "";
    // }
    // }
    // GetSuccessMessage($GetStudentProfile, "GetStudentProfile");
    // }
    // }
    public function getStudentMyInputs()
    {
        $this->studentservice->getStudentMyInputs();
    }

    public function getAssessmentListForStudent()
    {
        $this->studentservice->getAssessmentListForStudent();
    }

    // public function GetStudentAssessmentList() {
    // $this->object->ayCode = empty($this->input->post("ayCode")) ? NULL : $this->input->post("ayCode");
    // $this->object->StudentCode = $this->input->post("StudentCode");
    // $GetStudentAssessmentList = $this->bstudent->GetObjectReport("sGetStudentAssessmentList", $this->object);
    // sendResponse($GetStudentAssessmentList, "GetStudentAssessmentList");
    // }
    public function getStudentAssessmentGraph()
    {
        $this->studentservice->getStudentAssessmentGraph();
    }

    // public function GetStudentGraphByAssessment() {
    // $this->object->StudentCode = $this->input->post("StudentCode");
    // $this->object->AssessmentID = $this->input->post("AssessmentID");
    // $GetStudentGraphByAssessment = $this->bstudent->GetObjectReport("sGetStudentGraphByAssessment", $this->object);
    // sendResponse($GetStudentGraphByAssessment, "GetStudentGraphByAssessment");
    // }
    public function getStudentSubjectTrend()
    {
        $this->studentservice->getStudentSubjectTrend();
    }

    public function getStudentLatestAssessmentGraph()
    {
        $this->studentservice->getStudentLatestAssessmentGraph();
    }

    public function getAssessmentListByClass()
    {
        $this->studentservice->getAssessmentListByClass();
    }

    // public function GetStudentMarksTrendBySubject() {
    // $this->object->ayCode = empty($this->input->post("ayCode")) ? NULL : $this->input->post("ayCode");
    // $this->object->StudentCode = $this->input->post("StudentCode");
    // $this->object->Subject_Code = $this->input->post("Subject_Code");
    // $GetStudentMarksTrendBySubject = $this->bstudent->GetObjectReport("sGetStudentMarksTrendBySubject", $this->object);
    // sendResponse($GetStudentMarksTrendBySubject, "GetStudentMarksTrendBySubject");
    // }
    public function concernAdd()
    {
        $this->studentservice->concernAdd();
    }

    // public function ConcernAdd() {
    // $this->object->userCode = $this->session->userdata("User_Code");
    // $this->object->Concern = $this->input->post("Concern");
    // $this->object->Description = trim($this->input->post("Description"));
    // $this->object->Student_Codes = trim($this->input->post("Student_Codes"));
    // $this->object->IsResolved = $this->input->post("IsResolved");
    // $this->object->Resolution = $this->input->post("Resolution");
    // $this->object->Assign_To = trim($this->input->post("Assign_To"));
    // $this->object->Comments = trim($this->input->post("Comments"));
    // $this->object->Share_To = trim($this->input->post("Share_To"));
    // $ConcernAdd = $this->bstudent->GetObjectReport("sConcernAdd", $this->object);
    // sendResponse($ConcernAdd, "ConcernAdd");
    // }
    // public function getConcernToResolve() {
    // $this->studentservice->getConcernToResolve();
    // }
    // public function GetConcernToResolve() {
    // $this->object->ayCode = empty($this->input->post("ayCode")) ? NULL : $this->input->post("ayCode");
    // $this->object->userCode = $this->session->userdata("User_Code");
    // $this->object->PageNo = trim($this->input->post("PageNo"));
    // $this->object->NoOfRec = trim($this->input->post("NoOfRec"));
    // $GetConcernToResolve = $this->bstudent->GetObjectReport("sGetConcernToResolve", $this->object);
    // sendResponse($GetConcernToResolve, "GetConcernToResolve");
    // }
    public function getConcernStudents()
    {
        $this->studentservice->getConcernStudents();
    }

    // public function GetConcernStudents() {
    // $this->object->Concern_ID = trim($this->input->post("Concern_ID"));
    // $GetConcernStudents = $this->bstudent->GetObjectReport("sGetConcernStudents", $this->object);
    // sendResponse($GetConcernStudents, "GetConcernStudents");
    // }
    public function getSharedUsersComment()
    {
        $this->studentservice->getSharedUsersComment();
    }

    // public function GetSharedUsersComment() {
    // $this->object->Concern_ID = trim($this->input->post("Concern_ID"));
    // $GetSharedUsersComment = $this->bstudent->GetObjectReport("sGetSharedUsersComment", $this->object);
    // sendResponse($GetSharedUsersComment, "GetSharedUsersComment");
    // }
    public function getConcernHistory()
    {
        $this->studentservice->getConcernHistory();
    }

    public function getConcernFlow()
    {
        $this->studentservice->getConcernFlow();
    }

    public function getConcernsList()
    {
        $this->studentservice->getConcernsList();
    }

    public function getConcernShareList()
    {
        $this->studentservice->getConcernShareList();
    }

    public function updateConcern()
    {
        $this->studentservice->updateConcern();
    }

    public function addSharedUserComment()
    {
        $this->studentservice->addSharedUserComment();
    }

    public function getMyInputsList()
    {
        $this->studentservice->getMyInputsList();
    }

    public function updateStudentProfile()
    {
        $this->studentservice->updateStudentProfile();
    }

    public function uploadStudentProfilePics()
    {
        $this->studentservice->uploadStudentProfilePics();
    }

    public function uploadStudentInputAttachment()
    {
        $this->studentservice->uploadStudentInputAttachment();
    }
}
