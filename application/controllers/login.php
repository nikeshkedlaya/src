<?php

/**
 * @created by Karthik <karthik@kaholabs.com> on 26-Dec-2014 09:51:30
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
// namespace kaholabs
class Login extends KaHO_Controller
{

    public function __construct()
    {
        parent::__construct("loginservice");
    }

    public function checkSessionSet()
    {
        // leaving empty so it won't check in session is set or not,because extending KaHO_Controller
    }

    public function getLoggedIn()
    {
        $this->loginservice->getLoggedIn();
    }

    public function getUserForAuthentication()
    {
        $this->loginservice->getUserForAuthentication();
    }

    public function logout()
    {
        $this->loginservice->logout();
    }

    public function androidLogout()
    {
        $this->loginservice->androidLogout();
    }

    public function changePassword()
    {
        $this->loginservice->changePassword();
    }
    
    public function setSchoolContext(){
        $this->loginservice->setSchoolContext();
    }
    
    public function unsetSchoolContext(){
        $this->loginservice->unsetSchoolContext();
    }
}
