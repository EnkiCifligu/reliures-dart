jQuery( document ).ready( function($) {
	$(document).on('submit', 'form.fep-form', function(e) {
		if( typeof FormData === "undefined" ) {
			return;
		}
		e.preventDefault();
		var thisForm = this;
		var submit_button = $(thisForm).find('button[type="submit"]');
		
		submit_button.prop('disabled',true);
		$( '.fep-ajax-response', thisForm ).html( '' );
		$( '.fep-progress-bar', thisForm ).show();
		
		var formData = new FormData(thisForm);
		if ( 'set' in FormData ) {
			formData.set( 'token', fep_form_submit.token );
		}
		
		$.ajax({
			data: formData,
			type: 'POST', // GET or POST
			url: fep_form_submit.ajaxurl,
			processData: false,
			contentType: false,
			dataType: 'json',
			xhr: function () {
				var myXhr = $.ajaxSettings.xhr();
				if (myXhr.upload) {
					// For handling the progress of the upload
					myXhr.upload.addEventListener('progress', function (e) {
						if (e.lengthComputable) {
							var percentage = Math.round( ( e.loaded / e.total ) * 100 );
							if( percentage <= 100 ){
								$( '.fep-progress-bar-inner', thisForm ).width( percentage + '%' );
								$( '.fep-progress-bar-inner', thisForm ).text( percentage + '%' );
							} else {
								$( '.fep-progress-bar-inner', thisForm ).width( '100%' );
							}
						}
					}, false);
				}
				return myXhr;
			}
		})
		.done( function(response) { // on success..
			$( '.fep-ajax-response', thisForm ).html( response['info'] );
			if( 'success' == response['fep_return'] ) {
				$('input[name="message_title"]', thisForm).val( '' );
				if( typeof tinyMCE !== 'undefined' && tinyMCE.get('message_content') !== null ){
					tinyMCE.get('message_content').setContent( '' );
				} else {
					$('textarea[name="message_content"]', thisForm).val( '' );
				}
				$('div#fep_upload', thisForm).empty();
				
				if( 'reply' == $('input[name="fep_action"]', thisForm).val() ) {
					$( '#fep-content-single-sidebar .fep-message-head.fep-message-head-active' ).trigger('click');
				}
			}
			if( 'location_reload' ==  response['fep_redirect'] ){
				window.location.reload();
			} else if( response['fep_redirect'] ) {
				window.location.href = response['fep_redirect'];
			}
		})
		.fail( function( xhr, status, error ) { // on failed..
			$( '.fep-ajax-response', thisForm ).text( fep_form_submit.refresh_text );
		})
		.always( function() { // always..
			submit_button.prop('disabled',false);
			$( '.fep-progress-bar', thisForm ).hide();
			$( '.fep-progress-bar-inner', thisForm ).width( '0%' );
		});
	});
});
