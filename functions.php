<?php
// This file contains functions that are widely used
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 01/04/17
 * Time: 18:46
 */

// Clean input
// This "cleans" the data passed to the function and returns the clean version
function clean_input($data) {
    $data = trim($data); // strips whitespace from beginning/end
    $data = stripslashes($data); // remove backslashes
    $data = htmlspecialchars($data); // replace special characters with HTML entities
    return $data;
}

// Shorten input to a set number of characters but on a whole word
function postAdminPreview($data, $length=160) {
    if (preg_match('/^.{1,'.$length.'}\b/s', $data, $match)) {
        $data = $match[0];
    }
    return $data;
}

// Helper functions
// Seeing if a string ends with a certain string
function endsWith($haystack, $needle) {
    $length = strlen($needle);

    if ($length == 0) {
        return true;
    }
    return (substr($haystack, -$length) === $needle);
}

// My function to create XML data for the map based on data in the database
function getMapXMLData() {
    // Get data from database
    $sql = "SELECT * FROM map_markers";

    global $queriesModel;
    $statement = $queriesModel->pdoStatement($sql); // Running the query

    $mapData = $statement->fetchAll(); // Getting all the data from the query

    header("Content-type: text/xml"); // Setting the header so that the data is interpreted correctly

    // Create XML from data
    $dom = new DOMDocument("1.0");
    $parNode = $dom->createElement("markers");
    $dom->appendChild($parNode);

    foreach ($mapData as $datum) { // Looping through the data and creating relevant xml tags and attributes from it
        $node = $dom->createElement("marker");
        $node->setAttribute("id", $datum['id']);
        $node->setAttribute("name",$datum['mm_name']);
        $node->setAttribute("address", $datum['mm_address']);
        $node->setAttribute("lat", $datum['mm_lat']);
        $node->setAttribute("lng", $datum['mm_lng']);
        $node->setAttribute("type", $datum['mm_type']);
        $parNode->appendChild($node); // Adding the element to the main body
    }

    echo $dom->saveXML(); // Echoing out the result so that it is returned for the JSON call
}

// Function to encrypt passwords
function my_password_hash($password) {
    return sha1($password);
}

// Function to check that an entered password matches the stored hash in the database
function my_password_verify($password, $hash) {
    if (sha1($password) === $hash) {
        return true;
    } else {
        return false;
    }
}

// Function that uses curl to download a webpage so it can late be parsed
function downloadPage($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $page = curl_exec($ch);
    curl_close($ch);

    return $page; // Returning the downloaded data
}