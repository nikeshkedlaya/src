<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Notificationconfigurationloader
 * is a singleton class and will have single instance through out execution
 * will load the all notification configuraion files like push,sms email and notification_event
 * @author KaHO
 */
class Notificationconfigurationloader {

    //put your code here
    private $pushNotificationConfiguration;
    private $smsNotificationConfiguration;
    private $emailNotificationConfiguration;
    private $notificationEventConfiguration;
    private static $notificationconfigurationloader;
    private $ciLibrary;

    /* specific notification configuration type keyword starts here */

    const PUSH_NOTIFICATION_CONFIGURATION_KEYWORD = "push_notification_configuration";
    const SMS_NOTIFICATION_CONFIGURATION_KEYWORD = "sms_notification_configuration";
    const EMAIL_NOTIFICATION_CONFIGURATION_KEYWORD = "email_notification_configuration";
    const PUSH_NOTIFICATION_ENABLED_KEYWORD = "push_notification_enabled";
    const SMS_NOTIFICATION_ENABLED_KEYWORD = "sms_notification_enabled";
    const EMAIL_NOTIFICATION_ENABLED_KEYWORD = "email_notification_enabled";
    const NOTIFICATION_TYPE_IS_ENABLED_KEYWORD = "is_enabled";
    /* specific notification configuration type keyword ends here */

    /* notification event configuration key starts here */
    const NOTIFICATION_EVENT_CONFIGURATION_KEYWORD = "notification_event_configuration";
    /* notification event configuration key starts here */

    /* push notification configuration keywords starts here */
    const PUSH_NOTIFICATION_KEYWORD = "push_notification";
    const PUSH_NOTIFICATION_TYPE_KEYWORD = "push_notification_type";
    const REDIRECT_TO_KEYWORD = "redirect_to";
    const PUSH_NOTIFICATION_PLATFORM_ENABLED_KEYWORD = "is_enabled";
    const PUSH_NOTIFICATION_PLATFORM_CLASS_NAME_KEYWORD = "class_name";
    /* push notification configuration keywords ends here */

    /* push notification platform configuration keywords starts here */
    const PUSH_NOTIFICATION_PLATFORM_TYPE_KEY = "push_notification_platform_type";
    const PUSH_NOTIFICATION_PLATFORM_CONFIGURATION_KEYWORD = "push_notification_platform_configuration";
    /* push notification platform configuration keywords ends here */

    /* push notification platform type keywords starts here */
    const PUSH_NOTIFICATION_PLATFORM_TYPE_ANDROID_KEYNAME = "push_notification_platform_android";
    const PUSH_NOTIFICATION_PLATFORM_TYPE_WINDOWS_KEYNAME = "push_notification_platform_windows";
    const PUSH_NOTIFICATION_PLATFORM_TYPE_WEB_KEYNAME = "push_notification_platform_web";
    const PUSH_NOTIFICATION_PLATFORM_TYPE_IPHONE_KEYNAME = "push_notification_platform_iphone";

    /* push notification platform type keywords ends here */

    /* push notification platform type name starts here */
    const PUSH_NOTIFICATION_PLATFORM_TYPE_ANDROID = "android";
    const PUSH_NOTIFICATION_PLATFORM_TYPE_WINDOWS = "windows";
    const PUSH_NOTIFICATION_PLATFORM_TYPE_WEB = "web";
    const PUSH_NOTIFICATION_PLATFORM_TYPE_IPHONE = "iphone";

    /* push notification platform type name ends here */

    /* sms notification configuration keywords starts here */
    const SMS_NOTIFICATION_KEYWORD = "sms_notification";
    /* sms notification configuration keywords ends here */

    /* email notification configuration keywords starts here */
    const EMAIL_NOTIFICATION_KEYWORD = "email_notification";

    /* email notification configuration keywords ends here */

    private function __construct() {
        $this->ciLibrary = GetCILibrary();
        $this->initRequireNotConfiguration();
    }

    // <editor-fold defaultstate="collapsed" desc="initRequireNotConfiguration">
    /**
     * will load all notification and push notification conf files
     */
    public function initRequireNotConfiguration() {
        $this->loadPushNotificationConfiguration();
        $this->loadSMSNotificationConfiguration();
        $this->loadEmailNotificationConfiguration();
        $this->loadNotificationEventConfiguration();
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getNotificationConfigurationLoaderIns">
    /**
     * will return the Notificationconfigurationloader instance
     * @return Notificationconfigurationloader
     */
    public static function getNotificationConfigurationLoaderIns() {
        if (is_null(self::$notificationconfigurationloader) || empty(self::$notificationconfigurationloader)) {
            self::$notificationconfigurationloader = new Notificationconfigurationloader();
        }
        return self::$notificationconfigurationloader;
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="loadPushNotificationConfiguration">
    /**
     * will load the push notification configuration and set in member prop called pushNotificationConfiguration
     * @return array
     * @throws NotificationException
     */
    private function loadPushNotificationConfiguration() {
        try {
            if (is_null($this->pushNotificationConfiguration = GetCustomConfigItem(self::PUSH_NOTIFICATION_CONFIGURATION_KEYWORD))) {
                throw new NotificationException("push notification configuration is empty");
            }
        } catch (NotificationException $notificationExp) {
            $this->ciLibrary->writelog->writeErrorLog($notificationExp->GetNotificationExceptionMessage());
        }
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="loadSMSNotificationConfiguration">
    /**
     * will load the sms notification configuration and set in member prop called smsNotificationConfiguration
     * @return array
     * @throws NotificationException
     */
    private function loadSMSNotificationConfiguration() {
        try {
            if (is_null($this->smsNotificationConfiguration = GetCustomConfigItem(self::SMS_NOTIFICATION_CONFIGURATION_KEYWORD))) {
                throw new NotificationException("sms notification configuration is empty");
            }
        } catch (NotificationException $notificationExp) {
            $this->ciLibrary->writelog->writeErrorLog($notificationExp->GetNotificationExceptionMessage());
        }
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="loadEmailNotificationConfiguration">
    /**
     * will load the email notification configuration and set in member prop called emailNotificationConfiguration
     * @return array
     * @throws NotificationException
     */
    private function loadEmailNotificationConfiguration() {
        try {
            if (is_null($this->emailNotificationConfiguration = GetCustomConfigItem(self::EMAIL_NOTIFICATION_CONFIGURATION_KEYWORD))) {
                throw new NotificationException("email notification configuration is empty");
            }
        } catch (NotificationException $notificationExp) {
            $this->ciLibrary->writelog->writeErrorLog($notificationExp->GetNotificationExceptionMessage());
        }
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="loadNotificationEventConfiguration">
    /**
     * will load the notification event configuration and set in member prop called notificationEventConfiguration
     * @return array
     * @throws NotificationException
     */
    private function loadNotificationEventConfiguration() {
        try {
            if (is_null($this->notificationEventConfiguration = GetCustomConfigItem(self::NOTIFICATION_EVENT_CONFIGURATION_KEYWORD))) {
                throw new NotificationException("notification configuration is empty");
            }
        } catch (NotificationException $notificationExp) {
            $this->ciLibrary->writelog->writeErrorLog($notificationExp->GetNotificationExceptionMessage());
        }
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getNotificationConfigurationByKey">
    /**
     * will take the specific notification configuration such as sms,email and push and return the configuration value by key
     * @param type $specificNotificationConfiguration
     * @param type $specificNotificationConfigurationKey
     * @return mixed
     */
    private function getNotificationConfigurationByKey($specificNotificationConfiguration, $specificNotificationConfigurationKey) {
        try {
            $specificNotificationConfigurationVal = NULL;
            if (checkArrayParam($specificNotificationConfiguration)) {
                if (isStringParamValid($specificNotificationConfigurationKey) && isset($specificNotificationConfiguration[$specificNotificationConfigurationKey])) {
                    $specificNotificationConfigurationVal = $specificNotificationConfiguration[$specificNotificationConfigurationKey];
                } else {
                    throw new NotificationException("either key is" . $specificNotificationConfigurationKey . " empty or not found ");
                }
            }
        } catch (NotificationException $notificationExp) {
            $this->ciLibrary->writelog->writeErrorLog($notificationExp->GetNotificationExceptionMessage());
        } finally {
            return $specificNotificationConfigurationVal;
        }
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getNotificationEventConfigurationByKey">
    /**
     * will take the notification event configuration return the configuration value by key
     * @param type $specificNotificationConfiguration
     * @param type $specificNotificationConfigurationKey
     * @return mixed
     */
    public function getNotificationEventConfigurationByKey($notificationEventconfigurationKey) {
        try {
            $notificationEventConfigurationVal = NULL;
            $notificationEventConfiguration = $this->notificationEventConfiguration;
            if (checkArrayParam($notificationEventConfiguration)) {
                if (isStringParamValid($notificationEventconfigurationKey) && isset($notificationEventConfiguration[$notificationEventconfigurationKey])) {
                    $notificationEventConfigurationVal = $notificationEventConfiguration[$notificationEventconfigurationKey];
                } else {
                    throw new NotificationException("either key is" . $notificationEventconfigurationKey . " empty or not found ");
                }
            }
        } catch (NotificationException $notificationExp) {
            $this->ciLibrary->writelog->writeErrorLog($notificationExp->GetNotificationExceptionMessage());
        } finally {
            return $notificationEventConfigurationVal;
        }
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getPushNotificationConfigurationByKey">
    /**
     * will return the push notification configuration by key
     * @param type $pushNotificationConfigurationKey
     * @return mixed
     */
    public function getPushNotificationConfigurationByKey($pushNotificationConfigurationKey) {
        try {
            $pushNotificationConfigurationVal = $this->getNotificationConfigurationByKey($this->pushNotificationConfiguration, $pushNotificationConfigurationKey);
            if (!isParamValid($pushNotificationConfigurationVal)) {
                throw new NotificationException("either push notification configuration by " . $pushNotificationConfigurationKey . " is empty or not found");
            }
        } catch (NotificationException $notificationExp) {
            $this->ciLibrary->writelog->writeErrorLog($notificationExp->GetNotificationExceptionMessage());
        } finally {
            return $pushNotificationConfigurationVal;
        }
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getSMSNotificationConfigurationByKey">
    /**
     * will return the sms notification configuration by key
     * @param type $smsNotificationConfigurationKey
     * @return mixed
     */
    public function getSMSNotificationConfigurationByKey($smsNotificationConfigurationKey) {
        try {
            $smsNotificationConfigurationVal = $this->getNotificationConfigurationByKey($this->smsNotificationConfiguration, $smsNotificationConfigurationKey);
            if (!isParamValid($smsNotificationConfigurationVal)) {
                throw new NotificationException("either sms notification configuration by " . $smsNotificationConfigurationKey . " is empty or not found");
            }
        } catch (NotificationException $notificationExp) {
            $this->ciLibrary->writelog->writeErrorLog($notificationExp->GetNotificationExceptionMessage());
        } finally {
            return $smsNotificationConfigurationVal;
        }
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getEmailNotificationConfigurationByKey">
    /**
     * will return the emaiil notification configuration by key
     * @param type $emailNotificationConfigurationKey
     * @return mixed
     */
    public function getEmailNotificationConfigurationByKey($emailNotificationConfigurationKey) {
        try {
            $emailNotificationConfigurationVal = $this->getNotificationConfigurationByKey($this->emailNotificationConfiguration, $emailNotificationConfigurationKey);
            if (!isParamValid($emailNotificationConfigurationVal)) {
                throw new NotificationException("either email notification configuration by " . $emailNotificationConfigurationKey . " is empty or not found");
            }
        } catch (NotificationException $notificationExp) {
            $this->ciLibrary->writelog->writeErrorLog($notificationExp->GetNotificationExceptionMessage());
        } finally {
            return $emailNotificationConfigurationVal;
        }
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getPushNotificationPlatformConfigurationListByKey">
    /**
     * will return the push notification platform configuration list by platform name if success or null on failure
     * @return boolean
     */
    public function getPushNotificationPlatformConfigurationListByKey($platformName) {
        $pushNotificationPlatformConfigureList = $this->getPushNotificationConfigurationByKey(self::PUSH_NOTIFICATION_PLATFORM_CONFIGURATION_KEYWORD);
        if (checkArrayParam($pushNotificationPlatformConfigureList) && isset($pushNotificationPlatformConfigureList[$platformName]) && checkArrayParam($pushNotificationPlatformConfigureList[$platformName])) {
            return $pushNotificationPlatformConfigureList[$platformName];
        }
        return NULL;
    }

// </editor-fold>
}
