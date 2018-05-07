<?php
// Controller for the page displaying data scraped from another website
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 25/04/17
 * Time: 13:27
 */

// Creating the model
$model = new ScrapeModel();

// Function call to get the data
$scrapeData = $model->getScrapeDataTitles();

// Loading the view
require_once 'Views/ScrapeView.php';