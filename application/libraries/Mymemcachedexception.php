<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mymemcachedexception
 *
 * @author Quadir
 */
class Mymemcachedexception extends MemcachedException
{

    public function GetMemcachedCustomErrMessage()
    {
        $ErrMessage = "Memcached error " . $this->getMessage() . " on line no " . $this->getLine() . " on file " . $this->getFile() . " code is" . $this->getCode();
        return $ErrMessage;
    }
}
