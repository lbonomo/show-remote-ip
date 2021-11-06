<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://lucasbonomo.com
 * @since     0.0.2
 *
 * @package    Show_Remote_Ip
 * @subpackage Show_Remote_Ip/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since     0.0.2
 * @package    Show_Remote_Ip
 * @subpackage Show_Remote_Ip/includes
 * @author     Lucas Bonomo <bonomo.lucas@gmail.com>
 */
class Show_Remote_Ip {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since   0.0.2
	 * @access   protected
	 * @var      Show_Remote_Ip_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since   0.0.2
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since   0.0.2
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since   0.0.2
	 */
	public function __construct() {
		if ( defined( 'SHOW_REMOTE_IP_VERSION' ) ) {
			$this->version = SHOW_REMOTE_IP_VERSION;
		} else {
			$this->version = '0.0.2';
		}
		$this->plugin_name = 'show-remote-ip';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->define_api_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Show_Remote_Ip_Loader. Orchestrates the hooks of the plugin.
	 * - Show_Remote_Ip_i18n. Defines internationalization functionality.
	 * - Show_Remote_Ip_Admin. Defines all hooks for the admin area.
	 * - Show_Remote_Ip_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since   0.0.2
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-show-remote-ip-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-show-remote-ip-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-show-remote-ip-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-show-remote-ip-public.php';

		/**
		 * The class responsible for defining API endpoint.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'api/class-show-remote-ip-api.php';

		$this->loader = new Show_Remote_Ip_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Show_Remote_Ip_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since   0.0.2
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Show_Remote_Ip_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since   0.0.2
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Show_Remote_Ip_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since   0.0.2
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Show_Remote_Ip_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		// @lbonomo | Registro el shortcode.
		$this->loader->add_action( 'shortcode', $plugin_public, 'show-remote-ip' );
		// Ver public/class-[]-public.php.
		add_shortcode( 'show-remote-ip', array( $plugin_public, 'show_remote_ip' ) );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since   0.0.2
	 * @access   private
	 */
	private function define_api_hooks() {

		$plugin_api = new Show_Remote_Ip_API( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'rest_api_init', $plugin_api, 'show_remote_ip_api' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since   0.0.2
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since    0.0.2
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since    0.0.2
	 * @return    Show_Remote_Ip_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since    0.0.2
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
