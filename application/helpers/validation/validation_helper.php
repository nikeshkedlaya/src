<?php

/**
 * @created by Nikesh<nikesh@kaholabs.com> on 18 Nov, 2014 2:37:48 PM
 * 
 * Descripion: 
 * 
 * Security : 
 * 
 * Change History :-
 * created one function for date validation 01/12/2014 - sandeep kosta
 * 
 * 
 * 
 * @Audited by :-
 */
// namespace kaholabs
function ValidateEmptyString($String)
{ // going to check that if string is empty then return the true else false
    if ($String == '0') {
        return false;
    } else if (empty($String) === TRUE || trim($String) === "") {
        return true; // will return true if string is empty
    }
}

function ValidateBit($Bit)
{ // going to check that value is having either zero or one
    if ((int) $Bit === 0 || (int) $Bit === 1) {
        return TRUE;
    }
}

function ValidateBitOrAlpha($Str)
{ // going to check that value is having yes no
    if (strtolower($Str) == "yes" || strtolower($Str) == "no") {
        return TRUE;
    }
}

function ValidateDesignationCode($Bit)
{
    return empty($Bit) === FALSE ? in_array($Bit, GetConfigItem('designation_code')) : true; // designation code could be empty so if $bit is empty then simply return true
}

function ValidateStaffType($Type)
{
    return in_array($Type, GetConfigItem('staff_type'));
}

function ValidateActivityType($Type)
{
    return in_array($Type, GetConfigItem('activity_type'));
}

function ValidateBookType($Type)
{
    return in_array($Type, GetConfigItem('book_type'));
}

function ValidateBookFlag($Type)
{
    return in_array($Type, GetConfigItem('book_flag'));
}

/*
 * CheckString() can be used to validate the string
 * This function is used to check the string of only alphabets
 */
function ValidateAlphaString($String)
{
    // if (empty($String) === FALSE)
    // {
    if (preg_match('/[^a-zA-Z0-9-_ _]+/i', $String) === 0) {
        return true; // if pattern matches then return true
    } else {
        return FALSE; // else false
    }
    // } else
    // {
    // return true; // if string empty then return true;
    // }
    // return empty($String) === FALSE ? ctype_alpha($String) : true;
    // return empty($String) === FALSE ? (bool)preg_match('/[^a-zA-Z0-9-_ _]+/i', $String) : true;
}

function ValidateAlphaNumeric($String)
{
    return empty($String) === FALSE ? ctype_alnum($String) : true;
}

/*
 * CheckInt()fuction can be used to check whether the given value is float or not
 * $IntValue is the value that has to be checked
 */
function CheckInt($IntValue)
{
    if ($this->library->config->item("debug") === TRUE) {
        debug_log_message(__METHOD__ . " is initialized");
    }
    if (! filter_var($IntValue, FILTER_VALIDATE_INT)) {
        if ($this->library->config->item("debug") === TRUE) {
            debug_log_message(__METHOD__ . " is returning FALSE");
        }
        return FALSE;
    }
}

function CheckIntRange($IntValue, $int_options)
{
    if ($this->library->config->item("debug") === TRUE) {
        debug_log_message(__METHOD__ . " is initialized");
    }
    if (! filter_var($IntValue, FILTER_VALIDATE_INT, $int_options)) {
        if ($this->library->config->item("debug") === TRUE) {
            debug_log_message(__METHOD__ . " is returning FALSE");
        }
        return FALSE;
    }
}

/*
 * CheckFloat()fuction can be used to check whether the given value is float or not
 * $FloatValue is the value that has to be checked
 */
function CheckFloat($FloatValue)
{
    if ($this->library->config->item("debug") === TRUE) {
        debug_log_message(__METHOD__ . " is initialized");
    }
    if (! filter_var($FloatValue, FILTER_VALIDATE_FLOAT)) {
        if ($this->library->config->item("debug") === TRUE) {
            debug_log_message(__METHOD__ . " is returning FALSE");
        }
        return FALSE;
    }
}

/*
 * CheckEmail()fuction can be used to validate the AlphaNumeric value
 */
function ValidateEmail($Email)
{
    if (! empty($Email)) {
        if (! filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            return FALSE;
        }
    }
}

function CheckEmailRegex($Email)
{
    if (! preg_match_all('^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$', $Email)) {
        return FALSE;
    }
}

function ValidateStrings($Strings)
{
    if (preg_match('/[^a-zA-Z0-9 _]+/i', $Strings) == 0) {
        return true; // will return true if string is valid and no special chars found
    }
}

/*
 * CheckName() method can be used to validate the username
 * Name can contain lower case, upper case, number and only one special character underscore
 */
function ValidateName($Name)
{
    if (preg_match('/[^a-zA-Z _]+/i', $Name) == 0) {
        return true;
    }
}

function ValidateNumber($Num)
{
    if (preg_match("/[^0-9]/", $Num) == 0) {
        return true;
    }
}

/*
 * CheckPassword() method can be used to validate the password
 * Password Requirements for the below function
 * - Password of atleast length 8
 * - Must contain atleast one lower case and one upper case letter
 * - Must contain atleast one number
 * - Must contain atleast one special character
 */
function CheckPassword($Password)
{
    if (! preg_match_all('$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$', $Password)) {
        return FALSE;
    }
}

function CheckPasswordWithSpecifyingSpeciaChar($Password)
{
    if ($this->library->config->item("debug") === TRUE) {
        debug_log_message(__METHOD__ . " is initialized");
    }
    if (! preg_match_all('^(?=.*[\d])(?=.*[A-Z])(?=.*[a-z])[\w\d!@#$%_.]{6,40}$', $Password)) {
        if ($this->library->config->item("debug") === TRUE) {
            debug_log_message(__METHOD__ . " is returning FALSE");
        }
        return FALSE;
    }
}

// function ValidateDate($format, $date)
// {
// return DateTime::createFromFormat($format, $date);
// }
/* Time format validate as 9:10:00 */
function ValidateTimeFormat($time)
{
    // preg_match("/(1[012]|0[0-9]):([0-5][0-9])/", $foo)
    if (! preg_match("/^(0?\d|1[0-2]):[0-5]\d\s(am|pm)$/i", $time)) {
        return false;
    }
}

function ValidateDateFormat($date)
{
    if (! empty($date)) {
        if (! preg_match("^\\d{1,2}/\\d{2}/\\d{4}^", $date) && ! preg_match("^\\d{1,2}-\\d{2}-\\d{4}^", $date)) {
            return false; // it matched, return true
        }
    }
}
