<?php
 /*
   Project title: CBT
   Programmer: Abiodun Solomon <elitecode>
   Date: 06/07/2015
   Version: 0.0.1
 */
 


namespace connect;
 
//use \Predis\Client; 
use \connect\Mysql;

class Cbt{
    
    
    public function resizeimg($width, $height, $target)
    {
        if($width > $height)
        {
            $percent  = ($target / $width);
        }
        else
        {
            $percent = ($target/$height);
        }

        $width = round($width * $percent);
        $height = round($height * $percent);

        return 'width="'.$width.'" height="'.$height.'"';
    }
    
    public function getStudentImage($field, $id, $retrieve) {
        
        $mysql = new Mysql();
        
         $sql = $mysql::$mysql->prepare("SELECT * FROM studentrecord WHERE ".$field." = ?");
         $sql->execute(array($id));
        
          if($sql->rowCount() > 0):
              
              $ft = $sql->fetch();
              
               return $ft[$retrieve];
          endif;
    }
    
    public function delStudent($id) {
        
        $mysql = new Mysql();
        $query = $mysql::$mysql->prepare("SELECT * FROM studentrecord WHERE id=?");
        $query->execute(array($id));
        
         if($query->rowCount() > 0) {
             
              $ft = $query->fetch();
              $img = $ft['photo'];
             
              unlink($img);
             
             $qty = $mysql::$mysql->prepare("DELETE FROM studentrecord WHERE id=?");
             $qty->execute(array($id));
             
              
         }
    }
    
    public function totalqtn($subject) {
        
        $mysql = new Mysql();
        $query = $mysql::$mysql->prepare("SELECT * FROM question WHERE subject=?");
        $query->execute(array($subject));
        
        return $query->rowCount();
    }
    
    public function setTime($h, $m, $s) {
        
        $mysql = new Mysql();
        if($h == '00' && $m =='00' && $s == '00'):
            
          echo "<font color=\"red\">Atleast two field required</font>";
          return false;
        else:
            
           $query = $mysql::$mysql->prepare("SELECT * FROM practiseTime");
           $query->execute();
        
            if($query->rowCount() > 0) {
                
                $qty = $mysql::$mysql->prepare("UPDATE practiseTime SET hour =? , minute = ?, second =? , datetime = ?");
                $qty->execute(array($h, $m, $s, date('d-m-y h:ia')));
                
                echo "<font color=\"green\">Time Set Successfully !</font>";
                
            } else {
                
                  $qty = $mysql::$mysql->prepare("INSERT INTO practiseTime(hour, minute, second, datetime) VALUES(?, ?, ?, ?)");
                $qty->execute(array($h, $m, $s, date('d-m-y h:ia')));
                
                echo "<font color=\"green\">Time Set Successfully !</font>";
            }
         endif;
    }
    
    public function showTime() {
        
        $mysql = new Mysql();
        $query = $mysql::$mysql->query("SELECT * FROM practisetime ORDER BY id DESC");
        
         if($query->rowCount() > 0) {
             
              $ft = $query->fetchAll();
                return $ft;
             
         } else {
             
             return 'Not set';
         }
    }
    
    public function setQuestion($user, $subject) {
        

       $mysql = new Mysql();
       $subj = explode(',', str_replace(' ','_',$subject));
     
       $subject1 = self::cbt_check($subj[0]);
       $subject2 = self::cbt_check($subj[1]);
       $subject3 = self::cbt_check($subj[2]);
       $subject4 = self::cbt_check($subj[3]);      
	   $check_subject = 
	   					str_replace(' ', '_', $subject);	
			   
          $query = $mysql::$mysql->prepare("SELECT * FROM question WHERE subject = ? OR subject=? OR subject=? OR subject=?");
          $query->execute(array($subject1, $subject2, $subject3, $subject4));
        
       $row = $query->rowCount();
        
        $sql = $mysql::$mysql->prepare("SELECT * FROM tmp_answer WHERE username = ? AND subject = ? ");
        $sql->execute(array($user, $check_subject));
		
		
		 if($sql->rowCount() > 0) {
		 	
			// echo "Record Exists";
			 
		 } else {
        
            while($ft = $query->fetch()):
            //loop to recycle question          
                 
                $query1 = $mysql::$mysql->prepare("INSERT INTO tmp_answer(subject, correct, username, question) VALUES(?, ?, ?, ?)");
                $query1->execute(array($ft['subject'], $ft['answer'], $user, $ft['question']));
                
                // inserting into temporary table...
                    $qtn_tmp1 = $mysql::$mysql->prepare("INSERT INTO tmp_question(user, subject, answer, question, A, B, C, D, date_registered)
                     VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    
                $qtn_tmp1->execute(array($user, $ft['subject'], $ft['answer'], $ft['question'], $ft['A'], $ft['B'], $ft['C'], $ft['D'], date('d-m-y h:ia')));
  
         
            
            endwhile;

            $_SESSION['_save_'] = 'question_added';
			
			
		 }
    }
                                                            
    public function cbt_check($subject) {
        
        return $subject;
    }

    public function change_question_status($subject, $username) {

        $mysql = new Mysql();
        $sql = $mysql::$mysql->prepare("SELECT * FROM tmp_answer WHERE subject = ? AND username = ?");
        $sql->execute(array($subject, $username));
        $record = $sql->fetchAll();
    return $record;
    }

    public function get_t($t) {

        $mysql = new Mysql();

        $sql = $mysql::$mysql->query("SELECT * FROM practisetime ORDER BY id LIMIT 1");

        if($sql->rowCount() > 0):

            $time = $sql->fetch();
            return $time[$t];

        else :

            header('location: ./');

        endif;
    }

   public function save_quiz_time($u) {
   	
	  $mysql = 
	   		  new Mysql();
	   $d = 
	       date('d-m-y h:ia');
		$sql2 = 
				//$mysql::$mysql->prepare("SELECT * FROM practisetime");
	   $sql = 
	   		 $mysql::$mysql->query("INSERT INTO countdown(username, countdown, date) VALUES(?, ?, ?)");
	   $sql->execute(array($u, $c, $d));
	   
   }
   
   public function update_user_log($u_user) {
   	
		$mysql = new Mysql();
		$sql = $mysql::$mysql
		->prepare("SELECT * FROM studentlog WHERE loginkey = ?");
		$sql->execute(array($u_user));
		
		 if($sql->rowCount() > 0) {
		 	
			  $query = $mysql::$mysql
			  ->prepare("UPDATE studentlog SET status = ?, datetime = ? WHERE loginkey = ?");
			 $query->execute(array('completed', date('d-m-y h:ia'), $u_user));
			 
			 //delete time from table
			 $countdown_track = $mysql::$mysql
			 ->prepare("DELETE FROM countdown WHERE loginkey = ? ");
			 $countdown_track->execute(array($u_user));
		 } else {
		 	
			  $query = $mysql::$mysql
			  ->prepare("INSERT INTO studentlog(loginkey, status, datetime) VALUES(?, ?, ?)");
			 $query->execute(array($u_user, 'completed', date('d-m-y h:ia')));
		 }
   }
   
   public function save_current_time($u_user, $time) {
   		
		
		$mysql = new Mysql();
		$sql = $mysql::$mysql
		->prepare("SELECT * FROM countdown WHERE loginkey = ?");
		$sql->execute(array($u_user));
		
		if($sql->rowCount() > 0) {
								
			 $query =  $mysql::$mysql->prepare("UPDATE countdown SET countdown = ?, date = ? WHERE loginkey = ?");
			 $query->execute(array($time, date('d-m-y h:ia'), $u_user));
			 
		} else {
					
			  $mysql->insert('countdown', array('loginkey' => $u_user, 'countdown' => $time, 'date' => date('d-m-y h:ia')));
		}
   }

   public function get_current_time($u_user) {
   			
   		$mysql =  new Mysql();
		$sql = $mysql::$mysql->prepare("SELECT * FROM countdown WHERE loginkey = ?");
		$sql->execute(array($u_user));
		
		if($sql->rowCount() > 0) {
				
			$data = $sql->fetch();
			
			return $data['countdown'];	
		}
			
   	
   }

   public function get_question($subject) {
       
       $mysql = new Mysql();
       
       $sql = $mysql::$mysql->prepare('SELECT * FROM question WHERE id = ?');
       $sql->execute(array($subject));
       
        if($sql->rowCount() > 0) {
            
            $ft = $sql->fetch();
            return $ft['question'];
        }
   }
    
   public function get_status($user) {
               
      $mysql = new Mysql();     
      $sql   = $mysql::$mysql->prepare("SELECT * FROM countdown WHERE loginkey = ?");
      $sql->execute(array($user));
      
       if($sql->rowCount() > 0) {
           $ft = $sql->fetch();
           $status = $ft['status'];
           
            if($status == 'login') {
                return 'login';
            }else {
                return 'completed';
            }
       }    
   } 
    
   public function get_options_ajax($get_id) {
       
       $mysql = new Mysql();
       $query = $mysql::$mysql->prepare("SELECT * FROM question WHERE id = ?");
       $query->execute(array($get_id));
       $data = array();
       
       if($query->rowCount() > 0 ) {
           
           while($fet = $query->fetch()) {
                
              $data[] = array(
                            'A' => $fet['A'], 
                            'B' => $fet['B'],
                            'C' => $fet['C'],
                            'D' => $fet['D'],
                            'ans' => $fet['answer']
                            )
                            ;       
           }
       } else {
           
           echo 'No Options Found !';
       }
       
       return json_encode($data);
   } 
    
   public function convert_ssid_number($ssid) {
       
       $mysql = new Mysql();
       
       $sql = $mysql::$mysql->prepare("SELECT * FROM studentrecord WHERE surName = ?");
       $sql->execute(array($ssid));
       
       if($sql->rowCount() > 0) {
           
           $fet = $sql->fetch();
           return $fet['loginkey'];
       }else {
           echo $ssid;
       }
   } 
   
   public static function max_subject_count($subject) {
       
       $mysql = new Mysql();
       
       $query_check = $mysql::$mysql->prepare("SELECT * FROM qtn_limit WHERE SUBJECT = ?" );
       $query_check->execute(array($subject));
       
       if($query_check->rowCount() > 0) {
           
            $ft = $query_check->fetch();
            return $ft['max'];
       }else {
           
           return 0;
       }
   }
 
   public static function student_log($action, $u_key) {
       
       $mysql = new Mysql();
       
       if($action == 'null'){
       $query = $mysql::$mysql
       ->prepare("SELECT * FROM studentlog WHERE loginkey = ?");
       $query->execute(array($u_key));

        if($query->rowCount() > 0) {
                            
            $ft = $query->fetch();
                            
                return $ft['status'];
         } else {
                 
              return 'insert';
         }              
       } else {
           
            $mysql->insert('studentlog', 
                       array('loginkey' => $u_key, 
                       'status' => 'login', 
                        'datetime' => date('d-m-y h:ia'))
                        );
                 return 'log_insert';                  
       }
   }

   public static function authenticate($user) {
       
       $mysql = new Mysql();
       $str = explode('_', $user);
       $u = $str[0];
       $k = $str[1];
       
       $sql = $mysql::$mysql
       ->prepare("SELECT * FROM studentrecord WHERE surName=? AND loginkey=?");
       $sql->execute(array($u, $k));
          
            if($sql->rowCount() > 0) {
         
                 return true;
                 
            }else{
                
                return false;
            }          
   }
   
   
   
   
}