<?php session_start();
 require '../db/Model.php';
 require '../app/misc.php';
 $db = new Model();

 $qid = $_GET['qID'];
 $subject = $_GET['subject'];
 $user = $_SESSION['_matric_no_key'];
 $id = $_GET['id'];
 $_p = '';


 ?>

 <script>
   $(function() {
	   $('.mynav')
       .click(function(e) {
           e.preventDefault()
           var data = parseInt($(this).attr('myid'));
           var myid = parseInt("<?php print $id ?>");
           var current_id = parseInt($(this).attr('cid'));
           $('#current-page').val(data);
           if( myid == current_id ) {
             $(this).css('color', 'orange');
           }

          // console.log(myid + ', '+current_id);

           question_load(data);
       });
   });
 </script>
 <?php


  $d = json_decode($_SESSION['questions']);
  //print $qid;

 foreach($d as $key => $value )
 {
 	$i_d = $value->id;
 	//print $i_d.', '.$id;
 	$confirm = nav_map($db, $user, $i_d);

      if($confirm === 'true' and $i_d !== $id)
      {
        $style = "background: green !important; color: #FFFFFF;border:0px !important;";

      }elseif($confirm === 'false' and $i_d !== $id )
      {
        $style = "background: #FFF !important; color: green;font-weight:bold;";
      } else if ($i_d === $id and $confirm === 'false')
      {
      	$style = "background: black !important; color: green;font-weight:bold;border:0px !important";
      }else if ($i_d === $id and $confirm === 'true')
      {
      	$style = "background: orange !important; color: green;font-weight:bold;border: 0px !important";
      }else
      {
        $style = "";
      }
 	//print $confirm;
     echo "<li><a href=\"#\" class=\"mynav\" style='".$style.";border-radius:0px !important' 
     cid = '".$i_d."' myid =\"".$key." \">".($key+1)."
               </a></li>";
 }
