<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$login = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */
//$login['getLoggedIn'] = "sCheckUser"; // sCheckUser(IN PEmail varchar(128), IN PPassword varchar(128))
$login['getLoggedIn'] = "sUserAuthenticate"; // sUserAuthenticate(IN PUser_Email varchar(64), IN PUser_Password varchar(64), IN PUser_Agent text)
                                                          // $login['getUser'] = "sUserAuthenticate";
$login['getUserForAuthentication'] = "sUserAuthenticate"; // sUserAuthenticate(IN PUser_Email varchar(64), IN PUser_Password varchar(64), IN PUser_Agent text)
                                                          // $login['getUser'] = "sUserAuthenticate";
$login['getConfig'] = "sConfigGet";
$login['changePassword'] = "sChangePassword"; // sChangePassword(IN PUser_ID INT,IN POld_Password text, IN PNewPassword text)
$login['getLoggedInUserInfoByTeacher'] = "sTeacherInfoGet"; // sTeacherInfoGet(IN PTeacher_Code varchar(16))
$login['getLoggedInUserInfoByParent'] = "sParentInfoGet"; // sParentInfoGet(IN PUser_Code varchar(16))
                                                          // $login['passwordReset'] = "sUserActivate";
                                                          // $login['checkEmail'] = "sUserForgotPassword";
                                                          // $login['changePassword'] = "sChangePassword";
                                                          // $login['currentPasswordCheck'] = "sCheckPassword";

$config['login'] = $login; // key name must be controller class name in lower case
