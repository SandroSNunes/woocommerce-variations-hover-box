<?php 

/**
 * Loop Variations Hover Box
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/variations-hover-box.php.
 */

defined( 'ABSPATH' ) || exit;

// Gets the product attribute name to used to show the variations buttons.
$attribute_name  = 'pa_' . sanitize_title( wvhb_get_attribute_name() );

// Gets all variations from main loop product.
$variation_ids = $product->get_children();

// Gets the variations buttons html for the selected product attribute.
$buttons_html = '';

ob_start();

foreach ( $variation_ids  as $variation_id ) {

	$variation = wc_get_product( $variation_id );

	$attributes = [];
	if ( $variation->is_type('variation') ) {
		$attributes = $variation->get_variation_attributes();
	}

	// Verifies if the variation has the product attribute used to show the variation buttons.
	if ( isset( $attributes[ 'attribute_' . $attribute_name ] ) ) {

		$term_obj  = get_term_by( 'slug', $attributes[ 'attribute_' . $attribute_name ], $attribute_name );
		
		$term_name = '';
		if ( $term_obj ) {
			$term_name = $term_obj->name;
		}

		// Gets the variation stock.
		$stock = $variation->get_stock_quantity();

		// Gets quantities for each item in cart (array of product id / quantity pairs).
		$quantities_in_cart = WC()->cart->get_cart_item_quantities(); 

		// Total items remaining (stock - quantity in cart).
		$total_remaining = $stock;
		if ( isset( $quantities_in_cart[ $variation_id ] ) ) {
			$total_remaining = $stock - $quantities_in_cart[ $variation_id ];
		}
		
		?>
			<button href="<?php echo $variation->add_to_cart_url() ?>" value="<?php echo esc_attr( $variation_id ); ?>" class="variations-hover-box-button add_to_cart_button ajax_add_to_cart" data-quantity="1"  data-product_id="<?php echo $variation_id; ?>" data-product_sku="<?php echo esc_attr( $variation->get_sku() ); ?>" aria-label="<?php printf( esc_attr__( 'Add “%s” to your cart', 'wvhb' ), esc_attr( $product->get_title() ) ); ?>" rel="nofollow" <?php if ( $stock != '' && $stock >= 0 && $total_remaining < 1 ) echo 'disabled'; ?>>
				<span><?php echo $term_name; ?></span>
			</button>
		<?php
	}

}

$buttons_html = ob_get_clean();

// Extra classes built from the admin settings page.
$extra_classes = ' wvhb-style-' . get_option( 'wvhb_style', '1' );
$extra_classes .= get_option( 'wvhb_always_visible', '' ) ? ' wvhb-always-visible' : '';

if ( $buttons_html ) {
?>
<div class="variations-hover-box<?php echo esc_attr( $extra_classes ); ?>">
	<div class="variations-hover-box-content">
		<?php if ( get_option( 'wvhb_title_visible', true ) ) { ?>
		<h6 class="variations-hover-box-title">
			<?php echo esc_html( get_option( 'wvhb_title' ), __( 'Quick add', 'wvhb' ) ); ?>
		</h6>
		<?php } ?>
		<div class="variations-hover-box-buttons-container">
			<?php echo $buttons_html; ?>
			<span class="added_to_cart"></span>
		</div>
	</div>
</div>
<?php } ?>