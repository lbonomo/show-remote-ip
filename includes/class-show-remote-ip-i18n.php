<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://lucasbonomo.com
 * @since     0.0.2
 *
 * @package    Show_Remote_Ip
 * @subpackage Show_Remote_Ip/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since     0.0.2
 * @package    Show_Remote_Ip
 * @subpackage Show_Remote_Ip/includes
 * @author     Lucas Bonomo <bonomo.lucas@gmail.com>
 */
class Show_Remote_Ip_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since   0.0.2
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'show-remote-ip',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
