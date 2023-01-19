<?php
/**
 * Plugin Name: WooCommerce Variations Hover Box
 * Version: 1.0.0
 * Description: Adds a variation box when hovering a product in the shop page, which you can click to quick add to cart that product variation. This is intended for shops that have products variations using only one attribute, like size, or just color, etc.
 * Author: Sandro Nunes
 * Author URI: https://sandronunes.com
 * Text Domain: wvhb
 * Domain Path: /languages/
 * Requires at least: 5.3
 * Tested up to: 6.0.2
 * Requires PHP: 5.6
  */

namespace Sandro_Nunes\WooCommerce_Variations_Hover_Box;

use Sandro_Nunes\Lib\Util;
use Sandro_Nunes\Lib\Plugin;
use function Sandro_Nunes\Lib\wvhb_include;

defined( 'ABSPATH' ) || exit;

// Include autoloader.
require_once __DIR__ . '/vendor/autoload.php';

/**
 * WooCommerce_Variations_Hover_Box.
 */
class WooCommerce_Variations_Hover_Box {

	protected static $_instance = null;
	private $args               = [];
	public $core                = null;
	public $admin               = null;
	public $frontend            = null;

	/**
	 * Ensures only one instance is loaded or can be loaded.
	 */
	public static function instance( $args = [] ) {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self( $args );
		}
		return self::$_instance;
	}

	/**
	 * Constructor.
	 */
	public function __construct( $args = [] ) {
		$this->args = $args;
	}

	/**
	 * Initialize.
	 */
	public function initialize() {
		$this->init_core();
		$this->includes();
		$this->instantiate();
	}

	/**
	 * Init plugin core.
	 */
	private function init_core() {
		$this->core = new Plugin( [ 'file' => __FILE__ ] );
	}

	/**
	 * Includes.
	 */
	public function includes() {

		Util::include( [
			WVHB_DIR . 'src/functions-wvhb.php',
			WVHB_DIR . 'shortcodes/wvhb-hover-box.php',
		] );

	}

	/**
	 * Instantiate.
	 */
	private function instantiate() {

		if ( ! is_admin() || wp_doing_ajax() ) {
			$this->frontend = new Frontend();
		}

	}

}

/**
 * Unique access to instance of WooCommerce_Variations_Hover_Box class.
 * 
 * @return object Object instance.
 */
function WooCommerce_Variations_Hover_Box() {
	return WooCommerce_Variations_Hover_Box::instance()->initialize();
}

/**
 * Initializate Plugin.
 */
WooCommerce_Variations_Hover_Box();
