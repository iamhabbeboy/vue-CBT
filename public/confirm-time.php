<?php session_start();
 ob_start();

 /* Configuration file
 ===========================================================
    file containing the source of styles, JS, etc.

 */
    $link = "about"; // navigation purpose
  include "../../configuration/setup.php";

  if(!isset($_POST)) {

      header('location: '.BASE_URL.'/course');
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?=_ICON_?>/logo.ico">
    <title>Confirm Course :: CBT </title>
      <?php

      // houserent-JSLibs include here

      include "../../configuration/houserent-JSLibs.php";



                if(isset($_POST['subject'])) {

                    $view = "";
                    foreach ($_POST['subject'] as $key => $value) {

                        $display = str_replace("_", " ", $value);
                        $dat[] = strtoupper($display);

                    }

                        $_SESSION['_SUBJECT_'] = $dat;

                } else if(isset($_POST['science'])) {

                    $subject = substr($_POST['science'], 0, strlen($_POST['science']) -2);
                     $explode = explode(", ", $subject);

                    for($i=0;$i<count($explode); $i+=1) {

                        $data[] = strtoupper(str_replace("_", " ",$explode[$i]));
                    }

                    $_SESSION['_SUBJECT_'] = $data;

                } else if(isset($_POST['comm'])) {

                    $subject = substr($_POST['comm'], 0, strlen($_POST['comm']) -2);
                    $explode = explode(", ", $subject);

                    for($i=0;$i<count($explode); $i+=1) {

                        $data[] = strtoupper(str_replace("_", " ",$explode[$i]));
                    }

                    $_SESSION['_SUBJECT_'] = $data;

                } else if(isset($_POST['art'])) {

                    $subject = substr($_POST['art'], 0, strlen($_POST['art']) -2);
                    $explode = explode(", ", $subject);

                    for($i=0;$i<count($explode); $i+=1) {

                        $data[] = strtoupper(str_replace("_", " ",$explode[$i]));
                    }

                    $_SESSION['_SUBJECT_'] = $data;

                }
      ?>


      <script>

          function submit() {
            'use strict';
              var examHours, examMins, examSec;

              examHours = document.getElementById("ExamHours"),
                  examMins = document.getElementById("ExamMins"),
                  examSec = document.getElementById("ExamSecs");

              if(examHours.value == '0' && examMins.value == '0' && examSec.value == '0') {

                    examHours.style.border = "1px solid #993300";
                    examMins.style.border = "1px solid #993300";
                    examSec.style.border = "1px solid #993300";
                    examHours.focus();
                  return false;

              } else {


              }


          }


          $(function() {

              $('body').keypress(function(e) {

                  if(e.which == 110) {

                      submit();

                  } else if(e.which == 112) {

                    window.history.back();
                  }
              })
          })
      </script>


  </head>

  <body>

    <div class="container">


      <?php
  
        include "min-header.php";
      ?>


        <!-- user account and documentation -->
        <div class="houserent-user-account">

            <div class="houserent-center">

                <h2> Proceed By Setting Duration For Practise </h2>
                <p> <em> <font color="#993300">(Note: JAMB standard time takes 3:30 hrs)</font></em></p>

            </div>
        </div>

        <div class="houserent-browse">


            <div class="houserent-browse-option">

         <ul class="list-group">
        <li class="list-group-item active">
           <b>Subject Selected</b>
        </li>

             <?php

             if(isset($_SESSION['_SUBJECT_'])):

              $subject = $_SESSION['_SUBJECT_'];

              for($i=0;$i<count($subject);$i+=1):

                  echo "<a href=\"#\" class=\"list-group-item\">".$subject[$i]."</a>";

              endfor;

             else:

               header('location: '.BASE_URL.'/course');

             endif;
             ?>

 </ul>
            </div>

            <div class="houserent-show">

            <div class="alert alert-success" role="alert">

                    <h4 style="color: #111111"> Set Time/ Duration  </h4>
                <ul class="list-group">
        <li class="list-group-item active">
           Examination practise time 
        </li>
   <li class="list-group-item">

      <div class="timeRow"> Hours  <select class="form-control size" id="ExamHours" name="hour"><option value="0">00</option>

              <?php
               $i = 1;
                while($i <=5):
                   echo "<option value=\"".$i."\">".$i."</option>";
                $i+=1;
              endwhile;
              ?>

          </select></div>


        <div class="timeRow"> Minutes <select class="form-control size" id="ExamMins" name="minute"><option value="0">00</option>

                <option value="30">30</option></select></div>
        

        <div class="timeRow"> Seconds  <select class="form-control size" id="ExamSecs" name="second"><option value="0">00</option>
                <option value="30">30</option></select></div>


        <br class="clearAll" />
   </li>

  
 </ul>


   <div class="btn-area" style="margin-top: 10px;">

       <form action="" method="POST">
       <button class="btn btn-lg btn-primary btn-block" id="btn-custom" style="display: none !important;width: 20% !important" >&nbsp;</button>

       <a href="<?=BASE_URL?>/course" class="btn btn-lg btn-primary btn-block" id="btn-custom"  style="display: inline-block !important;width: 40% !important"><u>P</u>revious</a>

       <button class="btn btn-lg btn-primary btn-block" id="btn-custom" name="btn" type="submit" style="display: inline-block !important;width: 40% !important"><u>N</u>ext</button>

           <?php
           if(isset($_SESSION['_SUBJECT_'])):

           $subject = $_SESSION['_SUBJECT_'];

                if(isset($_POST['btn'])):

                    header('location: '.BASE_URL.'/start/'.str_replace(" ","_",strtolower($subject[0])));

                endif;
           endif;
               ?>
           </form>
       </div>

       <div class="clearAll">
            </div>

            </div>

            <div class="clearAll"> &nbsp;</div>

        </div>





        <!-- News Update -->

       

      <!-- Site footer -->
      <hr/>
     
        
          <center><small><a href="/sign-in">Home </a> &nbsp; copyright 2015</small> </center>
        </div>
    </div> <!-- /container -->


  </body>
</html>
