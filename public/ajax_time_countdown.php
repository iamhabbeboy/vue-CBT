<script src="javascript/Countdown_class.js"></script>
<script>
 
 /*
   This Countdown JS class
   accept one parameter as object with the following keys 
   time: time for countdown{'00:10:00'}, hours: display hours here by id'', minutes: '', second:'', url: url to end quiz if time is up 'url.php'} 
 */

  var Countdown_class = new Countdown({
   time : '<?php print $cd ?>', hours: 'hh', minutes: 'mm', seconds: 'ss', ajax: '<?=LAYOUT?>/ajax_time.php'
  });