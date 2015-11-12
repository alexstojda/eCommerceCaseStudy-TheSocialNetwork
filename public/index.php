<?php

require '../includes/config.php';
//require '../includes/core/Session.php';

// Also spl_autoload_register (Take a look at it if you like)
function __autoload($class) {
    $file = LIBS . $class .".php";
    if (file_exists($file)) {
        require $file;
    }
}


// Load the Bootstrap!
$bootstrap = new Bootstrap();

// Optional Path Settings
//$bootstrap->setControllerPath();
//$bootstrap->setModelPath();
//$bootstrap->setDefaultFile();
//$bootstrap->setErrorFile();

$bootstrap->init();