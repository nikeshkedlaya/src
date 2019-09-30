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
$mark = [];
$mark["Student Code"] = [
    [
        "isInputEmpty",
        REQUIRED_MESSAGE
    ]
];
$mark["Student Name"] = [
    [
        "isInputEmpty",
        REQUIRED_MESSAGE
    ]
];
$mark["Marks"] = [];

$config['mark'] = $mark; // key name must be controller class name in lower case
