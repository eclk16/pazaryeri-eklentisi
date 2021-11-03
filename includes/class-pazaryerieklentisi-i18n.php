<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link        https://emrecolak.net
 * @since      1.0.0
 *
 * @package    Pazaryerieklentisi
 * @subpackage Pazaryerieklentisi/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Pazaryerieklentisi
 * @subpackage Pazaryerieklentisi/includes
 * @author     Emre Çolak <pazaryerieklentisi@emrecolak.net>
 */
class Pazaryerieklentisi_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'pazaryerieklentisi',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
