<?php session_start();

 require "../app/Render.php";
 
$render = new Render();
$render->load_class('../db/Model');
$db = new Model();
//$render -> load_class('app/misc');

if ( isset($_GET['action']) and $_GET['action'] === 'save' ) 
{
	$ssid  = $_SESSION['_matric_no_key'];
	$hours = $_GET['h'];
	$mins  = $_GET['m'];
	$secs  = $_GET['s'];
	$_comb = $hours. ':' . $mins. ':' . $secs;
	$date  = date('d-m-y H:i');
	$data = array();

	$sql = $db ->find_by_fields('countdown', array('loginkey' => $ssid));

	$rows = $sql -> rowCount();

	  if ($rows > 0 ) {

	  	  $sql2 = $db -> update_by_fields('countdown', array('countdown' => $_comb, ',date' => $date, '->loginkey' => $ssid));
	  	  //print 'update '.$ssid.' '.$_comb;
	  	  $data[] = array('h' => $hours, 'm' => $mins, 's' => $secs);

	  } else {

	  	 //insert new count series

	  	 $sql2 = $db -> save_record('countdown', array('loginkey' => $ssid, 'countdown' => $_comb, 'date' => $date));
	  	 //print 'insert '.$ssid.' '. $_comb;
	  	 $data[] = array('error' => 'insert');

	  }

	  print json_encode($data);

} else if (isset($_GET['action']) and $_GET['action'] === 'check')  
{
   $ssid = $_SESSION['_matric_no_key'];
   $sql = $db -> find_by_fields('countdown', array('loginkey' => $ssid));

   if($sql-> rowCount() > 0){
	   $r = $sql -> fetch();
	   print $r['countdown'];
   } else {
   	 
   }
   
   
} else if (isset($_GET['action']) and $_GET['action'] === 'end' )
{
    $s = $db -> update_by_fields('studentlog', array('status' => 'complete',
     '->loginkey' => $_SESSION['_matric_no_key']));
    
	unset($_SESSION['_matric_no_key']);
    unset($_SESSION['questions']);
    unset($_SESSION['page']);
    $_SESSION['submit'] = 'auto';
    header('location:' .BASE_URL );
}

