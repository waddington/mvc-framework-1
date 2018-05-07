<?php
// View to edit a user
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 01/04/17
 * Time: 22:58
 */
?>
<h1>Edit User</h1>
<?php if ($errors) { ?>
<!--    Error message if required -->
    <div class="alert alert-danger" role="alert"><strong>Error! </strong>Invalid data entered.</div>
<?php } ?>
<?php if (!$errors && $success) { ?>
<!--    Success messgae if required -->
    <div class="alert alert-success" role="alert"><strong>Success! </strong>User Updated successfully.</div>
<?php } ?>
<!-- The form for editing a user-->
<!-- All of the fields, apart from the password, have their values set -->
<form class="form-horizontal" action="admin.php?page=users&modifier=edit&id=<?php echo $id; ?>" method="post">
    <div class="form-group">
        <label class="col-sm-2 control-label" for="nu-fname">First Name</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="nu-fname" id="nu-fname" placeholder="First Name" value="<?php echo $userData['u_fname']; ?>" required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="nu-lname">Last Name</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" name="nu-lname" id="nu-lname" placeholder="Last Name" value="<?php echo $userData['u_lname']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="nu-userEmail">Email</label>
        <div class="col-sm-10">
            <input class="form-control" type="email" name="nu-userEmail" id="nu-userEmail" placeholder="Email" value="<?php echo $userData['u_email']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="nu-dob">Date of Birth</label>
        <div class="col-sm-10">
            <input class="form-control" type="date" name="nu-dob" id="nu-dob" placeholder="Date of Birth" value="<?php echo $userData['u_dob']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="nu-password">Password</label>
        <div class="col-sm-10">
            <input class="form-control" type="password" name="nu-password" id="nu-password" placeholder="New Password" >
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default" id="user-edit">Update User</button>
        </div>
    </div>
</form>
