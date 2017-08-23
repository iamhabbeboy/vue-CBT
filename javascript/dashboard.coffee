$ ->
  $('.links-hover').hover ()->
  	id = $(this).attr 'id'
  	$('.btn-' + id).css 'display','block'
  ,->	
  	 id = $(this).attr 'id'
  	 $('.btn-' + id).css 'display', 'none'	
  	
   $('#search').click (e) ->
   	$('#form_search').submit()
   	
