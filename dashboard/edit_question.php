<?php session_start();
  ob_start();
   //error_reporting(0);
    
    
require '../app/Render.php';
require '../app/include.function.inc';
require '../app/CBT.php';
require '../app/Mysql.php';
$render = new Render();
$render -> load_class('../db/Model');
$db = new Model();

  $host = "http://localhost/cbt.org";
  $location = "adsubject";
  $mysql = new \connect\Mysql();
  $cbt = new \connect\Cbt();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> CBT :: Dashboard </title>
  <link rel="stylesheet" href="<?=$host?>/css/style2.css" type="text/css"/>
  <link rel="stylesheet" href="<?=_UI_?>/css/bootstrap.css" type="text/css"/>
    
    <?php
        /**
         *  Load static libs 
         * 
         */
         
         Render::load_lib_multiple(
         'css/css/vendor/bootstrap.min.css',
         'css/css/bootflat.min.css',
         'css/signin.css',
         'css/css/font-awesome.min.css',
         'css/animate.css',
         'css/main.css',
         'jquery.js',
         'dashboard.js'
         );
         
        ?>
  <style>
   .nleft label,input[type=submit] {
     display:block; 
   }
   
   .nleft input[type=text],textarea{
     border:1px solid #cccccc;
   }
   
   .nleft textarea {
      width:400px;
	  font-size:16px;
	  font-family:arial,helvetica;
   }
  #continue{
      margin-top:10px;
	  width:400px;
	  padding:8px;
	  font-weight:bold;
	  font-size:14px;
  }
  
  #hov:hover, .links-hover:hover{
   cursor:pointer;
   background:#3bafda;
   color:#FFF;
  } 
  </style>
  
  
  <script> 
   /*function addsubject() {
     document.addqtn.submit();
   }*/
  </script>
  


  
   </head>
    <body>
	 
	  <div id="wrapper">
	     
		  
		 <?php
    
            include "header.php";

           ?>
          
		    <div style="line-height:40px;text-indent:20px;" class="container">
		     <small><em> Welcome back <?=htmlspecialchars($_SESSION['admin']) ?> !</em></small>
		   </div>
		   <div id="content" class="container">
		    
			  <div class="col-md-6">
			   <div class="panel panel-warning">
			       <div class="panel panel-heading" >
				     <b><i class="fa fa-list"></i> Edit <?php print str_replace('_', ' ', $_GET['key'])?> Question's </b>
				   </div>  
				   
				  <div class="panel panel-body">
				       
				   <ul class="list-group-item">
				       
				   <?php
				    $key = $_GET['key']; 
                    
                     print '<h4><i class="fa fa-edit"></i> '.strtoupper($key). '</h4>';
				    
				     $sql = $db -> find_by_fields('question', array('subject' => $key));
                     
                     if($sql -> rowCount() > 0 ) {
                         
                         $num = 1;
                         while($ft = $sql -> fetch()):
                             
                           if(empty($fetch['subject']) || $fetch['subject'] ==''){ 
                       ?>
                       
                        <li class="list-group-item links-hover" id="<?php print $ft['id']?>">
                            
                            <b><small><?php print $num.') '.$ft['question']?></small></b>
                            <a href="#" style="font-size: 10px;font-weight:bold;display: none;color: black;text-decoration: underline;" class="btn-<?=$ft['id']?>">Edit <i class="fa fa-edit"></i></a>
                        </li>
                       <?php
                            } else {}
                          $num++;      
                         endwhile;    
                         
                     } else {
                         
                         print 'No Questions Available !';
                     }
				     
				    ?>
				    </ul>
				 <button type="submit" name="continue" id="continue" class="btn btn-primary" style="width: 100%;"> Submit  <i class="fa fa-edit"></i></button>
				 
				 
				 </div>
			   </div>
			   </div>
			   
			   <div class="col-md-4">
			       
			       <div class="panel panel-warning">
			           
			           <div class="panel panel-heading">
			               <b><i class="fa fa-list"></i> Upload Diagram Avatar </b>
			           </div>
			           
			           <div class="panel panel-body">
			               
			               <center>
			                   <img src="<?php print BASE_URL ?>/images/gallery.png" border="0"/>
			                   <br/><br/>  
			                   <a href="#" class="btn btn-primary" style="width: 100%;"> Choose <i class="fa fa-user"></i></a>
			               
			                </center>    
			           </div>
			       </div>
			       
			         
			      
			  </div>
			   <div class="clearfix"></div>
		  
	  
	    
	     <?php require 'footer.php'; ?>
	  </div>
	</body>
	
	</html>