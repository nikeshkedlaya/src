<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of kahoadmincontroller
 *
 * @author KaHO
 */
include_once APPPATH . "libraries/Kahoadminservices.php";

class Kahoadmincontroller extends KaHO_Controller
{
    public function __construct($serviceName = null)
    {
        parent::__construct();
        if (! is_null($serviceName)) {
            $this->load->library("adminservices/" . $serviceName);
        }
    }
}
