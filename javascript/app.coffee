$ ->
  $('.wrap-it-all').addClass 'animated bounceIn'
  $('.sign-text').addClass 'animated rubberBand'
  $('.input-group').addClass 'animated rubberBand'
  	
  $('#inputPassword').click () ->
  	$('#labelMatric').addClass 'animated bounceIn'
  	$('#labelMatric').html 'Matric No :'
  	$('#inputPassword').attr 'placeholder', ''
  
  $('#signout_power').click (e) ->
   e.preventDefault()
   m = $('#mID').val()
   confirm = window.confirm "Are you sure you want to Signout"
   
   if confirm is true
   	  $('.modal-wrap').fadeIn 'slow'
      $.ajax
        url: 'public/login_ajax.php?action=signout',
        data: { matric : m},
        type: 'GET',
        success: (a) ->
          window.location.reload()
      	
  $('#start_quiz').click (e) ->  
     #$('.modal-wrap').fadeIn 'slow'
     e.preventDefault()
   	 m = $('#mID').val()
     $.ajax
        url: 'public/login_ajax.php?action=start',
        data: { matric : m},
        type: 'GET',
        success: (a) ->
          window.location.reload()
          
  
   		    	
   
