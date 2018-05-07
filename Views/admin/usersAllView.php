<?php
// My view for seeing all users
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 01/04/17
 * Time: 20:10
 */
?>
<h1>All Users</h1>
<?php if (isset($deleted)) { ?>
<?php if (!$deleted) { ?>
<!--        Show an error message fi required -->
    <div class="alert alert-danger" role="alert"><strong>Error! </strong>User not deleted.</div>
<?php } else { ?>
<!--        Show a success message if required -->
    <div class="alert alert-success" role="alert"><strong>Success! </strong>User deleted.</div>
<?php } ?>
<?php } ?>
<!-- The table to list all the users -->
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th><strong>ID</strong></th>
                <th><strong>Name</strong></th>
                <th><strong>Email</strong></th>
                <th><strong>Edit</strong></th>
            </tr>
        </thead>
        <?php
        foreach ($allUsers as $user) {
            // Looping through the data for each user and outputting it into table cells
            $rowContent = "<tr><td>".$user['u_id'];
            $rowContent .= "</td><td>".$user['u_fname']." ".$user['u_lname'];
            $rowContent .= "</td><td>".$user['u_email'];
            $rowContent .= "</td><td><a class='btn btn-default btn-sm' href='admin.php?page=users&modifier=edit&id=".$user['u_id']."'>Edit</a>";
            // I want the ability to delete a user apart from the user with an ID of 1 so that not all users can be deleted
            // To improve this I would check the user ID when the delete is requested otherwise somebody could change the code of one of the buttons
            if ($user['u_id'] !== "1") {
                $rowContent .= " <a class='btn btn-danger btn-xs' href='admin.php?page=users&modifier=delete&id=".$user['u_id']."'>Delete</a>";
            }
            $rowContent .= "</td></tr>";
            echo $rowContent;
        }
        ?>
    </table>
</div>
