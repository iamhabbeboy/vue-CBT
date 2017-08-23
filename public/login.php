
    <body style="background-image:url('styles/assets/img/backgrounds/1500x500.png');background-size: 100%">
    <div>
    <div class="header-logo">
          <a href="#"><h3> &nbsp; </h3></a>
       </div>
     </div>
        <!-- Top content -->
        <div class="top-content">

            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><b>PN CLASSIC</b></h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Login</h3>
                            		<p>Enter your Matric No. to log on:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-lock"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action="" method="post" class="login-form" id="cbt_signin">
			                    	<div class="form-group">
                                <input type="text" autocomplete="off" placeholder="Surname" id="inputEmail" name="surname" value="Megafuse" aria-describedby="basic-addon1" style="visibility:hidden;height:2px;padding:0px;margin:0px;">

			                    		<label class="sr-only" for="form-username">Matric No.</label>
			                        	<input type="text" name="password" placeholder="Matric No..." class="form-username form-control" id="inputPassword"  autocomplete="off"
                                 autofocus >
			                        </div>
			                        <button type="submit" class="btn btn-info"><b>Sign in! <i class="fa fa-key"></i></b></button>
			                    </form>


                          <p style="color: #FFF;font-weight:bold;" id="userCalls">

                            <?php

                             if( isset( $_GET['error'] ) && $_GET['error'] == 'success' ){

                                    echo "<div class=\"alert alert-danger\"><strong>Error:</strong>
                                    <br/>
                                    <p>This user has already completed the test </p></div>";

                             }elseif( isset( $_GET['action'] ) && $_GET['action'] == 'error' ){

                                    echo "<div class=\"alert alert-danger\"><strong>Error:</strong> <br/>
                                    <p>Invalid information supplied</p></div>";

                             } else if(isset($_SESSION['submit']) and $_SESSION['submit'] === 'auto')
                             {
                             	echo "<div class=\"alert alert-success\"><strong>
                             	<i class='fa fa-check-circle'></i></strong> <br/>
                                    <p>Your exam/quiz has been auto submited successfully !</p></div>";
                             }
                            ?>

                          </p>
		                    </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
