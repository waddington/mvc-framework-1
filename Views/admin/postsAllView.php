<?php
// My view to see all posts
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 02/04/17
 * Time: 09:57
 */
?>
<h1>All Posts</h1>
<?php if (isset($deleted)) { ?>
    <!-- Show an error message if required -->
    <?php if (!$deleted) { ?>
        <div class="alert alert-danger" role="alert"><strong>Error! </strong>Post not deleted.</div>
    <?php } else { ?>
        <!-- Show a success message if required -->
        <div class="alert alert-success" role="alert"><strong>Success! </strong>Post deleted.</div>
    <?php } ?>
<?php } ?>
<!-- My table containing the posts -->
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th><strong>ID</strong></th>
                <th><strong>Title</strong></th>
                <th><strong>Excerpt</strong></th>
                <th><strong>Category</strong></th>
                <th><strong>Author</strong></th>
                <th><strong>Edit</strong></th>
                <th><strong>Delete</strong></th>
            </tr>
        </thead>
        <?php
        // Looping through the data for each post and putting the data into table cells
        foreach ($allPosts as $post) {
            $content = "<tr><td>".$post['p_id'];
            $content .= "</td><td>".$post['p_title'];
            $content .= "</td><td>".postAdminPreview($post['p_content']);
            $content .= "...</td><td>".(!empty($post['p_category']) ? $post['p_category'] : "---");
            $content .= "</td><td>".$post['u_email'];
            // Edit and delete buttons
            $content .= "</td><td><a class='btn btn-default btn-sm' href='admin.php?page=posts&modifier=edit&id=".$post['p_id']."'>Edit</a>";
            $content .= "</td><td><a class='btn btn-danger btn-sm' href='admin.php?page=posts&modifier=delete&id=".$post['p_id']."'>Delete</a>";
            $content .= "</td></tr>";
            echo $content;
        }
        ?>
    </table>
</div>
