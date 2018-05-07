<?php
// This file has most of the configs in
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 18/04/17
 * Time: 18:06
 */

// Database details
// I check if the file is served from igor or locally to save time when switching development locations
// I set database settings accordingly
$loc = $_SERVER['REQUEST_URI'];
if (strpos($loc, "/~kwadd001/dnw/coursework-2/term-2/") !== false) {
    // IGOR
    $dbname = "";
    $dbusername = "";
    $dbpassword = "";
} else {
    // Local
    $dbname = "";
    $dbusername = "";
    $dbpassword = "";
}

// Error reporting
// Ability to easily turn error reporting on/off
$errorReporting = true;
if ($errorReporting) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(0);
}

// Defining a name for the root folder so that it is easier to get to
define('BD', '/~kwadd001/dnw/coursework-2/term-2');
