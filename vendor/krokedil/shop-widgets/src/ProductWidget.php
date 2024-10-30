<?php
namespace Krokedil\ShopWidgets;

use Krokedil\ShopWidgets\Abstracts\AbstractWidget;

/**
 * Product widget class.
 *
 * @package Krokedil\ShopWidgets
 */
class ProductWidget extends AbstractWidget {
	/**
	 * Get the widget slug to append to the settings.
	 *
	 * @return string
	 */
	public function get_slug() {
		return 'product';
	}

	/**
	 * Get the options for the widget placements.
	 *
	 * @return array
	 */
	public function get_placement_options() {
		return array(
			'4'  => __( 'Above Title', 'krokedil-shop-widgets' ),
			'7'  => __( 'Between Title and Price', 'krokedil-shop-widgets' ),
			'15' => __( 'Between Price and Excerpt', 'krokedil-shop-widgets' ),
			'25' => __( 'Between Excerpt and Add to cart button', 'krokedil-shop-widgets' ),
			'35' => __( 'Between Add to cart button and Product meta', 'krokedil-shop-widgets' ),
			'45' => __( 'Between Product meta and Product sharing buttons', 'krokedil-shop-widgets' ),
			'55' => __( 'After Product sharing-buttons', 'krokedil-shop-widgets' ),
		);
	}

	/**
	 * Get the default option for the widget placement.
	 *
	 * @return string
	 */
	public function get_default_option() {
		return '45';
	}
	/**
	 * Get the hook to add the widget to.
	 *
	 * @return string
	 */
	public function get_hook() {
		return 'woocommerce_single_product_summary';
	}

	/**
	 * Get the priority for the widget.
	 *
	 * @return int
	 */
	public function get_priority() {
		return $this->get_setting( 'placement', '45' );
	}
	/**
	 * Is the page valid for the widget?
	 *
	 * @return bool
	 */
	public function is_valid_page() {
		return is_product();
	}
}
