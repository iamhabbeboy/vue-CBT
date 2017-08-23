(function() {
  $(function() {
    //$('.wrap-it-all').addClass('animated bounceIn');
    //$('.sign-text').addClass('animated rubberBand');
    //$('.input-group').addClass('animated rubberBand');
    // $('#inputPassword').click(function() {
    //   //$('#labelMatric').addClass('animated bounceIn');
    //   $('#labelMatric').html('Matric No :');
    //   return $('#inputPassword').attr('placeholder', '');
    // });
    $('#signout_power').click(function(e) {
      var confirm, m, modal, win;
      e.preventDefault();
      m = $('#mID').val();
      //confirm = window.confirm("Are you sure you want to Signout");
      modal = $('.modal-wrap');
      win = $('.window');
      modal.fadeIn('slow');
      win.html(
    		  '<br><h4><i class="fa fa-gear "></i> Are you sure you want to Submit ? </h4><br>'+
    		  '<button class="btn btn-success confirm1">confirmed <i class="fa fa-check-circle"></i></button>'+
    		  '&nbsp;&nbsp; '+
    		  '<button class="btn btn-danger cancel1">cancel <i class="fa fa-times-circle"></i></button><br/>' +
    		  '<br/><p>'+
    		  'By click on "Confirmed" button denote final submission for this exam/quiz.</p><br/>'
    		  );

      $(document).on('click', 'button.confirm1', function()
      {
    	 //alert('You clicked the confirmed button !');

            //$('.modal-wrap').fadeIn('slow');
            return $.ajax({
              url: 'public/login_ajax.php?action=signout',
              data: {
                matric: m
              },
              type: 'GET',
              success: function(a) {
                return window.location.reload();
              }
            });
          //}
      });

      $(document).on('click', 'button.cancel1', function()
      {
    	  modal.fadeOut('slow');
      })


    });
    return $('#start_quiz').click(function(e) {
      var m;
      e.preventDefault();
      modal = $('.modal-wrap');
      win = $('.window');
      modal.fadeIn('slow');
      m = $('#mID').val();
      return $.ajax({
        url: 'public/login_ajax.php?action=start',
        data: {
          matric: m
        },
        type: 'GET',
        success: function(a) {
          return window.location.reload();
        }
      });
    });
  });
}).call(this);
