<body style="background-image:url('styles/assets/img/backgrounds/1500x500.png');background-size: 100%">
<div class="container wrap-it-all">

    <div class="wrap-course-content">
      <div class="row">
          <div class="col-sm-8 col-sm-offset-2 text">
              <h1 style="color: #FFF"><b>VUE</b></h1>
          </div>
      </div>
        <div class="wrap-course-inside">

            <div class="form-top">
              <div class="form-top-left">
                <h3>Review Your Information</h3>
                <p>
                   You can use your mouse for selection and also use the keys on your keyboard for selection on
                    practise page.
                </p>
              </div>
              <div class="form-top-right">
                <i class="fa fa-lock"></i>
              </div>
              </div>

            <div style="background: #FFF !important">

                <!-- <div class="alert alert-warning">
                    <b> Notice: </b>
                    <p>
                       You can use your mouse for selection and also use the keys on your keyboard for selection on
                        practise page.
                    </p>
                </div> -->
                <div>&nbsp;</div>
                <div class="col-md-3">

                    <img src="<?php print BASE_URL ?>/images/avatar.png"  border="0"  style="padding:2px;border:1px solid #cccccc;"/>
                    <br/>
                </div>

                <div class="col-md-8" style="font-size: 1.11em;text-align:left !important">


                    <ul class="list-group small" id="listview">
        <li class="list-group-item ">
            <b class="color-orange"><small> MATRIC NO.: &nbsp;&nbsp; <?php print $_SESSION['_matric_no_key']?></small></b>
        </li>

               <?php

                  $render -> load_class('app/misc');
                  $matric = $_SESSION['_matric_no_key'];

                  $sql = $db -> find_by_fields('studentrecord', array('loginkey' => $matric));

                  if($sql -> rowCount() > 0):

                      while($ft = $sql ->fetch()):
               ?>
         <li class="list-group-item ">
            <b class="color-orange"><small> DEPARTMENT: &nbsp;&nbsp; <?php print ucfirst(str_replace('_', ' ',  $ft['department']) )?> </small></b>
        </li>
                    <li class="list-group-item ">
                        <b class="color-orange"><small> COURSE REGISTERED: <?php print str_replace('_', ' ', ucfirst($ft['subject']))?> </small></b></li>

                   <li class="list-group-item ">
                        <b class="color-orange"><small> Duration: <?php print get_time($db, $matric) ?></small></b></li>

                <?php endwhile;

                  else:


                  endif;


//
?>

 </ul>
   <input type="hidden" id="mID" value="<?php print $_SESSION['_matric_no_key']?>" />
 <button class="btn btn-default btn-styled" id="start_quiz" id="btn-custom">
 <b>
 <?=(get_status($db, $_SESSION['_matric_no_key']) > 1 ) ? ' Continue ' : ' Begin '?><i class="fa fa-chevron-circle-right"></i></b></button>
 &nbsp;&nbsp;&nbsp;
 <button class="btn btn-default btn-cancel btn-a" id="signout_power" style="background: #000 !important"> <b>Logout <i class="fa fa-power-off"></i> </b></button>
 <br/> <br/>
                </div>

                <div class="clearfix"></div>

                <div style="text-align:center;">

                </div>
            </div>
        </div>
    </div>
</div>
