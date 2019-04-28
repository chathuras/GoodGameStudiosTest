<?php

// Define path to System directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../System'));

// Define Application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure System/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../System'),
    get_include_path(),
)));

require_once 'CS/Application.php';

// Starting the application with configs
$application = new CS\Application(APPLICATION_ENV, APPLICATION_PATH . '/App/config.php');
$application->start();