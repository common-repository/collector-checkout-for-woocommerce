<?php
namespace Krokedil\ShopWidgets\Abstracts;

use Krokedil\ShopWidgets\Assets;
use Krokedil\ShopWidgets\Interfaces\WidgetInterface;
use Krokedil\ShopWidgets\Traits\FixedHook;
use Krokedil\ShopWidgets\Traits\HasScripts;
use Krokedil\ShopWidgets\Traits\HasStyles;


/**
 * Abstract Widget class.
 *
 * @package Krokedil\ShopWidgets\Abstracts
 */
abstract class AbstractWidget implements WidgetInterface {
	use FixedHook;
	use HasScripts;
	use HasStyles;

	/**
	 * The output of the widget.
	 *
	 * @var string
	 */
	protected $output;

	/**
	 * The plugin slug for the plugin that is adding the widget.
	 *
	 * @var string
	 */
	protected $plugin_slug;

	/**
	 * Plugin settings.
	 *
	 * @var array
	 */
	protected $plugin_settings;

	/**
	 * Settings prefix.
	 *
	 * @var string
	 */
	protected $setting_prefix = '';

	/**
	 * Assets class instance.
	 *
	 * @var Assets
	 */
	protected $assets;

	/**
	 * Class constructor.
	 *
	 * @param string $plugin_slug The slug for the plugin that is adding the widget.
	 * @param array  $plugin_settings The settings for the plugin that is adding the widget.
	 *
	 * @return void
	 */
	public function __construct( $plugin_slug, $plugin_settings = array() ) {
		$this->assets         = new Assets();
		$this->plugin_slug    = $plugin_slug;
		$this->setting_prefix = $plugin_slug . '_' . $this->get_slug() . '_';
		$this->set_plugin_settings( $plugin_settings );

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
	}

	/**
	 * Get the hook to add the widget to.
	 *
	 * @return string
	 */
	abstract public function get_hook();

	/**
	 * Get the priority for the widget.
	 *
	 * @return int
	 */
	abstract public function get_priority();

	/**
	 * Get the widget slug to append to the settings.
	 *
	 * @return string
	 */
	abstract public function get_slug();

	/**
	 * Get the options for the widget placements.
	 *
	 * @return array<string>
	 */
	abstract public function get_placement_options();

	/**
	 * Get the default option for the widget placement.
	 *
	 * @return string
	 */
	abstract public function get_default_option();

	/**
	 * Is the page valid for the widget?
	 *
	 * @return bool
	 */
	abstract public function is_valid_page();

	/**
	 * Initialize the widget and register the actions to add the widget.
	 *
	 * @return void
	 */
	public function init() {
		if ( ! $this->is_enabled() ) {
			return;
		}

		// Get the placement from the settings.
		$placement            = $this->get_setting( 'placement', $this->get_default_option() );
		$use_custom_placement = 'custom' === $placement;

		// If we have a fixed hook or priority, use that instead of the settings.
		$hook     = $this->hook;
		$priority = $this->priority;

		if ( $use_custom_placement ) {
			$hook     ??= $this->get_setting( 'custom_placement_hook' );
			$priority ??= $this->get_setting( 'custom_placement_priority' );
		} else {
			$hook     ??= $this->get_hook();
			$priority ??= $this->get_priority();
		}

		add_action( $hook, array( $this, 'render' ), $priority );
	}

	/**
	 * Is the widget enabled?
	 *
	 * @return bool
	 */
	public function is_enabled() {
		return $this->get_setting( 'enable' ) === 'yes';
	}

	/**
	 * Enqueue the assets for the widget.
	 *
	 * @return void
	 */
	public function enqueue_assets() {
		if ( ! $this->is_enabled() || ! $this->is_valid_page() ) {
			return;
		}

		foreach ( $this->get_script_handles() as $script ) {
			wp_enqueue_script( $script );
		}

		foreach ( $this->get_style_handles() as $style ) {
			wp_enqueue_style( $style );
		}
	}

	/**
	 * Render the widget.
	 *
	 * @return void
	 */
	public function render() {
		echo wp_kses_post( $this->get_output() );
	}

	/**
	 * Get the widget settings that can be added to the plugin using the widget.
	 *
	 * @param string $title The title of the widget.
	 *
	 * @return array
	 */
	public function get_setting_fields( $title ) {
		$placement_options = $this->get_placement_options();
		// Add a standard option for the placement that is "custom" to enabled the custom placements.
		$placement_options['custom'] = __( 'Custom Placement', 'krokedil-shop-widgets' );

		// Get the current placement value if it is set.
		$placement = $this->get_setting( 'placement', $this->get_default_option() );

		// If custom placement is enabled.
		$using_custom_placement = 'custom' === $placement;

		$settings = array(
			$this->setting_prefix . 'section'   => array(
				'type'  => 'title',
				'title' => $title,
			),
			$this->setting_prefix . 'enable'    => array(
				'title'   => __( 'Enable the widget', 'krokedil-shop-widgets' ),
				'type'    => 'checkbox',
				'default' => 'no',
			),
			$this->setting_prefix . 'placement' => array(
				'type'              => 'select',
				'desc_tip'          => __( 'Select where you want to place the widget.', 'krokedil-shop-widgets' ),
				'title'             => __( 'Placement', 'krokedil-shop-widgets' ),
				'default'           => $this->get_default_option(),
				'options'           => $placement_options,
				'custom_attributes' => array(
					'data-krokedil-placement'   => true,
					'data-krokedil-setting-key' => $this->setting_prefix,
				),
			),
			$this->setting_prefix . 'custom_placement_hook' => array(
				'title'             => __( 'Custom placement hook', 'krokedil-shop-widgets' ),
				'desc_tip'          => __( 'Enter your own action that you want to use for the placement of the widget.', 'krokedil-shop-widgets' ),
				'type'              => 'text',
				'default'           => '',
				'class'             => 'krokedil-shop-widget-custom-placement' . ( $using_custom_placement ? '' : ' krokedil-shop-widget-hidden' ), // Add a class for the custom placement fields to hide them if custom placement is not enabled.
				'custom_attributes' => array(
					'data-krokedil-setting-key' => $this->setting_prefix,
				),
			),
			$this->setting_prefix . 'custom_placement_priority' => array(
				'title'             => __( 'Custom placement hook priority', 'krokedil-shop-widgets' ),
				'desc_tip'          => __( 'Enter the priority for the custom hook that you want to use.', 'krokedil-shop-widgets' ),
				'type'              => 'number',
				'default'           => '',
				'class'             => 'krokedil-shop-widget-custom-placement' . ( $using_custom_placement ? '' : ' krokedil-shop-widget-hidden' ), // Add a class for the custom placement fields to hide them if custom placement is not enabled.
				'custom_attributes' => array(
					'data-krokedil-setting-key' => $this->setting_prefix,
				),
			),
		);

		// Register the plugin slug as a allowed section for the assets to be added to.
		$this->assets->add_allowed_section( $this->plugin_slug );

		return $settings;
	}

	/**
	 * Get the output of the widget.
	 *
	 * @return string
	 */
	public function get_output() {
		return $this->output;
	}

	/**
	 * Set the output of the widget.
	 *
	 * @param string $output The output of the widget.
	 *
	 * @return self
	 */
	public function set_output( $output ) {
		$this->output = $output;

		return $this;
	}

	/**
	 * Get the settings for the plugin that is adding the widget.
	 *
	 * @return array
	 */
	public function get_plugin_settings() {
		return $this->plugin_settings;
	}

	/**
	 * Set the settings for the plugin that is adding the widget.
	 *
	 * @param array $plugin_settings The settings for the plugin that is adding the widget.
	 *
	 * @return self
	 */
	public function set_plugin_settings( $plugin_settings ) {
		$this->plugin_settings = $plugin_settings;

		return $this;
	}

	/**
	 * Get the setting value for the widget.
	 *
	 * @param string $setting_key The key for the setting, without the prefix.
	 * @param mixed  $default_value The default value to return if the setting is not set. Default is false.
	 *
	 * @return mixed
	 */
	public function get_setting( $setting_key, $default_value = false ) {
		return $this->plugin_settings[ $this->setting_prefix . $setting_key ] ?? $default_value;
	}
}
