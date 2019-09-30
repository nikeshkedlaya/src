<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NotificationFactoryProducer
 * will do conditional checking that push,sms and email notification is enabled or not if yes then will instantiate the relevant factory class 
 *
 * @author KaHO
 */
include 'emailnotification/Emailnotificationfactory.php';
include 'pushnotification/Pushnotificationfactory.php';
include 'smsnotification/Smsnotificationfactory.php';

class NotificationFactoryProducer {

    private $notificationFactoriesArray = array();
    private $ciLibrary;
    private $notificationBuilder;

    // <editor-fold defaultstate="collapsed" desc="__construct">
    /**
     * will instantiate the NotificationFactoryProducer
     * @param Notificationbuilder $notificationBuilder
     * @param Bmanager $bManagerObj
     */
    public function __construct(Notificationbuilder $notificationBuilder) {
        $this->ciLibrary = Kahoutility::getCILibrary();
        $this->notificationBuilder = $notificationBuilder;
        $this->inititateNotificationFactories($notificationBuilder);
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="inititateNotificationFactories">
    /**
     * will instantiate the different notification factories based on its availability
     * @param type $notificationBuilder
     * @param type $bManagerObj
     */
    public function inititateNotificationFactories($notificationBuilder) {
        if ($this->isPushNotificationEnabled()) {
            $this->notificationFactoriesArray[] = new PushnotificationFactory($notificationBuilder);
        }
        if ($this->isSMSNotificationEnabled()) {
            $this->notificationFactoriesArray[] = new SmsnotificationFactory($notificationBuilder);
        }
        if ($this->isEmailNotificationEnabled()) {
            $this->notificationFactoriesArray[] = new EmailnotificationFactory($notificationBuilder);
        }
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="isPushNotificationEnabled">
    /**
     * will check that push notification is enabled or not from push notificaion level config and for specific event from notification_event_configuration level
     * @return boolean
     * @throws NotificationException
     */
    private function isPushNotificationEnabled() {
        $isPushNotificationEnabled = FALSE;
        try {
            if ($this->getNotificationConfigurationLoaderIns()->getPushNotificationConfigurationByKey(Notificationconfigurationloader::PUSH_NOTIFICATION_ENABLED_KEYWORD) === TRUE && $this->isSpecificNotificationEnabledForSpecificEvent(Notificationconfigurationloader::PUSH_NOTIFICATION_KEYWORD, $this->notificationBuilder->getEventType()) === TRUE) {
                $isPushNotificationEnabled = TRUE;
            } else {
                throw new NotificationException("push notification is not enabled either in global level or by event level");
            }
        } catch (NotificationException $notificationExp) {
            $this->ciLibrary->writelog->writeErrorLog($notificationExp->GetNotificationExceptionMessage());
        } finally {
            return $isPushNotificationEnabled;
        }
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="isSMSNotificationEnabled">
    /**
     * will check that sms notification is enabled or not
     * @throws NotificationException
     */
    private function isSMSNotificationEnabled() {
        $isSMSNotificationEnabled = FALSE;
        try {
            if ($this->getNotificationConfigurationLoaderIns()->getSMSNotificationConfigurationByKey(Notificationconfigurationloader::SMS_NOTIFICATION_ENABLED_KEYWORD) === TRUE && $this->isSpecificNotificationEnabledForSpecificEvent(Notificationconfigurationloader::SMS_NOTIFICATION_KEYWORD, $this->notificationBuilder->getEventType()) === TRUE) {
                $isSMSNotificationEnabled = TRUE;
            } else {
                throw new NotificationException("sms notification is not ebabled either in global level or by event level");
            }
        } catch (NotificationException $notificationExp) {
            $this->ciLibrary->writelog->writeErrorLog($notificationExp->GetNotificationExceptionMessage());
        } finally {
            return $isSMSNotificationEnabled;
        }
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="isEmailNotificationEnabled">
    /**
     * will check that email notification is enabled or not
     * @return boolean
     * @throws NotificationException
     */
    private function isEmailNotificationEnabled() {
        $isEmailNotificationEnabled = FALSE;
        try {
            if ($this->getNotificationConfigurationLoaderIns()->getSMSNotificationConfigurationByKey(Notificationconfigurationloader::EMAIL_NOTIFICATION_ENABLED_KEYWORD) === TRUE && $this->isSpecificNotificationEnabledForSpecificEvent(Notificationconfigurationloader::EMAIL_NOTIFICATION_KEYWORD, $this->notificationBuilder->getEventType()) === TRUE) {
                $isEmailNotificationEnabled = TRUE;
            } else {
                throw new NotificationException("email notification is not ebabled either in global level or by event level");
            }
        } catch (NotificationException $notificationExp) {
            $this->ciLibrary->writelog->writeErrorLog($notificationExp->GetNotificationExceptionMessage());
        } finally {
            return $isEmailNotificationEnabled;
        }
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="sendNotification">
    /**
     * will call the send notification method of every notification
     */
    public function sendNotification() {
        foreach ($this->notificationFactoriesArray as $notificationFactoriesObj) {
            $notificationFactoriesObj->sendNotification();
        }
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
    // <editor-fold defaultstate="collapsed" desc="isSpecificNotificationEnabledForSpecificEvent">

    private function isSpecificNotificationEnabledForSpecificEvent($notificationType, $eventType) {
        try {
            $isSpecificNotificationEnabledForSpecificEvent = FALSE;
            if (($isSpecificNotificationEnabledForSpecificEvent = $this->getNotificationConfigurationLoaderIns()->getNotificationEventConfigurationByKey($eventType)[$notificationType][Notificationconfigurationloader::NOTIFICATION_TYPE_IS_ENABLED_KEYWORD]) !== TRUE) {
                throw new NotificationException($notificationType . " is not enabled for given event" . $eventType);
            }
        } catch (NotificationException $notificationExp) {
            $this->ciLibrary->writelog->writeErrorLog($notificationExp->GetNotificationExceptionMessage());
        } finally {
            return $isSpecificNotificationEnabledForSpecificEvent;
        }
    }

// </editor-fold>
}
