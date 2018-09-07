<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://github.com/nicomollet
 * @since      1.0.0
 *
 * @package    Tmsm_Woocommerce_Booking_Thalasso
 * @subpackage Tmsm_Woocommerce_Booking_Thalasso/includes
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
 * @since      1.0.0
 * @package    Tmsm_Woocommerce_Booking_Thalasso
 * @subpackage Tmsm_Woocommerce_Booking_Thalasso/includes
 * @author     Nicolas Mollet <nico.mollet@gmail.com>
 */
class Tmsm_Woocommerce_Booking_Thalasso {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Tmsm_Woocommerce_Booking_Thalasso_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
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
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'TMSM_WOOCOMMERCE_BOOKING_THALASSO_VERSION' ) ) {
			$this->version = TMSM_WOOCOMMERCE_BOOKING_THALASSO_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'tmsm-woocommerce-booking-thalasso';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Tmsm_Woocommerce_Booking_Thalasso_Loader. Orchestrates the hooks of the plugin.
	 * - Tmsm_Woocommerce_Booking_Thalasso_i18n. Defines internationalization functionality.
	 * - Tmsm_Woocommerce_Booking_Thalasso_Admin. Defines all hooks for the admin area.
	 * - Tmsm_Woocommerce_Booking_Thalasso_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * Elementor overrides
		 */
		if ( function_exists( '_is_elementor_installed' ) ) {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/elementor/elementor-tag-accommodationpackageprice.php';
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/elementor/elementor-tag-packageprice.php';
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/elementor/elementor-tag-bookresaweburl.php';
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/elementor/elementor-tag-bookroombuttonlabel.php';
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/elementor/elementor-tag-packageratestable.php';
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/elementor/elementor-tag-packageratescards.php';
		}

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-tmsm-woocommerce-booking-thalasso-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-tmsm-woocommerce-booking-thalasso-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-tmsm-woocommerce-booking-thalasso-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-tmsm-woocommerce-booking-thalasso-public.php';

		$this->loader = new Tmsm_Woocommerce_Booking_Thalasso_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Tmsm_Woocommerce_Booking_Thalasso_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Tmsm_Woocommerce_Booking_Thalasso_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Tmsm_Woocommerce_Booking_Thalasso_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		// Post types
		$this->loader->add_action( 'init', $plugin_admin, 'register_post_type_accommodation' );
		$this->loader->add_action( 'init', $plugin_admin, 'register_post_type_package' );
		$this->loader->add_action( 'init', $plugin_admin, 'register_post_type_discovery' );
		$this->loader->add_action( 'init', $plugin_admin, 'register_post_type_spatreatment' );

		// Taxonomies
		$this->loader->add_action( 'init', $plugin_admin, 'register_taxonomy_accommodationtype' );
		$this->loader->add_action( 'init', $plugin_admin, 'register_taxonomy_packagetype' );
		$this->loader->add_action( 'init', $plugin_admin, 'register_taxonomy_triptype' );
		$this->loader->add_action( 'init', $plugin_admin, 'register_taxonomy_discoverytype' );
		$this->loader->add_action( 'init', $plugin_admin, 'register_taxonomy_spatreatmenttype' );

		// WooCommerce Product Type options
		$this->loader->add_filter( 'product_type_options', $plugin_admin, 'woocommerce_product_type_options_bookable' );
		$this->loader->add_action( 'woocommerce_variation_options', $plugin_admin, 'woocommerce_variation_options_bookable', 10 , 3 );
		$this->loader->add_action( 'woocommerce_save_product_variation', $plugin_admin, 'woocommerce_save_product_variation_bookable', 10, 2 );
		$this->loader->add_action( 'woocommerce_process_product_meta_simple', $plugin_admin, 'woocommerce_process_product_save_bookable_options', 10, 1 );
		$this->loader->add_action( 'woocommerce_process_product_meta_variable', $plugin_admin, 'woocommerce_process_product_save_bookable_options', 10, 1 );
		$this->loader->add_filter( 'woocommerce_product_data_tabs', $plugin_admin, 'woocommerce_product_data_tabs_bookable', 98 );
		$this->loader->add_filter( 'woocommerce_product_data_panels', $plugin_admin, 'woocommerce_product_data_panels_bookable' );

		// ACF
		$this->loader->add_action( 'acf/init', $plugin_admin, 'acf_register_groups' );
		$this->loader->add_filter( 'acf/settings/show_admin', $plugin_admin, 'acf_show_admin' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Tmsm_Woocommerce_Booking_Thalasso_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		// WooCommerce Button Booking
		$this->loader->add_action( 'woocommerce_before_add_to_cart_button', $plugin_public, 'woocommerce_before_add_to_cart_form' );
		$this->loader->add_action( 'woocommerce_after_add_to_cart_button', $plugin_public, 'woocommerce_after_add_to_cart_form' );

		// Ajax Functions
		$this->loader->add_action( 'wp_ajax_nopriv_booking_start', $plugin_public, 'booking_start' );
		$this->loader->add_action( 'wp_ajax_booking_start', $plugin_public, 'booking_start' );

		// Elementor
		$this->loader->add_action( 'elementor/dynamic_tags/register_tags', $plugin_public, 'elementor_tags_register', 10, 1 );
		$this->loader->add_action( 'elementor_pro/posts/query/accommodationpackage_price', $plugin_public, 'elementor_query_accommodationpackage_price', 10, 1);
		$this->loader->add_action( 'elementor_pro/posts/query/package_discover', $plugin_public, 'elementor_query_package_discover', 10, 1);

		// ACF
		$this->loader->add_filter( 'acf/format_value/name=new', $plugin_public, 'acf_format_value_new', 200);

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Tmsm_Woocommerce_Booking_Thalasso_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}


}