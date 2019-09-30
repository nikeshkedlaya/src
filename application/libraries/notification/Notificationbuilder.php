<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Notificationbuilder
 *
 * @author sandeep
 *        
 *         would be responsible to build the notification and its configuration,would be invoked by client program
 */
include_once 'NotificationFactoryProducer.php';
include_once 'NotificationException.php';
include_once 'Notificationconfigurationloader.php';

class Notificationbuilder
{

    // put your code here
    private $ciLibrary;

    private $userCode;

    // will hold the usercode
    private $audienceType;

    // will hold the audeinceType for procedure
    private $eventType;

    // will hold the registered event type
    private $pushNotificationTypeKeyName;

    // will hold the push notification type like either silent = user won't be notified,or buzz =user will be notified
    private $messageFormatterValue;

    private $pushNotificationMessage;

    private $eventSpecificData;

    private $redirectTo;

    public function __construct()
    {
        $this->ciLibrary = Kahoutility::getCILibrary();
    }

    // <editor-fold defaultstate="collapsed" desc="setUserCode">
    /**
     * will set the user code if any, no usercode no notification
     *
     * @param string $userCode
     *            will delimitir | if more than one
     * @throws NotificationException
     */
    public function setUserCode($userCode)
    {
        $this->ciLibrary->writelog->writeInitiatedDebugLog(__METHOD__, $userCode);
        try {
            if (isParamValid($userCode)) {
                $this->userCode = $userCode;
            } else {
                throw new NotificationException("usercode is empty");
            }
        } catch (NotificationException $notificationExp) {
            $this->ciLibrary->writelog->writeErrorLog($notificationExp->GetNotificationExceptionMessage());
        } finally {
            return $this;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getUserCode">
    
    /**
     *
     * @return string
     */
    public function getUserCode()
    {
        return $this->userCode;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="setPushNotificationMessage">
    /**
     * will set the push notification message, would override the default message for specific message
     *
     * @param type $message
     * @return $this
     * @throws NotificationException
     */
    public function setPushNotificationMessage($message)
    {
        $this->ciLibrary->writelog->writeInitiatedDebugLog(__METHOD__, $message);
        try {
            if (isParamValid($message)) {
                $this->pushNotificationMessage = $message;
            } else {
                throw new NotificationException("message is empty");
            }
        } catch (NotificationException $notificationExp) {
            $this->ciLibrary->writelog->writeErrorLog($notificationExp->GetNotificationExceptionMessage());
        } finally {
            return $this;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getPushNotificationMessage">
    /**
     * will return the message
     *
     * @return type
     */
    public function getPushNotificationMessage()
    {
        return $this->pushNotificationMessage;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="setEventType">
    /**
     * will set the event type name,which should be exists on notification_event_configuration
     *
     * @param string $eventType
     * @throws NotificationException
     */
    public function setEventType($eventType)
    {
        $this->ciLibrary->writelog->writeInitiatedDebugLog(__METHOD__, $eventType);
        try {
            if (! Kahoutility::isStringParamValid($this->eventType = $eventType)) {
                throw new NotificationException("eventType is empty");
            }
        } catch (NotificationException $notificationExp) {
            $this->ciLibrary->writelog->writeErrorLog($notificationExp->GetNotificationExceptionMessage());
        } finally {
            return $this;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getEventType">
    /**
     * will return the event name
     *
     * @return string
     */
    public function getEventType()
    {
        return $this->eventType;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="setAudienceType">
    /**
     *
     * @param string $audienceType
     * @return $this
     * @throws NotificationException
     */
    public function setAudienceType(string $audienceType)
    {
        $this->ciLibrary->writelog->writeInitiatedDebugLog(__METHOD__, $audienceType);
        try {
            if (! Kahoutility::isStringParamValid($this->audienceType = $audienceType)) {
                throw new NotificationException("audiencetype is empty");
            }
        } catch (NotificationException $notificationExp) {
            $this->ciLibrary->writelog->writeErrorLog($notificationExp->GetNotificationExceptionMessage());
        } finally {
            return $this;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getAudeinceType">
    public function getAudeinceType()
    {
        return $this->audienceType;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getProcedureParams">
    public function getProcedureParams()
    {
        return [];
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getAudienceType">
    public function getAudienceType()
    {
        return $this->audienceType;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="setPushNotificationType">
    /**
     * will set the push notification type key name like push_notification_type_silent or push_notification_type_buzz
     *
     * @param type $pushNotificationTypeKeyName
     * @return $this
     * @throws NotificationException
     */
    public function setPushNotificationType($pushNotificationTypeKeyName)
    {
        try {
            if (isStringParamValid($pushNotificationTypeKeyName)) {
                $this->pushNotificationTypeKeyName = $pushNotificationTypeKeyName;
            } else {
                throw new NotificationException("pushNotificationTypeKeyName is empty");
            }
        } catch (NotificationException $notificationExp) {
            $this->ciLibrary->writelog->writeErrorLog($notificationExp->GetNotificationExceptionMessage());
        } finally {
            return $this;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getPushNotificationType">
    /**
     * will return the pushNotificationTypeKeyName
     */
    public function getPushNotificationType()
    {
        return $this->pushNotificationTypeKeyName;
    }

    // </editor-fold>
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="setMessageFormatterValue">
    /**
     * will set the message formatter value to build the message with some callie input value or any dynamic value
     *
     * @return $this
     * @throws NotificationException
     */
    public function setMessageFormatterValue(...$messageFormatterValue): Notificationbuilder
    {
        $this->messageFormatterValue = $messageFormatterValue;
        return $this;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getMessageFormatterValue">
    /**
     * will return the messageFormatterValue
     *
     * @return type
     */
    public function getMessageFormatterValue()
    {
        return $this->messageFormatterValue;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="setEventSpecificData">
    /**
     * will set the event specific data to pass to client i.e can have meeting_request data to pass to client
     *
     * @param mixed $eventSpecificData
     * @throws NotificationException
     */
    public function setEventSpecificData($eventSpecificData)
    {
        $this->ciLibrary->writelog->writeInitiatedDebugLog(__METHOD__, $eventSpecificData);
        try {
            if (isParamValid($eventSpecificData)) {
                $this->eventSpecificData = $eventSpecificData;
            } else {
                throw new NotificationException("eventSpecificData is empty");
            }
        } catch (NotificationException $notificationExp) {
            $this->ciLibrary->writelog->writeErrorLog($notificationExp->GetNotificationExceptionMessage());
        } finally {
            return $this;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getEventSpecificData">
    /**
     * will return the event specific data
     *
     * @return type
     */
    public function getEventSpecificData()
    {
        return $this->eventSpecificData;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="setRedirectTo">
    /**
     * will set the redirection value and pass it to client to direct them to redirect
     *
     * @param type $redirectionValue
     * @throws NotificationException
     */
    public function setRedirectTo($redirectionValue)
    {
        $this->ciLibrary->writelog->writeInitiatedDebugLog(__METHOD__, $redirectionValue);
        try {
            if (isStringParamValid($redirectionValue)) {
                $this->redirectTo = $redirectionValue;
            } else {
                throw new NotificationException("redirectionValue is empty");
            }
        } catch (NotificationException $notificationExp) {
            $this->ciLibrary->writelog->writeErrorLog($notificationExp->GetNotificationExceptionMessage());
        } finally {
            return $this;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getRedirectTo">
    /**
     *
     * @return type
     */
    public function getRedirectTo()
    {
        return $this->redirectTo;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="build">
    /**
     * will build the notification,ins the notification factory and send the notification
     */
    public function build()
    {
        $notificationFactoryProducer = new NotificationFactoryProducer($this);
        return $notificationFactoryProducer;
    }
    
    // </editor-fold>
}
