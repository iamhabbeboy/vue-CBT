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
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
      <title><?php print $title; ?></title>

        <!-- CSS -->
        <!-- <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500"> -->
        <link rel="stylesheet" href="public/minify.css.php">
        <link rel="stylesheet" href="styles/assets/font-awesome/css/font-awesome.min.css">

       <?php
        // Render::load_lib_multiple(
        // 'css/css/vendor/bootstrap.min.css',
        // 'css/signin.css',
        // 'css/css/font-awesome.min.css',
        // 'css/animate.css',
        // 'css/main.css',
        // 'css/bootstrap-theme.min.css',
        // 'css/bootflat.min.css',
        // 'jquery.js',
        // 'Framework.js',
        // 'app.js',
        // 'Framework1.js'
        // );

       ?>

       <script src="javascript/jquery.js" ></script>
       <script src="public/combine-js.php" async></script>
  </head>
