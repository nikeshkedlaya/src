<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Groupservice extends Kahoservices
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getGroupList()
    {
        $params = $this->getPostParams();
        $this->mergeAYNUserCodeToSPParams($params)->mergePaginationParamsToSPParams($params);
        $conf = array(
            Respstructurebuilder::CALLBACK_KEY => array(
                Kahoutility::getCallback([
                    $this,
                    "isGroupChangeable"
                ])
            )
        );
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse($conf);
    }

    public function getGroups()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params);
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }

    public function getGroupDetails()
    {
        $params = $this->getPostParams();
        $this->mergeAYNUserCodeToSPParams($params);
        $this->addDefaultParamToSPParams($params, "IsHierarchy", 0, 4);
        $conf = array(
            Respstructurebuilder::CALLBACK_KEY => array(
                $this,
                "appendPhoto"
            )
        );
        $this->kahoCrudServices->getRecord($this->getProcedureName(), $params)
            ->sendResponse($conf);
    }

    public function appendPhoto($data)
    {
        if (Kahoutility::checkArrayParam($data)) {
            if (Kahoutility::isStringParamValid($data['User_Type'])) {
                $path = NULL;
                switch ($data['User_Type']) {
                    case USER_TYPE_STUDENT:
                        $path = STUDENT_IMAGE_PATH;
                        break;
                    case USER_TYPE_TEACH:
                    case USER_TYPE_PRINCIPAL:
                    case USER_TYPE_STAFF:
                        $path = TEACHERS_IMAGE_PATH;
                        break;
                    default:
                }
                $data = Kahoutility::appendAbsoluteFilePath($data, "Photo", $path, true);
            }
        }
        return $data;
    }

    public function isGroupChangeable($groupVal)
    {
        $groupVal['isGroupChangeable'] = $groupVal['Created_By_User'] === $this->userCode ? true : FALSE;
        return $groupVal;
    }

    public function addGroup()
    {
        $this->getAddNUpdateGroupParams($this->getProcedureName());
    }

    public function updateGroup()
    {
        $this->getAddNUpdateGroupParams($this->getProcedureName());
    }

    private function getAddNUpdateGroupParams(string $spName)
    {
        $params = $this->getPostParams();
        $this->addDefaultParamToSPParams($params, "createdBy", $this->userCode, 1)
            ->changeParamsPosition($params, "Users", 2)
            ->processInputParams($params, [
            "Users" => [
                [
                    $this,
                    "addLoggedInUserInGroup"
                ]
            ]
        ])
            ->changeParamsPosition($params, "Group_Name", 3)
            ->changeParamsPosition($params, "Group_Id", 4);
        $this->kahoCrudServices->addRecord($spName, $params)->sendResponse();
    }

    public function addLoggedInUserInGroup($selectedUsersForGroup)
    {
        $selectedUsersForGroupStr = NULL;
        if (Kahoutility::checkArrayParam($selectedUsersForGroup)) {
            $selectedUsersForGroupStr = Kahoutility::splitArrayByDelimiter($selectedUsersForGroup) . "|" . USER_TYPE_STAFF . "," . $this->userCode;
        }
        return $selectedUsersForGroupStr;
    }

    public function deleteGroup()
    {
        $params = $this->getPostParams();
        $this->addUserCodeAsFirstParam($params);
        $this->kahoCrudServices->deleteRecord($this->getProcedureName(), $params)
            ->sendResponse();
    }
}
