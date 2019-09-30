<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 * thumb rule
 *
 */
$student = [];
$student["Student Code/Admission No"] = [];
$student["Roll No"] = [];
$student["First Name*"] = [
[
        "isInputEmpty",
        REQUIRED_MESSAGE
    ],
    [
        "isNameValid",
        INVALID_MESSAGE
    ]
];
$student["Middle Name"] = [];
$student["Last Name"] = [];
$student["Gender"] = [];
$student["Class*"] = [
    [
        "isInputEmpty",
        REQUIRED_MESSAGE
    ]
];
$student["Section*"] = [];
$student["DOB(dd/mm/yyyy or dd-mm-yyyy)"] = [];
$student["Admission Date(dd/mm/yyyy or dd-mm-yyyy)"] = [];
$student["Father Name"] = [];
$student["Father Occupation"] = [];
$student["Father Email"] = [];
$student["Father Phone"] = [];
$student["Mother Name"] = [];
$student["Mother Occupation"] = [];
$student["Mother Email"] = [];
$student["Mother Phone"] = [];
$student["Address"] = [];
$student["Route No"] = [];
$student["Stop Name"] = [];
$student["Special Notes"] = [];
$student["Allergic To"] = [];
$config['student'] = $student; // key name must be controller class name in lower case
