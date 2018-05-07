<?php
// Model for everything to do with posts in the admin area
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 28/03/17
 * Time: 23:06
 */
class PostsAdminModel extends AdminModel
{
    // Variables for my posts
    private $postID;
    private $postTitle;
    private $postContent;
    private $postCategory;
    private $postVisibility;

    private $categoryTitle;

    private $formSubmitted;
    private $formErrors;
    private $submissionErrors;
    private $submissionSuccessful;

    private $getPostError;

    private $deletionSuccessful;

    public function __construct($action=null, $id=null)
    {
        parent::__construct(get_class($this));
        $this->postID = $id;
        $this->postTitle = null;
        $this->postContent = null;
        $this->postCategory = null;
        $this->postVisibility = null;

        $this->categoryTitle = null;

        $this->formSubmitted = false;
        $this->formErrors = false;
        $this->submissionErrors = false;
        $this->submissionSuccessful = false;
        $this->deletionSuccessful = false;

        $this->getPostError = false;

        $this->checkActionsRequired($action);
    }

    // This function works exactly the same way as in other models which have more in-depth comments
    private function checkActionsRequired($action=null) {
        // Check if the form was submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->formSubmitted = true;
            if ($action == "categories") { // Checking if the user is looking at the categories page
                if (!empty($_POST['nc-title'])) {
                    $this->categoryTitle = clean_input($_POST['nc-title']);
                } else {
                    $this->formErrors = true;
                }
            } else { // If the user is not looking at the category page
                // Getting form field values
                // title
                if (!empty($_POST['np-title'])) {
                    $this->postTitle = clean_input($_POST['np-title']);
                } else {
                    $this->formErrors = true;
                }
                // content
                if (!empty($_POST['np-content'])) {
                    $this->postContent = $_POST['np-content'];
                }
                // category
                if (!empty($_POST['np-category'])) {
                    $this->postCategory = clean_input($_POST['np-category']);
                } else {
                    $this->formErrors = true;
                }
                // visibility
                if (!empty($_POST['np-visibility'])) {
                    $this->postVisibility = clean_input($_POST['np-visibility']);
                } else {
                    $this->formErrors = true;
                }
            }
        } else {
            $this->formSubmitted = false;
        }
    }

    // Submitting the form data
    public function submitForm($update=false) {
        $this->formErrors = false;

        if (!$update) { // If the user wants to update a post then we have a different MySQL statement
            $sql = "INSERT INTO posts (u_id, p_title, p_content, p_category, p_visibility) VALUES (?, ?, ?, ?, ?)";
            $sqlData = array($_SESSION['UserID'], $this->postTitle, $this->postContent, $this->postCategory, $this->postVisibility);
        } else {
            $sql = "UPDATE posts SET p_title = ?, p_content = ?, p_category = ?, p_visibility = ? WHERE p_id = ?";
            $sqlData = array($this->postTitle, $this->postContent, $this->postCategory, $this->postVisibility, $this->postID);
        }

        global $queriesModel;
        $statement = $queriesModel->pdoStatement($sql, $sqlData);

        if ($statement->errorCode() != "00000") { // Checking if the statement was successful
            $this->submissionErrors = true;
        } else {
            $this->submissionSuccessful = true;
        }
    }

    // Checking if the form was submitted
    public function isFormSubmitted() {
        return $this->formSubmitted;
    }

    // Getting any errors
    public function getNewPostErrors() {
        if ($this->formErrors) {
            return true;
        }
        if ($this->submissionErrors) {
            return true;
        }
        return false;
    }

    // Getting more errors
    public function getEditPostErrors() {
        if ($this->getPostError) {
            return true;
        }
        return $this->getNewPostErrors();
    }

    // Getting successes
    public function getSubmissionSuccessful() {
        return $this->submissionSuccessful;
    }

    // A function to get all of the posts from the database
    // I could implement pagination by using the LIMIT keyword in MySQL
    public function getAllPosts() {
        $sql = "SELECT * FROM posts JOIN users ON posts.u_id = users.u_id ORDER BY p_title ASC";

        global $queriesModel;
        $statement = $queriesModel->pdoStatement($sql);

        $postsData = $statement->fetchAll();
        return $postsData;
    }

    // Function to get all post categories from the database
    // All categories for all object types (posts/media) are stored in the same table
    public function getAllCategories() {
        $sql = "SELECT * FROM categories WHERE c_type = 'post'";

        global $queriesModel;
        $statement = $queriesModel->pdoStatement($sql);

        $categoriesData = $statement->fetchAll();
        return $categoriesData;
    }

    // Function to get a specific post
    public function getPost($id=null) {
        $sql = "SELECT *, c_id FROM posts LEFT JOIN categories ON posts.p_category = categories.c_id WHERE p_id = ?";
        $sqlData = array($id);

        global $queriesModel;
        $statement = $queriesModel->pdoStatement($sql, $sqlData);

        if ($statement->rowCount() == 1) {
            $postData = $statement->fetch();
            return $postData;
        } else {
            $this->getPostError = true;
            return null;
        }
    }

    // Function to get the most recent posts in descending order
    public function getRecentPosts($number=5) {
        $sql = "SELECT * FROM posts ORDER BY p_created DESC LIMIT ".$number;
        $sqlData = array();

        global $queriesModel;
        $statement = $queriesModel->pdoStatement($sql, $sqlData);

        $recentPosts = $statement->fetchAll();
        return $recentPosts;
    }

    // Function to run a MySQL statement to add a new category
    public function addNewCategory() {
        $sql = "INSERT INTO categories (c_name, c_type) VALUES (?, ?)";
        $sqlData = array($this->categoryTitle, "post");

        global $queriesModel;
        $statement = $queriesModel->pdoStatement($sql, $sqlData);

        if ($statement->errorCode() != "00000") {
            $this->submissionErrors = true;
        } else {
            $this->submissionSuccessful = true;
        }
    }

    // Function to delete a post with a specified ID
    public function deletePost($id=null) {
        $sql = "DELETE FROM posts WHERE p_id = ?";
        $sqlData = array($id);

        global $queriesModel;
        $statement = $queriesModel->pdoStatement($sql, $sqlData);

        if ($statement->errorCode() != "00000") {
            $this->deletionSuccessful = false;
        } else {
            $this->deletionSuccessful = true;
        }
    }

    // Function to check whether a post was successfully deleted
    public function getDeletionSuccess() {
        return $this->deletionSuccessful;
    }
}