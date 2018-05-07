<?php
// My model to perform a search
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 07/04/17
 * Time: 16:18
 */
class SearchModel
{
    private $formSubmitted;
    private $searchParam;

    public function __construct()
    {
        // Setting default values
        $this->formSubmitted = false;
        $this->searchParam = null;

        // Determining if the form was submitted and if it was getting the search query
        $this->checkActionsRequired();
    }

    private function checkActionsRequired() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { // If the form was submitted
            $this->formSubmitted = true;
            if (!empty($_POST['site-search'])) {
                $this->searchParam = clean_input($_POST['site-search']); // Store the searched value
            }
        } else {
            $this->formSubmitted = false;
        }
    }

    // Returning whether the form was submitted
    public function isFormSubmitted() {
        return $this->formSubmitted;
    }

    // Function to do the search
    public function search() {
        // Splitting the search query on white space characters
        $searchItems = explode(' ', $this->searchParam);

        // Creating the beginning of the SQL statement
        $sql = "SELECT * FROM posts WHERE ";

        // Looping through all search query items and adding them to the SQL query
        $counter = 0;
        foreach ($searchItems as $item) {
            // I search both titles and content of posts
            if ($counter == 0) { // If this is the first query then the statement is slightly different
                $sql .= "p_title LIKE '%".$item."%' OR p_content LIKE '%".$item."%' ";
            } else {
                $sql .= " OR p_title LIKE '%".$item."%' OR p_content LIKE '%".$item."%' ";
            }
            $counter++;
        }

        // Executing the search query
        global $queriesModel;
        $statement = $queriesModel->pdoStatement($sql);

        // Getting and returning the data from the database
        $searchData = $statement->fetchAll();
        return $searchData;
    }

    // Getting the query that the user searched for
    public function getSearchParam() {
        return $this->searchParam;
    }
}