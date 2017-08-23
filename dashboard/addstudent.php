<?php session_start();
  ob_start();
   //error_reporting(0);
    (!isset($_SESSION['admin']))?header('location:./'):'';
require '../app/Render.php';
require '../app/include.function.inc';
require '../app/CBT.php';
require '../app/Mysql.php';


	$exam = new Render();
  $exam -> load_class('../db/Model');
  $db = new Model();

    $mysql = new \connect\Mysql();
    $cbt = new \connect\Cbt();


  $host = "http://localhost/exampractise.com";
  $location = "addstudent";


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> E-exam Practise :: Homepage </title>


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

      // var count = 0
      // function addSubject(subject) {
      //
      //     var sub =
      //         document.getElementById(subject)
      //
      //     var counter =
      //         document.getElementById("showSubject")
      //
      //
      //     if(sub.checked == false) {
      //
      //          sub.checked = true
      //          count++
      //          counter.innerHTML = '['+(count)+']'
      //
      //     } else {
      //
      //         sub.checked = false;
      //         count--
      //         counter.innerHTML = '['+(count)+']'
      //     }
      // }

      function del(e, id)
      {
        e.preventDefault();
        var url = document.getElementById('delete1');
        var c   = url.getAttribute('href');
        var conf = window.confirm("Are you sure ?");

        if ( conf )
        {
          window.location = c;
        }
        //console.log(c);
      }


      $(function() {
        $('#fileStudent').change(function() {
          $('.loader').html('<i>loading...</i>');
          $('#studentAjax').ajaxForm({
            'target':'.loader'
          }).submit();
        })
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

              <div class="col-md-7">

                <div class="panel panel-warning">
                 <div class="panel panel-heading">
                  <b><i class="fa fa-list"></i> Add Student </b>
                  </div>
                  <div class="panel panel-body">

                    <div class="alert alert-info">
                      <h4><i class="fa fa-info-circle"></i> Notice </h4>
                      <p style="color: red">
                        Please use the below format for the excel file
                      </p>
                      <p style="color: red">
                        The course code must tally with the one to be used when adding question
                      </p>
                      <table class="table">
                        <tr>
                          <td>Matric No.</td>
                          <td>Department </td>
                          <td>Course code</td>
                        </tr>
                      </table>

                      <img src="../images/addstudent.png" border="0" class="img-responsive">
                    </div>

                     <form method="POST" enctype="multipart/form-data" id="studentAjax" action="studentAjax.php">
                       <label> Add Student Matric <small>(.xls supported)</small> </label><br>

                       <input type="file" name="fileStudent" id="fileStudent"/>

                     </form>
                       <hr>
                       <div class="alert alert-info">
                         <h4><i class="fa fa-info-circle"></i> Notice </h4>
                         <p style="color: red">
                           You can only generate 100 Matric No. at once
                         </p>
                       </div>
                       <form method="post">
                       <h3> -- OR -- </h3>
                       <h4> Generate Matric No. </h4>

                       <label> Department </label>
                       <input type="text" class="form-control" name="department" required="">

                       <label> Select Course </label>
                       <select name="course" class="form-control" required="">
                         <option value=""> select </option>

                         <?php

                         $query = $db -> find_by_sql("SELECT * FROM exam_addsubject ORDER BY id DESC");

                         if($query->rowCount() > 0) {

                             while($fetch = $query->fetch()) {

                                 if(empty($fetch['subject']) || $fetch['subject'] =='') {


                                 } else {

                                 echo "<option value='".$fetch['subject']."'>
                                 ".strtoupper(str_replace("_"," ",$fetch['subject']))."</option>";

                                 } }

                         } else {

                             //echo '<font color="#666666"><i>No subject found !</i></font>';
                         }
                        ?>

                       </select>
                       <label> Year <small>(12)</small></label>
                       <input type="text" class="form-control" name="year" placeholder="<?=date('y')?>" required="">

                       <label> Departmental Code <small>(49)</small></label>
                       <input type="text" class="form-control" name="departCode" required="">

                       <label>Matric No. From <small>(1)</small></label>
                       <input type="number" class="form-control" name="mfrom" required="">

                       <label> Matric No. To <small>(20)</small></label>
                       <input type="number" class="form-control" name="mto" required>

                       <br>

                       <button class="btn btn-success" type="submit" name="generateBtn">
                         <b>Generate <i class="fa fa-check-circle"></i>
                       </button>

                     </form>

                  </div>
                     </div>
                     </div>
                     <div class="col-md-5">
                       <div class="panel panel-warning">
                        <div class="panel panel-heading">
                         <b><i class="fa fa-list"></i> View Student </b>
                         </div>
                         <div class="panel panel-body">

                           <br><br>
                           <div style="overflow:auto; height: 550px;">
                              <div class="loader"></div>


                           <?php

                           if(isset($_GET['del'])):
                              $param = $_GET['del'];
                              $queryDel = $db -> find_by_sql("DELETE FROM studentrecord WHERE subject='{$param}'");
                              echo "<b style='color:green'><i class='fa fa-check-circle'></i> Deleted Successfully !, <a href='addstudent.php'>click to continue</a></b>";
                           endif;

                             if (isset($_POST['generateBtn']))
                             {

                               function convert($num)
                               {
                                 $a = '';

                                  if($num < 10)
                                  {
                                     $a.='000'.$num;

                                  }else if(($num < 100) && ($num >= 10))
                                  {
                                     $a .='00'.$num;
                                  } else if(($num < 1000) && ($num >= 100))
                                  {
                                     $a .='0'.$num;
                                  }else
                                  {
                                     $a .= $num;
                                  }

                                  return $a;
                               }

                               $year       = $_POST['year'];
                               $course     = str_replace(' ', '_', $_POST['course']);
                               $department = $_POST['department'];
                               $departCode = $_POST['departCode'];
                               $mfrom      = (int)$_POST['mfrom'];
                               $mto        = (int)$_POST['mto'];
                               $my = $year."/".$departCode;
                               $count = 0;
                               $store = [];
                                 //echo $course.', '.$department.', '.$departCode.', '.$mfrom.','.$mto;
                                 echo "<h5>".str_replace('_', ' ', $department)."</h5>";

                                 echo "<table class='table'>";
                                 echo "<tr><td>Matric No.</td><td>Course Code</td></tr>";

                                 for($i = $mfrom; $i<= $mto; $i++ )
                                 {
                                   $mymatric = $year."/".$departCode."/".convert($i);

                                   $qtn = $db -> find_by_sql("SELECT * FROM studentrecord WHERE loginkey='{$mymatric}' AND subject='{$course}'");

                                   if ( $qtn->rowCount() > 0 )
                                   {
                                     $count = $count+1;
                                     array_push($store, $mymatric);

                                   } else {

                                   $qtn1  = $db -> save_record('studentrecord', [
                                     'surName' => 'megafuse',
                                     'firstName' => '',
                                     'loginkey'  => $mymatric,
                                     'department' => $department,
                                     'subject'    => $course,
                                     'photo'      => '',
                                     'datetime'   => date('Y-m-d h:i')
                                   ]);

                                   echo "<tr><td>".$mymatric."</td><td>".str_replace('_', ' ', $course)."</td></tr>";
                                 }
                               }

                               if ( $count > 0 )
                               {
                                 echo "<h3 style='color: red'>".$count." Student Already Exist </h3>";
                                 foreach($store as $key => $student)
                                 {
                                   echo "<tr>
                                     <td>".($key+1)."</td><td>".$student."</td></tr>";
                                 }
                               }


                                 echo "</table>";


                             } else {
                           ?>

                           <?php

                             $get_record = $db -> find_by_sql("SELECT * FROM studentrecord GROUP BY subject ORDER BY id DESC");

                             if ( $get_record->rowCount() > 0)
                             {
                               while($fet = $get_record->fetch())
                               {
                                 $c = $fet['subject'];
                                 $get_student = $db -> find_by_sql("SELECT * FROM studentrecord WHERE subject='{$c}'");

                                 if ( $get_student -> rowCount() > 0 ) {
                                   echo "<h4>
                                     <a href='?del=".$c."' style='color: red' id='delete1' onclick='del(event)'><i class='fa fa-trash'></i></a> &nbsp;Course Code:".str_replace('_', ' ', $fet['subject'] )."</h4>
                                       
                                        <table class='table'>
                                        <tr style='color: #993300'>
                                         <td>#</td>
                                         <td> Matric No.</td>
                                         <td> Department </td>
                                         <td> Submitted </td>
                                        </tr>";
                                    $i = 0;
                                   while($aft = $get_student->fetch()) {
                                     $m = $aft['loginkey'];
                                     $q = $db -> find_by_sql("SELECT * FROM studentlog WHERE loginkey='{$m}'");
                                   echo "<tr>
                                         <td>".($i+1)."</td>
                                          <td>".$aft['loginkey']."</td>
                                          <td>".$aft['department']."</td>
                                          <td>".(($q->rowCount() > 0 ) ? '<span style="color:green"><i class="fa fa-check-circle"></i> Done</span>' : '<span style="color:#ccc"><i class="fa fa-info-circle"></i> N/A</span>')."</td>
                                         </tr>";
                                          $i++;
                                    }
                                   echo "</table>";

                                 }
                               }
                             }else {
                               echo '<h1 style="color: #ccc;text-align:center;">
                                    <i class="fa fa-archive"></i>
                                    <br>
                                     Record Board
                                  </h1>';
                             }
                            ?>
                           <?php } ?>
                         </div>
                         </div>

                       </div>
                     </div>
                     <div class="clearfix"></div>
              </div>

          </div>


	    <?php
	      require 'footer.php';
	    ?>
	  </div>
	</body>

	</html>
