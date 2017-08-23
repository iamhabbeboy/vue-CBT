<?php
//require '';
//initialization...
$render = new Render();
$db = new Model();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
        Remove this if you use the .htaccess -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <meta name="description" content="">
        <meta name="author" content="MegaFuse Technologies">

        <meta name="viewport" content="width=device-width; initial-scale=1.0">

        <link rel="icon" href="/logo.ico">


        <title><?php print $title; ?></title>

        <?php
        /**
         *  Load static libs
         *
         */
         
         Render::load_lib_multiple(
         'css/css/vendor/bootstrap.min.css',
         'css/signin.css',
         'css/css/font-awesome.min.css',
         'css/animate.css',
         'css/main.css',
         'css/bootstrap-theme.min.css',
         'css/bootflat.min.css',
         'jquery.js',
         'Framework.js',
         'app.js',
         'Framework1.js'
         );

        ?>

        <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
        <link rel="shortcut icon" href="images/Megafuse1.ico">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    </head>
