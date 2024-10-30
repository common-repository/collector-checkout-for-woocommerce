<?php
namespace Krokedil\ShopWidgets;

defined( 'ABSPATH' ) || exit;

/**
 * Assets class to handle the assets for the package.
 *
 * @package Krokedil\ShopWidgets
 */
class Assets {
	/**
	 * The path to the packages assets folder.
	 *
	 * @var string
	 */
	protected $assets_path;

	/**
	 * Allowed sections to add the assets to.
	 *
	 * @var array
	 */
	protected $allowed_sections = array();

	/**
	 * Class constructor.
	 */
	public function __construct() {
		$this->assets_path = plugin_dir_url( __FILE__ ) . '../assets/';

		add_action( 'init', array( $this, 'register_assets' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
	}

	/**
	 * Add an allowed section to add the assets to.
	 *
	 * @param string $section The section to add the assets to.
	 *
	 * @return self
	 */
	public function add_allowed_section( $section ) {
		$this->allowed_sections[] = $section;

		return $this;
	}

	/**
	 * Check if the current section is allowed.
	 *
	 * @return bool
	 */
	public function is_section_allowed() {
		$section = isset( $_GET['section'] ) ? sanitize_text_field( wp_unslash( $_GET['section'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Nonce is not required here.

		return in_array( $section, $this->allowed_sections, true );
	}

	/**
	 * Register the scripts.
	 *
	 * @return void
	 */
	public function register_assets() {
		wp_register_style( 'krokedil-shop-widgets-settings', $this->assets_path . 'css/settings-page.css', array(), '1.0.0' );
		wp_register_script( 'krokedil-shop-widgets-settings', $this->assets_path . 'js/settings-page.js', array( 'jquery' ), '1.0.0', true );
	}

	/**
	 * Enqueue the assets.
	 *
	 * @return void
	 */
	public function enqueue_assets() {
		// Only if we are on a WC Settings page.
		if ( ! is_admin() || ! isset( $_GET['page'] ) || 'wc-settings' !== $_GET['page'] ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Nonce is not required here.
			return;
		}

		// Only if we are in an allowed section.
		if ( ! $this->is_section_allowed() ) {
			return;
		}

		wp_enqueue_style( 'krokedil-shop-widgets-settings' );
		wp_enqueue_script( 'krokedil-shop-widgets-settings' );
	}
}
