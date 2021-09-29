<?php

use Predis\Client;
use src\Modules\Redis\Infrastructure\RedisSessionHandler;
use Symfony\Component\Dotenv\Dotenv;

require 'vendor/autoload.php';

define('ROOT', dirname(__DIR__));
define('CONFIG', __DIR__);
define('VIEW', ROOT . '/view/');

$env = ROOT . '/.env';
if (file_exists($env)) {
    $dotenv = new Dotenv(true);
    $dotenv->load($env);
}

$redis = new Client([
    'scheme' => getenv('REDIS_CONNECTION_SCHEME'),
    'host'   => getenv('REDIS_HOST'),
    'port'   => getenv('REDIS_PORT'),
]);
$sessionHandler = new RedisSessionHandler($redis);

session_set_save_handler($sessionHandler);
session_start();