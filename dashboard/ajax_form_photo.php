<?php session_start();
  include "../configuration/setup.php";
  include "../configuration/Mysql.php";
  include "../configuration/CBT.php";

  $mysql = new \connect\Mysql();
  $cbt = new \connect\Cbt();

  if($_SERVER['REQUEST_METHOD'] == "POST"){

    
    if($_FILES['file']['error'] > 0) {

        echo "Image contain errors";
    }else{
            
        $img_name = strtolower($_FILES['file']['name']);
        $img_tmp = $_FILES['file']['tmp_name'];
        $valid_format = array('.jpg', '.jpeg', '.png', '.gif');
        $ext = strrchr($img_name, ".");
        

        if(!in_array($ext, $valid_format)) {

             echo "image format not supported !";

        } else {
            
            $location = "studentphotos/".time().$ext;

            if(move_uploaded_file($img_tmp, $location)) {
                
                 list($width, $height) = getimagesize($location);
                
                echo "<img src=\"".$location."\" border=\"0\" ".$cbt->resizeimg($width, $height, 150)."/>";

                $row = $mysql->insert('studentrecord', 
                              array(
                                'photo' => $location
                              ));

                  if($row > 0) {
                    
                       $id = $mysql::$mysql->lastInsertId();

                        $_SESSION['uustudentID'] = $id;
                }
                else {
    
                echo "Error Occured !";
            }

            }}}}
?>