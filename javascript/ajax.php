
<script>
/**
 * @author Azeez Abiodun
 */
 
$(function() {
    
    $('.start-btn')
           .click(function(e) {
              
               var user = $(this).attr('user')
               var subject = $(this).attr('subject')
               var str_subject = subject.replace(' ', '_')
               var form_data = 'user='+user+'&subject='+subject
               var app_version = parseInt(navigator.appVersion)
               
                $(this)
                    .html('<img src="<?php echo _ICON_?>/loading.gif" border="0"/><i> please wait...</i>')
                    .attr('disabled')
                    
                $.ajax({
                    url: '<?php echo _UI_?>/UIDesign/ajax.php',
                    data: form_data,
                    type: 'GET',
                    cache: false,
                    success: function(data) {
                        
                        
                        if(data == 'added') {
                            
                            if(app_version < 5){
                                window.location = '<?php echo BASE_URL.'/start-ie/'?>'+str_subject
                            }else {
                                window.location = '<?php echo BASE_URL.'/start/'?>'+str_subject
                           }
                            
                        } else if(data =='exist'){
                            
                             if(app_version < 5){
                                window.location = '<?php echo BASE_URL.'/start-ie/'?>'+str_subject
                            }else {
                                window.location = '<?php echo BASE_URL.'/start/'?>'+str_subject
                           }
                        } else {
                            
                            alert('Error Occured !')

                        }
                    }
                   
                })
                return false
           })
})

</script>