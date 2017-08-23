<?php

define( "DIR", "C:/xampp/htdocs/cbt.org" );    
//require DIR."/app/setup.php";
//require DIR."/app/CBT.php";
//require DIR."/app/Mysql.php"; 
//require DIR."/c/Redis.php";

   function route($url = null) {
       
       if($url == null) {
           
           header('location: '.BASE_URL);
       }else {
           
           $u = $url.'.php';
          header('location: '.BASE_URL.'/'.$u);
       }
   } 