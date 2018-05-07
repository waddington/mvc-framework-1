<?php
// Controller for the homepage
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 28/03/17
 * Time: 16:44
 */

// Creating the model
$model = new HomeModel();
// Getting the data for the homepage which is currently just the 3 most recent posts
$recentPosts = $model->getRecentPosts(3);

// Loading the view
require_once 'Views/HomeView.php';