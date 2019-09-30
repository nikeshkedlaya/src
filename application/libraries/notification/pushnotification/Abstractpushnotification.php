<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Abstractpushnotification
 * Abstractpushnotification is abstract level push notification class which would be extended by concrete push notification class like android,windows,web and iphone
 * @author Quadir
 */
get_instance()->load->Iface("Notificationinterface");
include_once APPPATH . "libraries/Callcurl.php";

abstract class Abstractpushnotification implements NotificationInterface {

    //put your code here
    protected $notificationData;
    protected $ciLibrary;
    protected $deviceId;

    public function __construct($notificationData, $deviceId) {
        $this->ciLibrary = Kahoutility::getCILibrary();
        $this->notificationData = $notificationData;
        $this->deviceId = $deviceId;
    }

    public abstract function buildPayload(); // will build the payload (a data would be transferred using http post body)

    final public function callHTTP($url, $header, $postData) {
        Callcurl::getCallCurlIns()
                ->setURL($url)
                ->setPostData($postData)
                ->setHeaders($header)
                ->callCurl();
//        echo Callcurl::getCallCurlIns()->getCurlRsesponse();
        $this->insertResponseToDB();
    }

    protected function insertResponseToDB() {
        
    }

    protected function getDeviceId() {
        return explode(",", $this->deviceId);
    }

    protected function getPushNotificationServerUrl($pushNotificationServerUrlKey) {
        return $this->getNotificationConfigurationLoaderIns()->getPushNotificationPlatformConfigurationListByKey(Notificationconfigurationloader::PUSH_NOTIFICATION_PLATFORM_TYPE_ANDROID)[$pushNotificationServerUrlKey];
    }

    final public function getNotificationConfigurationLoaderIns() {
        return Notificationconfigurationloader::getNotificationConfigurationLoaderIns();
    }

}
