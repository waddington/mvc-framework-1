<?php
// My view for seeing the recent posts on the dashboard
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 01/04/17
 * Time: 23:40
 */
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Recent Posts</h3>
    </div>
    <div class="panel-body">
        <?php
        // Looping through all the posts and displaying them
        $counter = 0;
        foreach ($recentPosts as $post) {
            $counter++;
            $content = "<p><strong>$counter. </strong>$post[p_title]</p>";
            echo $content;
        }
        ?>
    </div>
</div>
