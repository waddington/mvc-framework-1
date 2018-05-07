<?php
// My controller for displaying a single post
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 07/04/17
 * Time: 14:19
 */

// Creating the model and getting the post with the ID from the URL
$model = new PostsModel();
$postData = $model->getPost($id);

// Loading the view
require_once 'Views/SinglepostView.php';