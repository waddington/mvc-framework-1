<?php
// This is my model that handles actions related to user login
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 01/04/17
 * Time: 18:05
 */
class LoginModel extends AdminModel
{
    // Variables to store entered information
    private $userEmail;
    private $userPassword;

    // Variables to keep track of errors
    private $formSubmitted;
    private $formErrors;
    private $submissionErrors;

    public function __construct()
    {
        // Calling the parent constructor to store the type of model this is
        parent::__construct(get_class($this));
        // Setting initial values of all variables
        $this->userEmail = null;
        $this->userPassword = null;
        $this->formSubmitted = null;
        $this->formErrors = false;
        $this->submissionErrors = false;

        // Calling a function to determine:
        // a) whether the page was loaded through a form submission
        // b) Get any data from the form submission
        // c) validate the data
        $this->checkActionsRequired();
    }

    private function checkActionsRequired() {
        // Check if the form was submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Determining if the page was loaded through a form submission
            $this->formSubmitted = true;
            if (!empty($_POST['l-userEmail'])) {
                $this->userEmail = clean_input($_POST['l-userEmail']); // Getting and sanitizing the form data
            } else {
                $this->formErrors = true; // If the form fields are empty then I count this as an error
            }
            if (!empty($_POST['l-userPassword'])) {
                $this->userPassword = $_POST['l-userPassword']; // Getting and sanitizing the form data
            } else {
                $this->formErrors = true;
            }
        } else {
            $this->formSubmitted = false;
        }
    }

    public function isFormSubmitted() {
        return $this->formSubmitted; // Returning whether the form was submitted
    }

    public function getErrors() { // Getting any errors
        if ($this->formErrors) {
            return true;
        }
        if ($this->submissionErrors) {
            return true;
        }
        return false;
    }

    // Function to submit the form data
    public function submitLoginForm() {
        $this->formErrors = false; // Resetting any errors to false

        // Creating my MySQL statement and data to go into it
        $sql = 'SELECT * FROM users WHERE u_email = ?';
        $sqlData = array($this->userEmail);

        // Executing the statement using a function in my database class
        global $queriesModel;
        $statement = $queriesModel->pdoStatement($sql, $sqlData);

        // As usernames/emails should be unique, I check that there is only 1 returned row from the database
        if ($statement->rowCount() == 1) {
            $emailData = $statement->fetch(); // I get all of the data from the returned row
            // Then I check passwords match
            if (my_password_verify($this->userPassword, $emailData['u_password'])) { // I have a function to check passwords
                // Everything matches can log in
                // I set the session variables to show that they are logged in
                $_SESSION['UserEmail'] = $this->userEmail;
                $_SESSION['LoggedIn'] = true;
                $_SESSION['UserID'] = $emailData['u_id'];
                // I then refresh the page so that they are redirected to the admin dashboard
                header("Refresh: 0");
            } else {
                $this->submissionErrors = true; // If the passwords don't match then there is an error
            }
        } else { // If there is more than 1 returned row then I say there is an error
            $this->submissionErrors = true;
        }
    }

    // Function to logout
    public function logOut() {
        $_SESSION = array(); // Setting the session to an empty array
        session_destroy(); // Then destroying it
    }
}