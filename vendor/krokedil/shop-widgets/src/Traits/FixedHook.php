<?php
namespace Krokedil\ShopWidgets\Traits;

/**
 * Trait FixedHook
 *
 * @package Krokedil\ShopWidgets\Traits
 */
trait FixedHook {
	/**
	 * The hook to add the widget to.
	 *
	 * @var string|null
	 */
	protected $hook = null;

	/**
	 * The priority of the hook.
	 *
	 * @var int|null
	 */
	protected $priority = null;

	/**
	 * Set the hook to add the widget to.
	 *
	 * @param string $hook The hook to add the widget to.
	 *
	 * @return self
	 */
	public function set_hook( $hook ) {
		$this->hook = $hook;

		return $this;
	}

	/**
	 * Set the priority of the hook.
	 *
	 * @param int $priority The priority of the hook.
	 *
	 * @return self
	 */
	public function set_priority( $priority ) {
		$this->priority = $priority;

		return $this;
	}
}
