<?php session_start();
  
 

  print($_SESSION['questions']);
    
    
  /*************** QUERY FOR PAGINATION ****************/
  /*
  $pagination =  $mysql::$mysql->prepare("SELECT * FROM tmp_question WHERE subject=?");
  $pagination->execute(array($subject));
  $rows       = $pagination->rowCount();
  $page       = (isset($_GET['page']) ? (int)$_GET['page'] : 1); 
  $start      = $page - 1;
               
  $query      = $mysql::$mysql->prepare("SELECT * FROM tmp_question WHERE user=? AND subject=? LIMIT $start, 1");
  $query->execute(array($ssid, $subject));

  if($query->rowCount() > 0):
   
       for($i=0;$i<$query->rowCount();$i+=1):
    
            $fetch = $query->fetch();
    
            $query2 = $mysql::$mysql->prepare('SELECT * FROM tmp_answer WHERE
                        subject = ? AND question = ? AND username = ?');
            $query2->execute(array($subject, $fetch['question'], $ssid));
            $check = $query2->fetch();
           
            $c_question = $cbt->get_question($fetch['question']);
            
            $json = array(
                        'id'  => ($start+1), 
                        'qID' => $fetch['question'],
                        'subject' => $c_question, 
                        'A'  => $fetch['A'],
                        'B'  => $fetch['B'],
                        'C'  => $fetch['C'],
                        'D'  => $fetch['D'],
                        'ans'=> $check['ans'],
                        'user' => $ssid
                        )
                        ;               
     
        endfor;
                 else:

                     echo "<h4> No Question Available !";

                endif;
                
         print json_encode($json);
         
         */
  
  