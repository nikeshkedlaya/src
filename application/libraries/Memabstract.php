<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Memabstract
 *
 * @author Quadir
 */
abstract class Memabstract
{

    protected $isCacheEnabled = true;
 // will check that is method cached, by default would be true and could be changed in derived class
    protected $cachingExpirationTime = 0;

    protected $MemConnection = null;
 // to store memcached connection
    protected $library;

    protected function GetCachedData($key)
    { // get the data from memcached server
        if (is_null($this->MemConnection) === TRUE) {
            $this->library->load->library("memlibrary");
            $this->MemConnection = $this->library->memlibrary;
            return $this->MemConnection->Get($key);
        } else {
            return $this->MemConnection->Get($key);
        }
    }

    protected function SetCachedData($Key, $Val)
    { // set the data in the memcached server
        if (is_null($this->MemConnection) === TRUE) {
            $this->library->load->library("memlibrary");
            $this->MemConnection = $this->library->memlibrary;
            $this->MemConnection->Set($Key, $Val, $this->cachingExpirationTime);
        } else {
            $this->MemConnection->Set($Key, $Val, $this->cachingExpirationTime);
        }
    }

    protected function unsetCachedData($key)
    { // removing the cached data by key
                                               // try {
        if (is_null($this->MemConnection) === TRUE) {
            $this->library->load->library("memlibrary");
            $this->MemConnection = $this->library->memlibrary;
            $this->MemConnection->Delete($key);
        } else {
            $this->MemConnection->Delete($key);
        }
    }

    protected function isCachable()
    { // will just check that it is cacheable or not
        if ($this->isCacheEnabled === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
