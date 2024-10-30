<?php
namespace Krokedil\ShopWidgets;

use Krokedil\ShopWidgets\Abstracts\AbstractWidget;

/**
 * Cart widget class.
 *
 * @package Krokedil\ShopWidgets
 */
class CartWidget extends AbstractWidget {
	/**
	 * Get the widget slug to append to the settings.
	 *
	 * @return string
	 */
	public function get_slug() {
		return 'cart';
	}

	/**
	 * Get the options for the widget placements.
	 *
	 * @return array
	 */
	public function get_placement_options() {
		return array(
			'woocommerce_cart_collaterals'    => __( 'Above Cross sell', 'krokedil-shop-widgets' ),
			'woocommerce_before_cart_totals'  => __( 'Above cart totals', 'krokedil-shop-widgets' ),
			'woocommerce_proceed_to_checkout' => __( 'Between cart totals and proceed to checkout button', 'krokedil-shop-widgets' ),
			'woocommerce_after_cart_totals'   => __( 'After proceed to checkout button', 'krokedil-shop-widgets' ),
			'woocommerce_after_cart'          => __( 'Bottom of the page', 'krokedil-shop-widgets' ),
		);
	}

	/**
	 * Get the default option for the widget placement.
	 *
	 * @return string
	 */
	public function get_default_option() {
		return 'woocommerce_cart_collaterals';
	}
	/**
	 * Get the hook to add the widget to.
	 *
	 * @return string
	 */
	public function get_hook() {
		return $this->get_setting( 'placement', 'woocommerce_cart_collaterals' );
	}

	/**
	 * Get the priority for the widget.
	 *
	 * @return int
	 */
	public function get_priority() {
		return 5;
	}
	/**
	 * Is the page valid for the widget?
	 *
	 * @return bool
	 */
	public function is_valid_page() {
		return is_cart();
	}
}
