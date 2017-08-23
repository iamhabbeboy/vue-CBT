$(function(){
    $("#cbt_signin").submit(function(f){
    	f.preventDefault();
        var d=$("#inputEmail"),c=$("#inputPassword"),b=$("#error");
        //var c=$("#inputEmail"),d=$("#inputPassword"),b=$("#error");

    if(c.val()===""){b.css("display","block");b.fadeIn("slow")
    .html("<strong><i class='fa fa-times'></i> Error: </strong> Matric No. is required !");c.focus();return false}

else{if(d.val()===""){b.css("display","block");
b.fadeIn("slow").html("<strong><i class='fa fa-times'></i> Error: </strong> Surname is required !");d.focus();return false}
else {
	$('.modal-wrap').fadeIn('slow')
	data = $(this).serialize();
     $.ajax({
      url: 'public/login_ajax.php?action=login',
      data: data,
      type: 'GET',
      success: function(a) {

        if(a == 'loggedin')
        {
      			$('.modal-wrap').fadeOut('slow')
              	$('.wrap-it-all').addClass('animated shake');
                  $('.wrap-it-all').load('public/confirm-course.php');
              	window.location.reload();

        } else if (a === 'complete') {

          $('.modal-wrap').fadeOut('slow')
           $('#userCalls')
          .addClass('animated shake')
          .html('<br/><div class="alert alert-warning"><b><small><i class="fa fa-times"></i> oOps !!!<br/> You have already completed this practise </small></b></div>');

        }else {
        	console.log(a);
        	$('.modal-wrap').fadeOut('slow')
        	$('#userCalls')
        	.html('<br/><div class="alert alert-warning"><b><small><i class="fa fa-times"></i> oOps !!!<br/> You supplied invalid information </small></b></div>');
        }
      }
}); //$('#userCalls').removeClass('animated shake');
}

}});

function a(){var c=$("#inputEmail"),d=$("#inputPassword"),b=$("#error");var c=$("#inputEmail"),d=$("#inputPassword"),b=$("#error");if(c.val()===""){b.css("display","block");b.fadeIn("slow").html("<strong><i class='fa fa-times'></i>Error: </strong> surname is required !");c.focus();return false}else{if(!(/^[\w]+$/.exec(c.val()))){b.css("display","block");b.fadeIn("slow").html("<strong>Error: </strong> invalid character !");c.focus();return false}else{if(d.val()===""){b.css("display","block");b.fadeIn("slow").html("<strong>Error: </strong> firstname is required !");d.focus();return false}else{if(!(/^[\w]+$/.exec(d.val()))){b.css("display","block");b.fadeIn("slow").html("<strong>Error: </strong> invalid character !");d.focus();return false}}}}}});
