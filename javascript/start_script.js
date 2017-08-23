/**
 * Created by Azeez Abiodun on 6/20/2015.
 */

$(document).ready(function() {

    $( window ).scroll( function() {
    
     var header = $( '#header_content' )
     var scrollTop = $( window ).scrollTop()
     
       if ( scrollTop > header.offset().top ) {
           
            $( '#timearea' )
            .fadeIn( 'slow' )
           
            
       } else {
           
            $( '#timearea' )
            .fadeOut( 'slow' )
             
       }
    })
});