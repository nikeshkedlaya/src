<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Callhttprequest
 *
 * @author KaHO
 */
class Callhttprequest
{
 // would be used to call http ws request from script using file_get_contents specialy when need to call kaho common controller method as http request
    private static $getInstance;

    private function __construct()
    {}

    private static function GetInstance()
    {
        self::$getInstance = new Callhttprequest();
    }

    private static function GetResponse($httpURL, $jsonDecode = TRUE)
    {
        self::GetInstance();
        $httpContent = self::$getInstance->CallHTTPURL($httpURL, self::$getInstance->GetStreamContextForHTTP(), $jsonDecode);
        echo $httpContent;
        return $httpContent;
    }

    public static function CallHTTPURL($url, $streamContext, $jsonDecode = true)
    { // passing the sub url just like controller with method name and params
        $fileGetContents = @file_get_contents(GetBaseURI() . $url, false, $streamContext);
        if ($jsonDecode === TRUE) {
            $fileGetContents = json_decode($fileGetContents, true);
        }
        return $fileGetContents;
    }

    private function GetStreamContextForHTTP()
    {
        $opts = array(
            'http' => array(
                'method' => "GET",
                'header' => self::$getInstance->GetRequestedHeadersDetail()
            )
        );
        $context = stream_context_create($opts);
        return $context;
    }

    private function GetRequestedHeadersDetail()
    {
        $headerDetails = getallheaders();
        $header = "User-Agent: " . $headerDetails['User-Agent'] . "\r\nCookie: " . $headerDetails['Cookie'];
        return $header;
    }

    public static function GetUserCodeByGroupId($GroupId)
    {
        $httpURL = "kahocommon/getUserCodeByGroupId/" . $GroupId;
        $userCode = self::GetResponse($httpURL);
        if (empty($userCode['getUserCodeByGroupId']) === false) {
            return $userCode['getUserCodeByGroupId']['0']['User_Code'];
        }
    }

    public static function GetUserCodeBySectionAYCode($Section_AY_Code)
    { // will return the user code who assigned the task as string
        $httpURL = "kahocommon/getUserCodeBySectionAYCode/" . $Section_AY_Code;
        $assignedUserStr = self::GetResponse($httpURL);
        if (empty($assignedUserStr['getUserCodeBySectionAYCode']) === false) {
            return $assignedUserStr['getUserCodeBySectionAYCode']['0']['User_Code'];
        }
    }

    public static function GetAssignedUser($Ticket_ID)
    { // will return the user code who assigned the task as string
        $httpURL = "kahocommon/getAssignedUser/" . $Ticket_ID;
        $assignedUserStr = self::GetResponse($httpURL);
        if (empty($assignedUserStr['getTicketForToday']) === false) {
            return $assignedUserStr['getTicketForToday']['0']['Created_By'];
        }
    }

    public static function getLookUpList($lookUpType)
    { // will return the user code who assigned the task as string
        $httpURL = "kahocommon/admincommon/" . $lookUpType;
        $lookUpTypeResp = self::GetResponse($httpURL);
        return $lookUpTypeResp;
    }

    public static function GetHierarchicalFollowTeachers($Teacher_Code)
    { // will return the user code who assigned the task as string
        $httpURL = "kahocommon/getHierarchicalFollowTeachers/" . $Teacher_Code;
        $getHierarchicalFollowTeachers = self::GetResponse($httpURL);
        if ($getHierarchicalFollowTeachers['msg'] === "Success" && $getHierarchicalFollowTeachers['code'] === "SUC001") {
            if (empty($getHierarchicalFollowTeachers['GetHierarchicalFollowTeachers']) === false) {
                $getHierarchicalFollowTeachersCode = "";
                foreach (array_values($getHierarchicalFollowTeachers['GetHierarchicalFollowTeachers']) as $val) {
                    $getHierarchicalFollowTeachersCode .= empty($getHierarchicalFollowTeachersCode) === true ? $val['User_Code'] : "|" . $val['User_Code'];
                }
                return $getHierarchicalFollowTeachersCode;
            }
        }
    }
}
