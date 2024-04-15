jQuery(document).ready(function ($) {
      "use strict";


/*
* Function to reset values to default 
*/

var sections = ['p_typography', 'menu_typography', 'h1_typography', 'h2_typography', 'h3_typography', 'h4_typography', 'h5_typography', 'h6_typography'];

$.each( sections, function( index, id ) {
    
    wp.customize.control( id+'_reset_button_id', function( control ) {

        control.container.find( '.button' ).on( 'click', function() {
            
            var conf = confirm('Are you sure ? This will reset current style to defaults.');
            if( conf == true ){
             
               var ajaxurl = vmagazine_ajax_script.ajaxurl;
               $.ajax({
                        url: ajaxurl,
                        data: {
                            'action': 'vmagazine_'+id+'_reset',
                        },
                        success:function(data) {
                            // This outputs the result of the ajax request
                             wp.customize.previewer.refresh();//refresh the current customizer values
                        },
                        error: function(errorThrown){
                            
                        }
                    });  

            }else{
                console.info( 'No' );
            }
        });

    });
});

});