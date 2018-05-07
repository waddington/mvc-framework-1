<?php
// My controller for handling users of the admin area
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 01/04/17
 * Time: 20:10
 */

$model = new UsersModel($action, $id); // Creating the model passing the required action and relevant ID to the constructor

switch ($action) { // Switch statement on the action the user wants to make
    case "new": { // If the user wants to add a new user
        // This is almost identical to my other admin controllers
        //
        //
        // Check if the form was submitted -->> check if there were any errors in the form data -->> submit the form
        //
        //
        if ($model->isFormSubmitted()) {
            if (!$model->getNewUserErrors()) {
                $model->submitForm();
            }
        }
        $errors = $model->getNewUserErrors();
        $success = $model->getSubmissionSuccessful();
        require_once 'Views/admin/usersNewView.php';
        break;
    }
    case "edit": {
        if ($model->isFormSubmitted()) {
            if (!$model->getEditUserErrors()) {
                $model->submitForm(true);
            }
        }
        $userData = $model->getUser($id);
        $errors = $model->getEditUserErrors();
        $success = $model->getSubmissionSuccessful();
        require_once 'Views/admin/usersEditView.php';
        break;
    }
    case "delete": {
        $model->deleteUser($id);
        if ($model->getDeletionSuccess()) {
            $deleted = true;
        } else {
            $deleted = false;
        }
    }
    default: {
        $allUsers = $model->getAllUsers();
        require_once 'Views/admin/usersAllView.php';
    }
}