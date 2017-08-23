<?php session_start();

  require '../app/Render.php';
  $render = new Render();
  $render -> load_class('../db/Model');
  $db = new Model();


  if(isset($_GET['action']) and ($_GET['action'] == 'login')) {

      $surname = $_GET['surname'];
      $password = $_GET['password'];

      if(!empty($surname) and !(empty($password))) {


         $sql = $db -> find_by_fields('studentrecord',
         array('surname' => $surname, '&loginkey' => $password ));

          //print 'loggedin';
           if($sql ->rowCount() > 0 ) {

                 $sql2 = $db -> find_by_fields('studentlog',
                 array('loginkey' => $password));
                 $fields = $sql2 -> fetch();
				 $count = $fields['count']+1;

                 if ($fields['status'] === 'logged' )
                 {
                 	   $m = $password;
					  $serve = $db -> update_by_fields('studentlog',
					  array('count' => $count,
        '->loginkey' => $m));
                     $_SESSION['_matric_no_key'] = $password;
                     $_SESSION['page'] = 'confirm';
                     print 'loggedin';

                 } elseif ($fields['status'] === 'complete')
                 {

                      print 'complete';

                 } else {

                    $_SESSION['_matric_no_key'] = $password;
                     $_SESSION['page'] = 'confirm';

                    $save = $db -> save_record('studentlog', array('loginkey' => $_SESSION['_matric_no_key'],
                     'status' => 'logged','count' => $count, 'datetime' => date('d-m-y H:i')));
                    print 'loggedin';

                 }


           } else {

               print 'invalid';
           }

      } else {

          print 'error_occured';
      }
  } else if(isset($_GET['action']) and ($_GET['action'] == 'signout') ) {

      //sleep(2);

      $mat = $_SESSION['_matric_no_key'];
      $ukey = $_GET['matric'];
      $_SESSION['page'] = 'confirm';

       $sql = $db -> update_by_fields('studentlog', array('status' => 'complete',
       ',count' => '0', '->loginkey' => $mat));

      if($mat == $ukey) {

          unset($_SESSION['_matric_no_key']);
          unset($_SESSION['questions']);
          unset($_SESSION['page']);

          print "logout";
      } else {

          unset($_SESSION['_matric_no_key']);
          print "logout";
      }
  } else if(isset($_GET['action']) and ($_GET['action'] == 'start') ) {

  	  unset($_SESSION['submit']);
      $_SESSION['page'] = 'start';
      //$ukey = $_GET['_matric_no_key'];
      $sql = $db -> find_by_fields('studentrecord', array('loginkey' => $_SESSION['_matric_no_key']));
      $ft = $sql->fetch();
      $_SESSION['subject'] = $ft['subject'];
      $data = array();
      $sql1 = $db ->find_by_sql('SELECT * FROM question WHERE subject = "'. $ft['subject']. '" ORDER BY RAND() LIMIT 50');
      while($subj = $sql1 -> fetch()):
         $data[] = $subj;
      endwhile;
      $_SESSION['questions'] = json_encode($data);
      print $_SESSION['page'];
  }
