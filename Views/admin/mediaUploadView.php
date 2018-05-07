<?php
// This is my view to upload a new media file
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 02/04/17
 * Time: 17:51
 */
?>
<h1>Upload Media</h1>
<!-- Show an error message if there are any errors -->
<?php if ($errors) { ?>
    <div class="alert alert-danger" role="alert"><strong>Error! </strong>Error uploading file.</div>
<?php } ?>
<!-- Show a success message if required -->
<?php if (!$errors && $success) { ?>
    <div class="alert alert-success" role="alert"><strong>Success! </strong>Media uploaded successfully.</div>
<?php } ?>
<!-- A simple form to upload an image and set a title/name for the image -->
<form action="admin.php?page=media&modifier=upload" method="post" class="form-horizontal" enctype="multipart/form-data">
    <div class="form-group">
        <label for="nm-title" class="col-sm-2 control-label">Title</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="nm-title" id="nm-title" placeholder="Title">
        </div>
    </div>
    <div class="form-group">
        <label for="nm-category" class="col-sm-2 control-label">Category</label>
        <div class="col-sm-10">
            <select name="nm-category" id="nm-category" class="form-control">
                <?php
                // Ability to choose the category the image goes in
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
        <label for="nm-name" class="col-sm-2 control-label">File Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="nm-name" id="nm-name" placeholder="File Name">
        </div>
    </div>
    <div class="form-group">
        <label for="nm-file" class="col-sm-2 control-label">File</label>
        <div class="col-sm-10">
            <input type="file" name="nm-file" id="nm-file">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <!-- My submit button -->
            <button type="submit" class="btn btn-default">Upload Media</button>
        </div>
    </div>
</form>
