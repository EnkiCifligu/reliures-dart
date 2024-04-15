( function( api ) {
"use strict";
	api.controlConstructor['typography'] = api.Control.extend( {
		ready: function() {
			var control = this;

			control.container.on( 'change', '.typography-font-family select',
				function() {
					control.settings['family'].set( jQuery( this ).val() );
				}
			);

			control.container.on( 'change', '.typography-font-style select',
				function() {
					control.settings['style'].set( jQuery( this ).val() );
				}
			);

			control.container.on( 'change', '.typography-text-transform select',
				function() {
					control.settings['text_transform'].set( jQuery( this ).val() );
				}
			);

			control.container.on( 'change', '.typography-text-decoration select',
				function() {
					control.settings['text_decoration'].set( jQuery( this ).val() );
				}
			);

		}
	} );

} )( wp.customize );