<?php
require '../db/Model.php';
include_once '../app/ExcelReader.php';     // include the class
$db = new Model();

if ($_SERVER['REQUEST_METHOD']==='POST') {

  $excel_name = strtolower($_FILES['fileQuestion']['name']);
  $excel_tmp  = $_FILES['fileQuestion']['tmp_name'];
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

           $query = $db -> find_by_sql("SELECT * FROM question WHERE subject='{$course}'");
           if ( $query->rowCount() > 0 )
           {
             echo "<p style='color: red'> Its seems the course already exist </p>";

           } else {

          $re = '<table class="table">';     // starts html table
          $x = 1;
          while($x <= $sheet['numRows']) {
            $re .= "<tr>\n";
            $y = 1;
              $subject = isset($sheet['cells'][$x][1]) ? $sheet['cells'][$x][1] : '';
              $answer = isset($sheet['cells'][$x][2]) ? $sheet['cells'][$x][2] : '';
              $qtn = isset($sheet['cells'][$x][3]) ? $sheet['cells'][$x][3] : '';
              $A = isset($sheet['cells'][$x][4]) ? $sheet['cells'][$x][4] : '';
              $B = isset($sheet['cells'][$x][5]) ? $sheet['cells'][$x][5] : '';
              $C = isset($sheet['cells'][$x][6]) ? $sheet['cells'][$x][6] : '';
              $D = isset($sheet['cells'][$x][7]) ? $sheet['cells'][$x][7] : '';
              $re .= "<td>".$subject."</td><td>".$qtn."</td><td>".$answer."</td><td>".$A."</td><td>".$B."</td><td>".$C."</td>
              <td>".$D."</td>\n";
              $query = $db -> save_record('question', [
                'subject' => str_replace(' ', '_', $subject ),
                'answer'  => str_replace(' ', '', $answer ),
                'question' => $qtn,
                'A'  => $A,
                'B'  => $B,
                'C'  => $C,
                'D'  => $D,
                'date_registered' => date('M,d Y')
               ]);
            $re .= "</tr>\n";
           $x++;
          }
            return $re .'</table>';     // ends and returns the html table

          }
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
