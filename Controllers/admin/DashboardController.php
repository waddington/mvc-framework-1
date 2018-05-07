<?php
// This is my controller that handles the dashboard of the admin area
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 28/03/17
 * Time: 19:42
 */
// This is a note-to-self when I was trying to get to grips with MVC
// Controller gets input -->> sends appropriate something to model -->> model collects any further data needed -->> this is sent back to controller -->> controller loads the view with relevant data

$model = new DashboardModel(); // I create the model
$newsData = $model->getNewsData(); // Calling 3 basic functions in the model to return the data for the dashboard
$analyticsData = $model->getAnalyticsData();
$recentPosts = $model->getPostsData();

require_once 'Views/admin/dashboardView.php'; // Loading the dashboard view