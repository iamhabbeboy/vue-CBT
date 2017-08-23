<?php
  //exampractise classes
  //include 'include.php';
   class Exam
   {

       static $connection;

       public function __construct()
       {
           try {
               self::$connection = new PDO("mysql:host=localhost;dbname=megafuse", "root", "");
               //print "connected !";
               self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           } catch (PDOException $e) {
               
               print $e->getMessage() . ' Unable to connect';
               
           }
       }

       public function security($data)
       {
           $data = htmlspecialchars($data);
           return $data;
       }

       public function insertQuery($data)
       {
           if (is_array($data)) {
               $surname = filter_var($_POST[$data[0]], FILTER_SANITIZE_STRING);
               $other = filter_var($_POST[$data[1]], FILTER_SANITIZE_STRING);
               $email = filter_var($_POST[$data[2]], FILTER_VALIDATE_EMAIL);
               $user = filter_var($_POST[$data[3]], FILTER_SANITIZE_STRING);
               $pass = base64_encode($_POST[$data[4]]);
               $gender = $_POST[$data[5]];
               $phone = filter_var($_POST[$data[6]], FILTER_SANITIZE_STRING);
               $count = 1;

               if (!filter_var($surname, FILTER_SANITIZE_STRING)) {
                   $errors[] = "<li>* valid char required for surname </li>";
               }

               if (!filter_var($other, FILTER_SANITIZE_STRING)) {
                   $errors[] = "<li>* valid char required for othernames </li>";
               }

               if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                   $errors[] = "<li>* valid email required </li>";
               }

               if (!filter_var($user, FILTER_SANITIZE_STRING)) {
                   $errors[] = "<li>* valid username required</li>";
               }
               if (empty($pass)) {
                   $errors[] = "<li>* password required </li>";
               }

               if (!filter_var($phone, FILTER_SANITIZE_STRING)) {
                   $errors[] = "<li>* valid phone number required</li>";
               }
               if (is_array($errors)) {

                   while (list($key, $value) = each($errors)) {
                       print "<div class='valid'><ul>" . $value . "</ul></div>";
                   }
               } else {
                   $query = 'SELECT * FROM
				  member WHERE  
				  email=? AND
				  username=?';
                   $sql = self::$connection->prepare($query);
                   $sql->bindValue(1, $email, PDO::PARAM_STR);
                   $sql->bindValue(2, $user, PDO::PARAM_STR);
                   $sql->execute();

                   if ($sql->rowCount() > 0) {
                       print "<br/>&nbsp;&nbsp;<font color='red'>&raquo;User already exist ! </font>";
                   } else {
                       #print "row not found !";
                       //$da = NOW();

                       $q = 'INSERT INTO
					 member(surname,other,email,username,password,gender,phone,date_registered,login_count) VALUES(:sur,:other,:email,:user,:pass,:gend,:phone,:dat,:count)';
                       $query2 = self::$connection->prepare($q);

                       $query2->execute(array(':sur' => $surname, ':other' => $other, ':email' => $email, ':user' => $user, ':pass' => $pass, ':gend' => $gender, ':phone' => $phone, ':dat' => date('F d,y h:i:a'), ':count' => $count));
                       $_SESSION['user'] = $user;
                       header('location:p/image');
                   }
               }

           }
       }

       public function addLogin()
       {

       }

       function queryLogin($data)
       {
           $user = self::security($_POST[$data[0]]);
           $pwd = self::security(base64_encode($_POST[$data[1]]));

           if (empty($user)) {
               print "username required";
           } elseif (!filter_var($user, FILTER_SANITIZE_STRING)) {
               print "invalid username !";
           } else if (empty($pwd)) {
               print "password required !";
           } else {

               $query = 'SELECT * FROM
					member WHERE 
					username=? AND password=?';
               $sql = self::$connection->prepare($query);
               $sql->bindValue(1, $user, PDO::PARAM_STR);
               $sql->bindValue(2, $pwd, PDO::PARAM_STR);
               $sql->execute();
               $fetch = $sql->fetch();
               $loginer = $fetch['login_count'] + 1;

               if ($sql->rowCount() == 1) {
                   $update = self::$connection->prepare("UPDATE member SET login_count=?,last_login=? WHERE username=? AND password=?");
                   $update->execute(array($loginer, date('F d,y h:i a'), $user, $pwd));

                   $_SESSION['user'] = $user;
                   header('location:./p/home');
               } else {
                   print "invalid username/password";
               }
           }
       }


       public function adminLogin($data)
       {
           $error = array();
           
           if (is_array($data)) {
               $admin = $_POST[$data[0]];
               $pwd = $_POST[$data[1]];
                
             $query = "SELECT * FROM admin WHERE admin = ? AND pass = ?";
                   $sql = self::$connection->prepare($query);
                   $sql->bindValue(1, $admin, PDO::PARAM_STR);
                   $sql->bindValue(2, $pwd, PDO::PARAM_STR);
                   $sql->execute();

                   if ($sql->rowCount() > 0) {
                       $_SESSION['admin'] = $admin;
                       header('location:../megafuse/home.php');
                       exit;
                   } else {
                       print "<font color=\"red\">invalid details</font>";
                   }
                  
               }
           }



       public function addQuestion($result)
       {


           $subject = self::security($_POST[$result[0]]);
           $ans = self::security($_POST[$result[1]]);
           $quest = self::security($_POST[$result[2]]);
           $a = self::security($_POST[$result[3]]);
           $b = self::security($_POST[$result[4]]);
           $c = self::security($_POST[$result[5]]);
           $d = self::security($_POST[$result[6]]);


           if ($subject == '0') {
               $error[] = "<li> * subject required </li>";
           }
           if ($ans == '0') {
               $error[] = "<li> * answer required </li>";
           }
           if (empty($quest)) {
               $error[] = "<li> * question required </li>";
           }
           if (empty($a)) {
               $error[] = "<li> * option A required </li>";
           }
           if (empty($b)) {
               $error[] = "<li> * option B required </li>";
           }
           if (empty($c)) {
               $error[] = "<li> * option C required </li>";
           }
           if (empty($d)) {
               $error[] = "<li> * option D required </li>";
           }
           if (is_array($error)) {
               print "<ul style=\"color:red;\" type=1>";
               while (list($key, $value) = each($error)) {
                   print $value;
               }
               print "</ul>";
           } else {
               $query = 'SELECT * FROM
					 question WHERE 
					 subject=? AND question=?';
               $sql = self::$connection->prepare($query);
               $sql->bindValue(1, $subject, PDO::PARAM_STR);
               $sql->bindValue(2, $quest, PDO::PARAM_STR);
               $sql->execute();
               if ($sql->rowCount() > 0) {
                   print "<em><small><font color=\"red\">Question already added </font></small></em>";
               } else {
                   $query2 = 'INSERT INTO question
						  (subject,answer,question,A,B,C,D,date_registered) VALUES(:sub,:ans,:ques,:a,:b,:c,:d,:da)';
                   $sql2 = self::$connection->prepare($query2);
                   $sql2->execute(array(':sub' => $subject, ':ans' => $ans, ':ques' => $quest, ':a' => $a, ':b' => $b, ':c' => $c, ':d' => $d, ':da' => date('F,d Y')));
                   print "<em><small><font color=\"green\">Question inserted successfully </font></small></em>";
               }
           }
       }

       public function addSubject($result)
       {


           $subject = self::security($_POST[$result[0]]);


           if ($subject == ""):

               echo "<font color=\"red\">Field required</font>";
               return false;

           else:
               $query = 'SELECT * FROM
					 exam_addsubject WHERE 
					 subject=?';
               $sql = self::$connection->prepare($query);
               $sql->bindValue(1, $subject, PDO::PARAM_STR);
               $sql->execute();

               if ($sql->rowCount() > 0) {
                   print "<em><small><font color=\"red\">Subject already added </font></small></em>";
               } else {
                   $query2 = 'INSERT INTO exam_addsubject
						  (subject, date_created) VALUES(:sub, :da)';
                   $sql2 = self::$connection->prepare($query2);
                   $sql2->execute(array(':sub' => $subject, ':da' => date('F,d Y')));
                   print "<em><small><font color=\"green\">Subject added successfully </font></small></em>";
               }
           endif;
       }

       public function get_count($data)
       {
           $query = 'SELECT * FROM tmp_answer WHERE username = ?';
           $sql = self::$connection->prepare($query);
           $sql->execute(array($data));
           return $sql->rowCount();
       }

       public function update_info($user)
       {
           $user = addslashes(trim($user));
           $infoQuery = self::$connection->prepare("SELECT * FROM member WHERE username=?");
           $infoQuery->bindValue(1, $user, PDO::PARAM_STR);
           $infoQuery->execute();
           if ($infoQuery->rowCount() > 0) {
               $fetch = $infoQuery->fetchAll();
               return $fetch;
           } else {
               print "No information found !";
           }
       }

       #setting up countdown for exam
       public function countdown($hrs, $mins, $secs)
       {
           if (empty($hrs) and empty($mins) and empty($secs)) {
               return '00hrs 00mins 00secs';
           } else {
               $today = time();
               $countdown = mktime(0, 0, 0, 22, 4, 2014);
               $difference = ($countdown - $today);
               $days = (int)($difference / 86400);
               $hours = (int)($difference / 3600);
               $mins = (int)($difference / 60);
               $secs = (int)($mins / 60);
               return $days . 'days ' . $hours . 'hrs ';
           }
       }

       public function show_result($user)
       {
           #parsing the user current session
           // $user= trim(addslashes($user));
           $query = Exam::$connection->prepare('SELECT * FROM tmp_answer WHERE username=?');
           $query->bindValue(1, $user, PDO::PARAM_STR);
           $query->execute();
           if ($query->rowCount() > 0) {
               #fetching all the rows in table
               $fetch = $query->fetchAll();
               return $fetch;
           } else {
               print "result not found /created !";
           }
       }


       public function count_ans()
       {
           $query = Exam::$connection->query('SELECT * FROM tmp_answer');
           //$query->bindValue(1,$subject,PDO::PARAM_STR);
           $query->execute();

           if ($query->rowCount() > 0) {
               return $query->rowCount();
           } else {
               return "<b>null</b>";
           }
       }

       public function del_qtn($user)
       {
           $query = self::$connection->prepare("DELETE FROM tmp_answer WHERE username=?");
           $query->bindValue(1, $user);
           $query->execute();

       }


       function showLastPractise($user)
       {
           $query = self::$connection->prepare("SELECT * FROM member WHERE username=?");
           $query->execute(array($user));
           $fetch = $query->fetch();
           return $fetch['last_login'];
       }

       public function get_name($name)
       {
           $real_name = explode("_", $name);
           $surname = $real_name[0];
           $sql = self::$connection->prepare("SELECT * FROM studentrecord WHERE surName = ?");
           $sql->execute(array($surname));
           $full_name = $sql->fetch();
           return ucfirst($surname) . ' ' . ucfirst($full_name['firstName']);
       }

       public function get_scores($user)
       {
           $score = 0;
          $sql = self::$connection->prepare("SELECT * FROM tmp_answer WHERE username = ?");
           $sql->execute(array($user));

         if($sql->rowCount() > 0):

              while($ft = $sql->fetch()):

                   if($ft['ans'] == $ft['correct']):
                       $score++;
                  endif;
              endwhile;
          endif;
           return $score.'_'.$sql->rowCount();
       }


       public function get_subject($userID)
       {
           $name = explode("_", $userID);
           $sur = $name[0];
           $key = $name[1];
          $sql = self::$connection->prepare("SELECT * FROM studentrecord WHERE surName = ? AND loginKey = ? ");
           $sql->execute(array($sur, $key));

           if($sql->rowCount() > 0):

               $ft = $sql->fetch();
               return $ft['subject'];
           endif;
       }

       public function get_subject_scores($user, $subject)
       {
          $sub = explode(",", $subject);

           foreach($sub as $key => $value):

               $data = str_replace(' ', '_', $value);
               $d = (substr($data, 0, 1) =='_') ? substr($data, 1, strlen($data)): $data;
            //echo $d;
                $query = self::$connection->prepare("SELECT * FROM tmp_answer WHERE username = ? AND subject = ?");
            $query->execute(array($user, $d));
           endforeach;
       }

   }
		   
	
  ?>