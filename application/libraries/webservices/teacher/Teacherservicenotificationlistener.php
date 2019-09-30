<?php

class Teacherservicenotificationlistener extends Notificationlisteners
{

    // put your code here
    public function __construct()
    {
        parent::__construct();
    }

    public function sendUpdateTeacherTaskNotification(array $dbResponse)
    {
        $this->ciLibrary->notificationbuilder->setUserCode($this->getReportsTo())
            ->setEventType("daily_plan_update")
            ->setAudienceType(AUDIENCE_TYPE_TEACHER)
            ->setMessageFormatterValue(Kahoapplicationservice::getKaHOAppSerIns()->getLoggedInUserName())
            ->build()
            ->sendNotification();
    }
    
    public function sendFreePeriodUpdateNotification(array $dbResponse)
    {
        $this->ciLibrary->notificationbuilder->setUserCode($this->getReportsTo())
            ->setEventType("free_period_update")
            ->setAudienceType(AUDIENCE_TYPE_TEACHER)
            ->setMessageFormatterValue(Kahoapplicationservice::getKaHOAppSerIns()->getLoggedInUserName())
            ->build()
            ->sendNotification();
    }
    
    private function getReportsTo()
    {
        $reportsTo = Kahoutility::getCISessionValueByKey(Kahoapplicationservice::getKaHOAppSerIns()->getUserCode())[0]['ReportsTo'];
        return $reportsTo;
    }
}

