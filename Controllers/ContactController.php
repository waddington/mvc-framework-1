<?php
// Controller for my contact page
// This is almost redundant
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 07/04/17
 * Time: 14:55
 */

// Creating the model...which doesn't actually get used currently as the form is submitted via an ajax call...however this would allow for future expansion
$model = new ContactModel();

// Loading the view
require_once 'Views/ContactView.php';