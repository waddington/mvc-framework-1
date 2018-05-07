<?php
// My contact form submission file that is called via ajax
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 07/04/17
 * Time: 15:38
 */

// Creating the arrays
$errors = array();
$data = array();

// Getting the form data
if (empty($_POST['cm-name'])) {
    $errors['name'] = "Name is required.";
}
if (empty($_POST['cm-email'])) {
    $errors['email'] = "Email is required.";
}

if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {

    // Need this file to do basically everything
    require_once '../bootstrap.php';

    $cmName = clean_input($_POST['cm-name']);
    $cmEmail = clean_input($_POST['cm-email']);
    $cmMessage = clean_input($_POST['cm-message']);


    // Adding the contact form data to the database
    $sql = "INSERT INTO contact_messages (cm_name, cm_email, cm_message) VALUES (?, ?, ?)";
    $sqlData = array($cmName, $cmEmail, $cmMessage);

    global $queriesModel;
    $statement = $queriesModel->pdoStatement($sql, $sqlData);

    // Checking that the data was added to the database correctly
    if ($statement->errorCode() != "00000") {
        $data['success'] = false;
        $data['errors'] = "Error submitting form.";
    } else {
        $data['success'] = true;
        $data['message'] = "Success!";
    }
}

// Printing the data out so the ajax call can return it
echo json_encode($data);