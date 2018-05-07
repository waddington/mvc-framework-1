<?php
// This displays the login form
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 01/04/17
 * Time: 18:06
 */
?>

<h1 class="text-center">Log In</h1>

<div class="col-md-4 col-md-offset-4">
    <p class="text-center text-info text">admin@domain.com / Password123</p>
    <!-- If there are any errors then show a warning -->
    <?php if ($errors) { ?>
        <div class="alert alert-danger" role="alert"><strong>Error! </strong>Your email/password is incorrect.</div>
    <?php } ?>
    <form action="admin.php" method="post">
        <div class="form-group">
            <label for="l-userEmail">Email</label>
            <input class="form-control" type="email" name="l-userEmail" id="l-userEmail" placeholder="Email" required>
        </div>
        <div class="form-group">
            <label for="l-userPassword">Password</label>
            <input class="form-control" type="password" name="l-userPassword" id="l-userPassword" placeholder="Password" required>
        </div>
        <button class="btn btn-default center-block" type="submit">Login</button>
    </form>
</div>
