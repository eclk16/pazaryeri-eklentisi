<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link               https://emrecolak.net
 * @since             1.0.0
 * @package           Pazaryerieklentisi
 *
 * @wordpress-plugin
 * Plugin Name:       PazaryeriEklentisi
 * Plugin URI:        https://pazaryerieklentisi.com
 * Description:       Woocommerce Ürünlerinizi Pazaryerlerindeki Ürünleriniz İle Eş Zamanlı Yürütün.
 * Version:           1.0.0
 * Author:            Emre Çolak
 * Author URI:        https://emrecolak.net
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       pazaryerieklentisi
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
define('WCMP_LANG','PazaryeriEklentisi');
define('MY_PLUGIN_PATH',plugin_dir_url(__FILE__));
define('MY_PLUGIN_PATHH',plugin_dir_path(__FILE__));
define('OPTION_PREFİX','pzryr_');
/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PAZARYERIEKLENTISI_VERSION', '1.13.8' );
require_once 'vendor/autoload.php';
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-pazaryerieklentisi-activator.php
 */
function activate_pazaryerieklentisi() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pazaryerieklentisi-activator.php';
	Pazaryerieklentisi_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-pazaryerieklentisi-deactivator.php
 */
function deactivate_pazaryerieklentisi() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pazaryerieklentisi-deactivator.php';
	Pazaryerieklentisi_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_pazaryerieklentisi' );
register_deactivation_hook( __FILE__, 'deactivate_pazaryerieklentisi' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-pazaryerieklentisi.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_pazaryerieklentisi() {

	$plugin = new Pazaryerieklentisi();
	$plugin->run();

}
run_pazaryerieklentisi();
