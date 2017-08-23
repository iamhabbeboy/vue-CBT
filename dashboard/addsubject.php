<?php session_start();
  ob_start();
  require "../app/include.function.inc";
  require '../app/Render.php';

  $render = new Render();
  $render -> load_class('../db/Model');
  $db = new Model();

//$host = "http://localhost/exampractise.com";
  $location = "subject";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> CBT :: Dashboard </title>
  <link rel="stylesheet" href="<?=BASE_URL?>/css/style2.css" type="text/css"/>


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
         'Framework.js',
         'app.js'
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

  #hov:hover{
   cursor:pointer;
   background:#000000;
   color:#FFF;
  }
  </style>


  <script>
   /*function addsubject() {
     document.addqtn.submit();
   }*/
  </script>

  <script src="../javascript/jquery.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
	 $('.italic').click(function(){
	  $('#question').html('<i></i>');
	});
	 $('.bold').click(function(){
	   $('#question').html('<b></b>');
	 });
	});
  </script>

   </head>
    <body>

	  <div id="wrapper">

		  <div id="header">

		     <?php

            include "header.php";
           ?>
		    <div style="line-height:40px;text-indent:20px;" class="container">
		     <small><em> Welcome back <?=htmlspecialchars($_SESSION['admin']) ?> !</em></small>
		   </div>
		   <div id="content" class="container">

			  <div class="col-md-6">
			      <div class="panel panel-warning" style="height: 360px;">
			        <div class="panel panel-heading">
			       <b><i class="fa fa-list"></i> Add Subject </b>
			       </div>
			       <div class="panel panel-body">

				 <form action="" method="POST" name="addqtn">

				 <?php
				  if(isset($_POST['continue'])) {
				    //$exam->addSubject(array('addsubject'));

                $subject = $_POST['addsubject'];

                if ($subject == ""):

                    echo "<font color=\"red\">Field required</font>";
                    return false;
                else:
                    $sql = $db -> find_by_id("exam_addsubject", array('subject' => $subject ));

                    if ($sql->rowCount() > 0) {
                        print "<em><small><font color=\"red\">Subject already added </font></small></em>";
                    } else {

                        $query2 = $db -> save_record("exam_addsubject", array('subject' => $subject, 'date_created' => date('F, d Y')));
                        print "<em><small><font color=\"green\">Subject added successfully </font></small></em><br>";
                    }
                endif;
            }
				 ?>

				   <label> Course Title </label>

			<input type="text" name="addsubject" id="addquestion" class="form-control"/>

				      <button class="btn btn-primary" type="submit" id="continue" name="continue" style="width:150px">
  Submit <i class="fa fa-edit"></i>
</button>

				 </form>
				 </div>
			   </div>
			   </div>

			   <div class="col-md-4">
			       <div class="panel panel-warning">
			     <div class="panel panel-heading">
				   <b><i class="fa fa-list"></i> Subject Available </b>
				 </div>

                   <div style="overflow:auto;height: 300px;" class="panel panel-body">
				   <?php

                    $query = $db -> find_by_sql("SELECT * FROM exam_addsubject ORDER BY id DESC");

                    if($query->rowCount() > 0) {

                        echo "<ul class=\"list-group\">";

                        while($fetch = $query->fetch()) {

                            if(empty($fetch['subject']) || $fetch['subject'] =='') {


                            } else {

                            echo "<li class=\"list-group-item\"><small><b><i class=\"fa fa-check\"></i> ".strtoupper($fetch['subject'])."</b></small></li>";

                            } }

                            echo "</ul>";

                    } else {

                        echo '<font color="#666666"><i>No subject found !</i></font>';
                    }

                    ?>
                   </div>
			   </div>
			   </div>
			   <div class="clearfix"></div>
		   </div>

	     <?php require 'footer.php'; ?>
	  </div>
	</body>

	</html>
