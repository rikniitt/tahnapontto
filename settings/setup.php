<?php

date_default_timezone_set('Europe/Helsinki');

// Setup some constansts
define('PROJECT_DIR', realpath(__DIR__ . '/../'));
define('VIEW_DIR', PROJECT_DIR . '/views');

define('LOG_LEVEL', 'DEBUG');

// Database credentials
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'secret');
define('DB_DBAS', 'klein_php_example');

// Setup autoloading
spl_autoload_register(function ($class) {
    $file = PROJECT_DIR . '/system/' . strtolower($class) . '.class.php';
    include $file;
});

// Require libraries
require PROJECT_DIR . '/system/klein.php';
require PROJECT_DIR . '/system/idiorm.php';
require PROJECT_DIR . '/system/paris.php';

// Configure database connection with idiorm
ORM::configure('mysql:host=' . DB_HOST . ';dbname=' . DB_DBAS);
ORM::configure('username', DB_USER);
ORM::configure('password', DB_PASS);

// Require more settings
require PROJECT_DIR . '/settings/services.php';
require PROJECT_DIR . '/settings/routes.php';
