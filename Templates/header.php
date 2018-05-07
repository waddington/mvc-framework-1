<?php
// The header
// This uses the example bootstrap navigation
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 28/03/17
 * Time: 16:42
 */
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--    Reset   -->
        <link rel="stylesheet" type="text/css" href="<?php echo BD;?>/css/reset.css">

        <!--    Bootstrap    -->
        <link rel="stylesheet" type="text/css" href="<?php echo BD; ?>/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo BD; ?>/css/bootstrap-theme.min.css">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!--    jQuery  -->
        <script rel="script" type="application/javascript" src="<?php echo BD; ?>/js/jquery.min.js"></script>
        <script rel="script" type="application/javascript" src="<?php echo BD; ?>/js/jquery.validate.min.js"></script>
        <!--    Bootstrap    -->
        <script rel="script" type="application/javascript" src="<?php echo BD; ?>/js/bootstrap.min.js"></script>
        <!--    Custom JS  - written by me -->
        <script rel="script" type="application/javascript" src="<?php echo BD;?>/js/scripts.js"></script>
        <!--    Google Maps -->
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDze5nvo7cSRsjZMTpmDxBa9vR0ec2116g&callback=initMap"></script>
    </head>
    <body style="padding-top: 70px;">
        <!--    This is taken from the bootstrap getting started pages  -->
        <!--    http://getbootstrap.com/components/#navbar-default  -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo BD;?>">[LOGO HERE]</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo BD;?>">Home <span class="sr-only">(current)</span></a></li>
                        <li><a href="index.php?page=contact">Contact</a></li>
                        <li><a href="index.php?page=scrape">Web Scraping</a></li>
                    </ul>
                    <!--    Site Search -->
                    <form class="navbar-form navbar-left" method="post" action="index.php?page=search">
                        <div class="form-group">
                            <input type="text" class="form-control" name="site-search" id="site-search" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                    <!--    Right side admin only   -->
                    <?php if ($isLoggedIn) { ?>
                        <ul class="nav navbar-nav navbar-right only-admin-logged-in">
                            <li><a href="admin.php" target="_blank">Admin</a></li>
                            <li class="dropdown">
                                <a href="admin.php" target="_blank" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Your blog <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="admin.php">Dashboard</a></li>
                                    <li><a href="admin.php?page=posts&modifier=new">Add New Post</a></li>
                                    <li><a href="admin.php?page=posts">View Posts</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="admin.php?logout=true">Log Out</a></li>
                                </ul>
                            </li>
                        </ul>
                    <?php } ?>
                </div><!-- /.navbar-collapse -->
            </div>
        </nav>
        <div class="container">