<?php session_start();
  ob_start();
   error_reporting(0);
    (!isset($_SESSION['admin']))?header('location:index'):'';
	include '../config/exam.php';
	$exam = new Exam();

$host = "http://localhost/exampractise.com";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> E-exam Practise :: Homepage </title>
  <link rel="stylesheet" href="<?=$host?>/css/style2.css" type="text/css"/>
  
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
	     
		 <?php include "header.php"; ?>
          
		    <div style="line-height:40px;text-indent:20px;">
		     <small><em> Welcome back <?=htmlspecialchars($_SESSION['admin']) ?> !</em></small>
		   </div>
		   <div id="content">
		    
			  <div class="nleft">
			   <p>
			       <fieldset >
				     <legend><b> Add Question </b></legend>
				 <form action="<?=htmlentities($_SERVER['PHP_SELF']) ?>" method="POST" name="addqtn">
				 
				 <?php
				  if(isset($_POST['continue'])) {
				  $exam->addQuestion(array('subject','answer','question','a','b','c','d'));
				  }
				 ?>
				 
				   <label> Subject</label>
				     <select name="subject" id="subject" style="padding:5px;width:400px;border:1px solid #cccccc;">
				   
				    <option value="0">==>select </option>
					<option value="use_of_english" <?=(isset($_POST['subject']) && $_POST['subject']=='use_of_english')?'selected':''?>>Use of English</option>
					
					<option value="mathematics" <?=(isset($_POST['subject']) && $_POST['subject']=='mathematics')?'selected':''?>>Mathematics</option>
					
					<option value="government" <?=(isset($_POST['subject']) && $_POST['subject']=='government')?'selected':''?>>Government</option>
					
					<option value="commerce" <?=(isset($_POST['subject']) && $_POST['subject']=='commerce')?'selected':''?>>Commerce</option>
					<option value="chemistry" <?=(isset($_POST['subject']) && $_POST['subject']=='chemistry')?'selected':''?>>Chemistry</option>
					<option value="economics" <?=(isset($_POST['subject']) && $_POST['subject']=='economics')?'selected':''?>>Economics</option>
					<option value="history" <?=(isset($_POST['subject']) && $_POST['subject']=='history')?'selected':''?>>History</option>
					<option value="physics" <?=(isset($_POST['subject']) && $_POST['subject']=='physics')?'selected':''?>>Physics</option>
					<option value="agric" <?=(isset($_POST['subject']) && $_POST['subject']=='agric')?'selected':''?>>Agricultural Science</option>
					<option value="crk" <?=(isset($_POST['subject']) && $_POST['subject']=='crk')?'selected':''?>>C.R.K</option>
					<option value="geography" <?=(isset($_POST['subject']) && $_POST['subject']=='geography')?'selected':''?>>Geography</option>
					<option value="literature" <?=(isset($_POST['subject']) && $_POST['subject']=='literature')?'selected':''?>>Literature</option>
					<option value="account" <?=(isset($_POST['subject']) && $_POST['subject']=='account')?'selected':''?>>Principle of Account</option>
					<option value="biology" <?=(isset($_POST['subject']) && $_POST['subject']=='biology')?'selected':''?>> Biology</option>
					</select>
			
		
			<label> Question </label>
			<textarea name="question" id="question" cols="30" rows="2" > <?=$_POST['question'] ?></textarea>	
		
			
			<label> &nbsp; (A) </label>
			<textarea name="a" id="a" cols="30" rows="2"></textarea>	
			
			<label> &nbsp; (B) </label>
			<textarea name="b" id="b" cols="30" rows="2"></textarea>
			
			<label> &nbsp; (C) </label>
			<textarea name="c" id="c" cols="30" rows="2"></textarea>
			
			<label> &nbsp; (D) </label>
			<textarea name="d" id="d" cols="30" rows="2"></textarea>
				
                     	<label> Answer </label>
				   
			  <select name="answer" id="answer" style="padding:5px;width:400px;border:1px solid #cccccc;">
				   
				    <option value="0">==>select </option>
					<option value="A" <?=(isset($_POST['answer']) && $_POST['answer']=='A')?'selected':''?>>A</option>
					<option value="B" <?=(isset($_POST['answer']) && $_POST['answer']=='B')?'selected':''?>>B</option>
					<option value="C" <?=(isset($_POST['answer']) && $_POST['answer']=='C')?'selected':''?>>C</option>
					<option value="D" <?=(isset($_POST['answer']) && $_POST['answer']=='D')?'selected':''?>>D</option>
			
					</select> 
				 <input type="submit" name="continue" id="continue" value="add +"/>
				 
				 
				 </form>
				 </fieldset>
			   </p>
			   </div>
			   
			   <div class="oinfo">
			     <div class="inner">
				   user monitor &nbsp;&raquo;
				 </div>
				   
				   user logged in
			   </div>
			   <br style="clear:both;"/>
		   </div>
	  
	    <div id="footer"> 
		 <a href="home">home</a>&nbsp;&nbsp;<small>  &copy; copyright 2014  </small>
		</div>
	  </div>
	</body>
	
	</html>