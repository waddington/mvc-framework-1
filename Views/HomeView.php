<?php
// My homepage view
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 07/04/17
 * Time: 13:55
 */
?>
<!-- Just a nice big thing on the front page -->
<div class="jumbotron">
    <h1><?php echo $title; ?></h1>
</div>
<div class="row">
<!--    Here i display the 3 most recent posts -->
    <h3>Recent Posts</h3>
    <?php
    // Looping through the provided posts and adding their data to specific html elements
    foreach ($recentPosts as $post) {
        $content = "<div class='col-md-4'><div class='panel panel-default'>";
        $content .= "<div class='panel-heading'><div class='panel-title'>".$post['p_title']."</div></div>";
        // The below line uses a function that shortens the length of the provided input but doesn't chop words in half
        $content .= "<div class='panel-body'><p>".postAdminPreview($post['p_content'], 250)."...</p>";
        $content .= "<p><span class='label label-default'>".$post['u_fname']." ".$post['u_lname']."</span></p>";
        $content .= "<a class='btn btn-default' href='index.php?page=singlepost&id=".$post['p_id']."'>Read more</a>";
        $content .= "</div></div></div>";
        echo $content;
    }
    ?>
</div>
