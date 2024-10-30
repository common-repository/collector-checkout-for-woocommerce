<?php
namespace Krokedil\ShopWidgets\Traits;

/**
 * Has scripts trait.
 *
 * @package Krokedil\ShopWidgets\Traits
 */
trait HasScripts {
	/**
	 * Script handles.
	 *
	 * @var array<string>
	 */
	protected $script_handles = array();

	/**
	 * Get the script handles.
	 *
	 * @return array<string>
	 */
	public function get_script_handles() {
		return $this->script_handles;
	}

	/**
	 * Set the script handles.
	 *
	 * @param array<string> $script_handles The script handles.
	 *
	 * @return self
	 */
	public function set_script_handles( $script_handles ) {
		$this->script_handles = $script_handles;

		return $this;
	}
}
