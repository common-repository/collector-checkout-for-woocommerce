<?php
/**
 * Gets checkout information.
 *
 * @package  Collector/Classes/Requests
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class Collector_Checkout_Requests_Get_Checkout_Information
 */
class Collector_Checkout_Requests_Get_Checkout_Information extends Collector_Checkout_Requests {

	/**
	 * The endpoint path.
	 *
	 * @var string
	 */
	public $path = '';

	/**
	 * Class constructor
	 *
	 * @param string      $private_id The private Checkout Id.
	 * @param string      $customer_type The Customer type.
	 * @param bool|string $currency The currency.
	 */
	public function __construct( $private_id, $customer_type, $currency = false ) {
		parent::__construct();

		// Use current selected (or store base) currency if it's not passed in the constructor.
		if ( empty( $currency ) ) {
			$currency = get_woocommerce_currency();
		}

		$collector_settings = get_option( 'woocommerce_collector_checkout_settings' );
		switch ( $currency ) {
			case 'SEK':
				$store_id = $collector_settings[ 'collector_merchant_id_se_' . $customer_type ];
				break;
			case 'NOK':
				$store_id = $collector_settings[ 'collector_merchant_id_no_' . $customer_type ];
				break;
			case 'DKK':
				$store_id = $collector_settings[ 'collector_merchant_id_dk_' . $customer_type ];
				break;
			case 'EUR':
				$store_id = $collector_settings[ 'collector_merchant_id_fi_' . $customer_type ];
				break;
			default:
				$store_id = $collector_settings[ 'collector_merchant_id_se_' . $customer_type ];
				break;
		}
		$this->private_id = $private_id;
		$this->path       = '/merchants/' . $store_id . '/checkouts/' . $private_id;
	}

	/**
	 * Get the request args.
	 *
	 * @return array
	 */
	private function get_request_args() {
		$request_args = array(
			'headers' => $this->request_header( '', $this->path ),
			'timeout' => 10,
			'method'  => 'GET',
		);
		return $request_args;
	}

	/**
	 * Make the request.
	 *
	 * @return array|object|WP_Error
	 */
	public function request() {
		$request_url  = $this->base_url . $this->path;
		$request_args = $this->get_request_args();
		$response     = wp_remote_request( $request_url, $request_args );
		$code         = wp_remote_retrieve_response_code( $response );

		// Log the request.
		$log = CCO_WC()->logger::format_log( $this->private_id, 'GET', 'CCO get checkout', $request_args, $request_url, json_decode( wp_remote_retrieve_body( $response ), true ), $code );
		CCO_WC()->logger::log( $log );

		$formatted_response = $this->process_response( $response, $request_args, $request_url );
		return $formatted_response;
	}
}
