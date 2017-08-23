<?php
require '../db/Model.php';
include "../app/exam.php";
$exam = new Exam();
$db = new Model();

   //$data = array('Azeez Abiodun', 'Adeyemi Pelumi', 'Ayorinde Omotolani' );

   $subject = str_replace('_', ' ', $_GET['subject']);
   $sql = $db ->find_by_sql('SELECT * FROM tmp_answer GROUP BY username');
   while($ft = $sql->fetch()):

     $fopen = fopen('contacts.csv', 'w');
       //foreach($data as $line) {
         fputcsv($fopen, $ft);
       //}
       fclose($fopen);
  endwhile;
