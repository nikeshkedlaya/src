<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pushnotificationdatabuilder
 * will build the push notification data based on nb builder, push_notification_configuration and event_notification_configuration
 * @author sandeep
 */
class Pushnotificationdatabuilder {

//put your code here
    private $notificationbuilder;
    private $ciLibrary;
    private $pushNotificationData = array();

    const PUSH_NOTIFICATION_TITLE_KEYWORD = "title";
    const PUSH_NOTIFICATION_MESSAGE_KEYWORD = "message";
    const EVENT_SPECIFIC_DATA_KEYWORD = "event_specific_data";
    const EVENT_TYPE_KEYWORD = "event_type";

    public function __construct(Notificationbuilder $notificationbuilder) {
        $this->ciLibrary = Kahoutility::getCILibrary();
        $this->notificationbuilder = $notificationbuilder;
        $this->loadPushNotificationLang();
    }

// <editor-fold defaultstate="collapsed" desc="loadPushNotificationLang">
    /**
     * will just load the push_notification_language_file
     */
    private function loadPushNotificationLang() {
        $this->ciLibrary->lang->load("notification");
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="getPushNotificationLangData">
    /**
     * will return the push notificaion language data 
     * @param type $eventType which would be actually a registered event in push_notification_configuration
     * @return type
     * @throws NotificationException
     */
    private function getPushNotificationLangData($eventType) {
        try {
            $langVal = NULL;
            if (isStringParamValid($eventType)) {
                $langVal = $this->ciLibrary->lang->line($eventType);
            } else {
                throw new NotificationException("eventType is either empty or not exists in push notification languge file");
            }
        } catch (NotificationException $notificationExp) {
            $this->ciLibrary->writelog->writeErrorLog($notificationExp->GetNotificationExceptionMessage());
        } finally {
            return $langVal;
        }
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="setPushNotificationData">
    /**
     * will set the push notification data to class member prop called pushNotificationData
     * @param type $key
     * @param type $val
     * @throws NotificationException
     */
    public function setPushNotificationData($key, $val) {
        try {
            if (isStringParamValid($key)) {
                $this->pushNotificationData[$key] = $val;
            } else {
                throw new NotificationException("notificationData key is empty to set the notification data ");
            }
        } catch (NotificationException $notificationExp) {
            $this->ciLibrary->writelog->writeErrorLog($notificationExp->GetNotificationExceptionMessage());
        }
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="setPushNotificationTitle">
    /**
     * setting the PushNotificationTitle and storing it pushNotificationData class member array container
     */
    private function setPushNotificationTitle() {
        try {
            $pushNotificationTitle = "";
            if (is_null($pushNotificationTitle = $this->getPushNotificationLangDataByKey(self::PUSH_NOTIFICATION_TITLE_KEYWORD))) {
                throw new NotificationException("push notification lang key " . self::PUSH_NOTIFICATION_TITLE_KEYWORD . " is empty");
            }
        } catch (NotificationException $notificationExp) {
            $this->ciLibrary->writelog->writeErrorLog($notificationExp->GetNotificationExceptionMessage());
        } finally {
            $this->setPushNotificationData(self::PUSH_NOTIFICATION_TITLE_KEYWORD, $pushNotificationTitle);
        }
        return $this;
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getEventTypeLangData">
    /**
     * will return the lang type data by event
     * @param type $eventType
     * @return type
     * @throws NotificationException
     */
    private function getPushNotificationLangDataByKey($langKey) {
        $pushNotificationLangArray = NULL;
        $pushNotificationLangVal = NULL;
        try {
            if (isStringParamValid($langKey) && checkArrayParam($pushNotificationLangArray = $this->getPushNotificationLangData($this->notificationbuilder->getEventType())) && isset($pushNotificationLangArray[$langKey])) {
                $pushNotificationLangVal = $pushNotificationLangArray[$langKey];
            } else {
                throw new NotificationException("either lang configuration or event type is empty");
            }
        } catch (NotificationException $notificationExp) {
            $this->ciLibrary->writelog->writeErrorLog($notificationExp->GetNotificationExceptionMessage());
        } finally {
            return $pushNotificationLangVal;
        }
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="setPushNotificationTypeData">
    /**
     * will set the push_notification type either silent or buzz based on event configuration or passed by client program
     * @throws NotificationException
     */
    private function setPushNotificationTypeData() {
        $clientPassValue = $this->notificationbuilder->getPushNotificationType();
        $notificationDataKey = Notificationconfigurationloader::PUSH_NOTIFICATION_TYPE_KEYWORD;
        $defaultConfigValue = $this->getNotificationEventConfigurationByKey($this->notificationbuilder->getEventType())[Notificationconfigurationloader::PUSH_NOTIFICATION_KEYWORD][$notificationDataKey];
        $pushNotificationTypeArrayVal = $this->getPushNotificationConfigurationByKey($notificationDataKey);
        $this->overrideConfValueByClientValue($clientPassValue, $defaultConfigValue, $notificationDataKey, true, $pushNotificationTypeArrayVal);
        return $this;
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="setRedirectToData">
    /**
     * will set the redirect to value either set in default configuration or can be overridden by callie
     */
    private function setRedirectToData() {
        $clientPassValue = $this->notificationbuilder->getRedirectTo();
        $notificationDataKey = Notificationconfigurationloader::REDIRECT_TO_KEYWORD;
        $defaultConfigValue = $this->getNotificationEventConfigurationByKey($this->notificationbuilder->getEventType())[Notificationconfigurationloader::PUSH_NOTIFICATION_KEYWORD][$notificationDataKey];
        $this->overrideConfValueByClientValue($clientPassValue, $defaultConfigValue, $notificationDataKey, false);
        return $this;
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="setEventSpecificData">
    /**
     * will set the event specific data
     */
    private function setEventSpecificData() {
        $eventSpecifcData = isParamValid($this->notificationbuilder->getEventSpecificData()) ? $this->notificationbuilder->getEventSpecificData() : "";
        $this->setPushNotificationData(self::EVENT_SPECIFIC_DATA_KEYWORD, $eventSpecifcData);
        return $this;
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="setEventType">
    /**
     * will set the event type
     */
    private function setEventType() {
        $eventSpecifcData = isParamValid($this->notificationbuilder->getEventType()) ? $this->notificationbuilder->getEventType() : "";
        $this->setPushNotificationData(self::EVENT_TYPE_KEYWORD, $eventSpecifcData);
        return $this;
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="setPushNotificationMessage">
    /**
     * will build the push notification message passed by callie
     */
    private function setPushNotificationMessage() {
        $clientPassValue = $this->notificationbuilder->getPushNotificationMessage();
        $notificationDataKey = self::PUSH_NOTIFICATION_MESSAGE_KEYWORD;
        $eventSpecificMessage = $this->getPushNotificationLangDataByKey($notificationDataKey);
        $messageFormatterArrayVal = $this->notificationbuilder->getMessageFormatterValue();
        $defaultConfigValue = getTextmessage($eventSpecificMessage, $messageFormatterArrayVal);
        $this->overrideConfValueByClientValue($clientPassValue, $defaultConfigValue, $notificationDataKey, false);
        return $this;
//
//
//        $messageFormatterArrayVal = $this->notificationbuilder->getMessageFormatterValue();
//        $eventSpecificMessageArray = $this->getPushNotificationLangData($this->notificationbuilder->getEventType());
//        $this->setPushNotificationData(self::PUSH_NOTIFICATION_MESSAGE_KEYWORD, getTextmessage($eventSpecificMessageArray[self::PUSH_NOTIFICATION_MESSAGE_KEYWORD], $messageFormatterArrayVal));
//        return $this;
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="getNotificationConfigurationLoaderIns">
    /**
     * will return the getNotificationConfigurationLoaderIns
     * @return Notificationconfigurationloader instance
     */
    public function getNotificationConfigurationLoaderIns() {
        return Notificationconfigurationloader::getNotificationConfigurationLoaderIns();
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="getPushNotificationConfigurationByKey">
    /**
     * will simply call the getPushNotificationConfigurationByKey of NotificationConfigurationLoader method to get the response
     * @param type $key
     * @return type
     */
    private function getPushNotificationConfigurationByKey($key) {
        return $this->getNotificationConfigurationLoaderIns()->getPushNotificationConfigurationByKey($key);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="getNotificationEventConfigurationByKey">
    /**
     * will simply call the getPushNotificationConfigurationByKey of NotificationConfigurationLoader method to get the response
     * @param type $eventTypeKey
     * @return type
     */
    private function getNotificationEventConfigurationByKey($eventTypeKey) {
        return $this->getNotificationConfigurationLoaderIns()->getNotificationEventConfigurationByKey($eventTypeKey);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="overrideConfByClient">
    /**
     * 
     * @param string $clientData : which would be passed by callie to override certain configuration
     * @param string $defaultValue : value which is well defined in configuraion level
     * @param string $notificationDataKey : notification key which would be to store the processed data
     * @param boolean $strictChecking : boolean value to tell to check strictly or not
     * @param mixed $configurationValue : could be either array or string where program will comapre with client value
     */
    private function overrideConfValueByClientValue($clientData, $defaultValue, $notificationDataKey, $strictChecking = false, $configurationValue = null) {
        try {
            $value = NULL;
            if (isStringParamValid($clientData)) {
                if ($strictChecking === TRUE && ((checkArrayParam($configurationValue) && in_array($clientData, $configurationValue)) || (isStringParamValid($configurationValue) && $clientData === $configurationValue))) {
                    $value = $clientData;
                } else {
                    $value = $clientData;
                }
            } else {
                $value = $defaultValue;
            }
        } catch (NotificationException $notificationExp) {
            $this->ciLibrary->writelog->writeErrorLog($notificationExp->GetNotificationExceptionMessage());
        } finally {
            $this->setPushNotificationData($notificationDataKey, $value);
        }
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="buildPushNotificationData">
    /**
     * will be home of every function which is building the data
     */
    public function buildPushNotificationData() {
        $this->setPushNotificationTitle()->
                setPushNotificationTypeData()->
                setRedirectToData()->
                setEventSpecificData()->
                setEventType()->
                setPushNotificationMessage();
        return $this;
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getPushNotificationData">
    /**
     * will return the build push notification data
     */
    public function getPushNotificationData() {
        return $this->pushNotificationData;
    }

// </editor-fold>
}
