<?php session_start();
    /* Import */

   include "../app/setup.php";
   include "../db/Model.php";

   $qID = $_GET['qID'];
   $user = $_SESSION['_matric_no_key'];
   $subject = $_GET['subject'];

   $db = new Model();

?>

<style>
 .list-group-item{
    height: 80px !important;
    overflow: auto;
 }

 label {
   font-weight:normal;
   color: black;
 }
</style>

<script>

  $(function() {

              $('input[name=option]').change(function () {

                  var opt = $(this).val();
                  var qtn = $('#question').val();
                  var subject = "<?=$subject?>";
                  var url = "<?=BASE_URL."/public/ajax-ans.php" ?>";

                  //$('.showstuff').html('<em><small>loading....</small></em>');
                  console.log('loading......');

                  $.ajax({
                      url: url + '?subject=' + subject + '&opt='+ opt + '&qtn=' + qtn,
                      cache: false,
                      success: function (html) {
                      console.log(html);
                  }
                  })

              });

              function optionSubmit(t) {

                  var opt = t.val();
                  var qtn = $('#question').val();
                  var subject = "<?=$subject?>";
                  var url = "<?=BASE_URL."/public/ajax-ans.php" ?>";

                  console.log('loading......');
                  $.ajax({
                      url: url + '?subject=' + subject + '&opt='+ opt + '&qtn=' + qtn,
                      cache: false,
                      success: function (html) {
                      console.log(html);
                  }
                  })
              }

              $('body').keypress(function(e) {

                  if(e.which === 97) {

                      $('#optionA').attr('checked','checked');
                      var val = $('#optionA');
                      optionSubmit(val);

                  } else if(e.which === 98) {
                      var val = $('#optionB');
                      $('#optionB').attr('checked','checked');
                      optionSubmit(val);

                  }else if(e.which === 99) {
                      var val = $('#optionC');
                      $('#optionC').attr('checked','checked');
                      optionSubmit(val);

                  } else if(e.which === 100) {
                      var val = $('#optionD');
                      $('#optionD').attr('checked','checked');
                      optionSubmit(val);

                  }

              });
          });
</script>

<?php

   $sql = $db ->find_by_fields('question', array('id' => $qID ));
   //$sql->execute(array($qID));

    if($sql->rowCount() > 0) {

        while($fetch = $sql->fetch()) {

        $query2 = $db ->find_by_fields('tmp_answer',
        array('subject' => $subject, '&question' => $fetch['id'],'&username' => $user));
        $check = $query2->fetch();

        print '<li class="list-group-item">
		        <label for="optionA" class="sizer">
		        <div class="pull-left">(A)
        		     <input type="radio" name="option" value="A" id="optionA" '.(($check['ans'] == 'A') ? "checked" : "").'/>
                </div>
            	<div class="pull-right" '.(($check['ans'] == 'A') ? "style='color: green'" : "").'> &nbsp;'.$fetch['A'].'</div>
               <br class="clearAll"/>
            	</label>
            </li>

           <li class="list-group-item">
           <label for="optionB" class="sizer">
              <div class="pull-left" >(B)
                 <input type="radio" name="option" value="B" id="optionB" '.(($check['ans'] == 'B') ? "checked" : "").'/>
              </div>
            <div class="pull-right" '.(($check['ans'] == 'B') ? "style='color: green'" : "").'>&nbsp;'.$fetch['B'].'</div>
            <br class="clearAll"/>
            </label></li>

             <li class="list-group-item">
                <label for="optionC" class="sizer">
                  <div class="pull-left" >(C)
                  <input type="radio" name="option" value="C" id="optionC" '.(($check['ans'] == 'C') ? "checked" : "").'/>
              </div>
            <div class="pull-right" '.(($check['ans'] == 'C') ? "style='color: green'" : "").'> &nbsp;'.$fetch['C'].'</div>
            <br class="clearAll"/>
            </label></li>

              <li class="list-group-item">
              <label for="optionD" class="sizer">
              <div class="pull-left" >(D)
              <input type="radio" name="option" value="D" id="optionD" '.(($check['ans'] == 'D') ? "checked" : "").'/>
        </div>
            <div class="pull-right" '.(($check['ans'] == 'D') ? "style='color: green'" : "").'> &nbsp;'. $fetch['D'].'</div>
            <br class="clearAll"/>
            </label></li>';
        }
    } else {

        echo 'Try Reloading the browser !';
    }
            ?>
