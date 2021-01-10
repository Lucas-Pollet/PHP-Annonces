<?php

// Valid PHP Version?
$minPHPVersion = '7.2';
if (phpversion() < $minPHPVersion)
{
	die("Your PHP version must be {$minPHPVersion} or higher to run CodeIgniter. Current version: " . phpversion());
}
unset($minPHPVersion);

if(!file_exists('config.json')) {
    require('setup.php');
}else{
// Path to the front controller (this file)
    define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

// Location of the Paths config file.
// This is the line that might need to be changed, depending on your folder structure.
    $pathsPath = realpath(FCPATH . '../app/Config/Paths.php');
// ^^^ Change this if you move your application folder

// Ensure the current directory is pointing to the front controller's directory
    chdir(__DIR__);

// Load our paths config file
    require $pathsPath;
    $paths = new Config\Paths();


    $jsonConfigFile = file_get_contents("config.json");
    $config = json_decode($jsonConfigFile, true);

    $_ENV['db_hostname'] = $config['hostname'];
    $_ENV['db_username'] = $config['user'];
    $_ENV['db_password'] = $config['pwd'];
    $_ENV['db_name'] = $config['dbname'];

    // Location of the framework bootstrap file.
    $app = require rtrim($paths->systemDirectory, '/ ') . '/bootstrap.php';
    $app->run();
}

