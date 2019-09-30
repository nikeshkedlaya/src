<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of acknowledgement
 *
 * @author KaHO
 */
class Acknowledgement extends KaHO_Controller
{

    // put your code here
    public function __construct()
    {
        parent::__construct("acknowledgementservice");
    }

    public function getAcknowledgementDetail()
    {
        $this->acknowledgementservice->getAcknowledgementDetail();
    }

    public function addAcknowledgement()
    {
        $this->acknowledgementservice->addAcknowledgement();
    }
    
    /*

     *      */
}
