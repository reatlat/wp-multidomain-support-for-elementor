<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://reatlat.net
 * @since      1.0.0
 *
 * @package    Multidomain_Support_For_Elementor
 * @subpackage Multidomain_Support_For_Elementor/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Multidomain_Support_For_Elementor
 * @subpackage Multidomain_Support_For_Elementor/includes
 * @author     Alex Zappa <reatlat@gmail.com>
 */
class Multidomain_Support_For_Elementor_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'multidomain-support-for-elementor',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
