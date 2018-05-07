<?php
// This file contains code that is the same for admin.php and index.php
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 07/04/17
 * Time: 23:18
 */


require_once 'config.php'; // I put some config settings in a separate file so that they are more easily accessible
require_once 'functions.php'; // I have a file containing functions that will also be used by various other files

// This is my autoload class
// Only my Models are php classes so this first checks that it is looking for a Model - all Models' filename's end with "Model"
spl_autoload_register(function ($className) {
    if (endsWith($className, "Model")) { // Here I check that it is a Model that it is looking for
        if (file_exists('Models/admin/'.$className.'.php')) { // I first check if the class is in the folder for the public facing area of the site and include it if it exists
            require_once 'Models/admin/'.$className.'.php';
        } else if (file_exists('Models/'.$className.'.php')) { // I then check if the class is in the folder for the admin area of the site and include it if it exists
            require_once 'Models/' . $className . '.php';
        } else if (file_exists('../Models/'.$className.'.php')) { // I then check for it again in the public area but this time using a different path so that this works when a nested file includes this bootstrap file
            require_once '../Models/'.$className.'.php';
        } else {
            // error
            require_once '../e404.php'; // If it doesn't exist I load my 404 file
        }
    }
});

// Start the users session
session_start();

$isLoggedIn = false; // I initially set the users logged in state to false
$userEmailSession = null; // I initially set the users email to null

// Check if the user is logged in and to decide what to show
if (!empty($_SESSION['LoggedIn']) && !empty($_SESSION['UserEmail'])) { // If the session parameters are set then the user is considered logged in
    $isLoggedIn = true; // I store the session parameters in variables as I will be accessing the values several times
    $userEmailSession = $_SESSION['UserEmail'];
}

// Create PDO connection
global $queriesModel; // I use a global variable as I am going to be accessing this from lots of places that are only in the global scope
$queriesModel = new QueriesModel($dbname, $dbusername, $dbpassword); // I pass information from my config file to the constructor

// QueriesModel
parse_str($_SERVER['QUERY_STRING'], $queries); // I load all query parameters into an array