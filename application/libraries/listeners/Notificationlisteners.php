<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NotificationListeners
 *
 * @author KaHO
 */
abstract class Notificationlisteners implements Dbcrudlistenerinterface
{

    // put your code here
    protected $ciLibrary;

    protected function __construct()
    {
        $this->ciLibrary = Kahoutility::getCILibrary();
        $this->ciLibrary->load->library("notification/notificationbuilder");
    }

    public function update(string $callback, array $dbResponse = NULL, array $inputParams = NULL)
    {
        // if (Kahoutility::checkArrayParam($dbResponse) && $dbResponse['']) {
        Kahoutility::invokeCallback($dbResponse, [
            [
                $this,
                $callback
            ],
            $inputParams
        ]);
        $this->unRegisterNotificationListener();
        // }
    }

    protected function unRegisterNotificationListener()
    {
        Dbcrudsubject::getDBCrudSubjectIns()->unRegisterListener($this, Kahoutility::getCallieFunctionName(2));
    }
}
