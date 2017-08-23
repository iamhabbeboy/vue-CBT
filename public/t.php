<?php session_start();

include "../db/Model.php";
include "../app/misc.php";
$db = new Model();

//$subject = $_SESSION['subject'];
$cd = get_time($db);
$matric = $_SESSION['_matric_no_key'];
?>
 
<script src="javascript/Countdown_class.js"></script>
<script>
 
 /*
   This Countdown JS class
   accept one parameter as object with the following keys 
   time: time for countdown{'00:10:00'}, hours: display hours here by id'', minutes: '', second:'', url: url to end quiz if time is up 'url.php'} 
 */

  var Countdown_class = new Countdown({
   user: "<?php print $matric ?>", 
   time : "<?php print $cd ?>",
   hours: 'hh', minutes: 'mm',
   seconds: 'ss',
   ajax: '<?=LAYOUT?>/ajax_time.php'
  });

</script>

<input type="text" id="hh" value="00" class="timer" name="hh"/>&nbsp;: &nbsp;
<input type="text" id="mm" value="00" class="timer"/>&nbsp;:&nbsp; <input type="text" id="ss" value="00" class="timer" />

                 