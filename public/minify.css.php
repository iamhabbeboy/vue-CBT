<?php
  header("content-type:text/css");
  // ob_start("compress");
  //
  // function compress( $minify ) {
  //   $minify = preg_replace('!/*[^*]**+([^/][^*]**+)*/!', '', $minify);
  //   $minify = str_replace( array( 'rn', 'r', 'n', 't', ' ', '   '), '', $minify);
  //   return $minify;
  // }

   include('../styles/assets/bootstrap/css/bootstrap.min.css');
   include('../styles/assets/css/form-elements.css');
   include('../styles/assets/css/style.css');
   include('../styles/css/main.css');
  ob_end_flush();
