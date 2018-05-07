<?php
// View for adding a new user
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 01/04/17
 * Time: 20:57
 */
?>
<h1>Add New User</h1>
<?php if ($errors) { ?>
<!--    Error message if required -->
    <div class="alert alert-danger" role="alert"><strong>Error! </strong>Invalid data entered.</div>
<?php } ?>
<?php if (!$errors && $success) { ?>
<!--        Success message if required -->
    <div class="alert alert-success" role="alert"><strong>Success! </strong>User added successfully.</div>
<?php } ?>
<!-- The form for adding a new user -->
<form class="form-horizontal" action="admin.php?page=users&modifier=new" method="post">
    <div class="form-group">
        <label class="col-sm-2 control-label" for="nu-fname">First Name</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="nu-fname" id="nu-fname" placeholder="First Name" required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="nu-lname">Last Name</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="nu-lname" id="nu-lname" placeholder="Last Name">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="nu-userEmail">Email</label>
        <div class="col-sm-10">
            <input class="form-control" type="email" name="nu-userEmail" id="nu-userEmail" placeholder="Email">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="nu-dob">Date of Birth</label>
        <div class="col-sm-10">
            <input class="form-control" type="date" name="nu-dob" id="nu-dob" placeholder="Date of Birth">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="nu-lname">Password</label>
        <div class="col-sm-10">
            <input class="form-control" type="password" name="nu-password" id="nu-password" placeholder="Password">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Add User</button>
        </div>
    </div>
</form>