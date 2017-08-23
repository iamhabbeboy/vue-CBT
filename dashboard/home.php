<?php
session_start();
ob_start();
require "../app/include.function.inc";
require '../app/Render.php';

$render = new Render();
$render -> load_class('../db/Model');
$db = new Model();

$location = "home";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title> CBT :: Dashboard </title>
        <link rel="stylesheet" href="../css/style2.css" type="text/css"/>

        <style>
            .o-height {

                min-height: 350px !important;
            }
        </style>
        <?php
        /**
         *  Load static libs
         *
         */

        Render::load_lib_multiple('css/css/vendor/bootstrap.min.css', 'css/css/bootflat.min.css', 'css/signin.css', 'css/css/font-awesome.min.css', 'css/animate.css', 'css/main.css', 'jquery.js', 'Framework.js', 'app.js');
        ?>
    </head>
    <body>

        <div id="wrapper">

            <?php
            include "header.php";
            ?>

            <div style="line-height:40px;text-indent:20px;"  class="container">
                <small><em> Welcome back <?=htmlspecialchars($_SESSION['admin']) ?> !</em></small>
            </div>

            <div id="content"   class="container">

                <div class="nleft">
                    <div class="rows">
                        <div class="col-md-4">
                            <div class="panel panel-warning">
                                <div class="panel panel-heading">
                                    <b><i class="fa fa-list"></i> Course Available </b>
                                </div>

                                <div class="panel panel-body">

                                    <p>

                                        <img src="<?=BASE_URL ?>/images/computer-student.jpg" align="left" /> &nbsp; You are welcome to VUE Tech. CBT Admin Dashboard, where you can control the cbt student UI using the above links.
                                        <br/>

                                    </p>
                                </div>
                            </div>

                        </div>

                        <!--start here -->
                        <div class="col-md-4">

                            <div class="panel panel-warning o-height" style="min-height: 380px !important;">
                                <div class="panel panel-heading">
                                    <b><i class="fa fa-list"></i> Set Question Max. limit </b>
                                </div>

                                <div class="panel panel-body">

                                    <label>Subject</label>

                                    <?php

                                    $query = $db -> find_by_sql("SELECT * FROM question GROUP BY subject ORDER BY id DESC");
                                    $row = $query -> rowCount();
                                    ?>
                                    <select class="subject form-control">
                                        <option value="0">select</option>

                                        <?php
                                        if ($row > 0) :
                                            while ($ft = $query -> fetch()) :
                                                if ($ft['subject'] == '') {

                                                } else {
                                                    echo "<option value=\"" . strtolower($ft['subject']) . "\">" . strtoupper(str_replace('_', ' ', $ft['subject']) ) . "</option>";
                                                }
                                            endwhile;
                                        endif;
                                        ?>
                                    </select>
                                    <br/>
                                    <label>Total Question</label>
                                    <input type="text" id="subject_num" class="form-control" value="0" disabled/>
                                    <input type="hidden" id="subject_num"/>
                                    <br/>
                                    <label>Max. Qtn num.</label>
                                    <input type="text" id="subject_add" class="form-control" value="0" />
                                    <Br/>
                                    <button id="save" class="btn btn-primary">
                                        save
                                    </button>
                                    <span class="preview"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 height" >

                            <div class="panel panel-warning" style="min-height: 380px !important;">
                                <div class="panel panel-heading">
                                    <b><i class="fa fa-list"></i> Maximum Question per Course </b>
                                </div>

                                <div class="panel panel-body">

                                    <table class="table">
                                        <tr>
                                            <td><i class="fa fa-check"></i></td>
                                            <td>Courses</td>
                                            <td>Questions</td>
                                            <td> Max set</td>
                                        </tr>
                                        <?php

                                        $qq = $db -> find_by_sql('SELECT * FROM qtn_limit ORDER BY id DESC');

                                        if ($qq -> rowCount() > 0) {

                                            while ($ft = $qq -> fetch()) {

                                                echo "<tr><td><i class='fa fa-check'></i></td><td>" . $ft['subject'] . "</td><td>" . $ft['qtn'] . "</td><td>" . $ft['max'] . "</td></tr>";
                                            }
                                        } else {

                                            echo "<b>Question limit as not been set for any course </b>";

                                        }
                                        ?>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <!-- end here -->

                        <div class="clearfix"></div>

                    </div>

                    <div class="rows">



                        <div class="col-md-4">

                            <div class="panel panel-warning">
                                <div class="panel panel-heading">
                                    <b><i class="fa fa-list"></i> Course </b>
                                </div>

                                <div class="panel panel-body">

                                    <ul class="list-group">

                                        <?php

                                        $sql = $db -> find_by_sql('SELECT * FROM exam_addsubject ORDER BY id DESC LIMIT 5');

                                        if($sql -> rowCount() > 0 ):

                                        while($ft = $sql -> fetch()):
                                        ?>
                                        <li class="list-group-item">
                                            <small><b><i class="fa fa-check"></i> <?php print strtoupper($ft['subject'])?>
                                                </b></small>
                                        </li>
                                        <?php
                                        endwhile;
                                        endif;
                                        ?>
                                    </ul>
                                    <a href="#" class="pull-right">view more <i class="fa fa-arrow-circle-o-right"></i></b></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">

                            <div class="panel panel-warning" style="min-height: 320px !important;">
                                <div class="panel panel-heading">
                                    <b><i class="fa fa-list"></i> Result </b>
                                </div>

                                <div class="panel panel-body">

                                    <ul class="list-group">
                                        <?php

                                        $sql = $db -> find_by_sql('SELECT * FROM tmp_question ORDER BY id DESC LIMIT 5');

                                        if($sql -> rowCount() > 0 ):

                                        while($ft = $sql -> fetch()):
                                        ?>
                                        <li class="list-group-item">
                                            <?php print $ft['user'] ?>
                                        </li>
                                        <?php
                                        endwhile;
                                        else:
                                        print "No result yet !";
                                        endif;
                                        ?>

                                    </ul>

                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                </div>

            </div>

            <?php
    require 'footer.php';
 ?>
        </div>

        <script>
			$(function() {

				$('.subject').change(function() {

					var s = $(this)

					if (s.val() == '0') {
						s.focus()
						return false
					} else {

						$('#subject_num').css('font-size', '10px').val('wait...')
						var data = 's=' + s.val()

						ajax('get_subject_score.php?action=get_num', data, function(arg) {

							$('#subject_num').css('font-size', '13px').val(arg)
						})
					}
				})
				/**
				 * Save Event Handling
				 */
				$('#save').click(function() {
					var sadd = $('#subject_add')
					var s = $('.subject')
					var snum = $('#subject_num')

					if (s.val() == '0') {
						alert('select subject')
						s.focus()
						return false
					} else if (snum.val() == '0') {
						alert('No question found for this subject')
						return false
					} else if (sadd.val() == '0') {
						sadd.focus()
						return false
					} else if (parseInt(sadd.val()) > parseInt(snum.val())) {
						alert('Max. Question is ' + snum.val())
						sadd.focus()
						return false
					} else {

						$('.preview').html('<i>please wait...</i>')
						var data = 's=' + s.val() + '&snum=' + snum.val() + '&sadd=' + sadd.val()
						ajax('get_subject_score.php?action=save', data, function(arg) {

							$('.preview').html(arg)
						})
					}
				})
				function ajax($url, $data, fn) {

					$.ajax({
						url : $url,
						type : 'post',
						data : $data,
						cache : false,
						success : function(arg) {

							fn(arg)
						}
					})
				}

			})
        </script>
    </body>

</html>
