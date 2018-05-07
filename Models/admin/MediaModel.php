<?php
// Model relating to everything to do with media in the admin area
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 02/04/17
 * Time: 17:45
 */
class MediaModel extends AdminModel
{
    private $mediaNewName;
    private $mediaCategory;
    private $categoryTitle;

    // Variables storing information about a new uploaded file
    private $mediaTitle;
    private $mediaName;
    private $mediaSize;
    private $mediaTempName;
    private $mediaType;
    private $mediaExtension;
    private $mediaErrors;
    private $mediaUploadsPath;

    // Variables storing information about errors relating to the form submission
    private $formSubmitted;
    private $formErrors;
    private $submissionErrors;
    private $submissionSuccessful;

    public function __construct($action=null)
    {
        // Calling parent constructor same as my other admin models
        parent::__construct(get_class($this));
        // Setting default values
        $this->mediaTitle = null;
        $this->mediaName = null;
        $this->mediaSize = null;
        $this->mediaTempName = null;
        $this->mediaType = null;
        $this->mediaExtension = null;
        $this->mediaErrors = array();
        // Setting the path to where uploaded files will be stored
        $this->mediaUploadsPath = "media/uploads/";

        // Default error values
        $this->formSubmitted = false;
        $this->formErrors = false;
        $this->submissionErrors = false;
        $this->submissionSuccessful = false;

        // Calling a function to check what needs to be done
        $this->checkActionsRequired($action);
    }

    private function checkActionsRequired($action=null) {
        // Check if the form was submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->formSubmitted = true;
            if ($action == "categories") { // If the form was submitted AND they are on the categories page
                if (!empty($_POST['nc-title'])) {
                    $this->categoryTitle = clean_input($_POST['nc-title']); // If the form was submitted then get all the form fields and sanitize them
                } else {
                    $this->formErrors = true;
                }
            } else { // If they are not on the categories page and a form was submitted then they are uploading new media
                // Getting form field values
                // title
                if (!empty($_POST['nm-title'])) {
                    $this->mediaTitle = $_POST['nm-title'];
                } else {
                    $this->formErrors = true;
                }
                // file name
                if (!empty($_POST['nm-name'])) {
                    $this->mediaNewName = clean_input($_POST['nm-name']);
                } else {
                    $this->formErrors = true;
                }
                // category
                if (!empty($_POST['nm-category'])) {
                    $this->mediaCategory = clean_input($_POST['nm-category']);
                } else {
                    $this->formErrors = true;
                }
                // media
                // Handling the file upload field
                if (isset($_FILES['nm-file'])) {
                    // Getting various information about the uploaded fle
                    $this->mediaName = $_FILES['nm-file']['name'];
                    $this->mediaSize = $_FILES['nm-file']['size'];
                    $this->mediaTempName = $_FILES['nm-file']['tmp_name'];
                    $this->mediaType = $_FILES['nm-file']['type'];
                    $this->mediaExtension = explode('.', $_FILES['nm-file']['name']);
                    $this->mediaExtension = strtolower(end($this->mediaExtension));

                    // Checking if the file is within a certain file size
                    if ($this->mediaSize > 20097152) {
                        $this->mediaErrors[] = "File size too large (max 2MB).";
                        $this->formErrors = true;
                    }

                    // Checking that the file does actually exist
                    if ($this->mediaSize <= 0) {
                        $this->formErrors = true;
                    }

                    // If there are errors with the file then I set form-errors to true
                    if (!empty($this->mediaErrors)) {
                        $this->formErrors = true;
                    }
                } else {
                    $this->formErrors = true;
                }
            }
        } else {
            $this->formSubmitted = false;
        }
    }

    // Check if the page was loaded through a form submission
    public function isFormSubmitted() {
        return $this->formSubmitted;
    }

    // Get errors for uploading a media file
    public function getNewMediaErrors() {
        if ($this->formErrors) {
            return true;
        }
        if ($this->submissionErrors) {
            return true;
        }
        return false;
    }

    // Check whether the form was submitted successfully
    public function getSubmissionSuccessful() {
        return $this->submissionSuccessful;
    }

    // Get a list of all the media categories
    public function getAllCategories() {
        $sql = "SELECT * FROM categories WHERE c_type = ?";
        $sqlData = array("media");

        global $queriesModel;
        $statement = $queriesModel->pdoStatement($sql, $sqlData);

        $categoriesData = $statement->fetchAll();
        return $categoriesData;
    }

    // Uploading the file (moving it to the correct location)
    public function uploadMedia() {
        $this->formErrors = false;

        $counter = ""; // I have a counter so that I can incremental numbers at the end of a filename if the file already exists

        // Check if file exists and if it does change the name
        if (file_exists($this->mediaUploadsPath.$this->mediaNewName.".".$this->mediaExtension)) {
            $counter = "000";
            while (file_exists($this->mediaUploadsPath.$this->mediaNewName.$counter.".".$this->mediaExtension)) {
                $counter++; // Incrementing a number to add to the end of the filename if a file with the same name already exists
            }
        }

        $this->mediaNewName .= $counter; // Adding the number to the end of the filename

        // Creating the MySQL statement and data to create a record of the file in the database
        $sql = "INSERT INTO media (u_id, m_title, m_filelocation, m_filename, m_type, m_size, m_category) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $sqlData = array($_SESSION['UserID'], $this->mediaTitle, $this->mediaUploadsPath, $this->mediaNewName.".".$this->mediaExtension, $this->mediaType, $this->mediaSize, $this->mediaCategory);

        global $queriesModel;
        $statement = $queriesModel->pdoStatement($sql, $sqlData); // Executing the query

        if ($statement->errorCode() != "00000") { // If the sql query did not execute successfully
            $this->submissionErrors = true; // Therer is an error
        } else {
            if (move_uploaded_file($this->mediaTempName, $this->mediaUploadsPath.$this->mediaNewName.".".$this->mediaExtension)) {// Move the file to the correct location
                $this->submissionErrors = false; // Set the errors and successes
                $this->submissionSuccessful = true;
            } else {
                $this->submissionErrors = true;
                $this->submissionSuccessful = false;
            }
        }
    }

    // Function to create a new media category
    public function addNewCategory() {
        $sql = "INSERT INTO categories (c_name, c_type) VALUES (?, ?)";
        $sqlData = array($this->categoryTitle, "media");

        global $queriesModel;
        $statement = $queriesModel->pdoStatement($sql, $sqlData);

        if ($statement->errorCode() != "00000") {
            $this->submissionErrors = true;
        } else {
            $this->submissionSuccessful = true;
        }
    }

    // Function to get a list of all uploaded media items
    // These are stored in the database in case someone manages to create a file, they also need access to the database
    public function getAllMediaItems() {
        $sql = "SELECT * FROM media JOIN categories ON media.m_category = categories.c_id";
        $sqlData = array();

        global $queriesModel;
        $statement = $queriesModel->pdoStatement($sql, $sqlData);

        $mediaData = $statement->fetchAll();
        return $mediaData;
    }
}