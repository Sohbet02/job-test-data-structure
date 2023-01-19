<?php
require_once "config/config.php";
require_once 'config/autoload.php';   
require_once 'components/helpers.php';   

$router = new Router();
$router->run();