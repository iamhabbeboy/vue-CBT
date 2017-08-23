
<style>
    #error{display: none;}
</style>
  <body>
      <div class="wrap-it-all">
          <br/><Br/>
    <div class="container circle">
      <form class="form-signin" method="POST" id="cbt_signin" action="">



          <a href="#"><img src="<?php print _PHOTO_ ?>/Microfuse.jpg" border="0"/></a>
        <h4 class="form-signin-heading">&nbsp;

            <div class="move-content sign-text">Sign In </div></h4>

          <div class="alert alert-danger" role="alert" id="error">

              <strong><i class="fa fa-times"></i> Error: </strong> Field are required.</div>

        <label for="inputPassword" id="labelMatric1">&nbsp;</label>
        <!--<input type="text" id="inputPassword" class="form-control" name="password" autocomplete="off" autofocus placeholder="Matric No:">
        -->
        <div class="input-group">
  <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user"></i></span>
  <input type="text" class="form-control"  autocomplete="off"
   autofocus placeholder="Matric No:" id="inputPassword" name="password" aria-describedby="basic-addon1">


</div>
	<!--  --<label for="inputEmail" class="sr-on"> Surname</label>
        <input type="text" id="inputEmail" class="form-control" name="surname"
         value="Megafuse"> -->
         <!--<label> &nbsp;</label>
            <div class="input-group" >
  <span class="input-group-addon" id="basic-addon1"><i class="fa fa-lock"></i></span> -->

  <input type="text" autocomplete="off" placeholder="Surname" id="inputEmail" name="surname" value="Megafuse" aria-describedby="basic-addon1" style="visibility:hidden">
<!--</div> -->

        <div class="checkbox">
        </div>
        <button class="btn btn-lg btn-primary btn-block" id="btn-custom" type="submit" name="sub-login" style="background: #111111 !important">Login <i class="fa fa-check"></i></button>

        <p id="userCalls">

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
             	<i class='fa fa-check'></i></strong> <br/>
                    <p>Your exam/quiz has been auto submited successfully !</p></div>";
             }
            ?>
        </p>
      </form>
</div>
