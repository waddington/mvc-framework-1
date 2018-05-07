<?php
// This is my controller that handles everything related to posts in the admin area
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 28/03/17
 * Time: 23:05
 */

$model = new PostsAdminModel($action, $id); // Creating the model, passing the required action and any specific ID's to the constructor

if ($action == "new") { // If the user wants to make a new post
    if ($model->isFormSubmitted()) { // Check if the form was submitted
        if (!$model->getNewPostErrors()) { // Check if there were any errors in the form
            $model->submitForm(); // If there were no errors then submit the form adding the new post
        }
    }
    $errors = $model->getNewPostErrors(); // Get any errors
    $success = $model->getSubmissionSuccessful(); // Get any successes
    $allCategories = $model->getAllCategories(); // Get a list of all categories to display in the form
    require_once 'Views/admin/postsNewView.php'; // Load the view
} else if ($action === "edit") { // If the user wants to edit a post
    if ($model->isFormSubmitted()) { // Check if the form was submitted meaning they want to update the post
        if (!$model->getEditPostErrors()) { // Get any errors with the form
            $model->submitForm(true); // If there are no errors then submit the form updating the post
        }
    }
    $postData = $model->getPost($id); // Get the data of the post the user wants to edit
    $allCategories = $model->getAllCategories(); // Get a list of all categories to display
    $errors = $model->getEditPostErrors(); // Get any errors
    $success = $model->getSubmissionSuccessful(); // Get any successes
    require_once 'Views/admin/postsEditView.php'; // Load the view
} else if ($action == "categories") { // If the user wants view/edit categories - this is all on the same page
    if ($model->isFormSubmitted()) { // Check if the form on the page was submitted
        if (!$model->getEditPostErrors()) { // Get any errors in the form
            $model->addNewCategory(); // Submit the form adding the category
        }
    }
    $errors = $model->getNewPostErrors(); // Get any errors
    $success = $model->getSubmissionSuccessful(); // Get any successes
    $categoriesData = $model->getAllCategories(); // Get a list of all post categories to display
    require_once 'Views/admin/categoriesView.php'; // Load the view
} else if ($action == "delete") { // If the user wants to delete a post
    $model->deletePost($id); // Call the function to delete the post with the ID in the URL
    if ($model->getDeletionSuccess()) { // If it was deleted successfully
        $deleted = true;
    } else { // If it was not deleted successfully
        $deleted = false;
    }
    $allPosts = $model->getAllPosts(); // Get all the posts to display
    require_once 'Views/admin/postsAllView.php'; // Load the view
} else { // If there is no specific page specified then show all the posts
    $allPosts = $model->getAllPosts(); // Get all the posts
    require_once 'Views/admin/postsAllView.php'; // Load the view
}
