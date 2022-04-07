<?php

use Symfony\Component\Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

define('ROOT', dirname(__DIR__));
define('CONFIG', __DIR__);
define('VIEW', ROOT . '/view/');

$env = ROOT . '/.env';
if (file_exists($env)) {
    $dotenv = new Dotenv(true);
    $dotenv->load($env);
}

session_start();