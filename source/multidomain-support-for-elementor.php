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
 * @package           Multidomain_Support_For_Elementor
 *
 * @wordpress-plugin
 * Plugin Name:       Multidomain support for Elementor
 * Plugin URI:        https://github.com/reatlat/wp-multidomain-support-for-elementor
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Alex Zappa a.k.a. re[at]lat
 * Author URI:        https://reatlat.net
 * Donate link:       https://www.paypal.me/reatlat/5usd
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       multidomain-support-for-elementor
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('MULTIDOMAIN_SUPPORT_FOR_ELEMENTOR_VERSION', '1.0.0');

if (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG && !defined('MULTIDOMAIN_SUPPORT_FOR_ELEMENTOR_DEBUG'))
    define('MULTIDOMAIN_SUPPORT_FOR_ELEMENTOR_DEBUG', true);

if (!defined('MULTIDOMAIN_SUPPORT_FOR_ELEMENTOR_DEBUG'))
    define('MULTIDOMAIN_SUPPORT_FOR_ELEMENTOR_DEBUG', false);

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class--activator.php
 */
function activate_Multidomain_Support_For_Elementor()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class--activator.php';
    Multidomain_Support_For_Elementor_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class--deactivator.php
 */
function deactivate_Multidomain_Support_For_Elementor()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class--deactivator.php';
    Multidomain_Support_For_Elementor_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_Multidomain_Support_For_Elementor');
register_deactivation_hook(__FILE__, 'deactivate_Multidomain_Support_For_Elementor');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_Multidomain_Support_For_Elementor()
{

    $plugin = new Multidomain_Support_For_Elementor();
    $plugin->run();

}

run_Multidomain_Support_For_Elementor();
