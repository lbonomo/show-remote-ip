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
class Show_Remote_Ip_Public {

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
	 * @param      string $plugin_name       The name of the plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/show-remote-ip-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/show-remote-ip-public.js', array( 'jquery' ), $this->version, false );
	}

	/**
	 * Display the remote IP address of the client.
	 *
	 * This function retrieves the client's IP address from the server's
	 * `REMOTE_ADDR` variable and returns it wrapped in a span element
	 * with the class "show-remote-ip".
	 *
	 * @return string HTML span element containing the client's IP address.
	 */
	public function show_remote_ip() {
		$remote_address = '';
		if ( isset( $_SERVER['REMOTE_ADDR'] ) && ! empty( $_SERVER['REMOTE_ADDR'] ) ) {
			$remote_address = sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) );
		}
		$html = '<span class="show-remote-ip">' . $remote_address . '</span>';
		return $html;
	}
}
