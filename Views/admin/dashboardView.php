<?php
// My view for the admin dashboard, it is very simple and just loads other views
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 28/03/17
 * Time: 20:47
 */
?>
<h1><?php echo $title; ?></h1>
<div class="row">
    <div class="col-md-4">
        <?php require_once 'websiteNewsView.php'; ?>
    </div>
    <div class="col-md-4">
        <?php require_once 'postsRecentView.php'; ?>
    </div>
    <div class="col-md-4">
        <?php require_once 'websiteAnalyticsView.php'; ?>
    </div>
</div>
