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
interface Dbcrudlistenerinterface {

    //put your code here
    public function update(string $callback, array $dbResponse = NULL, array $inputParams = NULL);
}
