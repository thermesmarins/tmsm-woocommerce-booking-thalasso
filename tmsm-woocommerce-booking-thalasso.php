<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/nicomollet
 * @since             1.0.0
 * @package           Tmsm_Woocommerce_Booking_Thalasso
 *
 * @wordpress-plugin
 * Plugin Name:       TMSM WooCommerce Booking Thalasso
 * Plugin URI:        https://github.com/thermesmarins/tmsm-woocommerce-booking-thalasso
 * Description:       Booking Thalasso
 * Version:           1.1.3
 * Author:            Nicolas Mollet
 * Author URI:        https://github.com/nicomollet
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tmsm-woocommerce-booking-thalasso
 * Domain Path:       /languages
 * Github Plugin URI: https://github.com/thermesmarins/tmsm-woocommerce-booking-thalasso
 * Github Branch:     master
 * Requires PHP:      5.6
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
define( 'TMSM_WOOCOMMERCE_BOOKING_THALASSO_VERSION', '1.1.3' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-tmsm-woocommerce-booking-thalasso-activator.php
 */
function activate_tmsm_woocommerce_booking_thalasso() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tmsm-woocommerce-booking-thalasso-activator.php';
	Tmsm_Woocommerce_Booking_Thalasso_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-tmsm-woocommerce-booking-thalasso-deactivator.php
 */
function deactivate_tmsm_woocommerce_booking_thalasso() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tmsm-woocommerce-booking-thalasso-deactivator.php';
	Tmsm_Woocommerce_Booking_Thalasso_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_tmsm_woocommerce_booking_thalasso' );
register_deactivation_hook( __FILE__, 'deactivate_tmsm_woocommerce_booking_thalasso' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-tmsm-woocommerce-booking-thalasso.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_tmsm_woocommerce_booking_thalasso() {

	$plugin = new Tmsm_Woocommerce_Booking_Thalasso();
	$plugin->run();

}
run_tmsm_woocommerce_booking_thalasso();
