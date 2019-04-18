<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://reatlat.net
 * @since             1.0.0
 * @package           Elementor_Multidomain_Support
 *
 * @wordpress-plugin
 * Plugin Name:       Elementor Multidomain support
 * Plugin URI:        https://github.com/reatlat/wp-elementor-multidomain-support
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Alex Zappa a.k.a. re[at]lat
 * Author URI:        https://reatlat.net
 * Donate link:       https://www.paypal.me/reatlat/5usd
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       elementor-multidomain-support
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'ELEMENTOR_MULTIDOMAIN_SUPPORT_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-elementor-multidomain-support-activator.php
 */
function activate_elementor_multidomain_support() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-elementor-multidomain-support-activator.php';
	Elementor_Multidomain_Support_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-elementor-multidomain-support-deactivator.php
 */
function deactivate_elementor_multidomain_support() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-elementor-multidomain-support-deactivator.php';
	Elementor_Multidomain_Support_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_elementor_multidomain_support' );
register_deactivation_hook( __FILE__, 'deactivate_elementor_multidomain_support' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-elementor-multidomain-support.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_elementor_multidomain_support() {

	$plugin = new Elementor_Multidomain_Support();
	$plugin->run();

}
run_elementor_multidomain_support();
