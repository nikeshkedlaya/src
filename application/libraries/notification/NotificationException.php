<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NotificationException
 *
 * @author KaHO
 */
class NotificationException extends Exception {

    public function GetNotificationExceptionMessage() {
        $notificationExceptionMessage = "Notification Exception:" . $this->getMessage() . " on line no " . $this->getLine() . " on file " . $this->getFile() . " code is" . $this->getCode();
        return $notificationExceptionMessage;
    }

}
