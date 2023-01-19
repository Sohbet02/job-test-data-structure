<?php
define('DEBUG_MODE', false);

if(DEBUG_MODE === true) {
	ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

define('BASEURL', $_SERVER['DOCUMENT_ROOT']);

session_start();