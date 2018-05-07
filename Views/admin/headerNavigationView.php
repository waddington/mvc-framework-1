<?php
// This is my admin navigation
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 28/03/17
 * Time: 20:17
 */
?>
<!--    This is taken from the bootstrap getting started pages  -->
<!--    http://getbootstrap.com/components/#navbar-default  -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="<?php echo BD; ?>/admin.php">Dashboard <span class="sr-only">(current)</span></a></li>
                <li class="dropdown">
                    <a href="<?php echo BD; ?>/admin.php?page=posts&modifier=all" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Posts <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo BD; ?>/admin.php?page=posts&modifier=all">View All</a></li>
                        <li><a href="<?php echo BD; ?>/admin.php?page=posts&modifier=new">Add New</a></li>
                        <li><a href="<?php echo BD; ?>/admin.php?page=posts&modifier=categories">Categories</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="<?php echo BD; ?>/admin.php?page=media" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Media <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo BD; ?>/admin.php?page=media&modifier=all">Library</a></li>
                        <li><a href="<?php echo BD; ?>/admin.php?page=media&modifier=upload">Add New</a></li>
                        <li><a href="<?php echo BD; ?>/admin.php?page=media&modifier=categories">Categories</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="<?php echo BD; ?>/admin.php?page=users&modifier=all" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Users <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo BD; ?>/admin.php?page=users&modifier=all">All Users</a></li>
                        <li><a href="<?php echo BD; ?>/admin.php?page=users&modifier=new">Add New</a></li>
                        <li><a href="<?php echo BD; ?>/admin.php?page=users&modifier=edit&id=<?php echo $_SESSION['UserID']; ?>">Your Profile</a></li>
                    </ul>
                </li>
            </ul>
            <!--    Right side admin only   -->
            <ul class="nav navbar-nav navbar-right only-admin-logged-in">
                <li class="dropdown">
                    <a href="<?php echo BD; ?>/admin.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo BD; ?>/admin.php">Dashboard</a></li>
                        <li><a href="<?php echo BD; ?>/admin.php?page=posts">View Posts</a></li>
                        <li><a href="<?php echo BD; ?>/admin.php?page=media">Media Library</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="?&logout=true">Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div>
</nav>
