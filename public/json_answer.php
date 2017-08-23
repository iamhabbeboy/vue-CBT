<?php session_start();

 require "../app/Render.php";
 
$render = new Render();
$render->load_class('../db/Model');
$db = new Model();

  //$ssid    = $_SESSION['studentLoggedIn'].'_'.$_SESSION['key'];
  $ssid = $_SESSION['_matric_no_key'];
  
  // to confirm if record available in tmp "answer table"
  $sql = $db -> find_by_fields('tmp_answer', array('username' => $ssid));
  $rows = $sql -> rowCount();

    if ($rows > 0 ) 
    {
        $_i = array();
          while($fetch = $sql ->fetch() ) {

            $_i[] = $fetch;
          }

          $data = json_encode($_i);

          $_SESSION['tmp_answers'] = $data;

          print $_SESSION['tmp_answers'];

    } else 
    {
		$data = array(
			'subject' => '',
			'ans' => '',
			'correct' => '',
			'username' => '',
			'date' => '',
			'question' => ''
		);
		
		print $_SESSION['tmp_answers'] = json_encode($data);
    } 