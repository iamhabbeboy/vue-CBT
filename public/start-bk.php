<?php session_start();
  ob_start();
  error_reporting(0);

 /* Configuration file
 ===========================================================
    file containing the source of styles, JS, etc.

 */

  #include "../../configuration/Cache.php";	 	 
    $link = "about"; // navigation purpose
  include "../../configuration/setup.php";
  include "../../configuration/Mysql.php";
  include "../../configuration/CBT.php";
 
  $page = "start_page";
  
$cbt = new \connect\CBT();
$mysql = new \connect\Mysql();


if(!isset($_SESSION['_SUBJECT_'])) {

    header('location: '.BASE_URL.'/course');
}

  $session_subject = $_SESSION['_SUBJECT_'];

  $_SESSION['_START_'] = 'practise_start';

 if(!isset($_GET['subject'])):
    
    header('location: '.BASE_URL.'/sign-out');
endif;

$key = $_SESSION['key'];

 $ppage = "start";
  $u_user = $_SESSION['studentLoggedIn'].'_'.$_SESSION['key'];
  
  
if(isset($_SESSION['resume'])) {

	 $tDate = $cbt->get_current_time($u_user);	
 	
 } else {
	
	$dateFormat = "d F Y -- g:i a";
	$h = $cbt->get_t('hour');
	$m = $cbt->get_t('minute');
	$manual_h =  ($h > 0) ? $h*60 : 0;
	$m_total = $m + $manual_h;
	$targetDate = time() + ($m_total*60);
	$tDate = $targetDate;	
 }

	$cbt->save_current_time($u_user, $tDate);
	
	if(!isset($_SESSION['start_time'])){ $_SESSION['start_time'] = $tDate;}
		$actualDate = time();
		$secondsDiff = $_SESSION['start_time'] - $actualDate;
		
	
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="We offer best CBT platformt and other I.T services such as web development and sofware training, networking training and deployment.">
    <meta name="author" content="Megafuse Technologies">
    <link rel="icon" href="<?=_ICON_?>/logo.ico">
    <title>Start Test :: CBT </title>
      <?php

  

      include "../../configuration/houserent-JSLibs.php";

        $value1 = (isset($_GET['subject']) ? $_GET['subject'] : '');
      ?>


          <script type="text/javascript">

              var secondsDiff = <?=$secondsDiff?>;
              var remainingDay     = Math.floor(secondsDiff/60/60/24);
              var remainingHour    =  Math.floor((secondsDiff-(remainingDay*60*60*24))/60/60);
              var remainingMinutes = Math.floor((secondsDiff-(remainingDay*60*60*24)-(remainingHour*60*60))/60);
              var remainingSeconds = Math.floor((secondsDiff-(remainingDay*60*60*24)-(remainingHour*60*60))-(remainingMinutes*60));

              var days = remainingDay;
              var hours = remainingHour;
              var minutes = remainingMinutes;
              var seconds = remainingSeconds;


              function setCountDown ()
              {
                  var count = document.getElementById("remain")
                  seconds--;

                  if (seconds < 0){
                      minutes--;
                      seconds = 59
                  }
                  if (minutes < 0){
                      hours--;
                      minutes = 59
                  }
                  if (hours < 0){
                      days--;
                      hours = 23

                  } else if(hours == 0 && minutes < 10){

                     count.style.color = '#993300'
                  }

              
                  count.innerHTML = ((hours < 1) ? '0'+hours : hours)+" : "+((minutes < 10) ? '0'+minutes : minutes)+" : "+((seconds < 10) ? '0'+seconds: seconds);
                  SD=window.setTimeout( "setCountDown()", 1000 );
                  if (minutes == '00' && seconds == '00') { seconds = "00"; window.clearTimeout(SD);
                      //window.alert("Time is up. Press OK to continue."); // change timeout message as required
                      window.location = "<?=BASE_URL?>/completed" // Add your redirect url
                  }

              }


          $(function() {

              $('input[name=option]').change(function () {

                  var data = $(this).val();
                  var qtn = $('#question').val();
                  var subject = "<?=$value1?>";
                  var url = "<?=BASE_URL."/cbtUI/UIDesign/ajax-ans.php" ?>";

                  //$('.showstuff').html('<em><small>loading....</small></em>');
                  console.log('loading......');

                      $.ajax({
                      url: url + '?subject=' + subject,
                      data: {'data': data, 'qtn': qtn},
                      type: 'post',
                      cache: false, 
                      success: function (html) {
                      console.log(html);
                  }
                  })
                  
              });

              function optionSubmit(t) {

                  var data = t.val();
                  var qtn = $('#question').val();
                  var subject = "<?=$value1?>";
                  var url = "<?=BASE_URL."/cbtUI/UIDesign/ajax-ans.php" ?>";

                  //$('.showstuff').html('<em><small>loading....</small></em>');
                  console.log('loading......');

                  $.post(url + '?subject=' + subject, {'data': data, 'qtn': qtn}, function (html) {

                      console.log(html);
                  });
              }

              $('body').keypress(function(e) {

                  if(e.which == 97) {

                      $('#optionA').attr('checked','checked');
                      var val = $('#optionA');
                      optionSubmit(val);

                  } else if(e.which == 98) {
                      var val = $('#optionB');
                      $('#optionB').attr('checked','checked');
                      optionSubmit(val);

                  }else if(e.which == 99) {
                      var val = $('#optionC');
                      $('#optionC').attr('checked','checked');
                      optionSubmit(val);

                  } else if(e.which == 100) {
                      var val = $('#optionD');
                      $('#optionD').attr('checked','checked');
                      optionSubmit(val);

                  } else if(e.which == 39) {


                  } else if(e.which == 37) {


                  }

              })
          });

              function notice() {

                  var d = confirm("Are you sure you want to end test ?")

                   if(d == true)
                   {
                       window.location = "<?=BASE_URL?>/completed"

                   } else {

                       return false
                   }
              }
      </script>
  </head>

  <body onload="setCountDown()">

    

       <?php

         include "min-header.php";



       ?>



        <div class="houserent-browse" >



            <div class="houserent-show" >

              

            <div class="alert alert-success" role="alert">

                        <div class="alert alert-danger" role="alert" style="background: #265a88 !important;">
                <ul class="nav nav-tabs">

                    <?php

                     $hh = date("h");
                    $h = $cbt->get_t('hour');
                    $m = $cbt->get_t('minute');
                     //echo date("d F Y -- H:i a");

                    //echo $dateFormat.' '.($h+$hh).' '.$m;


             if(isset($_SESSION['_SUBJECT_'])):

                 $subject = explode(',', $_SESSION['_SUBJECT_']);
                 $get_subject = str_replace('_',' ', $_GET['subject']);
                 for($i=0;$i<count($subject);$i+=1):

                     $sub = strtolower($subject[$i]);
                     echo "<li role=\"presentation\" ".((isset($_GET['subject']) && $get_subject == $sub) ? "class=\"active\"" : " ")."><a href=\"".BASE_URL."/start-ie/".str_replace(" ","_", $sub)."\" ><b>".strtoupper($subject[$i])."</b></a></li>";

                 endfor;

             else:

                 header('location: '.BASE_URL.'/course');

             endif;
             ?>
</ul>
                </div>                
                <br/>

                <?php

                /**
                 * @ for pagination....
                 */
                $ssid = $_SESSION['studentLoggedIn'].'_'.$_SESSION['key'];
                $main_id = explode('_', $_GET['subject']);
                $subject = ($main_id[0] == '') ? substr($_GET['subject'], 1, strlen($_GET['subject'])) : $_GET['subject'];
                 

                $pagination =  $mysql::$mysql->prepare("SELECT * FROM tmp_question WHERE subject=?");
                $pagination->execute(array($subject));
                $rows = $pagination->rowCount();
                 $page = (isset($_GET['page']) ? (int)$_GET['page'] : 1);

                 $start = $page - 1;
                //$start = (!intval($page) ? header('location: '.BASE_URL.'/course') : $page - 1 );

                /**
                 *  this display the question......
                 */
                $query = $mysql::$mysql->prepare("SELECT * FROM tmp_question WHERE user=? AND subject=? LIMIT $start, 1");
                $query->execute(array($ssid, $subject));

                 if($query->rowCount() > 0):


                     for($i=0;$i<$query->rowCount();$i+=1):

                     $fetch = $query->fetch();

                         $query2 = $mysql::$mysql->prepare('SELECT * FROM tmp_answer WHERE subject = ? AND question = ? AND username = ?');
                         $query2->execute(array($subject, $fetch['question'], $ssid));

                         $check = $query2->fetch();

                     echo "
                     <div class=\"float grey height\" style=\"width:50%\"><h4>(".($page).") ".$cbt->get_question($fetch['question'])."  </h4></div> <div class=\"float margin\" style=\"width: 40%\"><ul class=\"list-group\">";


                         echo "<input type=\"hidden\" name=\"question\" id=\"question\" value=\"".$fetch['question']."\"/>";

                    echo "<li class=\"list-group-item\"><label for=\"optionA\" class=\"sizer\"> <div class=\"optionMenu\">(A) <input type=\"radio\" name=\"option\" value=\"A\" id=\"optionA\"".(($check['ans'] == 'A') ? "checked" : "")."/></div> <div class=\"optionAns\" ".(($check['ans'] == 'A') ? "style=\"color: green\"" : "").">".$fetch['A']."</div><br class=\"clearAll\"/></label></li>";

                         echo "<li class=\"list-group-item\"><label for=\"optionB\" class=\"sizer\"> <div class=\"optionMenu\">(B) <input type=\"radio\" name=\"option\" value=\"B\" id=\"optionB\"".(($check['ans'] == 'B') ? "checked" : "")."/></div> <div class=\"optionAns\" ".(($check['ans'] == 'B') ? "style=\"color: green\"" : "").">".$fetch['B']."</div><br class=\"clearAll\"/></label></li>";

                         echo "<li class=\"list-group-item\"><label for=\"optionC\" class=\"sizer\"> <div class=\"optionMenu\">(C) <input type=\"radio\" name=\"option\" value=\"C\" id=\"optionC\"".(($check['ans'] =='C') ? "checked" : "")."/></div> <div class=\"optionAns\" ".(($check['ans'] == 'C') ? "style=\"color: green\"" : "").">".$fetch['C']."</div><br class=\"clearAll\"/></label></li>";


                         echo "<li class=\"list-group-item\"><label for=\"optionD\" class=\"sizer\"> <div class=\"optionMenu\">(D) <input type=\"radio\" name=\"option\" value=\"D\" id=\"optionD\"".(($check['ans'] == 'D') ? "checked" : "")."/></div> <div class=\"optionAns\" ".(($check['ans'] == 'D') ? "style=\"color: green\"" : "").">".$fetch['D']."</div><br class=\"clearAll\"/></label></li>";


                     endfor;
                 else:

                     echo "<h4> No Question Available !";

                endif;

                             ?>

 </ul>
</div><br style="clear:both;" />
                <div class="showstuff"></div>

   <div style="float:left; width: 75%;">

       <?php

       $url = BASE_URL.'/start-ie/'.$_GET['subject'];
       $u_user = $_SESSION['studentLoggedIn'].'_'.$_SESSION['key'];
       $id = (isset($_GET['page']) ? $_GET['page'] : 0);
       //$cbt->change_question_status($_GET['subject'], $u_user, $id);
       $id = (empty($_GET['page']) ? 0 : $_GET['page']);
       //$data = $cbt->change_question_status($_GET['subject'], $u_user, $id);
          if($rows > 0):
             echo "<ul class=\"pager\">";
//              for($i=0;$i<$rows;$i+=1):
//                    $p = $i+1;
//                  echo "<li><a href=\"".$url."/".($i+1)."\" style=\"".$cbt->change_question_status($_GET['subject'], $u_user, $id, $i)."\" >".($i+1)." <span class=\"sr-only\">(current)</span></a></li>";
//             endfor;
          foreach($cbt->change_question_status($_GET['subject'], $u_user) as $key => $value):
               $k = $key+1;

              if(!empty($value['ans']) && $k == $_GET['page'])
              {
                  $style = "background: orange !important; color: #FFFFFF;border:0px !important;";

              }else if(empty($value['ans']) && $k == $_GET['page'])
              {
                  $style = "background: #993300 !important; color: #FFFFFF;border:0px !important;";

              }elseif(!empty($value['ans']))
              {
                  $style = "background: green !important; color: #FFFFFF;border:0px !important;";
              }
              else
              {
                  $style = "";
              }
              echo "<li><a href=\"".$url."/".($key+1)."\" style=\"".$style."\">".($key+1)." <span class=\"sr-only\">(current)</span></a></li>";
              endforeach;
                echo "</ul>";
          endif;
          
          //var_dump($cbt->change_question_status($_GET['subject'], $u_user));
          //echo $u_user;
       ?>
   </div>
  <div class="btn-area" style="margin-top: 10px; float:left; width: 25%;">



 <?php

        $n = (($page >=$rows) ? $rows : $page+1);
        $p = (($page <= 1) ? 1 : $page-1);

  //echo $n.', '.$p;
         echo "<button class=\"btn btn-lg btn-primary btn-block\" id=\"btn-custom\" type=\"submit\" style=\"display: none !important;width: 20% !important\">&nbsp;</button>";


            echo "<a href=\"".$url.'/'.$p."\" class=\"btn btn-lg btn-primary btn-block\" id=\"btn-custom\" style=\"display: inline-block !important;width: 30% !important\" name=\"prev\"><u>P</u>revious &nbsp;</a> &nbsp;";

      if($page > 99 ):

         
         // echo "<a href=\"".BASE_URL."/start/".$sub."\" class=\"btn btn-lg btn-primary btn-block\" id=\"btn-custom\" type=\"submit\" style=\"display: inline-block !important;width: 30% !important\" name=\"next\">Next Subject</a>";

      else:
             echo "<a href=\"".$url.'/'.$n."\" class=\"btn btn-lg btn-primary btn-block\" id=\"btn-custom\" type=\"submit\" style=\"display: inline-block !important;width: 30% !important\" name=\"next\"><u>N</u>ext</a>";
      endif;

             ?>

      <script>

          $(function() {
              $('body').keypress(function (e) {

                  if(e.which == 110) {

                      window.location = "<?=$url."/".$n?>";

                  } else if(e.which == 112) {

                      window.location = "<?=$url."/".$p?>";

                  } else if(e.which == 101) {

                      var conf = window.confirm("Are you sure you want to end the test ?")
                        if(conf == true) {
                            window.location = "<?=BASE_URL."/sign-out" ?>";
                        } else {

                        }

                  }
                  });
          });
      </script>
       </div>

       <div class="clearAll">&nbsp;
            </div>


            </div>
 <center><small><a href="#">Home </a> &nbsp; copyright 2015. <a href="#">&copy; MegaFuse Technologies</a></small> </center>
        </div>

         
        </div>
    

  </body>
</html>

<?php
   #include "../../configuration/Cache2.php";
?>
