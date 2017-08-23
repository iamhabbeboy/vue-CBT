<?php session_start();

 //error_reporting(0);
 include "../../configuration/setup.php";
  include "../../configuration/Mysql.php";
  include "../../configuration/CBT.php";
  include "../../configuration/Redis.php";

  
$cbt = new \connect\CBT();
$mysql = new \connect\Mysql();
$redis = new Redis();
$c = $redis->connect();
$h = $cbt->get_t('hour');
$m = $cbt->get_t('minute');
$u_user = $_GET['user'];
$tDate = 0;
    
  if(isset($_SESSION['resume'])) {

     $tDate = $_SESSION['resume'];       
      
      
   } else if ( !isset($_SESSION['resume'] ) ) {
    
        $dateFormat = "d F Y -- g:i a";
        $manual_h =  ($h > 0) ? $h*60 : 0;
        $m_total = $m + $manual_h;
        $targetDate = time() + ($m_total*60);
        $tDate = $targetDate;
   }
   
        $redis_save1 = $u_user.'_'.$tDate.'_'.date('d-m-y h:ia');
        $redis->save($u_user, $redis_save1);
        
  if(!isset($_SESSION['start_time'])){ $_SESSION['start_time'] = $tDate;}
        $actualDate = time();
        $secondsDiff = $_SESSION['start_time'] - $actualDate;
        $value1 = (isset($_GET['subject']) ? $_GET['subject'] : '');
  
          $redis_save1 = $u_user.'_'.$_SESSION['start_time'].'_'.date('d-m-y h:ia');
          $redis->save($u_user, $redis_save1);
         
        $secondsDiff = $secondsDiff;
              $remainingDay   = floor($secondsDiff/60/60/24);
              $remainingHour= floor(($secondsDiff-($remainingDay*60*60*24))/60/60);
             $remainingMinutes = floor(($secondsDiff-($remainingDay*60*60*24)-($remainingHour*60*60))/60);
             $remainingSeconds = floor(($secondsDiff-($remainingDay*60*60*24)-($remainingHour*60*60))-($remainingMinutes*60));


              //$days = $remainingDay;
              $hours = $remainingHour;
              $minutes = $remainingMinutes;
              $seconds = $remainingSeconds;
              $callback = [];  

                  $seconds--;

                  if ($seconds < 0){
                      $minutes--;
                      $seconds = 59;
                  }
                  if ($minutes < 0){
                      $hours--;
                      $minutes = 59;
                  }
                  if ($hours < 0){
                      //$days--;
                      $hours = 0;

                  } else if($hours == 0 && $minutes < 10){

                     $color = array( 'color' => '#993300' );
                     array_push($callback, $color);
                  } else if( $hours > $h) {
                      
                      $hours = $h;
                      $minutes = $m;
                  }

              
                  $time = (($hours < 1) ? '0'.$hours : $hours)." : ".(($minutes < 10) ? '0'.$minutes : $minutes)." : ".(($seconds < 10) ? '0'.$seconds: $seconds);
                    
                    array_push($callback, array('time' => $time));
                    
                  if ($minutes == '00' && $seconds == '00') { $seconds = "00"; 
                 
                     $timeout = 'timeup';
                     array_push($callback, array('timeup' => $timeout));
                  }

              echo json_encode($callback);
   