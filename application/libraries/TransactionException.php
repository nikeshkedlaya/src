<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TransactionException
 *
 * @author Sandeep
 */
class TransactionException extends Exception
{

    public function GetTransactionErrException()
    {
        $TransactionExcMessage = $this->getMessage() . " on line no " . $this->getLine() . " on file " . $this->getFile() . " backtrace at " . $this->getTraceAsString();
        return $TransactionExcMessage;
    }
}

