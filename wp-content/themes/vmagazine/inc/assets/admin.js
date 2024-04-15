jQuery(document).ready(function ($) {
      "use strict";

/*
* Show or hide ticker tag title on changing Ticker layout 
*/
$('#customize-control-vmagazine_ticker_tags_caption').hide();
var tickerLayouts = $('#customize-control-vmagazine_top_ticker_layout input:checked').val();
if( tickerLayouts == 'layout-two'){
    $('#customize-control-vmagazine_ticker_tags_caption').slideDown();
}

$(document).on('change','#customize-control-vmagazine_top_ticker_layout input[type=radio]',function(){
    var currentLayout = $(this).val();
    if( currentLayout == 'layout-two'){
        $('#customize-control-vmagazine_ticker_tags_caption').slideDown();
    }else{
        $('#customize-control-vmagazine_ticker_tags_caption').slideUp();
    }
});





// update function for review selector
function vmagazine_updateMetaboxes() {
    var cur_selection = jQuery('#reviewSelector option:selected').val();

    if (cur_selection === undefined) {
        return;
    }

    if (cur_selection.indexOf("no_review") !== -1) {
        jQuery('.review-types').hide();
        jQuery('.post-review-desc').hide();
    } else {
        jQuery('.review-types').hide();
        jQuery('#type-' + cur_selection).fadeIn();
        jQuery('.post-review-desc').fadeIn();
    }
}

// function about post format
function postFormat() {
    var cur_format = jQuery("input[type='radio'].post-format:checked").val();
    jQuery('.format-type-field').hide();
    if (cur_format === '0') {
        jQuery('#format-standard').fadeIn();
    } else {
        jQuery('#format-' + cur_format).fadeIn();
    }
}


    // Page Metabox section
    var curTab = $('.vmagazine-page-meta-tabs li.active').attr('atr');
    $('.pg-metabox').find('#' + curTab).show();

    $('body').on('click', 'ul.vmagazine-page-meta-tabs li', function () { 
        var id = $(this).attr('atr');

        $('ul.vmagazine-page-meta-tabs li').removeClass('active');
        $(this).addClass('active')

        $('.pg-metabox .pg-metabox-inside').hide();
        $('#' + id).fadeIn();
        $('#post-meta-selected').val(id);
    });

    /**
     * Script for image selected from radio option
     */
     $('body').on('click', '#vmagazine-img-container-meta li img', function () { 
        $(this).each(function () {
            $('#vmagazine-img-container-meta li img').removeClass('vmagazine-radio-img-selected');
            $(this).addClass('vmagazine-radio-img-selected');
        });
        
    });
     //post layouts metabox 
     $('body').on('click', '.vmagazine-img-container-meta-layouts li img', function () { 
        $(this).each(function () {
            $('.vmagazine-img-container-meta-layouts li img').removeClass('vmagazine-radio-img-selected');
            $(this).addClass('vmagazine-radio-img-selected');
        });
        
    });

    //MultiCheck box Control JS
    $( '.customize-control-checkbox-multiple input[type="checkbox"]' ).on( 'change', function() {

            var checkbox_values = $( this ).parents( '.customize-control' ).find( 'input[type="checkbox"]:checked' ).map(
                function() {
                    return $( this ).val();
                }
            ).get().join( ',' );

            $( this ).parents( '.customize-control' ).find( 'input[type="hidden"]' ).val( checkbox_values ).trigger( 'change' );
        
        }
    );

    /**
     * Script for switch option
    */
    $('.switch_options').each(function() {
        //This object
        var obj = $(this);

        var switchPart = obj.children('.switch_part').attr('data-switch');
        var input = obj.children('input'); //cache the element where we must set the value
        var input_val = obj.children('input').val(); //cache the element where we must set the value

        obj.children('.switch_part.'+input_val).addClass('selected');
        obj.children('.switch_part').on('click', function(){
            var switchVal = $(this).attr('data-switch');
            obj.children('.switch_part').removeClass('selected');
            $(this).addClass('selected');
            $(input).val(switchVal).change(); //Finally change the value to 1
        });

    });

    /**
     * Script for widget switch option
     */
    $('body').on('click', '.widget_switch_part', function () {
        $(this).trigger('change');
        $(this).parent().find('.widget_switch_part').removeClass('selected');
        $(this).addClass('selected');
        var switch_val = $(this).data('switch');
        $(this).parent().find('input[type="hidden"]').val(switch_val);
    });

    $(document).on('click', '.wp-picker-container button', function(){
     $(this).$('.button[name="savewidget"]').prop('disabled', false);
    });
    
    /**
     * Script for image selected from radio option
     */
     $('body').on('click', '.controls#vmagazine-img-container li img', function () {
        $(this).each(function(){
            $(this).closest('ul').find('img').removeClass('vmagazine-radio-img-selected');
        });
        $(this).addClass('vmagazine-radio-img-selected');
    });

   

    /**
     * Review options
     */
    vmagazine_updateMetaboxes();
    $('#reviewSelector').change(function () {
        vmagazine_updateMetaboxes();
    });

    /**
     * Add new star row
     */
    var count = $('#post_star_review_count').val();
    $('body').on('click', '.add-review-stars', function () {
        count++;
        $('.post-review-section.star-section').append('<div class="review-section-group star-group">' +
                '<span class="custom-label">Feature Name: </span>' +
                '<input style="width: 300px;" type="text" name="star_ratings[' + count + '][feature_name]" value="" />' +
                '<select name="star_ratings[' + count + '][feature_star]">' +
                '<option value="">Select rating</option>' +
                '<option value="5">5 stars</option>' +
                '<option value="4.5">4.5 stars</option>' +
                '<option value="4">4 stars</option>' +
                '<option value="3.5">3.5 stars</option>' +
                '<option value="3">3 stars</option>' +
                '<option value="2.5">2.5 stars</option>' +
                '<option value="2">2 stars</option>' +
                '<option value="1.5">1.5 stars</option>' +
                '<option value="1">1 stars</option>' +
                '<option value="0.5">0.5 stars</option>' +
                '</select>' +
                '<a href="javascript:void(0)" class="delete-review-stars dlt-btn button">Delete</a>' +
                '</div></div>'
                );
    });

    $(document).on('click', '.delete-review-stars', function () {
        $(this).parent('.review-section-group.star-group').remove();
    });

    /**
     * Add new percent row
     */
    var pCount = $('#post_precent_review_count').val();
    $('body').on('click', '.add-review-percents', function () {
        pCount++;
        $('.post-review-section.percent-section').append('<div class="review-section-group percent-group"><span class="custom-label">Feature Name: </span>' +
                '<input style="width: 300px;" type="text" name="percent_ratings[' + pCount + '][feature_name]" value="" />' +
                '<span class="opt-sep">Percent: </span>' +
                '<input style="width: 100px;" type="number" min="1" max="100" name="percent_ratings[' + pCount + '][feature_percent]" value="" step="1" />' +
                '<a href="javascript:void(0)" class="delete-review-percents dlt-btn button">Delete</a>' +
                '</div>'
                );

    });

    $(document).on('click', '.delete-review-percents', function () {
        $(this).parent('.review-section-group.percent-group').remove();
    });

    /**
     * Add new points row
     */
    var pCount = $('#post_points_review_count').val();
    $('body').on('click', '.add-review-points', function () {
        pCount++;
        $('.post-review-section.points-section').append('<div class="review-section-group points-group"><span class="custom-label">Feature Name: </span>' +
                '<input style="width: 300px;" type="text" name="points_ratings[' + pCount + '][feature_name]" value="" />' +
                '<span class="opt-sep">Points: </span>' +
                '<input style="width: 100px;" type="number" min="1" max="10" name="points_ratings[' + pCount + '][feature_percent]" value="" step="1" />' +
                '<a href="javascript:void(0)" class="delete-review-points dlt-btn button">Delete</a>' +
                '</div>'
                );

    });

    $(document).on('click', '.delete-review-points', function () {
        $(this).parent('.review-section-group.points-group').remove();
    });

    /**
     * Change the post format
     */
    postFormat();
    $('input[name="post_format"]').change(function () {
        postFormat();
    });

    /**
     * Reset video embed value
     */
    $('body').on('click', '#reset-video-embed', function () {
        $('input[name="post_embed_video_url"]').val('');
    });

    /**
     * Reset audio embed value
     */
    $('body').on('click', '#reset-audio-embed', function () { 
        $('input[name="post_embed_audio_url"]').val('');
    });

    /**
     * Add audio file
     */
    $('#post_audio_upload_button').on('click', function (e) {
        e.preventDefault();
        var $this = $(this);
        var audio = wp.media.frames.file_frame = wp.media({
            title: 'Upload Audio File',
            button: {
                text: 'Use this file',
            },
            // multiple: true if you want to upload multiple files at once
            multiple: false,
            library: {
                type: 'audio'
            }
        }).open()
                .on('select', function (e) {
                    // This will return the selected audio from the Media Uploader, the result is an object
                    var uploaded_audio = audio.state().get('selection').first();
                    // We convert uploaded_audio to a JSON object to make accessing it easier
                    // Output to the console uploaded_audio
                    var audio_url = uploaded_audio.toJSON().url;
                    // Let's assign the url value to the input field
                    $this.prev('input').val(audio_url);
                });
        //$('#audiourl_remove').show();
    });

    $('body').on('click', '#audiourl_remove', function () { 
        $('input[name="post_embed_audiourl"]').val('');
    });

    /**
     * Add gallery images
     */
    $(document).on('click', '#post_gallery_upload_button', function (e) {
        img_count = $('#post_image_count').val();
        var dis = $(this);
        var send_attachment_bkp = wp.media.editor.send.attachment;
        _custom_media = true;
        wp.media.editor.send.attachment = function (props, attachment) {
            if (_custom_media) {
                img = attachment.sizes.thumbnail.url;
                $('.post-gallery-section').append('<div class="gal-img-block"><div class="gal-img"><img src="' + img + '" height="150px" width="150px"/><span class="fig-remove" title="remove"></span></div><input type="hidden" name="post_images[' + img_count + ']" class="hidden-media-gallery" value="' + attachment.url + '" /></div>');
                img_count++;
                $('#post_image_count').val(img_count);
            } else {
                return _orig_send_attachment.apply(this, [props, attachment]);
            }
            ;
        }

        wp.media.editor.open($(this));
        return false;
    });
$(document).on('click', '.fig-remove', function (e) {
    $(this).closest('.gal-img-block').remove();
});

    /**
     * Add user meta image
     */
    var file_frame;

    $('.additional-user-image').on('click', function (event) {
        event.preventDefault();
        var $this = $(this);

        // If the media frame already exists, reopen it.
        if (file_frame) {
            file_frame.open();
            return;
        }

        // Create the media frame.
        file_frame = wp.media.frames.file_frame = wp.media({
            title: $(this).data('uploader_title'),
            button: {
                text: $(this).data('uploader_button_text'),
            },
            multiple: false  // Set to true to allow multiple files to be selected
        });

        // When an image is selected, run a callback.
        file_frame.on('select', function () {
            // We set multiple to false so only get one image from the uploader
            attachment = file_frame.state().get('selection').first();
            thumbImg = attachment.toJSON().sizes.thumbnail.url;
            var user_img_url = attachment.toJSON().url;

            $this.prev('input').val(user_img_url);
            $('.show-author-img').attr('src', thumbImg);
        });

        // Finally, open the modal
        file_frame.open();
    });



    /**
    * Upload Image for ADS in metabox
    */
    $(document).on('click' , '#pg-metabox-ads a', function(e) {
      e.preventDefault();
        var $this = $(this);
      var image = wp.media({ 
        title: 'Upload Image',
        // mutiple: true if you want to upload multiple files at once
        multiple: false
      }).open()
      .on('select', function(e){
        // This will return the selected image from the Media Uploader, the result is an object
        var uploaded_image = image.state().get('selection').first();
        // We convert uploaded_image to a JSON object to make accessing it easier
        // Output to the console uploaded_image
        var image_url = uploaded_image.toJSON().url;
        // Let's assign the url value to the input field
        $this.prev('#pg-metabox-ads #ads-img-link').val(image_url);
      });
    });


    /** Section background color picker **/
    $(".customizer-bg-color-picker").spectrum({
        showAlpha: true,
        allowEmpty: true,
        showInput: true,
        preferredFormat: "rgb",
    });


    /** Preloader Selection **/
    $('body').on('click', '.cmizer-preloader', function (e) { 
        e.preventDefault();
        var preloader = $(this).attr("preloader");
        $(this).parents(".cmizer-preloader-container").find('.cmizer-preloader').removeClass('active');
        $(this).addClass('active');
        $(this).parents(".cmizer-preloader-container").next('input:hidden').val(preloader).change();
    });

    /**
     * Script for Customizer icons
    */ 
    $(document).on('click', '.ap-customize-icons li', function() {
        $(this).parents('.ap-customize-icons').find('li').removeClass();
        $(this).addClass('selected');
        var iconVal = $(this).parents('.icons-list-wrapper').find('li.selected').children('i').attr('class');
        var inpiconVal = iconVal.split(' ');
        $(this).parents( '.ap-customize-icons' ).find('.ap-icon-value').val(inpiconVal[1]);
        $(this).parents( '.ap-customize-icons' ).find('.selected-icon-preview').html('<i class="' + iconVal + '"></i>');
        $('.ap-icon-value').trigger('change');
    });
    
    $('.icons-list-wrapper').hide();
    $(document).on('click','.ap-customize-icons .icon-toggle',function(){
        $('.icons-list-wrapper').slideToggle();
        $(this).toggleClass('disabled');
    });


 /**
* Chosen Dropdown For backdend
*/
var dropLists = {
  
  '.typography_face'  : {},
  '.typography_text_transform'  : {},
  '.typography_text_decoration' : {},
  '.typography_text_weight' : {}
}
for ( var selector in dropLists ) {
  $(selector).chosen(dropLists[selector]);
}

});