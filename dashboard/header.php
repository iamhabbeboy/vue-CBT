<?php (!isset($_SESSION['admin'])) ? header('location:../'):''; ?>

<style>
  .st{
    position: relative;
  }

  .de {

    width: 50%;
    margin: auto;
    letter-spacing: .3em;
    font-family: arial Narrow, arial black;
    text-shadow: 1px 1px 1px #333;
  }
 </style>
     <nav class="navbar navbar-inverse">
  <div class="container" style="color: #FFF">
     <a class="navbar-brand"> VUE </a>

			<ul class="nav navbar-nav">
        <li <?=($location =="home") ? 'class="active"' : '' ?>><a href="<?=NAV_URL?>/home.php">Home <span class="sr-only">(current)</span></a></li>
         <li  <?=($location =="subject") ? 'class="active"' : '' ?>><a href="<?=NAV_URL?>/addsubject.php">Add Course Code</a></li>
        <li  <?=($location =="adsubject") ? 'class="active"' : '' ?>><a href="<?=NAV_URL?>/add-question.php">Add Question</a></li>
        <li  <?=($location =="addstudent") ? 'class="active"' : '' ?>><a href="<?=NAV_URL?>/addstudent.php">Add Student </a></li>
        <li  <?=($location =="addTime") ? 'class="active"' : '' ?>><a href="<?=NAV_URL?>/addTime.php">Add Time </a></li>
        <li  <?=($location =="view") ? 'class="active"' : '' ?>><a href="<?=NAV_URL?>/view.php">View Result</a></li>
        <li><a href="<?=NAV_URL?>/logoff.php">Signout </a></li>

          </ul>
  </div>
</nav>
<!-- <section style="height: 400px;background: url('../images/woman.jpg') center no-repeat;
margin-top: -30px;border-bottom: 3px solid #000">

            <div class="st">
              <div class="de animated wobble"> <br/>
               <img src="<?php print _PHOTO_?>/Microfuse1.jpg" border="0"/> <br/>

               <h3> Megatude Dashboard </h3>
               </div>
            </div>
           </section> -->
