<?php
// This is my single point of entry to everything in the admin area
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 28/03/17
 * Time: 16:29
 */

// I include a bootstrapping file which contains common code for this and my single point of entry for the public facing area of the site
require_once 'bootstrap.php';

// Below I get the different query parameters on the url
$title = 'Dashboard';

// Section
// This relates to the controller that is loaded
$page = 'dashboard'; // I set a default for the variables
if (isset($queries['page'])) { // I check to see if the variable is set before I try and access it
    if (!empty($queries['page'])) {
        $page = $queries['page'];
        $title = ucwords($page); // I transform the first letter of each word to be uppercase
    }
}

// Action
// This relates to what the controller is going to do, what functions in the method will be called
$action = 'view'; // I set a default for the variables
if (isset($queries['modifier'])) { // I check to see if the variable is set before I try and access it
    if (!empty($queries['modifier'])) {
        $action = $queries['modifier'];
    }
}

// Specific id
$id = 'null'; // I set a default for the variables
if (isset($queries['id'])) { // I check to see if the variable is set before I try and access it
    if (!empty($queries['id'])) {
        $id = $queries['id'];
    }
}

// Check if user wants to logout
if (isset($queries['logout'])) { // I check to see if the variable is set before I try and access it
    if (!empty($queries['logout'])) {
        if ($queries['logout'] == true) {
            $_SESSION = array(); // If the user wants to log out I first set the session to an empty array
            session_destroy(); // Then I destroy the session
            $isLoggedIn = false; // Then I set a variable signalling that they are NOT logged in
        }
    }
}

// Uppercase and remove whitespace
$page = preg_replace('/\s+/', '', ucwords($page));

require_once 'Templates/admin/header.php'; // I get the header
if ($isLoggedIn) { // If the user is logged in I want to load whichever controller is required based on the query parameters
    require_once 'Controllers/admin/'.$page.'Controller.php';
} else { // If they're not logged in, show the login form
    require_once 'Controllers/admin/LoginController.php';
}
require_once 'Templates/admin/footer.php'; // I get the footer