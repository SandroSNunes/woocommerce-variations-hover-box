<?php

namespace Sandro_Nunes\WooCommerce_Variations_Hover_Box;

use Sandro_Nunes\Lib\Util;

/**
 * Woo Variations Hover Box Frontend.
 */

class Frontend {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->init_hooks();
		return $this;
	}


	/**
	 * Initializate hooks.
	 */
	private function init_hooks() {

		// Enqueue frontend scripts & styles.
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );

		// Add the variations buttons on the shop loop inside the product thumbnail.
		add_action( 'woocommerce_before_shop_loop_item_title', [ $this, 'add_hover_container_open'], 9 );
		add_action( 'woocommerce_before_shop_loop_item_title', [ $this, 'add_hover_buttons' ], 98 );
		add_action( 'woocommerce_before_shop_loop_item_title', [ $this, 'add_hover_container_close'], 99 );

		// Pass the total remaining items for a variation in the cart fragments.
		add_filter( 'woocommerce_add_to_cart_fragments', [ $this, 'fragments_get_variation_total_remaining' ] );

	}


	/**
	 * Enqueue frontend scripts & styles.
	 */
	public function enqueue_scripts() {

		$suffix = SCRIPT_DEBUG ? '' : '.min';

		// Enqueue plugin style and script.
		if ( apply_filters( 'wvhb_enqueue_styles', true ) ) {
			wp_enqueue_style( 'wvhb', Util::get_active_file_url( 'woo-variations-hover-box' . $suffix . '.css' ), array(), '1.0.0', 'all' );
		}
		if ( apply_filters( 'wvhb_enqueue_scripts', true ) ) {
			wp_enqueue_script( 'wvhb', Util::get_active_file_url( 'woo-variations-hover-box' . $suffix . '.js' ), array( 'jquery' ), '1.0.0', true );
		}

		// Pass global variables to the plugin script.
		wp_localize_script( 'wvhb', 'wvhb', array(
			'checkMarkDelay' => get_option( 'wvhb_check_mark_delay' , '0' ),
		));

	}


	/**
	 * Adds a container to the featured image so that we can insert the hover buttons.
	 */
	public function add_hover_container_open() {
		echo apply_filters( 'wvhb_hover_container_open', '<div class="variations-hover-box-container">' );
	}


	/**
	 * Closes the featured image container.
	 */
	public function add_hover_container_close() {
		echo apply_filters( 'wvhb_hover_container_close', '</div>' );
	}


	/**
	 * Add the variations buttons on the shop loop.
	 */
	public function add_hover_buttons() {
		global $product;

		// Get the hover box template location, if its either on the child theme, parent theme or on the plugin.
		$template = Util::locate_template( 'loop/variations-hover-box.php' );

		if ( $template ) {
			include $template;
		}

	}


	/**
	 * Gets the total remaining items for the variations that was added to the cart.
	 * 
	 * @param string $fragments The plugin info.
	 * @return string The plugin info.
	 */
	function fragments_get_variation_total_remaining( $fragments ) {

		$variation_id = isset( $_POST['product_id'] ) ? intval( $_POST['product_id'] ) : '';

		if ( $variation_id > 0 ) {
			$variation = wc_get_product( $variation_id );

			// Get the stock of the product without the cart.
			$stock = $variation->get_stock_quantity();

			// Get quantities for each item in cart (array of product id / quantity pairs).
			$quantities_in_cart = WC()->cart->get_cart_item_quantities(); 

			// Total items remaining (stock - quantity in cart).
			$total_remaining = $stock - $quantities_in_cart[ $variation_id ];

			// Return the total remaining items in the cart fragments.
			$fragments['stock']           = $stock;
			$fragments['quantities']      = $quantities_in_cart[ $variation_id ];
			$fragments['total_remaining'] = $total_remaining;
		}

		return $fragments;
	}

	/**
	 * Get the selected attibute name.
	 * 
	 * @return string The name of the attribute to create the buttons on the hover box.
	 */
	public static function get_attribute_name() {
		$attribute_name = get_option( 'wvhb_attribute_name', '' );
		return $attribute_name;
	}
	
}
