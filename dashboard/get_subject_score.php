<?php
   //error_reporting(0);
  require "../app/include.function.inc";
  require '../app/Render.php';
  
  $render = new Render();
  $render -> load_class('../db/Model');
  $db = new Model();
   
   //$exam = new Exam();
   
   if(isset($_GET['action']) && $_GET['action'] == 'get_num') {
       
   $s = str_replace(' ', '_', $_POST['s']);
   
   $sql = $db -> find_by_id('question', array('subject' => $s));
   
    echo $sql->rowCount();
    
   }else if(isset($_GET['action']) && $_GET['action'] == 'save') {
       
       $s = $_POST['s'];
       $snum = $_POST['snum'];
       $sadd =  $_POST['sadd'];
       
       $sql_query = $db -> find_by_id('qtn_limit', array('subject' => $s));
       
       if ($sql_query->rowCount() > 0) {
           $sql_query_update = $db -> update_by_fields('qtn_limit', 
           array(
           'qtn' => $snum, 'max' => $sadd, '->subject', $s)
           );
           //$sql_query_update->execute(array($snum, $sadd, $s));
           
       } else {
           
           $sql_query_insert = $db ->save_record('qtn_limit',array('subject' => $s, 'qtn' => $snum, 'max' => $sadd));
          //$sql_query_insert->execute(array($s, $snum, $sadd));
          
       }    
      echo '<b>Succeess: </b> set max. question to ['.$sadd.']'; 
      
   }
?>