<?php

use src\App;

require CONFIG . '/bootstrap.php';

$config = [
    'definitions' => require CONFIG . '/definitions.php'
];

try {
    (new App($config))->run();
} catch (Throwable $e) {
    echo $e->getMessage();
}