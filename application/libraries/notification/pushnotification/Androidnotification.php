<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Androidnotification
 *
 * @author Quadir
 */
include_once 'Abstractpushnotification.php';

class Androidnotification extends Abstractpushnotification {

    const GOOGLE_GCM_SERVER_URL_KEYWORD = "google_gcm_server_url";
    const GOOGLE_API_KEY_KEYWORD = "google_api_key";

    //put your code here
    public function __construct($notificationData, $deviceId) {
        parent::__construct($notificationData, $deviceId);
    }

    public final function buildPayload() {
        $payload = array("registration_ids" => $this->getDeviceId(), "data" => $this->getPayload());
        return json_encode($payload);
    }

    private function getPayload() {
        return $this->notificationData;
    }

    public function sendNotification() {
        $this->callHTTP($this->getPushNotificationServerUrl(self::GOOGLE_GCM_SERVER_URL_KEYWORD), $this->getHeaders(), $this->buildPayload());
    }

    private function getHeaders() {
        $headers = array('Authorization: key=' . $this->getNotificationConfigurationLoaderIns()->getPushNotificationPlatformConfigurationListByKey(Notificationconfigurationloader::PUSH_NOTIFICATION_PLATFORM_TYPE_ANDROID)[self::GOOGLE_API_KEY_KEYWORD], 'Content-Type: application/json');
        return $headers;
    }

}
