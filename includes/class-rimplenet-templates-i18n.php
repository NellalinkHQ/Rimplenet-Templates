<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://rimplenet.com/templates
 * @since      1.0.0
 *
 * @package    Rimplenet_Templates
 * @subpackage Rimplenet_Templates/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Rimplenet_Templates
 * @subpackage Rimplenet_Templates/includes
 * @author     Nellalink <info@rimplenet.com>
 */
class Rimplenet_Templates_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'rimplenet-templates',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
