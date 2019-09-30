<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Writelog
 *
 * @author Quadir
 */
class Writelog
{

    private $isDebugTrue;

    const METHOD_INITIATED_MSG = " is initiated inside the method ";

    const METHOD_RETURNED_MSG = " is returning ";

    const MAIL_ERROR_CODE = 1;
 // will send an email too
    private $systemAdminEmail = array(
        "iamabornprogrammer@gmail.com"
    );

    public function __construct()
    {
        $this->isDebugTrue = Kahoutility::getRequestedClientConfigurationsByKey("debug");
    }

    public function writeInitiatedDebugLog($methodName, $methodParams = NULL, $message = null)
    {
        if ($this->isDebugTrue) {
            $getDebugBacktrace = GetDebugBacktrace(3);
            $debugMessage = empty($message) ? $methodName . self::METHOD_INITIATED_MSG . $getDebugBacktrace : $methodName . $message . $getDebugBacktrace;
            if (! is_null($methodParams)) {
                $debugMessage .= " with params ";
                if (is_object($methodParams)) {
                    settype($methodParams, "array");
                    $methodParams = current($methodParams);
                    goto ArrayLine;
                } else if (is_array($methodParams)) {
                    ArrayLine:
                    array_walk($methodParams, function ($value, $key) use (& $debugMessage) {
                        $debugMessage .= $this->buildMessage($value, $key);
                    });
                } else {
                    $debugMessage .= $methodParams;
                }
            } else {
                $debugMessage .= " with no params";
            }
            debug_log_message($debugMessage);
        }
    }

    public function writeReturnedDebugLog($methodName, $returnedData = NULL, $message = null)
    {
        if ($this->isDebugTrue) {
            $debugMessage = empty($message) ? $methodName . self::METHOD_RETURNED_MSG : $methodName . $message;
            $debugMessage .= is_array($returnedData) ? print_r($returnedData, TRUE) : (empty($returnedData) ? " void" : $returnedData);
            debug_log_message($debugMessage);
        }
    }

    private function buildMessage($value, $key)
    {
        return is_array($value) ? print_r($value, TRUE) : (is_object($value) ? ObjectToString($value, "", ",", true) : $value) . " ";
    }

    public function writeErrorLog($message, $code = NULL)
    {
        log_message("error", $message);
        $this->performActionBasedOnCode($code, $message);
    }

    private function performActionBasedOnCode($code, $message)
    {
        if (! is_null($code)) {
            switch ($code) {
                case self::MAIL_ERROR_CODE:
                    $this->sendEmail($message);
                    break;
                default:
                    break;
            }
        }
    }

    private function sendEmail($message)
    {
        $subject = "Severity Error";
        $to = implode(",", $this->systemAdminEmail);
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: ' . '<' . "System" . '>' . "\r\n";
        mail($to, $subject, $message, $headers);
    }
}
