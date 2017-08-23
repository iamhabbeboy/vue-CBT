<?php
$subject = $_SESSION['subject'];

$render -> load_class('app/misc');
$matric = $_SESSION['_matric_no_key'];
$photo = get_photo( _PHOTO_, $db, $matric);
$cd = get_time($db, $matric);
?>

<script src="javascript/Countdown_class.js"></script>

<script>
 /*
   This Countdown JS class
   accept one parameter as object with the following keys
   time: time for countdown{'00:10:00'}, hours: display hours here by id'', minutes: '', second:'', url: url to end quiz if time is up 'url.php'}
 */
 var notification = document.querySelector('#notify');
  var Countdown_class = new Countdown({
   user: "<?php print $matric ?>",
   time : "<?php print $cd ?>",
   hours: 'hh', minutes: 'mm',
   seconds: 'ss',
   ajax: '<?=LAYOUT?>/ajax_time.php'
  });

    $(function () {

     var ajax_xhr = function() {
         var xhr = new XMLHttpRequest();
         xhr.open('GET', '<?php print LAYOUT ?>/ajax_question.php', false );
         xhr.send(null);
         var call = xhr.responseText;
         var json = JSON.parse(call);
         //console.log(call);
         return json.length -1;
     };


     var _p = '', d = ajax_xhr(), _view = $('#current-page').val();
            var func = function() {

                    var xhr = new XMLHttpRequest();
                     xhr.open('GET', '<?php print LAYOUT ?>/json_answer.php', false );
                     xhr.send(null);
                     var call = xhr.responseText;
                     return JSON.parse(call);
            }

            /*
             * <!-- this wrap code handle close button event
             */

            $('.clickx').click(function() {

 				$('#notify').fadeOut('slow');
            });


        $('.btn-block').click(function (e) {
                    e.preventDefault();
                    var data_attr = $(this).attr('name'),
                        page = $('#current-page').val(),
                        sub_btn = $('.sub-end'),
                        total_qtn = ajax_xhr();

                    if (data_attr === 'next') {

                        page = parseInt(page) + 1;
                        //p_test = page
                        p_test = (page >= total_qtn) ? total_qtn : page;

                        if (page >= total_qtn) {

                            $(this).addClass('disabled');

                        }
                        $('#prevBtn').removeClass('disabled');
                        $(this).attr('page', p_test);
                        $('#current-page').val(p_test);


                    } else if (data_attr === 'prev') {

                        var cin = parseInt(total_qtn);

                        if (parseInt(page) === 1 ) {

                            $('#prevBtn').addClass('disabled');
                        }
                        $('#nextBtn').removeClass('disabled');
                        page = parseInt(page) - 1;
                        p_test = (page < 0) ? 0 : page;
                        $(this).attr('page', page);
                        $('#current-page').val(p_test);

                    }

                    question_load(p_test);
                    return false;
                });


        question_load(0);

    });



    function question_load(p) {
        //var _dx = document.getElementbyId('current-page');
        $('#get_question')
        .html('<center><img src="<?php print _PHOTO_ ?>/loading-gif-animation.gif" border="0" /></center>');

        var loader = '<img src="<?php print _PHOTO_ ?>/loader-animator.gif" border="0" />';
        $('#A')
                .fadeIn('slow')
                .html(loader);

        $('#B')
                .fadeIn('slow')
                .html(loader);

        $('#C')
                .fadeIn('slow')
                .html(loader);

        $('#D')
                .fadeIn('slow')
                .html(loader);

        $.ajax({

            url: "<?php print LAYOUT ?>/ajax_question.php",
            cache: false,
            success: function(_a){

              var json_answer = function() {
                    var xhr = new XMLHttpRequest();
                     xhr.open('GET', '<?php print LAYOUT ?>/json_answer.php', false );
                     xhr.send(null);
                     var call = xhr.responseText;
                     return ((JSON.parse(call).length ) ? JSON.parse(call) : {});
                 };


            var d = JSON.parse(_a),
                _js = ((json_answer()[p]) === undefined ) ? ' ' : json_answer()[p],
                _cpage = $('#current-page').val(),
                a = d[p],
                q_id = a.id,
                sub  = a.subject,
                user = a.user,
                _v    = parseInt(_cpage) + 1;

               $('#get_question').html('('+ (_v) +') '+a.question);
               $('#subject').val(sub);
               $('.qID').val(q_id);
               //alert(ans);

              $('.myoption')
              .load('<?=LAYOUT?>/myoptions.php?qID=' + q_id + '&user=' + user + '&subject=' + sub);

              $('.pager')
              .load('<?=LAYOUT?>/pager.php?qID=' + _v + '&subject=' + sub + '&id='+q_id);
        }});


    }
</script>
<style>
 .time-style{ }
</style>
<body style="overflow-x: hidden;background-image:url('styles/assets/img/backgrounds/1500x500.png');background-size: 100%">

    <div class="container wrap-it-all" >
        <!--  logo here -->
        <div class="col-md-2">
          <br>
          <b style="font-size: 2.3em;margin-top: 2px;color: #FFF">PN-C</b> <br/><br/>
        </div>
        <!--  end logo here -->
        <!--  Duration & timer -->
        <div class="col-md-10" >
           <br>
            <!--  timer here -->
            <div class="pull-left" id="font-select" style="color: #FFF">

                <input type="text" id="hh" value="00" class="timer" name="hh" style="padding-left: 10px;padding-right: 10px;color:green;width: 60px;font-size: 1.5em"/>&nbsp;: &nbsp;
                 <input type="text" id="mm" value="00" class="timer"
                 style="padding-left: 10px;padding-right: 10px;color:green;width: 60px;font-size: 1.3em"/>&nbsp;:&nbsp;
                 <input type="text" id="ss" value="00" class="timer time-style" style="padding-left: 10px;padding-right: 10px;color:green;" />
            </div>
            <!-- end timer -->
            <!-- signout -->
            <div class="pull-right">

                <button class="btn btn-lg btn-success sub-end" id="signout_power"
                type="submit" name="next"
                title="By clicking on this button shows that you have finally submited">
                <i class="fa fa-power-off"></i> <u>S</u>ubmit </button>


            </div>
            <!--  end signout -->
        </div>
        <!-- end Duration & timer -->
        <div class="clearfix"></div>

        <div class="houserent-show wrap-course-inside" >
            <div>
              <div class="form-top">
                <div class="form-top-left">
                  <h3><b><i class="fa fa-book"></i>
                            Course/ Subject :&nbsp; <?php print str_replace('_', ' ', ucfirst($subject))?></b></h3>
                    <p style="padding: 5px;color: #FFF;">
                          <b>Login As : <i class="fa fa-user"></i> <?php print $matric; ?></b>
                    </p>
                </div>

                <div class="form-top-right">
                  <i class="fa fa-book"></i>
                </div>
                </div>
                <div style="background:#FFF" >
                    <div>

                </div>
                <br/>

                <!-- Question board -->
                <div class="col-md-6 grey question_design" style="border-bottom: 2px solid #CCC">
                    <h3 id="get_question" style="text-align:left !important"></h5>
                </div>
                <!--  end question board -->
                <!--  options -->
                <div class="col-md-6">
                    <ul class="list-group" style="text-align:left !important">
                        <input type="hidden" name="question" id="question" class="qID"/>
                         <input type="hidden" name="subject" id="subject" class="sub"/>
                        <div class="myoption"></div>
                    </ul>
                </div>
                <!-- end options -->

                <div class="clearfix"></div>

                <!--  pagination -->
                <div class="col-md-8" id="border" style="text-align:left !important;border-bottom: 2px solid #ccc;height: 80px;overflow: auto;">
                    <ul class="pager">

                    </ul>
                </div>

                <!-- end pagination -->

                <!-- Navigation -->
                <!--
                  These are button for the program navigations
                -->
                <div class="btn-area" class="col-md-7">

                    <button class="btn btn-lg btn-primary btn-block" id="btn-custom" type="submit" style="display: none !important;width: 20% !important">&nbsp; &nbsp;&nbsp;</button> &nbsp;&nbsp;

<a href="#" class="btn btn-lg btn-success prev btn-block disabled"  id="prevBtn"
            style="background: #000 !important;display: inline !important;width: 30% !important;" name="prev"><i class='fa fa-chevron-circle-left'></i> <u>P</u>revious &nbsp;</a> &nbsp;

<a href="#" class="btn btn-lg btn-success btn-block next" id="nextBtn" type="submit" style="display: inline;width: 30% !important;" name="next" ><u>N</u>ext <i class='fa fa-chevron-circle-right'></i></a>

&nbsp;

                    <input type="hidden" name="current-page" id="current-page" value="0"/>
                </div>
                <!-- end Navigation
                  Program navigations
                -->

                <div class="clearfix">&nbsp;
                </div>

            </div>
        </div>
          </div>
    </div>

  <div class="animated" id="notify">
    <div class="innerBox">
    <div class="closex">
    <a href="#" class="close clickx">close <i class="fa fa-times"></i></a></div>
    <h3 style="color: #FFF !important"><i class="fa fa-info"></i> You have less than 10 Minutes.</h3>
    </div>
  </div>
