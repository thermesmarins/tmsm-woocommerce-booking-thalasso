<?php

/**
 * Fired during plugin activation
 *
 * @link       https://github.com/nicomollet
 * @since      1.0.0
 *
 * @package    Tmsm_Woocommerce_Booking_Thalasso
 * @subpackage Tmsm_Woocommerce_Booking_Thalasso/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Tmsm_Woocommerce_Booking_Thalasso
 * @subpackage Tmsm_Woocommerce_Booking_Thalasso/includes
 * @author     Nicolas Mollet <nico.mollet@gmail.com>
 */
class Tmsm_Woocommerce_Booking_Thalasso_Activator
{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate()
	{
		// Register taxonomies first
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-tmsm-woocommerce-booking-thalasso-admin.php';
		$admin = new Tmsm_Woocommerce_Booking_Thalasso_Admin('tmsm-woocommerce-booking-thalasso', '1.2.7');
		$admin->register_taxonomy_duration();

		// Initialize duration terms
		$admin->initialize_duration_terms();
	}
}
