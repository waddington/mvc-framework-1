<?php
// This is my single point of entry for everything in the public facing area of the site
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 28/03/17
 * Time: 16:29
 */

// I include a bootstrapping file which contains common code for this and my single point of entry for the public facing area of the site
require_once 'bootstrap.php';

// Below I get the different query parameters on the url
$title = 'Home';

// Section
// This relates to the controller that is loaded
$page = 'home'; // I set a default for the variables
if (isset($queries['page'])) { // I check to see if the variable is set before I try and access it
    if (!empty($queries['page'])) {
        $page = $queries['page'];
        $title = ucwords($page); // I transform the first letter of each word to be uppercase
    }
}

// Specific id
$id = 'null';
if (isset($queries['id'])) { // I transform the first letter of each word to be uppercase
    if (!empty($queries['id'])) {
        $id = $queries['id'];
    }
}

// Uppercase and remove whitespace
$page = preg_replace('/\s+/', '', ucwords($page));

require_once 'Templates/header.php'; // I get the header
if (file_exists('Controllers/'.$page.'Controller.php')) { // I check that the file for the controller exists before I try to load it
    require_once 'Controllers/'.$page.'Controller.php'; // If the controller file does exist then I load it
} else { // If the file does not exist I load a generic 404 type file that says there was an error
    require_once 'e404.php';
}
require_once 'Templates/footer.php'; // I get the footer