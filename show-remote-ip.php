<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://lucasbonomo.com
 * @since             1.3.0
 * @package           Show_Remote_Ip
 *
 * @wordpress-plugin
 * Plugin Name:       Show Remote IP
 * Plugin URI:        https://lucasbonomo.com/wordpress
 * Description:       Just show the remote IP of client (with a shortcode [show-remote-ip])
 * Version:           1.3.0
 * Stable tag:        1.3.0
 * Requires PHP:      7.0
 * Tested up to:      6.7.1
 * Author:            Lucas Bonomo
 * Author URI:        https://lucasbonomo.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       show-remote-ip
 * Domain Path:       /languages
 */

use Show_Remote_Ip;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 0.0.2 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'SHOW_REMOTE_IP_VERSION', '1.3.0' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-show-remote-ip.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 */
function run_show_remote_ip() {

	$plugin = new Show_Remote_Ip();
	$plugin->run();
}
run_show_remote_ip();
