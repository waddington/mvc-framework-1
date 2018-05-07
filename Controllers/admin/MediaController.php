<?php
// This is my controller that handles the media section of the admin area
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 02/04/17
 * Time: 17:45
 */

$model = new MediaModel($action); // Creating the model, also passing the required action to the construction

// Checking the action the user wants to do, this is from a url query parameter
if ($action == "upload") { // If the user wants to upload a file
    if ($model->isFormSubmitted()) { // I check if the controller is loaded from a form submission
        if (!$model->getNewMediaErrors()) { // If the form was submitted, and there are no errors in the data
            $model->uploadMedia(); // Submit the form thus uploading the media object
        }
    }
    $errors = $model->getNewMediaErrors(); // Getting any errors
    $success = $model->getSubmissionSuccessful(); // Checking if there was a successful events
    $allCategories = $model->getAllCategories(); // Returning a list of all the categories to show in the form
    require_once 'Views/admin/mediaUploadView.php'; // Loading the relevant view
} else if ($action == "categories") { // If the user wants to view the categories
    if ($model->isFormSubmitted()) { // Check if the form on the page was submitted
        if (!$model->getNewMediaErrors()) { // If it was check if there are any errors
            $model->addNewCategory(); // If not then add the new category
        }
    }
    $errors = $model->getNewMediaErrors(); // Check for any errors
    $success = $model->getSubmissionSuccessful(); // Check for any successes
    $categoriesData = $model->getAllCategories(); // Get all the categories to display them
    require_once 'Views/admin/categoriesView.php'; // Load the view
} else { // If they don't want to upload or view the categories then they want to view all items
    $mediaData = $model->getAllMediaItems(); // Get a list of all items in the media library, these are stored in the database
    require_once 'Views/admin/mediaAllView.php'; // Load the view
}