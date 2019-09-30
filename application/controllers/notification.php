<?php

class Notification extends KaHO_Controller {

    public function __construct() {
        parent::__construct("notificationservice");
    }

    public function registerDeviceId() {
        $this->notificationservice->registerDeviceId();
    }

    public function unRegisterDeviceId() { 
        $this->notificationservice->unRegisterDeviceId();
    }

    public function getNotificationSettingsList() {
        $this->notificationservice->getNotificationSettingsList();
    }

    public function updateNotificationSettings() {
        $this->notificationservice->updateNotificationSettings();
    }
    public function getNotificationList() {
        $this->notificationservice->getNotificationList();
    }
}

?>