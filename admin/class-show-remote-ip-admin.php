<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://lucasbonomo.com
 * @since      0.0.2
 *
 * @package    Show_Remote_Ip
 * @subpackage Show_Remote_Ip/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Show_Remote_Ip
 * @subpackage Show_Remote_Ip/admin
 * @author     Lucas Bonomo <bonomo.lucas@gmail.com>
 */
class Show_Remote_Ip_Admin {

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
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    0.0.2
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Show_Remote_Ip_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Show_Remote_Ip_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/show-remote-ip-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    0.0.2
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Show_Remote_Ip_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Show_Remote_Ip_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/show-remote-ip-admin.js', array( 'jquery' ), $this->version, false );
	}
}
