<?php

use Sandro_Nunes\WooCommerce_Variations_Hover_Box\WooCommerce_Variations_Hover_Box;

/**
 * Gets the product attribute name used to show the variations buttons.
 */

if ( ! function_exists( 'wvhb_get_attribute_name') ) {

	function wvhb_get_attribute_name() {
		return WooCommerce_Variations_Hover_Box::instance()->frontend::get_attribute_name();
	}

}
