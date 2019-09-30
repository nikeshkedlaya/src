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
$adminteacher = [];
$adminteacher["First Name*"] = [
    [
        "isInputEmpty",
        REQUIRED_MESSAGE
    ],
    [
        "isNameValid",
        INVALID_MESSAGE
    ]
];
$adminteacher["Middle Name"] = [
    [
        "isNameValid",
        INVALID_MESSAGE
    ]
];
$adminteacher["Last Name"] = [
    [
        "isInputEmpty",
        REQUIRED_MESSAGE
    ],
    [
        "isNameValid",
        INVALID_MESSAGE
    ]
];
$adminteacher["Email*"] = [
    [
        "isInputEmpty",
        REQUIRED_MESSAGE
    ],
    [
        "isEmailValid",
        INVALID_MESSAGE
    ]
];
$adminteacher["Phone"] = [
    [
        "isPhoneNumberValid",
        INVALID_MESSAGE
    ]
];
$adminteacher["Gender"] = [
    [
        "isInputEmpty",
        REQUIRED_MESSAGE
    ],
    [
        "isGenderValid",
        INVALID_MESSAGE
    ]
];
$adminteacher["DOB(dd/mm/yyyy or dd-mm-yyyy)"] = [
    [
        "isInputEmpty",
        REQUIRED_MESSAGE
    ],
    [
        "isDateValid",
        INVALID_MESSAGE
    ]
];
$adminteacher["DOJ(dd/mm/yyyy or dd-mm-yyyy)"] = [
    [
        "isInputEmpty",
        REQUIRED_MESSAGE
    ],
    [
        "isDateValid",
        INVALID_MESSAGE
    ]
];
$adminteacher["Qualification"] = [];
$adminteacher["Reports To(Email)"] = [
    [
        "isEmailValid",
        INVALID_MESSAGE
    ]
];
$adminteacher["Designation"] = [];
$adminteacher["Address"] = [];

$config['adminteacher'] = $adminteacher; // key name must be controller class name in lower case
