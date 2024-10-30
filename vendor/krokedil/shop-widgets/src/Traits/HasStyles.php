<?php
namespace Krokedil\ShopWidgets\Traits;

/**
 * Has styles trait.
 *
 * @package Krokedil\ShopWidgets\Traits
 */
trait HasStyles {
	/**
	 * Style handles.
	 *
	 * @var array<string>
	 */
	protected $style_handles = array();

	/**
	 * Get the style handles.
	 *
	 * @return array<string>
	 */
	public function get_style_handles() {
		return $this->style_handles;
	}

	/**
	 * Set the style handles.
	 *
	 * @param array<string> $style_handles The style handles.
	 *
	 * @return self
	 */
	public function set_style_handles( $style_handles ) {
		$this->style_handles = $style_handles;

		return $this;
	}
}
