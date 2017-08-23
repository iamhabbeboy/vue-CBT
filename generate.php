<?php

 $connect = mysql_connect('localhost','root');
 mysql_select_db('megafuse');
 $status = false;
 $loop_count = 400;

  for($i=1;$i<=$loop_count;$i+=1) {
     $matric = '14/69/'.convert($i);

     $sql = mysql_query('INSERT INTO studentrecord(surName, firstName, loginkey, department, subject, photo) VALUES("Megafuse", "", "'.$matric.'", "Computer Science", "OO_Basic", "avatar.png")') or die(mysql_error());

    // echo $matric."<br/>";
  }

   echo $loop_count." query updated";


  function convert($num)
  {
    $a = '';

     if($num < 10)
     {
        $a.='000'.$num;

     }else if(($num < 100) && ($num >= 10))
     {
        $a .='00'.$num;
     } else if(($num < 1000) && ($num >= 100))
     {
        $a .='0'.$num;
     }else
     {
        $a .= $num;
     }

     return $a;
  }
