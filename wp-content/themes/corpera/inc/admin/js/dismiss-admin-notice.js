/**
 * Dismiss admin notice
 *
 * @package corpera
 */

 /*global ajaxurl, corpera_dismiss_admin_notice*/

'use strict';

// Dismiss admin notice.
var CorperaDismiss = function() {
	var notice = document.querySelectorAll( '.corpera-admin-notice' );
	if ( ! notice.length ) {
		return;
	}

	notice.forEach( function( element ) {
		var button = element.querySelector( '.notice-dismiss' ),
			slug   = element.getAttribute( 'data-notice' );

		if ( ! button || ! slug ) {
			return;
		}

		button.addEventListener( 'click', function() {
			// Request.
			var request = new Request(
				ajaxurl,
				{
					method: 'POST',
					body: 'action=dismiss_admin_notice&nonce=' + corpera_dismiss_admin_notice.nonce + '&notice=' + slug,
					credentials: 'same-origin',
					headers: new Headers({
						'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'
					})
				}
			);

			// Fetch API.
			fetch( request );
		} );
	});
}

document.addEventListener( 'DOMContentLoaded', function() {
	CorperaDismiss();
} );
