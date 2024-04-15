jQuery(document).ready(function ($) {
      "use strict";

    /*
    * Widget layouts click funciton
    */
    $('body').on('click','.widget-layouts li', function()  {
        $('.widget-layouts li').each(function(){
            $(this).find('.img-icon').removeClass ('img-selected');
            $(this).find('img').removeClass ('current-img-selected');
        });
        $(this).find('.img-icon').addClass('img-selected');
        $(this).find('img').addClass('current-img-selected');
    });

    /**
    * Widgets tab click functions
    */ 
    $('.vmagazine_admin_widget_wrapper > .vmagazine-hidden').hide();
    
    $(document).on('panelsopen', function(e) {
        $('.vmagazine_admin_widget_wrapper > .vmagazine-hidden').hide();
    });
    
    $(document).on('click','.widget-tabs-wrapper li', function(){
        
        var curent = $(this).attr('data-tab');
        $('.vmagazine_admin_widget_wrapper > .vmagazine-wie').fadeOut();
        $('.vmagazine_admin_widget_wrapper > .'+curent).fadeIn();
        
        $('.widget-tabs-wrapper li').removeClass('active');
        $(this).addClass('active');
        
    }); 
    
    
    
    
        
    /*$('.vmagazine-number-type').hide();
    $(document).on('panelsopen', function(e) {
        $('.vmagazine-number-type').hide();
    });*/
    
});  