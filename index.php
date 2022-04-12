<?php

require __DIR__ . '/config/bootstrap.php';

$config = [
    'definitions' => require CONFIG . '/definitions.php'
];

try {
    echo (new App($config))->run();
} catch (Throwable $e) {
    echo $e->getMessage();
}