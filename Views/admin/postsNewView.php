<?php
// This is my view for adding a new post
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 02/04/17
 * Time: 10:30
 */
?>
<h1>Add New Post</h1>
<?php if ($errors) { ?>
<!--    Show an error message if required -->
    <div class="alert alert-danger" role="alert"><strong>Error! </strong>Invalid data entered.</div>
<?php } ?>
<?php if (!$errors && $success) { ?>
<!--    Show a success message if required -->
    <div class="alert alert-success" role="alert"><strong>Success! </strong>Post added successfully.</div>
<?php } ?>
<!-- The form for adding the post -->
<form action="admin.php?page=posts&modifier=new" method="post" class="form-horizontal">
    <div class="form-group">
        <label for="np-title" class="col-sm-2 control-label">Title</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="np-title" id="np-title" placeholder="Title">
        </div>
    </div>
    <div class="form-group">
        <label for="np-content" class="col-sm-2 control-label">Content</label>
        <div class="col-sm-10">
            <textarea name="np-content" id="np-content" placeholder="Content" rows="20" class="form-control" style="resize: vertical;"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="np-category" class="col-sm-2 control-label">Category</label>
        <div class="col-sm-10">
            <select name="np-category" id="np-category" class="form-control">
                <?php
                // Displaying all the categories in a drop down
                foreach ($allCategories as $category) {
                    $option = "<option value='".$category['c_id']."' >";
                    $option .= $category['c_name'];
                    $option .= "</option>";
                    echo $option;
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-2 control-label">Visibility</label>
        <div class="col-sm-10">
            <div class="radio">
                <label><input type="radio" name="np-visibility" value="0">Hidden</label>
            </div>
            <div class="radio">
                <label><input type="radio" name="np-visibility" value="1" checked>Visible</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Add Post</button>
        </div>
    </div>
</form>
