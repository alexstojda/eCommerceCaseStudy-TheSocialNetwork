<?php

require '../includes/config.php';

// Also spl_autoload_register (Take a look at it if you like)
function __autoload($class)
{
    $file = LIBS . $class . ".php";
    if (file_exists($file)) {
        /** @noinspection PhpIncludeInspection */
        require_once $file;
    }
}

// Load the Bootstrap!
$bootstrap = new Bootstrap();
$bootstrap->init();