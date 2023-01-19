<?php

use \Sandro_Nunes\Lib\Util;

/**
 * This is just an example.
 */

defined( 'ABSPATH' ) || exit;

add_shortcode( 'wvhb-hover-box' , 'wvhb_hover_box_shortcode' );

function wvhb_hover_box_shortcode( $atts, $content, $tag ) {

	// Default attributes.
	$atts = shortcode_atts(
		[
			'attribute-name'   => '',
			'style'            => '',
			'always-visible'   => '',
			'title-visible'    => '',
			'title'            => '',
			'check-mark-delay' => '',
		],
		$atts,
		$tag
	);

	// Filter attributes.
	$atts['check_mark_delay'] = filter_var( $atts['check-mark-delay'],  FILTER_VALIDATE_INT );

	// Displays the shortcode html.
	$template = Util::locate_template( 'shortcode-' . str_replace( '_', '-', $tag ) . '.php' );

	ob_start();

	if ( $template ) {
		include $template;
	}

	$out = ob_get_clean();

	return $out;
}
