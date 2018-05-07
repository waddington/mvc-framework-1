<?php
// This is my controller for the login form for the admin area
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 01/04/17
 * Time: 17:56
 */

$model = new LoginModel(); // Creating the model

if ($model->isFormSubmitted()) { // First I check whether this controller was loaded because of a form submission meaning that there was a login attempt
    if (!$model->getErrors()) { // Then I check if there are any errors in the form data
        $model->submitLoginForm(); // If everything is fine then I submit the login form and set the session variables
    }
}
$errors = $model->getErrors(); // I get any errors if there were any
require_once 'Views/admin/loginView.php'; // Loading the view