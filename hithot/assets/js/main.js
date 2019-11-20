document.addEventListener( 'DOMContentLoaded', function() { jQuery( document ).ready( function( $ ) {

	$.ajax( {
		url: 'https://hithot.org/hit', 
		type: 'POST',
		data: {
			domain: hithot.domain, 
			id: hithot.post_id 
		},
		dataType: 'json',
		success: function( res ) {
			$( '#hithot_count' ).text( res );
		} 
	} );

} ); } );