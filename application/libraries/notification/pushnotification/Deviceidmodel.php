<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Deviceidmodel
 *
 * @author KaHO
 */
final class Deviceidmodel
{

    // put your code here
    private $notificationBuilder;

    private static $deviceIdModelIns;

    private $ciLibrary;

    private function __construct()
    {
        $this->ciLibrary = Kahoutility::getCILibrary();
        // $this->ciLibrary->load->library("databaseservice");
    }

    public static function getDeviceIDModelIns()
    {
        if (is_null(self::$deviceIdModelIns)) {
            self::$deviceIdModelIns = new Deviceidmodel();
        }
        return self::$deviceIdModelIns;
    }

    public function getDevicesId(Notificationbuilder $notificationBuilder)
    {
        $dbResp = NULL;
        try {
            if ($notificationBuilder instanceof Notificationbuilder) {
                $this->notificationBuilder = $notificationBuilder;
                $params = $this->getProcedureParams();
                $dbResp = $this->ciLibrary->dbService->getRecord($this->getProcedureNameForDeviceIDByAudienceType(), $params);
            }
        } catch (Exception $exc) {} finally {
            return $this->buildStructureForDeviceID($dbResp);
        }
    }

    // <editor-fold defaultstate="collapsed" desc="buildStructureForDeviceID">
    private function buildStructureForDeviceID($deviceIDResp)
    {
        $deviceID = []; // platformType=>csv device id
        try {
            $deviceIDResp = $deviceIDResp[0]['pDevice_IDs'];
            if (Kahoutility::isStringParamValid($deviceIDResp)) {
                $deviceIDArr = explode("|", $deviceIDResp);
                array_map(function ($deviceIDArrElem) use (&$deviceID) {
                    $deviceIDExp = explode("~", $deviceIDArrElem);
                    $deviceID[$deviceIDExp[1]] = isset($deviceID[$deviceIDExp[1]]) ? $deviceID[$deviceIDExp[1]] . "," . $deviceIDExp[0] : $deviceIDExp[0];
                }, $deviceIDArr);
            }
        } catch (Exception $ex) {} finally {
            return $deviceID;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getProcedureNameForDeviceIDByAudienceType">
    private function getProcedureNameForDeviceIDByAudienceType()
    {
        $procedureNameForDeviceIDByAudienceType = "";
        switch ($this->notificationBuilder->getAudeinceType()) {
            case AUDIENCE_TYPE_STUDENT:
                $procedureNameForDeviceIDByAudienceType = "sGetDeviceIDsForStudents"; // sGetDeviceIDsForStudents(IN PStudent_Codes TEXT, IN PEvent_Type VARCHAR(1024))
                break;
            case AUDIENCE_TYPE_USERS:
                $procedureNameForDeviceIDByAudienceType = "sGetDeviceIDsForUsers"; // sGetDeviceIDsForUsers(IN PUsers TEXT, IN PEvent_Type VARCHAR(1024))
                break;
            case AUDIENCE_TYPE_GROUPS:
                $procedureNameForDeviceIDByAudienceType = "sGetDeviceIDsForGroups"; // sGetDeviceIDsForGroups(IN PGroup_IDs TEXT, IN PEvent_Type VARCHAR(1024))
                break;
            case AUDIENCE_TYPE_CLASS:
                $procedureNameForDeviceIDByAudienceType = "sGetDeviceIDsForClass"; // sGetDeviceIDsForClass(IN PAY_Code VARCHAR(16), IN PClass_Codes TEXT, IN PEvent_Type VARCHAR(1024))
                break;
            case AUDIENCE_TYPE_CLASS_SECTION:
                $procedureNameForDeviceIDByAudienceType = "sGetDeviceIDsForClassSection"; // sGetDeviceIDsForClassSection(IN PSection_AY_Codes TEXT, IN PEvent_Type VARCHAR(1024))
                break;
            case AUDIENCE_TYPE_USERS_WITH_GROUP:
                $procedureNameForDeviceIDByAudienceType = "sGetDeviceIDsForUsersWithGroup"; // sGetDeviceIDsForUsersWithGroup(IN PUsers_With_Group TEXT, IN PEvent_Type VARCHAR(1024))
                break;
            default: // AUDIENCE_TYPE_TEACHER
                $procedureNameForDeviceIDByAudienceType = "sGetDeviceIDsForTeachers"; // sGetDeviceIDsForTeachers(IN PTeacher_Codes TEXT, IN PEvent_Type VARCHAR(1024))
                break;
        }
        return $procedureNameForDeviceIDByAudienceType;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getProcedureParams">
    private function getProcedureParams()
    {
        $params = [
            'userCode' => $this->notificationBuilder->getUserCode(),
            "eventType" => $this->notificationBuilder->getEventType()
        ];
        return $params;
    }
    
    // </editor-fold>
}
