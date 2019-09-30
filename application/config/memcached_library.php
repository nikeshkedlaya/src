<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (! defined("BASEPATH"))
    exit("No direct script access allowed");
/* server details starts here */
$memcached['server_amazon']['host'] = "localhost";
$memcached['server_amazon']['port'] = 31596;
$memcached['server_amazon']['weight'] = "10";
// $memcached['server_amazon']['persistant'] = [false];
// $memcached['server_amazon']['site_key'] = ["thvs"]; // as any site's data could be stored in any server so we need tyo

/* server details ends here */

/* memcached configuration setting stars here */
// $memcached['memcached_set_option'][Memcached::OPT_PREFIX_KEY] = 'development_';
$memcached['memcached_set_option'][Memcached::OPT_PREFIX_KEY] = GetMemcachedPrefixForKey();
$config['memcached'] = $memcached;
