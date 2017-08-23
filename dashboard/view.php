<?php session_start();
  ob_start();
 require "../app/include.function.inc";
  require '../app/Render.php';
  include "../app/Mysql.php";
  include "../app/CBT.php";
  include "../app/exam.php";


    // $exam = new Exam();
    // $mysql = new \connect\Mysql();
    // $cbt = new \connect\Cbt();
    $render = new Render();
    $render -> load_class('../db/Model');
    $db = new Model();

$location = "view";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> CBT :: Dashboard </title>
  <link rel="stylesheet" href="../css/style2.css" type="text/css"/>
    <link rel="stylesheet" href="<?=_UI_?>/css/bootstrap.css" />

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
         'Framework.js'
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

  #th tr td:hover{
   cursor:pointer;
   background:#CCC;
  }
  </style>


  <script>
   /*function addsubject() {
     document.addqtn.submit();
   }*/

    function exp()
    {
      var opt = document.querySelector('#opt');
      var ext = document.querySelector('.ext');
      var dpt = document.querySelector('#depart');
      var _v = opt.value;
       if (opt.value === '0')
       {
          alert('Please select subject !');

       } else if (ext.value === '0')
       {
         alert('Please select format to export !');

       }else
       {
         window.location = 'export.php?subject='+_v +'&depart='+dpt.value;
       }
    }

   </script>
   </head>
    <body>

	  <div id="wrapper">

		  <?php include "header.php"; ?>

		    <div style="line-height:40px;text-indent:20px;" class="container">
		     <small><em> Welcome back <?=htmlspecialchars($_SESSION['admin']) ?> !</em></small>
		   </div>
		   <div id="content" class="container">

			  <div >

              <div>
              	<h3> Practise Result </h3>
              </div>

              <div style="background: #ccc;color: #000; padding-top: 15px;">

              	 <div class="col-md-3">

			        <label style="padding-top: 5px;padding-left: 8px;">Choose your option:</label>

               </div>

               <div class="col-md-4">

               	 <form action="" method="get" id="form_search">
                   <div class="col-md-6">
                   <select name="depart" class="form-control" id="depart">
                     <option value="0"> -department- </option>
                     <?php
                     $query31 = $db->find_by_sql("SELECT * FROM studentrecord GROUP BY department");

                     if($query31 ->rowCount() > 0) {

                       							while($ft = $query31 ->fetch()) {

                       								echo "<option value=\"".$ft['department']."\">".str_replace('_', ' ', ucfirst($ft['department']))."</option>";
                      	}
                      } else {
                      		echo "<option value=\"\"> N/A</option>";
                      }

                     ?>
                   </select>
                 </div>
                 <div class="col-md-6">
               	   <select class="form-control" id="opt" name="action" >
			        	<option value="0"> course </option>


			        <?php

                $query1 = $db->find_by_sql('SELECT * FROM tmp_answer GROUP BY subject ORDER BY id DESC');

					   if($query1 ->rowCount() > 0) {

							while($ft = $query1 ->fetch()) {

								echo "<option value=\"".$ft['subject']."\">".str_replace('_', ' ', ucfirst($ft['subject']))."</option>";
							}
						} else {
							echo "<option value=\"\"> N/A</option>";
						}
			        ?>

			        </select>
            </div>
              <br class="clearfix" />
               </div>

                <div class="col-md-5">

                   <div class="input-group form-search">
                  <input type="text" class="form-control search-query" name="query" placeholder="Search Student Matric No., Score" />
                  <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary" data-type="last" id="search">Search</button>
                  </span>
                </div> <br/>
                </form>
               </div>




                <div class="clearfix"></div>

              </div>
                        <div class="panel panel-default">

                            <!-- Table -->

                            <div class="panel panel-heading">
                                <b>Student Result</b> <div class="pull-right">

                                    <select class="form-control ext" style="width: 200px;float:left;">
                                        <option value="0"> Export Result</option>
                                        <option value="excel"> Excel</option>
                                    </select>
                                    &nbsp;
                                    <button  name="button" onclick="exp()"> Go </button>
                                    <br style="clear:both" />
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel panel-body">
                           <table class="table table-striped
                                    table-bordered table-hover" id="dataTables-example">
                             <?php

                               if(isset($_GET['action']) and $_GET['action'] != 0 ):
                             ?>
                            	<thead>
                            		<h4> &nbsp;<i class="fa fa-edit"></i> <?=(isset($_GET['action']) ? ucfirst(str_replace('_', ' ', $_GET['action'])) : '') ?></h4>
                            	</thead>
                             <?php elseif(isset($_GET['query']) and $_GET['action'] == 0):
                               ?>
                                    <thead>
                                    <h4> &nbsp;<i class="fa fa-user"></i> Student Found</h4>
                                </thead>
                            <?php
                               endif;
                             ?>
                                <tr style="color:#111111"><th>S/n</th><th> Username</th><th> Total Question </th> <th> Date</th> <th> View</th></tr>

					<?php

          function get_count($db, $data)
          {
              $query = "SELECT * FROM tmp_answer WHERE username = '{$data}'";
              $sql = $db ->find_by_sql($query);
              //$sql->execute(array($data));
              return $sql->rowCount();
          }


          function get_scores($db, $user)
          {
              $score = 0;
             $sql = $db->find_by_sql("SELECT * FROM tmp_answer WHERE username = '{$user}'");
              //$sql->execute(array($user));

            if($sql->rowCount() > 0):

                 while($ft = $sql->fetch()):

                      if($ft['ans'] == $ft['correct']):
                          $score++;
                     endif;
                 endwhile;
             endif;
              return $score.'_'.$sql->rowCount();
          }

					  if(isset($_GET['action']) and $_GET['action'] != '' and $_GET['query'] == '') {

						  $act = $_GET['action'];
						  //echo $act;
						  $sql = $db -> find_by_sql("SELECT * FROM tmp_answer  WHERE subject = '{$act}' GROUP BY username ORDER BY id DESC");
					//$sql ->execute(array($act));


					  } else if(isset($_GET['query'])) {

                           $act = str_replace(' ', '_', $_GET['query'] );
                           $sql = $db -> find_by_sql("SELECT * FROM
                            tmp_answer  WHERE username = '{$act}' GROUP BY username ORDER BY id DESC ");
                            //$sql ->execute(array($act));
                           //print $act;
                      }else {

						 $sql = $db->find_by_sql('SELECT * FROM tmp_answer GROUP BY username ORDER BY id DESC');

					  }


				    $rows = $sql->rowCount();

				 if($sql->rowCount() > 0) {

				        for($i=1;$i<=$rows;$i++){
						       $fetch = $sql->fetch();
                         $exp = explode("_", get_scores($db, $fetch['username']));
                         $avg = $exp[1] / 2;
                         $u =  $fetch['username'];

					   echo "<tr style=\"background:#FFFFFF\" id=\"th\"><td>".$i."</td>";
					 echo "<td> ". $u ."</td><td>(&nbsp;<font color=\"red\">".get_count($db, $fetch['username'])."</font>&nbsp;)</td><td>".$fetch['date']."</td>
					 <td> <i><b>".
					   (($exp[0] <= $avg) ? '<font color="red">'.$exp[0].'</font>' : '<font color="green">'.$exp[0].'</font>').' / <font color="green">'.$exp[1]
					 ."</font></b></i></td></tr>";

					 }
				   }else{

	                echo "<tr><td colspan=\"5\">";
				     print "<center><h2 style=\"color: #666666\"> No Student Result Available </h2></center>";
				     echo "</td></tr>";
				   }

					?>
					</table></div>
                    </div>

			   </div>


		   </div>

	   <?php require 'footer.php'; ?>

	  </div>
	</body>

	<script>
  window.onload = function()
  {
		var sub = document.getElementById("sub")

		sub.onclick = function() {
			var opt = document.getElementById("opt")

			window.location = '?action='+opt.value
		}
  }
	</script>
	</html>
