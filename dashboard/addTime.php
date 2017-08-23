<?php session_start();
  ob_start();
   //error_reporting(0);
   require "../app/include.function.inc";
  require '../app/Render.php';

  $render = new Render();
  $render -> load_class('../db/Model');
  $db = new Model();

//$host = "http://localhost/exampractise.com";
  $location = "addTime";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> CBT :: Dashboard </title>
  <link rel="stylesheet" href="<?=BASE_URL?>/css/style2.css" type="text/css"/>
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
         'Framework.js',
         'app.js'
         );

        ?>
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
			   <div class="panel panel-warning">
			       <div class="panel panel-heading">
				     <b> Set Time </b>
				     </div>
				   <div class="panel panel-body">
				 <form action="" method="POST" name="addqtn">

				   <label> Enter your subject </label>

                      <?php

                        if(isset($_POST['continue'])):

                           $h = $_POST['hours']; $m = $_POST['minutes']; $s = $_POST['seconds'];

                          //$cbt->setTime($h, $m, $s);
                          if($h == '00' && $m =='00' && $s == '00'):

                            echo "<font color=\"red\">Atleast two field required</font>";
                            return false;
                          else:

                             $query = $db->find_by_sql("SELECT * FROM practisetime");
                               $d = date('d-m-y h:ia');
                              if($query->rowCount() > 0) {

                                  $qty = $db->find_by_sql("UPDATE practisetime SET hour ='{$h}' , minute = '{$m}', second ='{$s}' , datetime = '{$d}'");
                                  //$qty->execute(array($h, $m, $s, ));

                                  echo "<font color=\"green\">Time Set Successfully !</font>";

                              } else {

                                    $qty = $db->find_by_sql("INSERT INTO practisetime(hour, minute, second, datetime) VALUES('{$h}', '{$m}', '{$s}', '{$d}')");
                                  //$qty->execute(array($h, $m, $s, date('d-m-y h:ia')));

                                  echo "<font color=\"green\">Time Set Successfully !</font>";
                              }
                           endif;
                        endif;
                     ?>
			       <ul class="list-group">
  <li class="list-group-item">Hours : <select class="form-control" name="hours"><option value="0">00</option>

      <?php

          for($i=1;$i<=60;$i+=1):

               echo "<option value=\"".$i."\">".$i."</option>";
               endfor;
        ?>
      </select></li>
  <li class="list-group-item"> Minutes: <select class="form-control" name="minutes"><option value="0">00</option>

      <?php
        for($i=1;$i<=60;$i+=1):

               echo "<option value=\"".$i."\">".$i."</option>";
               endfor;
        ?>
      </select></li>
  <li class="list-group-item"> Seconds: <select class="form-control" name="seconds"><option value="0">00</option>

      <?php
        for($i=1;$i<=60;$i+=1):

               echo "<option value=\"".$i."\">".$i."</option>";
               endfor;
        ?>
      </select></li>

</ul>

				      <button class="btn btn-primary" type="submit" id="continue" name="continue" style="width:150px">
  add+
</button>


				 </form>
				 </div>
			   </div>
			   </div>

			   <div class="col-md-4">
			     <div class="panel panel-warning">
			     <div class="panel panel-heading">
				   Subject Available
				 </div>

                   <div style="height:200px;overflow:auto;" class="panel panel-body">
				   <?php

                    $query = $db->find_by_sql("SELECT * FROM question ORDER BY id DESC");

                    if($query->rowCount() > 0) {

                        echo "<ul class=\"list-group\">";

                        while($fetch = $query->fetch()) {

                            if(empty($fetch['subject']) || $fetch['subject'] =='') {


                            } else {

                            echo "<li class=\"list-group-item\">".strtoupper($fetch['subject'])."</li>";

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


        <?php
           require 'footer.php';
        ?>
	  </div>
	</body>

	</html>
