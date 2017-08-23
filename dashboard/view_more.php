<?php session_start();
  ob_start();

    (!isset($_SESSION['admin'])) ? header('location:./'):'';
	include '../config/exam.php';
include "../configuration/setup.php";
	$exam = new Exam();
 $location = '';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> E-exam Practise :: Homepage </title>
  <link rel="stylesheet" href="../css/style2.css" type="text/css"/>
    <link rel="stylesheet" href="<?=_UI_?>/css/bootstrap.css" />

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
  
  #th tr td:hover{
   cursor:pointer;
   background:#CCC;
  }
  </style>
  
  
  <script> 
   function del(id,getid) {
     var d = window.confirm("Are you sure you want to REMOVE this question ?");
	 if(d==true) {
	   window.location='delete.php?id='+id+'&getid='+getid;
	   return false;
	 }
	 else{
	   return false;
	 }
//alert(id+", "+getid);	 
   }
  </script>
   </head>
    <body>
	 
	  <div id="wrapper">
	     
          <?php

            include "header.php";
            $getid = $_GET['user'];
          ?>
		    <div style="line-height:40px;text-indent:20px;">
		     <small><em> Welcome back <?=htmlspecialchars($_SESSION['admin']) ?> !</em></small>
		   </div>
		   <div id="content">
		    
			  <div >

                  <center> <h2> <?=$exam->get_name($getid)?></h2></center> <hr/>

                  <h3 style="float: left;"> Practise Result </h3>
                   <strong style="float: right; padding:10px 10px;"><small> <a href="javascript:window.print()" style="color: #666666;">[ print ]</a> </small></strong>

                  <div class="panel panel-default" style="clear:both;">

                      <b style="padding: 10px !important;">score: <?php $exp = explode("_", $exam->get_scores($getid)); echo $exp[0].' / '.$exp[1]?></b> <span style="margin-left: 20px;"> <b><?php $subject = $exam->get_subject($getid); echo $exam->get_subject_scores($getid, $subject);?></b></span>
                      </div>
                  <div class="panel panel-default" style="clear: both;">

                      <!-- Table -->
                      <table class="table">
                          <tr style="color:#111111"><th>S/n</th><th> Username</th><th> Question </th> <th>Answer </th> <th> Correct</th> <th> Reward </th></tr>

                          <?php

                          $sql = Exam::$connection->prepare("SELECT * FROM tmp_answer WHERE username = ? ORDER BY subject");
                          $sql->execute(array($getid));
                          $rows = $sql->rowCount();
                          if($sql->rowCount() > 0) {

                              for($i=1;$i<=$rows;$i++){
                                  $fetch = $sql->fetch();

                              if($fetch['ans'] == $fetch['correct']):

                                  $img = '<img src="../photo_web/s_success.png" border="0"/>';
                                  else:
                                  $img = '<img src="../photo_web/wrong.png" border="0"/>';
                                  endif;

                                  echo "<tr style=\"background:#FFFFFF\" id=\"th\"><td>".$i."</td>";
                                  echo "<td>".strtoupper(str_replace('_',' ',$fetch['subject']))."</td><td>".$fetch['question']."</td><td><i>".$fetch['ans']."</i></td> <td><i>".$fetch['correct']."</i></td><td>".$img."</td></tr>";

                              }
                          }else{

                              echo "<tr><td colspan=\"3\">";
                              print "error ";
                              echo "</td></tr>";
                          }

                          ?>
                      </table></div>
		   </div>
	  
	    <div id="footer"> 
		 <a href="home">home</a>&nbsp;&nbsp;<small>  &copy; copyright 2014  </small>
		</div>
	  </div>
	</body>
	
	</html>