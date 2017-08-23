<?php //error_reporting(0);
  include "../app/setup.php";
  include "../app/Mysql.php";
  include "../app/CBT.php";
  $mysql = new \connect\Mysql();
  $cbt = new \connect\CBT();
 //$url = BASE_URL.'/start/'.$_GET['subject'];
   $u_user = $_GET['user'];
       $id = $_GET['page'];
      
      ?>
      
      <script>
          $(function() {
              
              $('.mynav')
                  .click(function(e) {
                      e.preventDefault()
                      var data = $(this).attr('data')
                      var current_id = "<?php echo $id?>" 
                     
                      if(data == current_id) {
                        $(this).css('color', 'orange')
                      }
                       question_load(data, "<?=$_GET['subject']?>")
                  })
          })
      </script>
      
      <?php
          foreach($cbt->change_question_status($_GET['subject'], $u_user) as $key => $value):
               $k = $key+1;

              if(!empty($value['ans']) && $k == $id)
              {
                  $style = "background: orange !important; color: #000;border:0px !important;";

              }else if(empty($value['ans']) && $k == $id)
              {
                  $style = "background: #993300 !important; color: #FFFFFF;border:0px !important;";

              }elseif(!empty($value['ans']))
              {
                  $style = "background: green !important; color: #FFFFFF;border:0px !important;";
              }
              else {
                  $style = "";
              }
              echo "<li><a href=\"#\" style=\"".$style."\" class=\"mynav\" data=\"".($key+1)."\">".($key+1)."
               <span class=\"sr-only\">(current)</span></a></li>";
              endforeach;
          
 ?>