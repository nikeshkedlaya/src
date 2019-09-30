<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$client_specific_configuration = array(); // this is testing
$client_specific_configuration['development']['debug'] = false;
$client_specific_configuration['development']['cwd'] = "assets/client/development/";
$client_specific_configuration['development']['webwd'] = $client_specific_configuration['development']['cwd'] . "web/";
$client_specific_configuration['development']['adminwd'] = $client_specific_configuration['development']['cwd'] . "admin/";

$client_specific_configuration['kahoms']['debug'] = false;
$client_specific_configuration['kahoms']['cwd'] = "assets/client/kahoms/";
$client_specific_configuration['kahoms']['webwd'] = $client_specific_configuration['kahoms']['cwd'] . "web/";
$client_specific_configuration['kahoms']['adminwd'] = $client_specific_configuration['kahoms']['cwd'] . "admin/";

$config['client_specific_configuration'] = $client_specific_configuration;
