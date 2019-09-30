<?php

/**
 * @created by Sandeep kosta <sandeep@kaholabs.com> on 18 Nov, 2014 10:36:12 AM
 * 
 * Descripion: would be used to store configuration option for importing features
 * 
 * Security : 
 * 
 * 
 */
/* Teacher */
$validationRuleConfiguration['adminteacher']['First Name*'] = array(
    "required" => "ValidateEmptyString",
    "name" => "ValidateName"
);
$validationRuleConfiguration['adminteacher']['Middle Name'] = array(
    "name" => "ValidateName"
);
$validationRuleConfiguration['adminteacher']['Last Name'] = array(
    "name" => "ValidateName"
);
$validationRuleConfiguration['adminteacher']['Phone'] = array();
$validationRuleConfiguration['adminteacher']['Qualification'] = array();
$validationRuleConfiguration['adminteacher']['Reports To(Email)'] = array();
$validationRuleConfiguration['adminteacher']['Designation'] = array();
$validationRuleConfiguration['adminteacher']['Address'] = array();
/* Last column should'nt be the forieign key references */

$config['validation_rule_configuration'] = $validationRuleConfiguration;

