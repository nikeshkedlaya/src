<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PushnotificationFactory
 * will check that current request does qualify to send the push notification if yes then which platform is enabled to send the notification 
 * @author KaHO
 */
include_once APPPATH . 'libraries/notification/Notificationabstractfactory.php';
include_once 'Androidnotification.php';
include_once 'Windowsnotification.php';
include_once 'Webnotification.php';
include_once 'Pushnotificationdatabuilder.php';
include_once 'Deviceidmodel.php';

class PushnotificationFactory extends Notificationabstractfactory {

    /**
     * @var Notificationbuilder
     */
    private $deviceIdByUser;
    private $notificationObjContainer;
    private $pushNotificationData;

//put your code here

    public function __construct(Notificationbuilder $notificationBuilder) {
        parent::__construct($notificationBuilder);
    }

    // <editor-fold defaultstate="collapsed" desc="initNotificationRequest">
    /**
     * will initiate the initPushNotificationFactory method which will initiate the
     */
    public function initNotificationRequest() {
        $this->deviceIdByUser = Deviceidmodel::getDeviceIDModelIns()->getDevicesId($this->notificationBuilder);
        $this->processNotificationRequest();
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="processNotificationRequest">
    /**
     * will iterate every available platform for push notification defined in push_notification_configuration and will instantiate after checking that every platform is fully qualified to send the notification or not
     */
    protected function processNotificationRequest() {
        try {
            $pushNotificationPlatformTypeList = $this->getPushNotificationPlatformTypeList();
            if ($pushNotificationPlatformTypeList !== FALSE) {
                foreach ($pushNotificationPlatformTypeList as $val) {
                    switch ($val) {
                        case Notificationconfigurationloader::PUSH_NOTIFICATION_PLATFORM_TYPE_ANDROID:
                            if ($this->isAndroidEnabledForPushNotification()) {
                                $this->instantiateNotificationClassByPlatform($val);
                            }
                            break;
                        case Notificationconfigurationloader::PUSH_NOTIFICATION_PLATFORM_TYPE_WINDOWS:
                            if ($this->isWindowsEnabledForPushNotification()) {
                                $this->instantiateNotificationClassByPlatform($val);
                            }
                            break;
                        case Notificationconfigurationloader::PUSH_NOTIFICATION_PLATFORM_TYPE_WEB:
                            if ($this->isWebEnabledForPushNotification()) {
                                $this->instantiateNotificationClassByPlatform($val);
                            }
                            break;
                        case Notificationconfigurationloader::PUSH_NOTIFICATION_PLATFORM_TYPE_IPHONE:
                            if ($this->isIphoneEnabledForPushNotification()) {
                                $this->instantiateNotificationClassByPlatform($val);
                            }
                            break;
                        default :
                            break;
                    }
                }
            }
        } catch (NotificationException $notificationExp) {
            $this->ciLibrary->writelog->writeErrorLog($notificationExp->GetNotificationExceptionMessage());
        }
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="instantiateNotificationClass">
    /**
     * will instantiate the android,web,iphone and windows notification class based on classname and store in `$notificationObjContainer prop
     */
    protected function instantiateNotificationClassByPlatform($platformName) {
        try {
            if (!is_null($platformName) && !empty($platformName)) {
                $pushNotificationPlatformConfigurationListByKey = $this->getNotificationConfigurationLoaderIns()->getPushNotificationPlatformConfigurationListByKey($platformName);
                $className = isset($pushNotificationPlatformConfigurationListByKey[Notificationconfigurationloader::PUSH_NOTIFICATION_PLATFORM_CLASS_NAME_KEYWORD]) ? $pushNotificationPlatformConfigurationListByKey[Notificationconfigurationloader::PUSH_NOTIFICATION_PLATFORM_CLASS_NAME_KEYWORD] : "";
                $this->notificationObjContainer[] = new $className($this->buildPushNotificationData(), $this->getDeviceIdByPlatform($platformName));
            } else {
                throw new NotificationException("platform name doesn't exists");
            }
        } catch (NotificationException $notificationExp) {
            $this->ciLibrary->writelog->writeErrorLog($notificationExp->GetNotificationExceptionMessage());
        }
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getPushNotificationPlatformTypeList">
    /**
     * will return the push notification platform type list if success or false on failure
     * @return array
     */
    protected function getPushNotificationPlatformTypeList() {
        $pushNotificationPlatformTypeList = $this->getNotificationConfigurationLoaderIns()->getPushNotificationConfigurationByKey(Notificationconfigurationloader::PUSH_NOTIFICATION_PLATFORM_TYPE_KEY);
        if (checkArrayParam($pushNotificationPlatformTypeList)) {
            return $pushNotificationPlatformTypeList;
        }
        return FALSE;
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getPushNotificationPlatformTypeName">
    /**
     * will return the push notification platform type name
     * @return array
     */
    protected function getPushNotificationPlatformTypeName($PlatformTypeKey) {
        try {
            $pushNotificationPlatformTypeName = NULL;
            if (checkArrayParam($this->getPushNotificationPlatformTypeList()) && isset($this->getPushNotificationPlatformTypeList()[$PlatformTypeKey])) {
                $pushNotificationPlatformTypeName = $this->getPushNotificationPlatformTypeList()[$PlatformTypeKey];
            }
        } catch (NotificationException $notificationExp) {
            $this->ciLibrary->writelog->writeErrorLog($notificationExp->GetNotificationExceptionMessage());
        } finally {
            return $pushNotificationPlatformTypeName;
        }
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getDevicesIdByUser">
    /**
     * @description fetching the device id from db based on user code
     * @return type
     * @throws NotificationException
     */
//    public function getDevicesIdByUser() {
//        $this->ciLibrary->writelog->writeInitiatedDebugLog(__METHOD__, array($userCode, $eventType));
//        $this->deviceIdByUser = NULL;
//        try {
//            if (empty($userCode) === false) {
//                $this->ciLibrary->load->library("kahocrudservices");
//                $params = $this->getPr;
//                $this->deviceIdByUser = $this->ciLibrary->kahocrudservices->getRecord($this->getProcedureNameForDeviceIDByAudienceType(), $params)->getResponse();
//                $this->deviceIdByUser = checkArrayParam($this->deviceIdByUser) ? array_column($this->deviceIdByUser, "Device_ID", "Platform_Type") : $this->deviceIdByUser;
//            } else {
//                throw new NotificationException("UserCode can't be empty");
//            }
//        } catch (NotificationException $notificationExp) {
//            $this->ciLibrary->writelog->writeErrorLog($notificationExp->GetNotificationExceptionMessage());
//        }
//        $this->ciLibrary->writelog->writeReturnedDebugLog(__METHOD__, $this->deviceIdByUser);
//        return $this->deviceIdByUser;
//    }
// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getProcedureNameForDeviceIDByAudienceType">
//    private function getProcedureNameForDeviceIDByAudienceType() {
//        $procedureNameForDeviceIDByAudienceType = "";
//        switch ($this->notificationBuilder->getAudeinceType()) {
//            case AUDIENCE_TYPE_STUDENT:
//                $procedureNameForDeviceIDByAudienceType = "sGetDeviceIDsForStudents"; // sGetDeviceIDsForStudents(IN PStudent_Codes TEXT, IN PEvent_Type VARCHAR(1024))
//                break;
//            case AUDIENCE_TYPE_USERS:
//                $procedureNameForDeviceIDByAudienceType = "sGetDeviceIDsForUsers"; //sGetDeviceIDsForUsers(IN PUsers TEXT, IN PEvent_Type VARCHAR(1024))
//                break;
//            case AUDIENCE_TYPE_GROUPS:
//                $procedureNameForDeviceIDByAudienceType = "sGetDeviceIDsForGroups"; // sGetDeviceIDsForGroups(IN PGroup_IDs TEXT, IN PEvent_Type VARCHAR(1024))
//                break;
//            case AUDIENCE_TYPE_CLASS:
//                $procedureNameForDeviceIDByAudienceType = "sGetDeviceIDsForClass"; //sGetDeviceIDsForClass(IN PAY_Code VARCHAR(16), IN PClass_Codes TEXT, IN PEvent_Type VARCHAR(1024))
//                break;
//            case AUDIENCE_TYPE_CLASS_SECTION:
//                $procedureNameForDeviceIDByAudienceType = "sGetDeviceIDsForClassSection"; // sGetDeviceIDsForClassSection(IN PSection_AY_Codes TEXT, IN PEvent_Type VARCHAR(1024))
//                break;
//            case AUDIENCE_TYPE_USERS_WITH_GROUP:
//                $procedureNameForDeviceIDByAudienceType = "sGetDeviceIDsForUsersWithGroup"; //sGetDeviceIDsForUsersWithGroup(IN PUsers_With_Group TEXT, IN PEvent_Type VARCHAR(1024))
//                break;
//            default: // AUDIENCE_TYPE_TEACHER
//                $procedureNameForDeviceIDByAudienceType = "sGetDeviceIDsForTeachers"; // sGetDeviceIDsForTeachers(IN PTeacher_Codes TEXT, IN PEvent_Type VARCHAR(1024))
//                break;
//        }
//        return $procedureNameForDeviceIDByAudienceType;
//    }
// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getProcedureParams">
//    private function getProcedureParams() {
//        $params = array("User_Code" => $this->notificationBuilder->getUserCode(), "Event_Type" => $this->notificationBuilder->getEventType());
//    }
// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="buildProcedureParamsByAudienceType">

    private function buildProcedureParamsByAudienceType(array &$params) {
        
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getDeviceId">
    /**
     * will return the device id which is stored in $this->deviceIdByUser prop after db process done by method getDevicesIdByUser
     * @return array
     */
    private function getDeviceId() {
        $deviceId = FALSE;
        if (checkArrayParam($this->deviceIdByUser)) {
            $deviceId = $this->deviceIdByUser;
        }
        return $deviceId;
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="isAndroidEnabledForPushNotification">
    /**
     * will check that android is qualified platform to send the notification or not by checking in configure file as well as in db response
     * @return boolean
     */
    private function isAndroidEnabledForPushNotification() {
        $isAndroidEnabledForPushNotification = FALSE;
        $platformName = $this->getPushNotificationPlatformTypeName(Notificationconfigurationloader::PUSH_NOTIFICATION_PLATFORM_TYPE_ANDROID_KEYNAME);
        if ($this->isPushNotificationEnabledForSpecificPlatform($platformName) && isStringParamValid($this->getDeviceIdByPlatform($platformName))) {
            $isAndroidEnabledForPushNotification = TRUE;
        }
        return $isAndroidEnabledForPushNotification;
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="isWebEnabledForPushNotification">
    /**
     * will check that web is quilified platform to send the notification or not by checking in configure file as well as in db response
     * @return boolean
     */
    private function isWebEnabledForPushNotification() {
        $isWebEnabledForPushNotification = FALSE;
        $platformName = $this->getPushNotificationPlatformTypeName(Notificationconfigurationloader::PUSH_NOTIFICATION_PLATFORM_TYPE_WEB_KEYNAME);
        if ($this->isPushNotificationEnabledForSpecificPlatform($platformName) && !is_null($this->getDeviceIdByPlatform($platformName))) {
            $isWebEnabledForPushNotification = TRUE;
        }
        return $isWebEnabledForPushNotification;
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="isWindowsEnabledForPushNotification">
    /**
     * will check that windows is quilified platform to send the notification or not by checking in configure file as well as in db response
     * @return boolean
     */
    private function isWindowsEnabledForPushNotification() {
        $isWindowsEnabledForPushNotification = FALSE;
        $platformName = $this->getPushNotificationPlatformTypeName(Notificationconfigurationloader::PUSH_NOTIFICATION_PLATFORM_TYPE_WINDOWS_KEYNAME);
        if ($this->isPushNotificationEnabledForSpecificPlatform($platformName) && !is_null($this->getDeviceIdByPlatform($platformName))) {
            $isWindowsEnabledForPushNotification = TRUE;
        }
        return $isWindowsEnabledForPushNotification;
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="isIphoneEnabledForPushNotification">
    /**
     * will check that android is quilified platform to send the notification or not by checking in configure file as well as in db response
     * @return boolean
     */
    private function isIphoneEnabledForPushNotification() {
        $isIphoneEnabledForPushNotification = FALSE;
        $platformName = $this->getPushNotificationPlatformTypeName(Notificationconfigurationloader::PUSH_NOTIFICATION_PLATFORM_TYPE_IPHONE_KEYNAME);
        if ($this->isPushNotificationEnabledForSpecificPlatform($platformName) && !is_null($this->getDeviceIdByPlatform($platformName))) {
            $isIphoneEnabledForPushNotification = TRUE;
        }
        return $isIphoneEnabledForPushNotification;
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getDeviceIdByPlatform">
    /**
     * will return the device id came from db based on platform key like android device id, windows device id and web device id and iphone device id
     * @param type $platformName
     * @return type
     * @throws NotificationException
     */
    private function getDeviceIdByPlatform($platformName) {
        try {
            $deviceIdByPlatform = NULL;
            if (isParamValid($platformName)) {
                if (!empty($this->getDeviceId()) && isset($this->getDeviceId()[$platformName]) && !empty($this->getDeviceId()[$platformName])) {
                    $deviceIdByPlatform = $this->getDeviceId()[$platformName];
                }
            } else {
                throw new NotificationException("either platformKey or device id db response or device id for specific platform is empty");
            }
        } catch (NotificationException $notificationExp) {
            $this->ciLibrary->writelog->writeErrorLog($notificationExp->GetNotificationExceptionMessage());
        } finally {
            return $deviceIdByPlatform;
        }
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="isPushNotificationEnabledForSpecificPlatform">
    /**
     * will check by platform key that push notification is enabled by platform key in push_notification configuration
     * @param type $platformName
     * @return boolean
     */
    private function isPushNotificationEnabledForSpecificPlatform($platformName) {
        try {
            if (isStringParamValid($platformName)) {
                $isPushNotificationEnabledForSpecificPlatform = FALSE;
                $pushNotificationConfigurationByPlatform = $this->getNotificationConfigurationLoaderIns()->getPushNotificationPlatformConfigurationListByKey($platformName);
                if (!is_null($pushNotificationConfigurationByPlatform)) {
                    if (isset($pushNotificationConfigurationByPlatform[Notificationconfigurationloader::PUSH_NOTIFICATION_PLATFORM_ENABLED_KEYWORD]) && $pushNotificationConfigurationByPlatform[Notificationconfigurationloader::PUSH_NOTIFICATION_PLATFORM_ENABLED_KEYWORD] === true) {
                        $isPushNotificationEnabledForSpecificPlatform = TRUE;
                    } else {
                        throw new NotificationException("push notification is not enabled by key " . $platformName);
                    }
                }
            } else {
                throw new NotificationException("platform key is empty");
            }
        } catch (NotificationException $notificationExp) {
            $this->ciLibrary->writelog->writeErrorLog($notificationExp->GetNotificationExceptionMessage());
        } finally {
            return $isPushNotificationEnabledForSpecificPlatform;
        }
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="buildPushNotificationData">
    /**
     * will instantiate the Pushnotificationdatabuilder and build the data
     */
    protected function buildPushNotificationData() {
        if (!checkArrayParam($this->pushNotificationData)) {
            $pushnotificationdatabuilder = new Pushnotificationdatabuilder($this->notificationBuilder);
            $this->pushNotificationData = $pushnotificationdatabuilder->buildPushNotificationData()->getPushNotificationData();
        }
        return $this->pushNotificationData;
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="sendNotification">
    /**
     * will call the send notification method of every concrete push notification class like android,web,windows and iphone
     */
    public function sendNotification() {
        try {
            if (checkArrayParam($this->notificationObjContainer)) {
                foreach ($this->notificationObjContainer as $pushNotificationObj) {
                    $pushNotificationObj->sendNotification();
                }
            } else {
                throw new NotificationException("push notification is not sent in ant any platform");
            }
        } catch (NotificationException $notificationExp) {
            $this->ciLibrary->writelog->writeErrorLog($notificationExp->GetNotificationExceptionMessage());
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
}
