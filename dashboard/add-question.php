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

  //$host = "http://localhost/cbt.org";
  $location = "adsubject";
  $mysql = new \connect\Mysql();
  $cbt = new \connect\Cbt();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> CBT :: Dashboard </title>

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
         'jquery.form.js'
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
  <style>

#progress-bar {background-color: #12CC1A;height:20px;color: #FFFFFF;width:0%;-webkit-transition: width .3s;-moz-transition: width .3s;transition: width .3s;}
#progress-div {border:#0FA015 1px solid;padding: 5px 0px;margin:30px 0px;border-radius:4px;text-align:center;}

</style>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#fileQuestion').change(function(e) {
              e.preventDefault();
              $('.loader').html('<img src="../images/LoaderIcon.gif" border="0">');
              $('#questionForm').ajaxSubmit({
                  target:   '.success',
                  beforeSubmit: function() {
                      $("#progress-bar").width('0%');
                  },
                  uploadProgress: function (event, position, total, percentComplete){
                      $("#progress-bar").width(percentComplete + '%');
                      $("#progress-bar").html('<div id="progress-status">' + percentComplete +'/ '+ total +' %</div>')
                  },
                  success:function (){
                      $('.loader').hide();
                  },
                  resetForm: true
              });
              return false;
      });
    });
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

			  <div class="col-md-8">
			   <div class="panel panel-warning">
			       <div class="panel panel-heading" >
				     <b><i class="fa fa-list"></i> Add Question </b>
				   </div>

				  <div class="panel panel-body">


            <div class="alert alert-info">
              <h4> Notice </h4>
              <p style="color: red">
                Please use the below format for the excel file
              </p>
              <p style="color: red">
                The course code must tally with the one to be used when adding student
              </p>
              <table class="table">
                <tr>
                  <td>course code</td>
                  <td>Answer </td>
                  <td>Question </td>
                  <td>option A</td>
                  <td>option B</td>
                  <td>option C</td>
                  <td>option D</td>
                </tr>
              </table>

              <img src="../images/question-shot.png" border="0" class="img-responsive">
            </div>
          <form method="POST" enctype="multipart/form-data" action="questionAjax.php" id="questionForm">

            <!-- <label> Add Course Code </label>
            <input type="text" name="coursecode" id="coursecode" class="form-control">
            <br> -->
            <label> Add Question <small>(.xls supported)</small>

            <input type="file" name="fileQuestion" id="fileQuestion">
            <br>
            <!-- <div id="progress-div"><div id="progress-bar"></div></div> -->
              <!-- <div id="targetLayer"></div> -->
            <br>
            <div class="loader">
            </div>
            <div class="success">
            </div>
            <!-- <button class="btn btn-success">
              <b>Submit <i class="fa fa-check-circle"></i>
            </button> -->


        </form>
				 <!-- <form action="<?=htmlentities($_SERVER['PHP_SELF']) ?>" method="POST" name="addqtn">

				 <?php
				  if(isset($_POST['continue'])) {
				  $exam->addQuestion(array('subject','answer','question','a','b','c','d'));
				  }
				 ?>

				   <label> Subject</label>
				     <select name="subject" id="subject" class="form-control">

				    <option value="0">==>select </option>

                <?php

                    $qty = $query = $db -> find_by_sql("SELECT * FROM exam_addsubject ORDER BY subject DESC");

                  if($qty->rowCount() > 0) {

                      while($ft = $qty->fetch()) {

					 echo "<option value=\"".str_replace(" ","_", $ft['subject'])."\"".((isset($_POST['subject']) && $_POST['subject']== $ft['subject']) ? "selected" : "").">".strtoupper($ft['subject'])."</option>";

				 }
                  }else {

                      echo "<option value=\"0\">NO SUBJECT ADDED</option>";
                  }
                     ?>
					</select>


			<label> Question </label>
			<textarea name="question" id="question" cols="30" class="form-control"></textarea>


			<label> &nbsp; (A) </label>
			<textarea name="a" id="a" cols="30" rows="2" class="form-control"></textarea>

			<label> &nbsp; (B) </label>
			<textarea name="b" id="b" cols="30" rows="2" class="form-control"></textarea>

			<label> &nbsp; (C) </label>
			<textarea name="c" id="c" cols="30" rows="2" class="form-control"></textarea>

			<label> &nbsp; (D) </label>
			<textarea name="d" id="d" cols="30" rows="2" class="form-control"></textarea>

                     	<label> Answer </label>

			  <select name="answer" id="answer" class="form-control">

				    <option value="0">==>select </option>
					<option value="A" >A</option>
					<option value="B" >B</option>
					<option value="C" >C</option>
					<option value="D" >D</option>

					</select>
				 <button type="submit" name="continue" id="continue" class="btn btn-primary" style="width: 100%;"> Submit  <i class="fa fa-edit"></i></button>


				 </form> -->
				 </div>
			   </div>
			   </div>

			   <div class="col-md-4">

			       <!-- <div class="panel panel-warning">

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
			       </div> -->

			         <!-- <form>
			             <label> <b> OR you can also upload by:</b></label>
			          <select name="subject" class="form-control">
			              <option value="0">==>select </option>

                <?php

                    $qty = $query = $db -> find_by_sql("SELECT * FROM exam_addsubject ORDER BY subject DESC");

                  if($qty->rowCount() > 0) {

                      while($ft = $qty->fetch()) {

                     echo "<option value=\"".str_replace(" ","_", $ft['subject'])."\"".((isset($_POST['subject']) && $_POST['subject']== $ft['subject']) ? "selected" : "").">".strtoupper($ft['subject'])."</option>";

                 }
                  }else {

                      echo "<option value=\"0\">NO SUBJECT ADDED</option>";
                  }
                     ?>
			          </select> <br/>
			         <button class="btn btn-primary" style="width: 100%;"><b>Upload Question from file <i class="fa fa-file"></i></b></button>
			         </form> -->

			     <div class="panel panel-warning" style="overflow: auto">
			     <div class="panel panel-heading">
				    <b><i class="fa fa-list"></i> Available </b>
				 </div>

				    <div class="panel panel-body">
				   <?php

                    $query = $db -> find_by_sql("SELECT * FROM question GROUP BY subject ORDER BY id DESC");

                    if($query->rowCount() > 0) {

                        while($fetch = $query->fetch()) {

                            if(empty($fetch['subject']) || $fetch['subject'] =='') {


                            } else {

                            echo "<div style=\"padding:5px;border-bottom:1px solid #CCCCCC;\">
                            <b><small>
                            <a href='edit_question.php?key=". $fetch['subject'] ."'>
                            ".strtoupper(str_replace("_"," ",$fetch['subject']))." <span class=\"badge\">".$cbt->totalqtn($fetch['subject'])."</span>
                            </a> </b></small> </div>";

                            } }

                    } else {

                        echo '<font color="#666666"><i>No subject found !</i></font>';
                    }

                    ?>
                   </div>
			   </div>
			  </div>
			   <div class="clearfix"></div>



	     <?php require 'footer.php'; ?>
	  </div>
	</body>

	</html>
