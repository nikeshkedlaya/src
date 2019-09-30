<?php

/**
 * @created by Sandeep kosta <sandeep@kaholabs.com> on 4 Mar, 2015 6:58:06 PM
 * 
 * Descripion: 
 * 
 * Security : 
 * 
 * Change History :-
 * 
 * 
 * 
 * 
 * @Audited by :-
 */
class KaHO_Loader extends CI_Loader
{

    public function __construct()
    {
        parent::__construct();
    }

    public function Iface($InterfaceName)
    {
        require_once APPPATH . 'interfaces/' . $InterfaceName . '.php';
    }
}
