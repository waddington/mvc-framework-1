<?php
// Model for everything related to viewing/editing/deleting users in the admin area
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 01/04/17
 * Time: 20:10
 */
class UsersModel extends AdminModel
{
    // Variables storing the data of a user being edited/added
    private $userID;
    private $userFName;
    private $userLName;
    private $userDOB;
    private $userEmail;
    private $userPassword;
    private $userAction;

    // Storing information regarding the success of the form submission
    private $formSubmitted;
    private $formErrors;
    private $submissionErrors;
    private $submissionSuccessful;
    private $deletionSuccessful;
    private $getUserError;

    public function __construct($action=null, $id=null)
    {
        parent::__construct(get_class($this));
        // Setting default values
        $this->userID = $id;
        $this->userFName = null;
        $this->userLName = null;
        $this->userDOB = null;
        $this->userEmail = null;
        $this->userPassword = null;

        $this->formSubmitted = false;
        $this->formErrors = false;
        $this->submissionErrors = false;
        $this->submissionSuccessful = false;
        $this->getUserError = false;
        $this->deletionSuccessful = false;

        $this->checkActionsRequired($action);
    }

    // This works exactly the same way as in other models, please see a different admin model for a more in depth explanation of what I am doing
    private function checkActionsRequired($action=null) {
        // Check if the form was submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->formSubmitted = true;
            // first name
            if (!empty($_POST['nu-fname'])) {
                $this->userFName = clean_input($_POST['nu-fname']);
            } else {
                $this->formErrors = true;
            }
            // last name
            if (!empty($_POST['nu-lname'])) {
                $this->userLName = clean_input($_POST['nu-lname']);
            }
            // email
            if (!empty($_POST['nu-userEmail'])) {
                $this->userEmail = clean_input($_POST['nu-userEmail']);
            } else {
                $this->formErrors = true;
            }
            // date of birth
            if (!empty($_POST['nu-dob'])) {
                $this->userDOB = clean_input($_POST['nu-dob']);
            }
            if ($action == "edit") {
                // password
                if (!empty($_POST['nu-password'])) {
                     $this->userPassword = my_password_hash($_POST['nu-password']);
                }
            } else {
                // password
                if (!empty($_POST['nu-password'])) {
                     $this->userPassword = my_password_hash($_POST['nu-password']);
                } else {
                    $this->formErrors = true;
                }
            }
        } else {
            $this->formSubmitted = false;
        }
    }

    // Used by the controller to check if the form was submitted
    public function isFormSubmitted() {
        return $this->formSubmitted;
    }

    // Getting a list of all users to display
    public function getAllUsers() {
        $sql = "SELECT u_id, u_fname, u_lname, u_email FROM users ORDER BY u_fname ASC";

        global $queriesModel;
        $statement = $queriesModel->pdoStatement($sql);

        if ($statement->rowCount() > 0) {
            // sweet success
            $usersData = $statement->fetchAll();
            return $usersData;
        } else {
            // error
            return null;
        }
    }

    // Getting the details of a specific user
    public function getUser($id=null) {
        $sql = "SELECT u_fname, u_lname, u_email, u_dob FROM users WHERE u_id = ?";
        $sqlData = array($id);

        global $queriesModel;
        $statement = $queriesModel->pdoStatement($sql, $sqlData);

        if ($statement->rowCount() == 1) {
            $userData = $statement->fetch();
            return $userData;
        } else {
            $this->getUserError = true;
            return null;
        }
    }

    // Getting errors when adding a new user
    public function getNewUserErrors() {
        if ($this->formErrors) {
            return true;
        }
        if ($this->submissionErrors) {
            return true;
        }
        return false;
    }

    // Getting errors when editing a user
    public function getEditUserErrors() {
        if ($this->getUserError) {
            return true;
        }
        return $this->getNewUserErrors();
    }

    // Getting successes
    public function getSubmissionSuccessful() {
        return $this->submissionSuccessful;
    }

    // Function to add the data from the form to the database
    public function submitForm($update=false) {
        $this->formErrors = false;

        // Different MySQL statements for adding a user and updating a user
        if (!$update) {
            $sql = "INSERT INTO users (u_fname, u_lname, u_dob, u_email, u_password) VALUES (?, ?, ?, ?, ?)";
            $sqlData = array($this->userFName, $this->userLName, $this->userDOB, $this->userEmail, $this->userPassword);
        } else {
            // Different MySQL statements for updating a users password or not
            if (!empty($_POST['nu-password'])) {
                $sql = "UPDATE users SET u_fname = ?, u_lname = ?, u_dob = ?, u_email = ?, u_password = ? WHERE u_id = ?";
                $sqlData = array($this->userFName, $this->userLName, $this->userDOB, $this->userEmail, $this->userPassword, $this->userID);
            } else {
                $sql = "UPDATE users SET u_fname = ?, u_lname = ?, u_dob = ?, u_email = ? WHERE u_id = ?";
                $sqlData = array($this->userFName, $this->userLName, $this->userDOB, $this->userEmail, $this->userID);
            }
        }

        global $queriesModel;
        $statement = $queriesModel->pdoStatement($sql, $sqlData);

        // Checking whether the statement was executed successfully
        if ($statement->errorCode() != "00000") {
            $this->submissionErrors = true;
        } else {
            $this->submissionSuccessful = true;
        }
    }

    // Function to delete a user with a specific ID
    public function deleteUser($id=null) {
        $sql = "DELETE FROM users WHERE u_id = ?";
        $sqlData = array($id);

        global $queriesModel;
        $statement = $queriesModel->pdoStatement($sql, $sqlData);

        if ($statement->errorCode() != "00000") {
            $this->deletionSuccessful = false;
        } else {
            $this->deletionSuccessful = true;
        }
    }

    // Function to check whether a user was deleted successfully
    public function getDeletionSuccess() {
        return $this->deletionSuccessful;
    }
}