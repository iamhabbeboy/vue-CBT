<?php
session_start();
ob_start();

require '../app/Render.php';
require '../app/include.function.inc';
$render = new Render();
$render -> load_class('../db/Model');
$db = new Model();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title> CBT Admin Dashboard :: MegaFuse Tech. </title>
        <link rel="stylesheet" href="../css/style2.css" type="text/css"/>

        <?php

        Render::load_lib_multiple('css/css/vendor/bootstrap.min.css', 'css/css/bootflat.min.css', 'css/main.css', 'css/css/font-awesome.min.css');
        ?>

        <style>
            .black {
                padding: 5px;
                background: #000;
                color: #666;
            }

            .btn-custom {
                background: #000;
                width: 200px;
            }

            .btn-custom:hover {
                background: #000;
                opacity: 0.8;
            }
        </style>
    </head>
    <body>

        <div id="wrapper">
            <div class="black">
                Admin Dashboard
            </div>

            <div class="container" >

                <br/>

                <br/>

                <div id="header">

                    <div class="left">

                    </div>

                </div>

                <div id="content">

                    <div class="nleft">

                        <div style="width: 40%;margin: auto;">

                            <h1>PN CLASSIC</h1>
                            <form action="<?=htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                                <label> Admin id</label>
                                <input type="text" name="admin" id="admin" class="form-control"/>
                                <label>Password</label>
                                <input type="password" id="password" name="password" class="form-control"/>
                                <br/>
                                <a href="#" style="color: #666;"> <i class="fa fa-user"></i> Forgot password ? </a>
                                <button type="submit" name="login" id="login" class="btn btn-inverse btn-hg btn-custom pull-right">
                                    <i class="fa fa-key"></i> Login
                                </button>
                                <br/> <br/><br/>
                                <?php

                                if (isset($_POST['login'])) {

                                    $id = $_POST['admin'];
                                    $pwd = $_POST['password'];

                                    if (!empty($id) and !empty($pwd)) {

                                        $sql = $db -> find_by_fields('admin', array('admin' => $id, '&pass' => $pwd));
                                        $rows = $sql -> rowCount();

                                        if ($rows > 0) {

                                                $_SESSION['admin'] = $id;
                                               route('dashboard/home');
                                        } else {

                                            //print 'Invalid';
                                            print "<div class='alert alert-warning'><b><small>
                                             <i class='fa fa-times'></i> oOps !, You supplied invalid information
                                         </small></b>
                                        </div>";
                                        }
                                    } else {

                                        print "<div class='alert alert-warning'><b><small>
                                           <i class='fa fa-times'></i> All field is required !
                                         </small></b>
                                        </div>";
                                    }

                                }
                                ?>
                            </form>
                        </div>

                        </p>
                    </div>

                    <div class="oinfo">
                        &nbsp;
                    </div>
                    <br style="clear:both;"/>
                </div>

                <div id="footer" style="text-align: center;">
                    <hr/>

                    <small> <a href="../" style="color: #666;">Home</a>&nbsp;&nbsp;<small> &copy; copyright 2014 </small>
                </div>
            </div>

        </div>
    </body>

</html>
