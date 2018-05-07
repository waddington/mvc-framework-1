<?php
// The view for editing a post
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 02/04/17
 * Time: 11:16
 */
?>
<h1>Edit Post</h1>
<?php if ($errors) { ?>
<!--    Show an error message if required -->
    <div class="alert alert-danger" role="alert"><strong>Error! </strong>Invalid data entered.</div>
<?php } ?>
<?php if (!$errors && $success) { ?>
<!--    Show a success message if required -->
    <div class="alert alert-success" role="alert"><strong>Success! </strong>Post updated successfully.</div>
<?php } ?>
<!-- The form for editing the post -->
<form action="admin.php?page=posts&modifier=edit&id=<?php echo $id; ?>" method="post" class="form-horizontal">
    <div class="form-group">
        <label for="np-title" class="col-sm-2 control-label">Title</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="np-title" id="np-title" placeholder="Title" value="<?php echo $postData['p_title']; ?>">
        </div>
    </div>
<!--    I did want to have the ability to upload media on the posts page and to be able to dynamically insert images from the media library but it was overly complicated -->
<!--    <div class="form-group">-->
<!--        <div class="col-sm-10 col-sm-offset-2">-->
<!--            <div class="btn-toolbar" role="toolbar">-->
<!--                <div class="btn-group" role="group">-->
<!--                    <button type="button" class="btn btn-default">Insert Media</button>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
    <div class="form-group">
        <label for="np-content" class="col-sm-2 control-label">Content</label>
        <div class="col-sm-10">
            <textarea name="np-content" id="np-content" placeholder="Content" rows="20" class="form-control" style="resize: vertical;"><?php echo $postData['p_content']; ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="np-category" class="col-sm-2 control-label">Category</label>
        <div class="col-sm-10">
            <select name="np-category" id="np-category" class="form-control">
                <?php
                // Displaying all the caregories for the post and whichever category the post is in the default selected one
                foreach ($allCategories as $category) {
                    $option = "<option value='".$category['c_id']."' ".($category['c_id'] == $postData['p_category'] ? 'selected' : '')." >";
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
                <label><input type="radio" name="np-visibility" value="0" <?php echo ($postData['p_visibility'] == 0 ? "checked" : ""); ?>>Hidden</label>
            </div>
            <div class="radio">
                <label><input type="radio" name="np-visibility" value="1" <?php echo ($postData['p_visibility'] == 1 ? "checked" : ""); ?>>Visible</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Update Post</button>
        </div>
    </div>
</form>