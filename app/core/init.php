<?php

// First, include Composer's autoloader if you're using Composer
if (file_exists(__DIR__ . '/../../vendor/autoload.php')) {
    require __DIR__ . '/../../vendor/autoload.php';
}

// Then, use your custom autoloader for your application classes only
spl_autoload_register(function ($classname) {
    // Only try to autoload model classes, not external libraries
    $filePath = "../app/models/" . ucfirst($classname) . ".php";
    if (file_exists($filePath)) {
        require $filePath;
    }
});

// // First, include Composer's autoloader if you're using Composer
// if (file_exists(__DIR__ . '/../../vendor/autoload.php')) {
//     require __DIR__ . '/../../vendor/autoload.php';
// }

require 'config.php';
require 'functions.php';
require 'Database.php';
require 'Model.php';
require 'Controller.php';
require 'App.php';
