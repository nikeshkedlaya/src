<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Kahocommonservice
 *
 * @author KaHO
 */
class Kahocommonservice extends Kahoservices {

    // put your code here
    public function __construct() {
        parent::__construct();
    }

    public function getLookUpType($lookUpType = null) {
        parent::getLookUpType();
    }

    public function getUserList() {
        $params = [];
        $this->mergeAYNUserCodeToSPParams($params)
                ->addDefaultParamToSPParams($params, "userType", $this->userType)
                ->addDefaultParamToSPParams($params, "isHierarchy", 0);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

    public function getMonths() {
        $this->kahoCrudServices->getRecord($this->getProcedureName())->sendResponse();
    }

    // <editor-fold defaultstate="collapsed" desc="getAllUserListWithGroup">
    /**
     * will return the list of relevant users to such as teacher,student and group
     */
    public function getAllUserListWithGroup() {
        $spParams = $this->getPostParams();
        $this->mergeAYNUserCodeToSPParams($spParams)
                ->setDefaultValueIfPostValNotFound($spParams, "userType", $this->userType, 3)
                ->setDefaultValueIfPostValNotFound($spParams, "isHierarchy", 0, 4);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $spParams)
                ->sendResponse();
    }

    // </editor-fold>
    public function getTeachersWithGroup() {
        $params = [];
        $this->addUserCodeAsFirstParam($params);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

    public function getCharacteristics() {
        $params = $this->getUriSegments();
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

    public function getCharacteristicsList() {
        $conf = array(
            "Type_ID" => Respstructurebuilder::SHOW_ALL_KEY,
            Respstructurebuilder::GROUP_BY_KEY => "Type_ID"
        );
        $this->kahoCrudServices->getRecord($this->getProcedureName())
                ->sendResponse($conf, FALSE, TRUE);
    }

    public function getTags($tagType = null) {
        $params = $tagType ?? $this->getUriSegments();
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

    public function getUsersWithGroup() {
        $params = $this->getPostParams();
        $this->mergeAYNUserCodeToSPParams($params)
                ->addDefaultParamToSPParams($params, "User_Type", $this->userType)
                ->setDefaultValueIfPostValNotFound($params, "Is_Hierarchy", 0, 4);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

    public function deleteAttachment() {
        $params = $this->getPostParams();
        $isDeleted = Kahoutility::deleteFile(current($params));
        if ($isDeleted) {
            $this->kahoCrudServices->printResponse([
                'deleted' => true
                    ], FALSE, "deleteFile", "file deleted successfully", Kahocrudservices::RESPONSE_FOUND);
        } else {
            $this->kahoCrudServices->printResponse(NULL, FALSE, "deleteFile", "file not deleted successfully", Kahocrudservices::RESPONSE_NOT_FOUND);
        }
    }

    public function getLPFormat() {
        $dbResp = $this->kahoCrudServices->getRecord($this->getProcedureName())
                ->getResponse();
        if ($this->kahoCrudServices->isDBOperationSuccess()) {
            $lpDetailsXMLTOArray = Kahoutility::convertXMLToArray($dbResp[0]['LP_Detail']);
            $this->kahoCrudServices->printResponse($lpDetailsXMLTOArray, true, "getLPFormat");
        } else {
            $this->kahoCrudServices->printResponse($dbResp, FALSE, "getLPFormat");
        }
    }

    private function convertLPDetailsXMLTOArray($lpDetailsXML) {
        $arrayResp = Kahoutility::convertXMLToArray($lpDetailsXML);
        $lpDetailsXMLTOArray;
        settype($arrayResp, "array");
        foreach ($arrayResp as $key => $val) {
            $lpDetailsXMLTOArray[$key] = $val;
            if ($key === "SchoolSpecific") {
                if (empty($val)) {
                    $lpDetailsXMLTOArray[$key] = "";
                } else {
                    if (is_object($val->Field)) {
                        $lpDetailsXMLTOArray[$key]->Field[] = $val->Field;
                    }
                }
            }
        }
        return $lpDetailsXMLTOArray;
    }

    public function getConfig() {
        $dbResp = $this->kahoCrudServices->getRecord($this->getProcedureName())
                ->getResponse();
        if ($this->kahoCrudServices->isDBOperationSuccess()) {
            $lpDetailsXMLTOArray = Kahoutility::convertXMLToArray($dbResp[0]['LP_Detail']);
            $qualityAspectXMLTOArray = Kahoutility::convertXMLToArray($dbResp[0]['Quality_Aspect']);
            $dbResp[0]['NamingConvention'] = $lpDetailsXMLTOArray;
            $dbResp[0]['Quality_Aspect'] = $qualityAspectXMLTOArray;
            $vals = & $dbResp[0]['NamingConvention']['SchoolSpecific'];
            $vals = isset($vals['Field']) ? $vals : "";
            $this->kahoCrudServices->printResponse($dbResp[0], true, "getConfig");
        } else {
            $this->kahoCrudServices->printResponse($dbResp, FALSE, "getConfig");
        }
    }

    public function getAcademicYearList() {
        $this->kahoCrudServices->getRecord($this->getProcedureName())
                ->sendResponse();
    }

    public function changeAYCode() {
        $printResp = $this->changeSessionVal(AY_CODE);
        if (Kahoutility::checkArrayParam($printResp)) {
            $this->kahoCrudServices->printResponse($printResp, FALSE, "changeAYCode", "", Kahocrudservices::CUDU_CHANGED);
        } else {
            $this->kahoCrudServices->printResponse(NULL, FALSE, "changeAYCode", "there is an error to update the session val", Kahocrudservices::CUDU_NOT_CHANGED);
        }
    }

    private function changeSessionVal($paramsKey) {
        $params = $this->getPostParams();
        $printResp = NULL;
        if (array_key_exists($paramsKey, $params) && Kahoutility::isStringParamValid($params[$paramsKey])) {
            Kahoutility::setCISessionValueByKey($paramsKey, $params[$paramsKey]);
            $sessionVal = Kahoutility::getCISessionValueByKey($paramsKey);
            $printResp = [
                $paramsKey => $sessionVal
            ];
        }
        return $printResp;
    }

    public function switchStudentInSession() {
        $printResp = $this->changeSessionVal(SELECTED_STUDENT_CODE);
        if (Kahoutility::checkArrayParam($printResp) && Kahoapplicationservice::getKaHOAppSerIns()->isUserTypeParent()) {
            $userCode = Kahoapplicationservice::getKaHOAppSerIns()->getUserCode();
            $studentObj = Kahoutility::getCISessionValueByKey($userCode);
            if (Kahoutility::checkArrayParam($studentObj)) {
                foreach ($studentObj as $value) {
                    if ($value['Student_Code'] === current($printResp)) {
                        $printResp = $value;
                        break;
                    }
                }
            }
            $this->kahoCrudServices->printResponse($printResp, true, "switchStudentInSession", "", Kahocrudservices::CUDU_CHANGED);
        } else {
            $this->kahoCrudServices->printResponse(NULL, FALSE, "switchStudentInSession", "there is an error to update the session val", Kahocrudservices::CUDU_NOT_CHANGED);
        }
    }

    public function addUserFollowUp() {
        $params = $this->getPostParams();
        $this->addUserCodeOrStudentCodeToParams($params)
                ->setDefaultValueIfPostValNotFound($params, USER_TYPE, $this->userType, 2)
                ->changeAllParamsPosition($params, [
                    'Object_Type',
                    'Transaction_ID'
                        ], 3);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
                ->sendResponse();
    }

    private function getParentMenuList(): array {
        $menuArray = [
            [
                'Menu_Name' => "Get Involved",
                "Class" => "gen_involved",
                "State_Name" => "studentEngagement.pending",
                "Sub_Menu" => ""
            ],
            [
                'Menu_Name' => "Student Activity",
                "Class" => "student_activity",
                "State_Name" => "myKidDetail.observation",
                "Sub_Menu" => ""
            ],
            [
                'Menu_Name' => "Learning Resource",
                "Class" => "learning_resources",
                "State_Name" => "learningresources.withme",
                "Sub_Menu" => ""
            ],
            [
                'Menu_Name' => "Gallery",
                "Class" => "gallery",
                "State_Name" => "gallery.fileslist",
                "Sub_Menu" => ""
            ],
            [
                'Menu_Name' => "Communication",
                "Class" => "communication",
                "Sub_Menu" => [
                    [
                        'Menu_Name' => "Mail",
                        "State_Name" => "teachercommunication.inbox",
                        "Class" => "communication"
                    ],
                    [
                        'Menu_Name' => "Announcement",
                        "State_Name" => "announcement.detail",
                        "Class" => "announcement"
                    ]
                ]
            ],
            [
                'Menu_Name' => "Calendar",
                "Class" => "calendar",
                "State_Name" => "teachercalendar.detail",
                "Sub_Menu" => ""
            ]
        ];
        return $menuArray;
    }

    public function getMenuList() {
        $menuArray = null;
        switch ($this->userType) {
            case USER_TYPE_TEACH:
                $menuArray = $this->getTeacherMenuList();
                break;
            case USER_TYPE_PRINCIPAL:
                $menuArray = $this->getPrincipalMenuList();
                break;
            case USER_TYPE_PARENT:
                $menuArray = $this->getParentMenuList();
                break;
        }
        $this->kahoCrudServices->printResponse($menuArray, FALSE, "getMenuList", "", Kahocrudservices::RESPONSE_FOUND);
    }

    private function getTeacherMenuList() {
        $menus = $this->getCommonMenuForTeacherNPrincipal();
        $approvals = [
            'Menu_Name' => "Concern",
            "State_Name" => "concern.pending",
            "Class" => "concern"
        ];
        array_push($menus['0']["Sub_Menu"], $approvals);
        return $menus;
    }

    private function getPrincipalMenuList() {
        $menus = $this->getCommonMenuForTeacherNPrincipal();
        $approvals = [
            'Menu_Name' => "Approvals",
            "State_Name" => "approval.pending",
            "Class" => "approvals"
        ];
        $schoolAnalysis = [
            'Menu_Name' => "School Analysis",
            "State_Name" => "schooldoinganalysis.classwise",
            "Class" => "substitute",
            "Sub_Menu" => ""
        ];
        array_push($menus['0']["Sub_Menu"], $approvals);
        array_push($menus, $schoolAnalysis);
        return $menus;
    }

    private function getCommonMenuForTeacherNPrincipal(): array {

        $menuArray = [
            [
                'Menu_Name' => "Operation",
                "Class" => "operation",
                "Sub_Menu" => [
                    [
                        'Menu_Name' => "Teacher Attendance",
                        "State_Name" => "teacherattendance.detail",
                        "Class" => "substitute"
                    ],
                    [
                        'Menu_Name' => "Roster Duty",
                        "State_Name" => "rosterduty.detail",
                        "Class" => "roster_duty"
                    ],
                    [
                        'Menu_Name' => "Task",
                        "State_Name" => "teachertask.pending",
                        "Class" => "task"
                    ],
                    [
                        'Menu_Name' => "Announcement",
                        "State_Name" => "announcement.detail",
                        "Class" => "announcements"
                    ],
                    [
                        'Menu_Name' => "My Group",
                        "State_Name" => "mygroup.detail",
                        "Class" => "group"
                    ],
                    [
                        'Menu_Name' => "Learning Resource",
                        "State_Name" => "learningresources.withme",
                        "Class" => "learning_resources"
                    ]
                ]
            ],
            [
                'Menu_Name' => "Quality",
                "Class" => "quality",
                "Sub_Menu" => [
                    [
                        'Menu_Name' => "Teacher Comments",
                        "State_Name" => "",
                        "Class" => "teacher_comments"
                    ],
                    [
                        'Menu_Name' => "Correction Report",
                        "State_Name" => "",
                        "Class" => "correction_report"
                    ],
                    [
                        'Menu_Name' => "Feedback",
                        "State_Name" => "feedback.surveylist",
                        "Class" => "feedback"
                    ],
                    [
                        'Menu_Name' => "Dairy Comments",
                        "State_Name" => "",
                        "Class" => "dairy_comments"
                    ]
                ]
            ],
            [
                'Menu_Name' => "Academics",
                "Class" => "academics",
                "Sub_Menu" => [
                    [
                        'Menu_Name' => "Lesson Plan",
                        "State_Name" => "lessonplan.detail",
                        "Class" => "lesson_plan"
                    ],
                    [
                        'Menu_Name' => "MCQ",
                        "State_Name" => "teachermcq.createdbyme",
                        "Class" => "mcq"
                    ],
                    [
                        'Menu_Name' => "Question Bank",
                        "State_Name" => "",
                        "Class" => "question_bank"
                    ]
                ]
            ],
            [
                'Menu_Name' => "Gallery",
                "State_Name" => "gallery.fileslist",
                "Class" => "gallery",
                "Sub_Menu" => ""
            ],
            [
                'Menu_Name' => "Calendar",
                "State_Name" => "teachercalendar.detail",
                "Sub_Menu" => "",
                "Class" => "calendar"
            ],
            [
                'Menu_Name' => "My Data",
                "Class" => "my_data",
                "Sub_Menu" => [
                    [
                        'Menu_Name' => "My Dairy",
                        "Class" => "my_dairy",
                        "State_Name" => "teachersDiary.view"
                    ],
                    [
                        'Menu_Name' => "My Observation",
                        "Class" => "my_observation",
                        "State_Name" => "teacherobservation.observed"
                    ],
                    [
                        'Menu_Name' => "My Feedback",
                        "State_Name" => "myFeedback.pending",
                        "Class" => "my_feedback"
                    ]
                ]
            ],
            [
                'Menu_Name' => "Traction",
                "State_Name" => "traction.detail",
                "Sub_Menu" => "",
                "Class" => "traction"
            ]
        ];
        return $menuArray;
    }

    public function getGrades() {
        $this->kahoCrudServices->getRecord($this->getProcedureName())
                ->sendResponse();
    }
    
    public function getMDMReasons() {
        $this->kahoCrudServices->getRecord($this->getProcedureName())
                ->sendResponse();
    }

}
