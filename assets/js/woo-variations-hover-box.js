( function( $ ) {

	$( function () {
		
		/**
		 * After product has beed added to cart.
		 */
		$( 'body' ).on( 'added_to_cart', function( event, fragments, cart_hash, button ) {

			// Disables the variation button if there are no items remaining.
			if ( fragments.total_remaining == 0 ) {
				button.attr("disabled", true);
			}
			
			// Remove the check mark after 5 seconds after adding the product to the cart.
			setTimeout( function () {
				button.removeClass( 'added' );
			}, wvhb.checkMarkDelay );

		});

		/**
		 * When a variaton removed from cart, removes also the disabled property from the respective button.
		 */
		$( 'body' ).on( 'removed_from_cart', function( event, fragments, cart_hash, button ) {
			$( '.variations-hover-box-button[data-product_sku="' + button.data( 'product_sku' ) + '"]' ).attr("disabled", false);
		});

		/**
		 * Remove the check mark when hovering a variation button.
		 */
		$( '.variations-hover-box-button' ).on( 'mouseenter', function () {
			$( this ).removeClass( 'added' );
		});

	} );

} )( jQuery );