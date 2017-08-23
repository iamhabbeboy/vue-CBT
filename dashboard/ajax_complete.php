<?php session_start();
  ob_start();
   //error_reporting(0);
    (!isset($_SESSION['admin']))?header('location:index'):'';
	include '../config/exam.php';
include "../configuration/setup.php";
include "../configuration/CBT.php";
include "../configuration/Mysql.php";
	$exam = new Exam();
    $mysql = new \connect\Mysql();
    $cbt = new \connect\CBT;
  $host = "http://localhost/exampractise.com";
  $location = "adsubject1";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> E-exam Practise :: Homepage </title>
  <link rel="stylesheet" href="<?=$host?>/css/style2.css" type="text/css"/>
  <link rel="stylesheet" href="<?=_UI_?>/css/bootstrap.css" type="text/css"/>
    
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
      
      .rower{background: #dddddd;margin-top:5px;padding: 10px;}
      .subjectSelection{padding: 5px;margin-top: 5px;}
  </style>
  

  
   </head>
    <body>
	 
	  <div id="wrapper">
	     
		  
		 <?php
    
            include "header.php";

           ?>
          
		    <div style="line-height:40px;text-indent:20px;">
		     <small><em> Welcome back <?=htmlspecialchars($_SESSION['admin']) ?> !</em></small>
		   </div>
		   <div id="content">
		    
			  <div class="nleft">
			   <p>
			       <fieldset >
				     <legend><b style="color: green"> Record Saved Successfully</b></legend>
			     
				        <div style="width: 500px;">
                                 <?php
                                    $convert = $cbt->getStudentImage('id', $_SESSION['uustudentID'], 'photo');
                                        list($width, $height) = getimagesize($convert);
                                     $resize = $cbt->resizeimg($width, $height, 180);
                                ?>
                                
                                
            
                            <ul class="list-group">
  <li class="list-group-item"> <img src="<?=$convert?>" border="0" <?=$resize ?> style="border-radius:5px;padding:2px;border:1px solid #cccccc;"/></li>
  <li class="list-group-item"> <strong> Full Name: </strong>  &nbsp; <strong><?=$_POST['fname']?> </strong></li>
                                <li class="list-group-item"><strong> Key : </strong>  &nbsp; <strong><?=$_POST['key']?> </strong></li>
  <li class="list-group-item"> <strong> Login with : </strong>  &nbsp; <em><?php $explode = explode(" ", $_POST['fname']); echo "surname: '<b><small>".$explode[0]."</small></b>' and password key is : '<b><small>".$_POST['key']."</small></b>'"?></em></li>
  <li class="list-group-item"><strong> Department: </strong>  &nbsp; <strong><?=$_POST['department']?> </strong></li>
    <li class="list-group-item">
                                <strong> Subject Selection: </strong> 
                                
                                <div class="subjectSelection">
                                    
                                   <?php
                                    
                                       $sub = '';

                                if($_POST['subjectAdd'] !== "on"):

                                    foreach($_POST['subjectAdd'] as $key => $value):
                                    
                                            $sub .= $value.', ';
                                    endforeach;
                                        $sub = $sub;
                                 else:
                                    echo "";
                                endif;    
                              switch($_POST['department']) {
                                    
                                    case 'science':
                                      $subject = 'english language, mathematics, biology, agric. science';
                                      break;
                                    
                                    case 'commercial':
                                       $subject = 'english language, mathematics, account, government';
                                       break;
                                    
                                    case 'art':
                                         $subject = 'english language, mathematics, government, history';
                                         break;
                                    case 'others':
                                         $subject = substr($sub, 0, strlen($sub) -2);
                                          break;
                                    default: 'error';
                                        break;
                                    
                                }

                                  echo "<b><small>".strtoupper($subject)."</small></b>";
                                        ?>
                                </div>
                                </li>
</ul>
                            <?php
                                    
                        
                                 
                                    $id = $_SESSION['uustudentID']; 
                    

                        $query = $mysql::$mysql->prepare("SELECT * FROM studentrecord WHERE loginkey=?");
                        $query->execute(array($_POST['key']));

                        if($query->rowCount() > 0) {
                            
                             $loginkey = rand(0, time());
                            
                        } else {
                            
                            $loginkey = $_POST['key'];
                            
                              $sql = $mysql::$mysql->prepare("UPDATE studentrecord SET surName = ?, firstName = ?, loginkey = ?, department = ?, subject = ? WHERE id=?");
                                  $sql->execute(array($explode[0], $explode[1], $loginkey, $_POST['department'], $subject, $id));
                        }
                                
                            ?>
                                                
                            
                              <div> 	
                                  
                                  <button class="btn btn-primary" type="submit" id="continue" name="continue" style="width:150px" name="submit" onclick="window.location='addstudent.php'">
  Back
</button> 
                            
                            </div>
                             
                       </div>
				 </fieldset>
			   </p>
			   </div>
			   
			   <div class="oinfo">
			    &nbsp;
				    
			   </div>
			   <br style="clear:both;"/>
		   </div>
	  
	    <div id="footer"> 
		 <a href="home">home</a>&nbsp;&nbsp;<small>  &copy; copyright 2014  </small>
		</div>
	  </div>
	</body>
	
	</html>