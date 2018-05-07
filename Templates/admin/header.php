<?php
// My admin area header
// This is considerable smaller and loads the navigation from another file
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 28/03/17
 * Time: 18:41
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
    </head>
    <body style="padding-top: 70px;">
        <?php
            if ($isLoggedIn) {
                require_once  'Views/admin/headerNavigationView.php';
            }
        ?>
        <div class="container">