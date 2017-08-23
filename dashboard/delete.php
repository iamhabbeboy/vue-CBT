<?php require '../config/exam.php';
  $exam = new Exam();
  
  #fetching data supplied
  
 if(isset($_GET['id'])) {
     
	 $getid = addslashes($_GET['id']); 

	   $query = Exam::$connection->prepare("DELETE FROM question WHERE id=?");
	   //$query->bindValue(1,$getid);
	   $query->execute(array($getid));
	   header('location:view_more.php?id='.$_GET['getid']);
	 }
	 else{
	   header('404 error');
	   exit;
	 }
?>