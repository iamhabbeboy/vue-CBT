<?php
require '../db/Model.php';
include_once '../app/ExcelReader.php';     // include the class
$db = new Model();

if ($_SERVER['REQUEST_METHOD']==='POST') {

  $excel_name = strtolower($_FILES['fileStudent']['name']);
  $excel_tmp  = $_FILES['fileStudent']['tmp_name'];
  $extension  = strrchr($excel_name, ".");
  $excelDir = "excel/".time();
  //check file format
  if ( $extension !== '.xls' )
  {
    echo "<p style='color: red'>Oops Error Occured, please try again</p>";

  } else {

     $filename = substr(time(), 0, 10).$extension;
     $dir = "excel/".$filename;

     if(move_uploaded_file($excel_tmp, $dir))
     {

        $excel = new PhpExcelReader;
        $excel->read($dir);

        function sheetData($db, $sheet) {
          $course = isset($sheet['cells'][1][1]) ? $sheet['cells'][1][1] : '';

          $re = '<br><table class="table">';     // starts html table
          $x = 1;
          $count = 0;
          $store = [];

          while($x <= $sheet['numRows']) {
            $re .= "<tr>\n";
            $y = 1;

            $loginkey = isset($sheet['cells'][$x][1]) ? $sheet['cells'][$x][1] : '';
            $department = isset($sheet['cells'][$x][2]) ? str_replace(' ', '_', $sheet['cells'][$x][2]) : '';
            $subject = isset($sheet['cells'][$x][3]) ? str_replace(' ', '_', $sheet['cells'][$x][3]) : '';

            $query = $db -> find_by_sql("SELECT * FROM studentrecord WHERE loginkey='{$loginkey}' AND subject='{$subject}'");

            //echo $query->rowCount().','.$loginkey.', '.$subject;

            if ( $query->rowCount() > 0 )
            {
              //echo "<p style='color: red'> Its seems the course already exist </p>";
              $count = $count+1;
              array_push($store, $loginkey);
              //echo "Found !";
            } else {

              $re .= "<td>".$x."</td><td>".$loginkey."</td><td>".str_replace('_', ' ', $department)."</td><td>".str_replace('_', ' ', $subject)."</td>\n";
              $query = $db -> save_record('studentrecord', [
                'surName' => 'megafuse',
                'firstName'  => '',
                'loginkey' => $loginkey,
                'department'  => $department,
                'subject'  => $subject,
                'photo'  => '',
                'datetime' => date('M,d Y')
               ]);
            $re .= "</tr>\n";

          }
             // ends and returns the html table
           $x++;
          }

          if ( $count > 0 )
          {
            echo "<h3 style='color: red'>".$count." Student Already Exist </h3>";
            echo "<table class='table'><tr><td>#</td><td>Matric No. </td></tr>";
            foreach($store as $key => $student)
            {
              echo "<tr>
                <td>".($key+1)."</td><td>".$student."</td></tr>";
            }
            echo "</table><br><br>";
          }


          return $re .'</table>';


        }
       //
        $nr_sheets = count($excel->sheets);
        $excel_data = '';              // to store the the html tables with data of each sheet
       //
       // // traverses the number of sheets and sets html table with each sheet data in $excel_data
        for($i=0; $i<$nr_sheets; $i++) {
          //$excel_data .= '<h4>Sheet '. ($i + 1) .' (<em>'. $excel->boundsheets[$i]['name'] .'</em>)</h4>';
          $excel_data .= sheetData($db, $excel->sheets[$i]) .'<br/>';
        }
       //
        echo $excel_data;      // outputs HTML tables with excel file data

     } else {
       echo "<p style='color: red'>Oops Error Occured, please try again </p>";
     }
  }
}
