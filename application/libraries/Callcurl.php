<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Callcurl
 *
 * @author Quadir
 */
class Callcurl
{

    // put your code here
    private $curlConn;

    private $curlResponse;

    private $ciLibrary;

    private static $callCurlIns;

    private function __construct()
    {
        $this->ciLibrary = GetCILibrary();
        $this->curlConn = curl_init();
        curl_setopt($this->curlConn, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curlConn, CURLOPT_SSL_VERIFYPEER, false);
    }

    public static function getCallCurlIns()
    {
        if (! isParamValid(self::$callCurlIns)) {
            self::$callCurlIns = new Callcurl();
        }
        return self::$callCurlIns;
    }

    public function setURL($url)
    {
        try {
            if (isStringParamValid($url)) {
                curl_setopt($this->curlConn, CURLOPT_URL, $url);
            } else {
                throw new NotificationException("url key is empty");
            }
        } catch (NotificationException $notificationExp) {
            $this->ciLibrary->writelog->writeErrorLog($notificationExp->GetNotificationExceptionMessage());
        }
        return $this;
    }

    public function setPostMethod($bool = true)
    {
        try {
            if ($bool === TRUE) {
                curl_setopt($this->curlConn, CURLOPT_POST, $bool);
            }
        } catch (NotificationException $notificationExp) {
            $this->ciLibrary->writelog->writeErrorLog($notificationExp->GetNotificationExceptionMessage());
        }
        return $this;
    }

    public function setHeaders($header)
    {
        try {
            if (checkArrayParam($header)) {
                curl_setopt($this->curlConn, CURLOPT_HEADER, true);
                curl_setopt($this->curlConn, CURLOPT_HTTPHEADER, $header);
            } else {
                throw new NotificationException("header is either empty or not in array structure");
            }
        } catch (NotificationException $notificationExp) {
            $this->ciLibrary->writelog->writeErrorLog($notificationExp->GetNotificationExceptionMessage());
        }
        return $this;
    }

    public function setPostData($postData)
    {
        try {
            if (isParamValid($postData)) {
                curl_setopt($this->curlConn, CURLOPT_POST, true);
                curl_setopt($this->curlConn, CURLOPT_POSTFIELDS, $postData);
            } else {
                throw new NotificationException("postdata is empty");
            }
        } catch (NotificationException $notificationExp) {
            $this->ciLibrary->writelog->writeErrorLog($notificationExp->GetNotificationExceptionMessage());
        }
        return $this;
    }

    public function getCurlResponse()
    {
        return $this->curlResponse;
    }

    public function callCurl()
    {
        $this->curlResponse = curl_exec($this->curlConn);
        // var_dump(curl_strerror(curl_errno($this->curlConn)));
        $this->curlResponse = $this->curlResponse === FALSE ? curl_error($this->curlConn) : $this->curlResponse;
        // var_dump($this->curlResponse);
        $this->ciLibrary->writelog->writeReturnedDebugLog(__METHOD__, $this->curlResponse);
        curl_close($this->curlConn);
        return $this;
    }
}
