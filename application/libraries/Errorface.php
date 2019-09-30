<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Quadir
 */
interface Errorface
{

    // put your code here
    public function getCustomMemcachedError();

    public function setCustomMemcachedError($errorMessage, $methodName);
}
