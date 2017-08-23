<?php session_start();
/**
 * Created by PhpStorm.
 * User: Azeez Abiodun
 * Date: 6/12/2015
 * Time: 8:54 AM
 */

include "../app/setup.php";
include "../db/Model.php";
include "../app/misc.php";
$db = new Model();

 
 $sub = $_GET['subject'];
 $_opt  = $_GET['opt'];
 $_qtn     = $_GET['qtn'];
 $user    = $_SESSION['_matric_no_key'];
 $time   = date('d-m-y H:i');
 $correct = get_answer($db, $_qtn);
 
  print $sub.', '. $_opt.', '.$_qtn;
  
  
  $data = $db ->find_by_fields('tmp_answer', 
  array('subject' => $sub, '&username' => $user, '&question' => $_qtn ));

  
      
    if ( $data -> rowCount() > 0 ) {
     
         $sql2 = $db ->update_by_fields('tmp_answer', 
         array('ans' => $_opt, ',date' => $time, '->question' => $_qtn ));
          
		   print 'update';
		   
    } else {
      
      $sql = $db->save_record('tmp_answer', 
      array('subject' => $sub, 'ans' => $_opt, 'correct' => $correct,
       'username' => $user, 'date' => $time, 'question' => $_qtn ) );
      
	   print 'insert';
 
   }   
/*
  if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
      
      $user = $_SESSION['_matric_no_key'];
      $_opt = $_GET['opt'];
      $_qtn = $_GET['qtn'];
      $sub  = $_GET['subject'];
      $time = date('d-m-y H:i');
      //print $_opt.' ';
      
      $data = $db ->find_by_fields('tmp_answer', array('subject' => $sub, '&username' => $user, '&question' => $_qtn ));

      
    if ( $data -> rowCount() > 0 ) {
        
         /*$sql2 = $db ->find_by_sql("UPDATE tmp_answer SET ans ='". $_opt."', date = '".date('d-m-y h:i a')."' WHERE question = '".$_qtn. "'");

         $sql2 = $db ->update_by_fields('tmp_answer', array('ans' => $_opt, ',date' => $time, '->question' => $_qtn ));
         //print 'updated '.$sql2->rowCount();
         $dt = array();
		   while($ft = $data -> fetch()) {
		   	 $dt[] = $ft;
		   }
		   //print $_SESSION['tmp_answers'] = json_encode($dt); 
		   print 'success';
         
    } else {
      
      $sql = $db->save_record('tmp_answer', array('subject' => $sub, 'ans' => $_opt, 'username' => $user, 'date' => $time, 'question' => $_qtn ) );
      
      
      $dt = array('subject' => $sub, 'ans'=> $_opt,
       'username'=>$user, 'date'=> $time, 'question' => $_qtn);
	   print 'success';
 
   }


  }

 if($_SERVER['REQUEST_METHOD'] == "POST"):

  $answer = $_POST['data'];
  $str_subject = (substr($_GET['subject'], 0, 1) == '_') ? substr($_GET['subject'], 1, strlen($_GET['subject'])) : $_GET['subject'];
  $question = trim($_POST['qtn']);

  //$user = $_SESSION['studentLoggedIn'].'_'.$_SESSION['key'];
  $user = $_SESSION['_matric_no_key'];

  $subject = str_replace(' ', '', $str_subject);
    // echo htmlspecialchars($question);
      
       
      $query = $mysql::$mysql->prepare('SELECT * FROM question WHERE  subject = ? AND id = ?');
      $query->execute(array($subject, $question));
      $ans = $query->fetch();

      if($query->rowCount() > 0) {

          /********************** CHECKING TMP_ANSWER TABLE FOR EXISTING ROW ******************


          $insert = $mysql::$mysql->prepare('SELECT * FROM tmp_answer WHERE subject=? AND question=? AND username=? AND correct=?');
          $insert->execute(array($subject, $question, $user, $ans['answer']));

          if($insert->rowCount() > 0){

              /********************** CHECKING ANSWER TABLE FOR EXISTING ROW ******************

            $answer_table = $mysql::$mysql->prepare("SELECT * FROM answer WHERE subject = ? AND question = ? AND username = ? ");
              $answer_table->execute(array( $subject, $question, $user));

              if($answer_table->rowCount() > 0) {

                 $answer_table1 = $mysql::$mysql->prepare("UPDATE answer SET ans = ? WHERE subject = ? AND question = ? AND username = ? AND date = ?");
                  $answer_table1->execute(array($answer, $subject, $question, $user, date('d-m-y')));

              } else {

                  $mysql->insert('answer',
                      array(
                          'subject' => $subject,
                          'question' => $question,
                          'ans' => $answer,
                          'correct' => $ans['answer'],
                          'username' => $user,
                          'date' => date('d-m-y')
                      ));
              }

              $inserter2 = $mysql::$mysql->prepare('UPDATE tmp_answer SET ans = ?, date =?  WHERE subject=? AND question=? AND username = ?');
              $inserter2->execute(array($answer, date('d-m-y'), $subject, $question, $user));

               echo $answer.", ".$subject.", ".$question.", ".$user;
               print 'update';

          }

      }else{

          print "not found !!!";
          #sprint $subject.', '.$answer;
      }

   endif;
*/