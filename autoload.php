<?php

declare(strict_types=1);

spl_autoload_register(function (string $className) {
    $fileName = __DIR__ . '/src/' . $className . '.php';
    if (file_exists($fileName)) {
        require_once $fileName;
    }
});
