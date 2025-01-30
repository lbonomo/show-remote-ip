<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://lucasbonomo.com
 * @since      0.0.2
 *
 * @package    Show_Remote_Ip
 * @subpackage Show_Remote_Ip/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Show_Remote_Ip
 * @subpackage Show_Remote_Ip/public
 * @author     Lucas Bonomo <bonomo.lucas@gmail.com>
 */
class Show_Remote_Ip_API {

	/**
	 * The ID of this plugin.
	 *
	 * @since    0.0.2
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    0.0.2
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    0.0.2
	 * @param    string $plugin_name  The name of the plugin.
	 * @param    string $version      The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Arranco con el ShortCode.
	 */
	public function show_remote_ip_api() {
		register_rest_route(
			'show-remote-ip/v1',
			'/get-ip',
			array(
				'methods'  => 'GET',
				'callback' => 'Show_Remote_Ip_API::get_remote_ip',
			)
		);
	}

	/**
	 * Get IP.
	 */
	public static function get_remote_ip() {
		$remote_address = '';
		$forwarded_for  = '';
		$client_ip      = '';

		// HTTP_X_FORWARDED_FOR.
		if ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) && ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
			$forwarded_for = explode(
				',',
				sanitize_text_field( wp_unslash( $_SERVER['HTTP_X_FORWARDED_FOR'] ) )
			);
		}

		// HTTP_CLIENT_IP.
		if ( isset( $_SERVER['HTTP_CLIENT_IP'] ) && ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
			$client_ip = sanitize_text_field( wp_unslash( $_SERVER['HTTP_CLIENT_IP'] ) );
		}

		// REMOTE_ADDR.
		if ( isset( $_SERVER['REMOTE_ADDR'] ) && ! empty( $_SERVER['REMOTE_ADDR'] ) ) {
			$remote_address = sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) );
		}

		$data = array(
			'forwarded_for'  => $forwarded_for,
			'client_ip'      => $client_ip,
			'remote_address' => $remote_address,
		);

		return $data;
	}
}
