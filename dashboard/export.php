<?php
require '../db/Model.php';
include "../app/exam.php";
//$exam = new Exam();
$db = new Model();
$subject = $_GET['subject'];
$depart = $_GET['depart'];


function get_scores($db, $user)
{
    $score = 0;
   $sql = $db->find_by_sql("SELECT * FROM tmp_answer WHERE username = '{$user}'");
    //$sql->execute(array($user));

  if($sql->rowCount() > 0):

       while($ft = $sql->fetch()):

            if($ft['ans'] == $ft['correct']):
                $score++;
           endif;
       endwhile;
   endif;
    return $score.'_'.$sql->rowCount();
}


if ( $depart == '0')
{

  header('Content-type: application/vnd-ms-excel');
  header('Content-Disposition:attachment; filename='.$subject.'.xls');

$i = 1;
echo "<table border='1' width='600'>
  <tr style='background: #ccc'>
  <td colspan='4'> <center><h2>".str_replace('_', ' ', $subject)."</h2></center> </td> </tr>
  <tr><th> s/n </th>
  <th> Matric </th>
  <th> Subject </th>
  <th> Score </th>";
$result = 0;
$sql = $db ->find_by_sql('SELECT * FROM tmp_answer WHERE subject = "'.$subject.'" GROUP BY username');

while($ft = $sql->fetch()):

  $exp = explode("_", get_scores($db, $ft['username']));
  echo "<tr><td>".$i."</td><td>".$ft['username']."</td><td>".str_replace('_', ' ', $ft['subject'])."</td><td>".$exp[0]."</td></tr>";

  $i++;

endwhile;

 echo "</table>";
 } else {
   $filename = $subject.'_'.str_replace(' ', '_', $depart).'.xls';
   header('Content-type: application/vnd-ms-excel');
   header('Content-Disposition:attachment; filename='.$filename);

   $i = 1;
   echo "<table border='1' width='600'>
     <tr style='background: #ccc'>
     <td colspan='4'> <center><h2>".str_replace('_', ' ', $depart)." -- ".str_replace('_', ' ', $subject)."</h2></center> </td> </tr>
     <tr><th> s/n </th>
     <th> Matric </th>
     <th> Subject </th>
     <th> Score </th>";
   $result = 0;
   //$sql = $db ->find_by_sql('SELECT * FROM tmp_answer WHERE subject = "'.$subject.'" GROUP BY username');
    $query31 = $db->find_by_sql("SELECT * FROM studentrecord WHERE department='{$depart}'");

    if ( $query31->rowCount() > 0)
    {
         while($a = $query31->fetch()):
         $code = $a['loginkey'];
         $as = $db -> find_by_sql("SELECT * FROM tmp_answer WHERE username ='{$code}' GROUP BY username");

         while($ft1 = $as->fetch()):
           $exp = explode("_", get_scores($db, $ft1['username']));
           echo "<tr><td>".$i."</td><td>".$ft1['username']."</td><td>".str_replace('_', ' ', $ft1['subject'])."</td><td>".$exp[0]."</td></tr>";

           $i++;
         endwhile;
       endwhile;
    }



    echo "</table>";

 }
