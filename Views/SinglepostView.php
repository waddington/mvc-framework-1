<?php
// View to display a single post
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 07/04/17
 * Time: 14:21
 */
?>
<div class="row">
<!--    Displaying the post title -->
    <h1><?php echo $postData['p_title']; ?></h1>
</div>
<div class="row">
    <div class="post-content">
<!--        Displaying the post content -->
        <?php echo $postData['p_content']; ?>
    </div>
    <hr>
    <div class="post-meta">
<!--        Showing some extra information about the post -->
        <p>Category: <span class="label label-default"><?php echo $postData['c_name']; ?></span></p>
        <p>Author: <span class="label label-default"><?php echo $postData['u_fname']." ".$postData['u_lname']; ?></span></p>
    </div>
</div>
