<?php
// This is my view for display categories in the admin area and also for adding new categories
// This view is used by multiple models for both posts and media categories
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 02/04/17
 * Time: 17:13
 */
?>
<h1>Categories</h1>
<!-- I'm using bootstrap for a quick and easy layout -->
<div class="row">
    <div class="col-md-5">
        <h3>Add New Category</h3>
        <!-- Display an error message if there are any -->
        <?php if ($errors) { ?>
            <div class="alert alert-danger" role="alert"><strong>Error! </strong>Invalid data entered. Does category already exist?</div>
        <?php } ?>
        <!-- Display a success message if there are any -->
        <?php if (!$errors && $success) { ?>
            <div class="alert alert-success" role="alert"><strong>Success! </strong>Category added successfully.</div>
        <?php } ?>
        <!-- My form for adding new categories -->
        <form action="admin.php?page=<?php echo strtolower($page); ?>&modifier=categories" method="post" class="form-horizontal">
            <div class="form-group">
                <label for="nc-title" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nc-title" id="nc-title" placeholder="Category Name">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Add Category</button>
                </div>
            </div>
        </form>
    </div>
    <!-- My table showing a list of all categories -->
    <div class="col-md-7">
        <h3>All Categories</h3>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <th><strong>ID</strong></th>
                    <th><strong>Name</strong></th>
                </thead>
                <?php
                // Looping through the data that the controller got from the model and adding it to table cells
                foreach ($categoriesData as $categoriesDatum) {
                    $content = "<tr><td>".$categoriesDatum['c_id'];
                    $content .= "</td><td>".$categoriesDatum['c_name'];
                    $content .= "</td></tr>";
                    echo $content;
                }
                ?>
            </table>
        </div>
    </div>
</div>
