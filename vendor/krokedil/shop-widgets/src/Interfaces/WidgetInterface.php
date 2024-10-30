<?php
namespace Krokedil\ShopWidgets\Interfaces;

/**
 * Widget interface.
 *
 * @package Krokedil\ShopWidgets\Interfaces
 */
interface WidgetInterface {
	/**
	 * Get the output of the widget.
	 *
	 * @return string
	 */
	public function get_output();

	/**
	 * Get the widget settings that can be added to the plugin using the widget.
	 *
	 * @param string $title The title of the widget.
	 *
	 * @return array
	 */
	public function get_setting_fields( $title );

	/**
	 * Render the widget.
	 *
	 * @return void
	 */
	public function render();

	/**
	 * Get the setting value for the widget.
	 *
	 * @param string $setting_key The key for the setting.
	 * @param mixed  $default_value The default value to return if the setting is not set. Default is false.
	 *
	 * @return mixed
	 */
	public function get_setting( $setting_key, $default_value = false );
}
