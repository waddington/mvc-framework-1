<?php
// Controller for the search functionality
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 07/04/17
 * Time: 16:17
 */

$model = new SearchModel(); // Creating the model

// If the form was submitted, which it should always be to get to this controller, then store the search parameter and do the search
if ($model->isFormSubmitted()) {
    $searchParam = $model->getSearchParam();
    $searchData = $model->search();
}

// Load the view
require_once 'Views/searchResultsView.php';