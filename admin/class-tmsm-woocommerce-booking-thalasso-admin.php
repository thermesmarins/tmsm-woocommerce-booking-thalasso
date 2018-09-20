<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/nicomollet
 * @since      1.0.0
 *
 * @package    Tmsm_Woocommerce_Booking_Thalasso
 * @subpackage Tmsm_Woocommerce_Booking_Thalasso/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Tmsm_Woocommerce_Booking_Thalasso
 * @subpackage Tmsm_Woocommerce_Booking_Thalasso/admin
 * @author     Nicolas Mollet <nico.mollet@gmail.com>
 */
class Tmsm_Woocommerce_Booking_Thalasso_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tmsm-woocommerce-booking-thalasso-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tmsm-woocommerce-booking-thalasso-admin.js', array( 'jquery' ), $this->version, false );

	}


	/**
	 * Creates a new custom post type: accommodation
	 *
	 * @since 	1.0.0
	 * @access 	public
	 * @uses 	register_post_type()
	 */
	public static function register_post_type_accommodation() {
		$opts                                           = [];
		$single                                         = __( 'Accommodation', 'tmsm-woocommerce-booking-thalasso' );
		$plural                                         = __( 'Accommodations', 'tmsm-woocommerce-booking-thalasso' );
		$cpt_name                                       = 'accommodation';
		$opts['menu_icon']                              = 'dashicons-building';
		$opts['can_export']                             = true;
		$opts['capability_type']                        = 'page';
		$opts['description']                            = '';
		$opts['exclude_from_search']                    = false;
		$opts['has_archive']                            = true;
		$opts['hierarchical']                           = false;
		$opts['map_meta_cap']                           = true;
		$opts['menu_position']                          = 25;
		$opts['public']                                 = true;
		$opts['publicly_querable']                      = true;
		$opts['query_var']                              = true;
		$opts['register_meta_box_cb']                   = '';
		$opts['show_in_admin_bar']                      = true;
		$opts['show_in_menu']                           = true;
		$opts['show_in_nav_menu']                       = true;
		$opts['show_ui']                                = true;
		$opts['supports']                               = array( 'title', 'editor', 'thumbnail', 'page-attributes' );
		$opts['taxonomies']                             = array();
		$opts['capabilities']['delete_others_posts']    = "delete_others_posts";
		$opts['capabilities']['delete_post']            = "delete_post";
		$opts['capabilities']['delete_posts']           = "delete_posts";
		$opts['capabilities']['delete_private_posts']   = "delete_private_posts";
		$opts['capabilities']['delete_published_posts'] = "delete_published_posts";
		$opts['capabilities']['edit_others_posts']      = "edit_others_posts";
		$opts['capabilities']['edit_post']              = "edit_post";
		$opts['capabilities']['edit_posts']             = "edit_posts";
		$opts['capabilities']['edit_private_posts']     = "edit_private_posts";
		$opts['capabilities']['edit_published_posts']   = "edit_published_posts";
		$opts['capabilities']['publish_posts']          = "publish_posts";
		$opts['capabilities']['read_post']              = "read_post";
		$opts['capabilities']['read_private_posts']     = "read_private_posts";
		$opts['labels']['add_new']                      = sprintf( esc_html__( 'Add New %s', 'tmsm-woocommerce-booking-thalasso' ), $single );
		$opts['labels']['add_new_item']                 = sprintf( esc_html__( 'Add New %s', 'tmsm-woocommerce-booking-thalasso' ), $single );
		$opts['labels']['all_items']                    = sprintf( esc_html__( '%s', 'tmsm-woocommerce-booking-thalasso' ), $plural );
		$opts['labels']['edit_item']                    = sprintf( esc_html__( 'Edit %s', 'tmsm-woocommerce-booking-thalasso' ), $single );
		$opts['labels']['menu_name']                    = sprintf( esc_html__( '%s', 'tmsm-woocommerce-booking-thalasso' ), $plural );
		$opts['labels']['name']                         = sprintf( esc_html__( '%s', 'tmsm-woocommerce-booking-thalasso' ), $plural );
		$opts['labels']['name_admin_bar']               = sprintf( esc_html__( '%s', 'tmsm-woocommerce-booking-thalasso' ), $single );
		$opts['labels']['new_item']                     = sprintf( esc_html__( 'New %s', 'tmsm-woocommerce-booking-thalasso' ), $single );
		$opts['labels']['not_found']                    = sprintf( esc_html__( 'No %s Found', 'tmsm-woocommerce-booking-thalasso' ), $plural );
		$opts['labels']['not_found_in_trash']           = sprintf( esc_html__( 'No %s Found in Trash', 'tmsm-woocommerce-booking-thalasso' ), $plural );
		$opts['labels']['parent_item_colon']            = sprintf( esc_html__( 'Parent %s:', 'tmsm-woocommerce-booking-thalasso' ), $plural );
		$opts['labels']['search_items']                 = sprintf( esc_html__( 'Search %s', 'tmsm-woocommerce-booking-thalasso' ), $plural );
		$opts['labels']['singular_name']                = sprintf( esc_html__( '%s', 'tmsm-woocommerce-booking-thalasso' ), $plural );
		$opts['labels']['view_item']                    = sprintf( esc_html__( 'View %s', 'tmsm-woocommerce-booking-thalasso' ), $single );
		$opts['rewrite']['ep_mask']                     = EP_PERMALINK;
		$opts['rewrite']['feeds']                       = false;
		$opts['rewrite']['pages']                       = true;
		$opts['rewrite']['slug']                        = strtolower( $cpt_name );
		$opts['rewrite']['with_front']                  = false;
		register_post_type( strtolower( $cpt_name ), $opts );

	}

	/**
	 * Creates a new custom taxonomy: accommodationtype
	 *
	 * @since 	1.0.0
	 * @access 	public
	 * @uses 	register_taxonomy()
	 */
	function register_taxonomy_accommodationtype() {
		$labels = array(
			'name'              => _x( 'Accommodation Types', 'taxonomy general name', 'tmsm-woocommerce-booking-thalasso' ),
			'singular_name'     => _x( 'Accommodation Type', 'taxonomy singular name', 'tmsm-woocommerce-booking-thalasso' ),
			'search_items'      => __( 'Search Accommodation Type', 'tmsm-woocommerce-booking-thalasso' ),
			'all_items'         => __( 'All Accommodation Types', 'tmsm-woocommerce-booking-thalasso' ),
			'parent_item'       => __( 'Parent Accommodation Type', 'tmsm-woocommerce-booking-thalasso' ),
			'parent_item_colon' => __( 'Parent Accommodation Type:', 'tmsm-woocommerce-booking-thalasso' ),
			'edit_item'         => __( 'Edit Accommodation Type', 'tmsm-woocommerce-booking-thalasso' ),
			'update_item'       => __( 'Update Accommodation Type', 'tmsm-woocommerce-booking-thalasso' ),
			'add_new_item'      => __( 'Add New Accommodation Type', 'tmsm-woocommerce-booking-thalasso' ),
			'new_item_name'     => __( 'New Accommodation Type', 'tmsm-woocommerce-booking-thalasso' ),
			'menu_name'         => __( 'Accommodation Types', 'tmsm-woocommerce-booking-thalasso' ),
		);

		$args = array(
			'hierarchical'      => false,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'accomodation-type' ),
		);

		register_taxonomy( 'accommodation_type', array( 'accommodation' ), $args );
	}

	/**
	 * Creates a new custom post type: package
	 *
	 * @since 	1.0.0
	 * @access 	public
	 * @uses 	register_post_type()
	 */
	public static function register_post_type_package() {
		$opts                                           = [];
		$single                                         = __( 'Package', 'tmsm-woocommerce-booking-thalasso' );
		$plural                                         = __( 'Packages', 'tmsm-woocommerce-booking-thalasso' );
		$cpt_name                                       = 'package';
		$opts['menu_icon']                              = 'dashicons-clipboard';
		$opts['can_export']                             = true;
		$opts['capability_type']                        = 'page';
		$opts['description']                            = '';
		$opts['exclude_from_search']                    = false;
		$opts['has_archive']                            = true;
		$opts['hierarchical']                           = false;
		$opts['map_meta_cap']                           = true;
		$opts['menu_position']                          = 30;
		$opts['public']                                 = true;
		$opts['publicly_querable']                      = true;
		$opts['query_var']                              = true;
		$opts['register_meta_box_cb']                   = '';
		$opts['show_in_admin_bar']                      = true;
		$opts['show_in_menu']                           = true;
		$opts['show_in_nav_menu']                       = true;
		$opts['show_ui']                                = true;
		$opts['supports']                               = array( 'title', 'editor', 'thumbnail', 'page-attributes', 'excerpt', 'comments' );
		$opts['taxonomies']                             = array();
		$opts['capabilities']['delete_others_posts']    = "delete_others_posts";
		$opts['capabilities']['delete_post']            = "delete_post";
		$opts['capabilities']['delete_posts']           = "delete_posts";
		$opts['capabilities']['delete_private_posts']   = "delete_private_posts";
		$opts['capabilities']['delete_published_posts'] = "delete_published_posts";
		$opts['capabilities']['edit_others_posts']      = "edit_others_posts";
		$opts['capabilities']['edit_post']              = "edit_post";
		$opts['capabilities']['edit_posts']             = "edit_posts";
		$opts['capabilities']['edit_private_posts']     = "edit_private_posts";
		$opts['capabilities']['edit_published_posts']   = "edit_published_posts";
		$opts['capabilities']['publish_posts']          = "publish_posts";
		$opts['capabilities']['read_post']              = "read_post";
		$opts['capabilities']['read_private_posts']     = "read_private_posts";
		$opts['labels']['add_new']                      = sprintf( esc_html__( 'Add New %s', 'tmsm-woocommerce-booking-thalasso' ), $single );
		$opts['labels']['add_new_item']                 = sprintf( esc_html__( 'Add New %s', 'tmsm-woocommerce-booking-thalasso' ), $single );
		$opts['labels']['all_items']                    = sprintf( esc_html__( '%s', 'tmsm-woocommerce-booking-thalasso' ), $plural );
		$opts['labels']['edit_item']                    = sprintf( esc_html__( 'Edit %s', 'tmsm-woocommerce-booking-thalasso' ), $single );
		$opts['labels']['menu_name']                    = sprintf( esc_html__( '%s', 'tmsm-woocommerce-booking-thalasso' ), $plural );
		$opts['labels']['name']                         = sprintf( esc_html__( '%s', 'tmsm-woocommerce-booking-thalasso' ), $plural );
		$opts['labels']['name_admin_bar']               = sprintf( esc_html__( '%s', 'tmsm-woocommerce-booking-thalasso' ), $single );
		$opts['labels']['new_item']                     = sprintf( esc_html__( 'New %s', 'tmsm-woocommerce-booking-thalasso' ), $single );
		$opts['labels']['not_found']                    = sprintf( esc_html__( 'No %s Found', 'tmsm-woocommerce-booking-thalasso' ), $plural );
		$opts['labels']['not_found_in_trash']           = sprintf( esc_html__( 'No %s Found in Trash', 'tmsm-woocommerce-booking-thalasso' ), $plural );
		$opts['labels']['parent_item_colon']            = sprintf( esc_html__( 'Parent %s:', 'tmsm-woocommerce-booking-thalasso' ), $plural );
		$opts['labels']['search_items']                 = sprintf( esc_html__( 'Search %s', 'tmsm-woocommerce-booking-thalasso' ), $plural );
		$opts['labels']['singular_name']                = sprintf( esc_html__( '%s', 'tmsm-woocommerce-booking-thalasso' ), $plural );
		$opts['labels']['view_item']                    = sprintf( esc_html__( 'View %s', 'tmsm-woocommerce-booking-thalasso' ), $single );
		$opts['rewrite']['ep_mask']                     = EP_PERMALINK;
		$opts['rewrite']['feeds']                       = false;
		$opts['rewrite']['pages']                       = true;
		$opts['rewrite']['slug']                        = strtolower( $cpt_name );
		$opts['rewrite']['with_front']                  = false;
		register_post_type( strtolower( $cpt_name ), $opts );
	}

	/**
	 * Creates a new custom taxonomy: packagetype
	 *
	 * @since 	1.0.0
	 * @access 	public
	 * @uses 	register_taxonomy()
	 */
	function register_taxonomy_packagetype() {
		$labels = array(
			'name'              => _x( 'Package Types', 'taxonomy general name', 'tmsm-woocommerce-booking-thalasso' ),
			'singular_name'     => _x( 'Package Type', 'taxonomy singular name', 'tmsm-woocommerce-booking-thalasso' ),
			'search_items'      => __( 'Search Package Type', 'tmsm-woocommerce-booking-thalasso' ),
			'all_items'         => __( 'All Package Types', 'tmsm-woocommerce-booking-thalasso' ),
			'parent_item'       => __( 'Parent Package Type', 'tmsm-woocommerce-booking-thalasso' ),
			'parent_item_colon' => __( 'Parent Package Type:', 'tmsm-woocommerce-booking-thalasso' ),
			'edit_item'         => __( 'Edit Package Type', 'tmsm-woocommerce-booking-thalasso' ),
			'update_item'       => __( 'Update Package Type', 'tmsm-woocommerce-booking-thalasso' ),
			'add_new_item'      => __( 'Add New Package Type', 'tmsm-woocommerce-booking-thalasso' ),
			'new_item_name'     => __( 'New Package Type', 'tmsm-woocommerce-booking-thalasso' ),
			'menu_name'         => __( 'Package Types', 'tmsm-woocommerce-booking-thalasso' ),
		);

		$args = array(
			'hierarchical'      => false,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'package-type' ),
		);

		register_taxonomy( 'package_type', array( 'package' ), $args );
	}

	/**
	 * Creates a new custom taxonomy: triptype
	 *
	 * @since 	1.0.0
	 * @access 	public
	 * @uses 	register_taxonomy()
	 */
	function register_taxonomy_triptype() {
		$labels = array(
			'name'              => _x( 'Trip Types', 'taxonomy general name', 'tmsm-woocommerce-booking-thalasso' ),
			'singular_name'     => _x( 'Trip Type', 'taxonomy singular name', 'tmsm-woocommerce-booking-thalasso' ),
			'search_items'      => __( 'Search Trip Type', 'tmsm-woocommerce-booking-thalasso' ),
			'all_items'         => __( 'All Trip Types', 'tmsm-woocommerce-booking-thalasso' ),
			'parent_item'       => __( 'Parent Trip Type', 'tmsm-woocommerce-booking-thalasso' ),
			'parent_item_colon' => __( 'Parent Trip Type:', 'tmsm-woocommerce-booking-thalasso' ),
			'edit_item'         => __( 'Edit Trip Type', 'tmsm-woocommerce-booking-thalasso' ),
			'update_item'       => __( 'Update Trip Type', 'tmsm-woocommerce-booking-thalasso' ),
			'add_new_item'      => __( 'Add New Trip Type', 'tmsm-woocommerce-booking-thalasso' ),
			'new_item_name'     => __( 'New Trip Type', 'tmsm-woocommerce-booking-thalasso' ),
			'menu_name'         => __( 'Trip Types', 'tmsm-woocommerce-booking-thalasso' ),
		);

		$args = array(
			'hierarchical'      => false,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'trip-type', 'with_front' => false),
		);

		register_taxonomy( 'trip_type', array( 'package' ), $args );
	}

	/**
	 * Creates a new custom post type: discovery
	 *
	 * @since 	1.0.1
	 * @access 	public
	 * @uses 	register_post_type()
	 */
	public static function register_post_type_discovery() {
		$opts                                           = [];
		$single                                         = __( 'Discovery', 'tmsm-woocommerce-booking-thalasso' );
		$plural                                         = __( 'Discoveries', 'tmsm-woocommerce-booking-thalasso' );
		$cpt_name                                       = 'discovery';
		$opts['menu_icon']                              = 'dashicons-clipboard';
		$opts['can_export']                             = true;
		$opts['capability_type']                        = 'page';
		$opts['description']                            = '';
		$opts['exclude_from_search']                    = false;
		$opts['has_archive']                            = true;
		$opts['hierarchical']                           = false;
		$opts['map_meta_cap']                           = true;
		$opts['menu_position']                          = 30;
		$opts['public']                                 = true;
		$opts['publicly_querable']                      = true;
		$opts['query_var']                              = true;
		$opts['register_meta_box_cb']                   = '';
		$opts['show_in_admin_bar']                      = true;
		$opts['show_in_menu']                           = true;
		$opts['show_in_nav_menu']                       = true;
		$opts['show_ui']                                = true;
		$opts['supports']                               = array( 'title', 'editor', 'thumbnail', 'page-attributes', 'excerpt' );
		$opts['taxonomies']                             = array();
		$opts['capabilities']['delete_others_posts']    = "delete_others_posts";
		$opts['capabilities']['delete_post']            = "delete_post";
		$opts['capabilities']['delete_posts']           = "delete_posts";
		$opts['capabilities']['delete_private_posts']   = "delete_private_posts";
		$opts['capabilities']['delete_published_posts'] = "delete_published_posts";
		$opts['capabilities']['edit_others_posts']      = "edit_others_posts";
		$opts['capabilities']['edit_post']              = "edit_post";
		$opts['capabilities']['edit_posts']             = "edit_posts";
		$opts['capabilities']['edit_private_posts']     = "edit_private_posts";
		$opts['capabilities']['edit_published_posts']   = "edit_published_posts";
		$opts['capabilities']['publish_posts']          = "publish_posts";
		$opts['capabilities']['read_post']              = "read_post";
		$opts['capabilities']['read_private_posts']     = "read_private_posts";
		$opts['labels']['add_new']                      = sprintf( esc_html__( 'Add New %s', 'tmsm-woocommerce-booking-thalasso' ), $single );
		$opts['labels']['add_new_item']                 = sprintf( esc_html__( 'Add New %s', 'tmsm-woocommerce-booking-thalasso' ), $single );
		$opts['labels']['all_items']                    = sprintf( esc_html__( '%s', 'tmsm-woocommerce-booking-thalasso' ), $plural );
		$opts['labels']['edit_item']                    = sprintf( esc_html__( 'Edit %s', 'tmsm-woocommerce-booking-thalasso' ), $single );
		$opts['labels']['menu_name']                    = sprintf( esc_html__( '%s', 'tmsm-woocommerce-booking-thalasso' ), $plural );
		$opts['labels']['name']                         = sprintf( esc_html__( '%s', 'tmsm-woocommerce-booking-thalasso' ), $plural );
		$opts['labels']['name_admin_bar']               = sprintf( esc_html__( '%s', 'tmsm-woocommerce-booking-thalasso' ), $single );
		$opts['labels']['new_item']                     = sprintf( esc_html__( 'New %s', 'tmsm-woocommerce-booking-thalasso' ), $single );
		$opts['labels']['not_found']                    = sprintf( esc_html__( 'No %s Found', 'tmsm-woocommerce-booking-thalasso' ), $plural );
		$opts['labels']['not_found_in_trash']           = sprintf( esc_html__( 'No %s Found in Trash', 'tmsm-woocommerce-booking-thalasso' ), $plural );
		$opts['labels']['parent_item_colon']            = sprintf( esc_html__( 'Parent %s:', 'tmsm-woocommerce-booking-thalasso' ), $plural );
		$opts['labels']['search_items']                 = sprintf( esc_html__( 'Search %s', 'tmsm-woocommerce-booking-thalasso' ), $plural );
		$opts['labels']['singular_name']                = sprintf( esc_html__( '%s', 'tmsm-woocommerce-booking-thalasso' ), $plural );
		$opts['labels']['view_item']                    = sprintf( esc_html__( 'View %s', 'tmsm-woocommerce-booking-thalasso' ), $single );
		$opts['rewrite']['ep_mask']                     = EP_PERMALINK;
		$opts['rewrite']['feeds']                       = false;
		$opts['rewrite']['pages']                       = true;
		$opts['rewrite']['slug']                        = strtolower( $cpt_name );
		$opts['rewrite']['with_front']                  = false;
		register_post_type( strtolower( $cpt_name ), $opts );
	}

	/**
	 * Creates a new custom taxonomy: discovery_type
	 *
	 * @since 	1.0.1
	 * @access 	public
	 * @uses 	register_taxonomy()
	 */
	function register_taxonomy_discoverytype() {
		$labels = array(
			'name'              => _x( 'Discovery Types', 'taxonomy general name', 'tmsm-woocommerce-booking-thalasso' ),
			'singular_name'     => _x( 'Discovery Type', 'taxonomy singular name', 'tmsm-woocommerce-booking-thalasso' ),
			'search_items'      => __( 'Search Discovery Type', 'tmsm-woocommerce-booking-thalasso' ),
			'all_items'         => __( 'All Discovery Types', 'tmsm-woocommerce-booking-thalasso' ),
			'parent_item'       => __( 'Parent Discovery Type', 'tmsm-woocommerce-booking-thalasso' ),
			'parent_item_colon' => __( 'Parent Discovery Type:', 'tmsm-woocommerce-booking-thalasso' ),
			'edit_item'         => __( 'Edit Discovery Type', 'tmsm-woocommerce-booking-thalasso' ),
			'update_item'       => __( 'Update Discovery Type', 'tmsm-woocommerce-booking-thalasso' ),
			'add_new_item'      => __( 'Add New Discovery Type', 'tmsm-woocommerce-booking-thalasso' ),
			'new_item_name'     => __( 'New Discovery Type', 'tmsm-woocommerce-booking-thalasso' ),
			'menu_name'         => __( 'Discovery Types', 'tmsm-woocommerce-booking-thalasso' ),
		);

		$args = array(
			'hierarchical'      => false,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'discovery-type' ),
		);

		register_taxonomy( 'discovery_type', array( 'discovery' ), $args );
	}
	/**
	 * Creates a new custom post type: spa-treatment
	 *
	 * @since 	1.0.1
	 * @access 	public
	 * @uses 	register_post_type()
	 */
	public static function register_post_type_spatreatment() {
		$opts                                           = [];
		$single                                         = __( 'Spa Treatment', 'tmsm-woocommerce-booking-thalasso' );
		$plural                                         = __( 'Spa Treatments', 'tmsm-woocommerce-booking-thalasso' );
		$cpt_name                                       = 'spatreatment';
		$opts['menu_icon']                              = 'dashicons-clipboard';
		$opts['can_export']                             = true;
		$opts['capability_type']                        = 'page';
		$opts['description']                            = '';
		$opts['exclude_from_search']                    = false;
		$opts['has_archive']                            = true;
		$opts['hierarchical']                           = false;
		$opts['map_meta_cap']                           = true;
		$opts['menu_position']                          = 30;
		$opts['public']                                 = true;
		$opts['publicly_querable']                      = true;
		$opts['query_var']                              = true;
		$opts['register_meta_box_cb']                   = '';
		$opts['show_in_admin_bar']                      = true;
		$opts['show_in_menu']                           = true;
		$opts['show_in_nav_menu']                       = true;
		$opts['show_ui']                                = true;
		$opts['supports']                               = array( 'title', 'editor', 'thumbnail', 'page-attributes', 'excerpt' );
		$opts['taxonomies']                             = array();
		$opts['capabilities']['delete_others_posts']    = "delete_others_posts";
		$opts['capabilities']['delete_post']            = "delete_post";
		$opts['capabilities']['delete_posts']           = "delete_posts";
		$opts['capabilities']['delete_private_posts']   = "delete_private_posts";
		$opts['capabilities']['delete_published_posts'] = "delete_published_posts";
		$opts['capabilities']['edit_others_posts']      = "edit_others_posts";
		$opts['capabilities']['edit_post']              = "edit_post";
		$opts['capabilities']['edit_posts']             = "edit_posts";
		$opts['capabilities']['edit_private_posts']     = "edit_private_posts";
		$opts['capabilities']['edit_published_posts']   = "edit_published_posts";
		$opts['capabilities']['publish_posts']          = "publish_posts";
		$opts['capabilities']['read_post']              = "read_post";
		$opts['capabilities']['read_private_posts']     = "read_private_posts";
		$opts['labels']['add_new']                      = sprintf( esc_html__( 'Add New %s', 'tmsm-woocommerce-booking-thalasso' ), $single );
		$opts['labels']['add_new_item']                 = sprintf( esc_html__( 'Add New %s', 'tmsm-woocommerce-booking-thalasso' ), $single );
		$opts['labels']['all_items']                    = sprintf( esc_html__( '%s', 'tmsm-woocommerce-booking-thalasso' ), $plural );
		$opts['labels']['edit_item']                    = sprintf( esc_html__( 'Edit %s', 'tmsm-woocommerce-booking-thalasso' ), $single );
		$opts['labels']['menu_name']                    = sprintf( esc_html__( '%s', 'tmsm-woocommerce-booking-thalasso' ), $plural );
		$opts['labels']['name']                         = sprintf( esc_html__( '%s', 'tmsm-woocommerce-booking-thalasso' ), $plural );
		$opts['labels']['name_admin_bar']               = sprintf( esc_html__( '%s', 'tmsm-woocommerce-booking-thalasso' ), $single );
		$opts['labels']['new_item']                     = sprintf( esc_html__( 'New %s', 'tmsm-woocommerce-booking-thalasso' ), $single );
		$opts['labels']['not_found']                    = sprintf( esc_html__( 'No %s Found', 'tmsm-woocommerce-booking-thalasso' ), $plural );
		$opts['labels']['not_found_in_trash']           = sprintf( esc_html__( 'No %s Found in Trash', 'tmsm-woocommerce-booking-thalasso' ), $plural );
		$opts['labels']['parent_item_colon']            = sprintf( esc_html__( 'Parent %s:', 'tmsm-woocommerce-booking-thalasso' ), $plural );
		$opts['labels']['search_items']                 = sprintf( esc_html__( 'Search %s', 'tmsm-woocommerce-booking-thalasso' ), $plural );
		$opts['labels']['singular_name']                = sprintf( esc_html__( '%s', 'tmsm-woocommerce-booking-thalasso' ), $plural );
		$opts['labels']['view_item']                    = sprintf( esc_html__( 'View %s', 'tmsm-woocommerce-booking-thalasso' ), $single );
		$opts['rewrite']['ep_mask']                     = EP_PERMALINK;
		$opts['rewrite']['feeds']                       = false;
		$opts['rewrite']['pages']                       = true;
		$opts['rewrite']['slug']                        = strtolower( $cpt_name );
		$opts['rewrite']['with_front']                  = false;
		register_post_type( strtolower( $cpt_name ), $opts );
	}

	/**
	 * Order package/accommodation/spatreatment/discovery by order_menu
	 *
	 * @param WP_Query $query
	 */
	function pre_get_posts( $query ){

		if ( $query->is_main_query() && in_array( $query->get( 'post_type' ), [ 'package', 'accommodation', 'spatreatment', 'discovery' ] ) ) {
			if(empty($query->get( 'orderby'))){
				$query->set( 'orderby', 'menu_order' );
				$query->set( 'order', 'ASC' );
			}
		}

	}

	/**
	 * Creates a new custom taxonomy: spatreatment_type
	 *
	 * @since 	1.0.1
	 * @access 	public
	 * @uses 	register_taxonomy()
	 */
	function register_taxonomy_spatreatmenttype() {
		$labels = array(
			'name'              => _x( 'Spa Treatment Types', 'taxonomy general name', 'tmsm-woocommerce-booking-thalasso' ),
			'singular_name'     => _x( 'Spa Treatment Type', 'taxonomy singular name', 'tmsm-woocommerce-booking-thalasso' ),
			'search_items'      => __( 'Search Spa Treatment Type', 'tmsm-woocommerce-booking-thalasso' ),
			'all_items'         => __( 'All Spa Treatment Types', 'tmsm-woocommerce-booking-thalasso' ),
			'parent_item'       => __( 'Parent Spa Treatment Type', 'tmsm-woocommerce-booking-thalasso' ),
			'parent_item_colon' => __( 'Parent Spa Treatment Type:', 'tmsm-woocommerce-booking-thalasso' ),
			'edit_item'         => __( 'Edit Spa Treatment Type', 'tmsm-woocommerce-booking-thalasso' ),
			'update_item'       => __( 'Update Spa Treatment Type', 'tmsm-woocommerce-booking-thalasso' ),
			'add_new_item'      => __( 'Add New Spa Treatment Type', 'tmsm-woocommerce-booking-thalasso' ),
			'new_item_name'     => __( 'New Spa Treatment Type', 'tmsm-woocommerce-booking-thalasso' ),
			'menu_name'         => __( 'Spa Treatment Types', 'tmsm-woocommerce-booking-thalasso' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'spa-treatment-type' ),
		);

		register_taxonomy( 'spatreatment_type', array( 'spatreatment' ), $args );
	}

	/**
	 * Definition for product type option "bookable"
	 *
	 * @since 1.0.0
	 *
	 * @param $product_type_options
	 *
	 * @return mixed
	 */
	function woocommerce_product_type_options_bookable( $product_type_options ) {
		$product_type_options['bookable'] = array(
			'id'            => '_bookable',
			'wrapper_class' => 'show_if_simple',
			'label'         => __( 'Bookable', 'tmsm-woocommerce-booking-thalasso' ),
			'description'   => __( 'Bookable', 'tmsm-woocommerce-booking-thalasso' ),
			'default'       => 'no'
		);
		return $product_type_options;
	}

	/**
	 * Checkbox for product variation type "bookable"
	 *
	 * @since 1.0.0
	 *
	 * @param $loop
	 * @param $variation_data
	 * @param $variation
	 *
	 * @return void
	 */
	public function woocommerce_variation_options_bookable( $loop, $variation_data, $variation ) {
		$is_bookable = ( isset( $variation_data['_bookable'] ) && 'yes' == $variation_data['_bookable'][0] );
		echo '<label class="notips"><input type="checkbox" class="checkbox variable_is_bookable" name="variable_is_bookable[' . $loop . ']"' . checked( true, $is_bookable, false ) . '> '.__( 'Bookable', 'tmsm-woocommerce-booking-thalasso' ).'</label>' . PHP_EOL;
	}

	/**
	 * Save product variation type "bookable"
	 *
	 * @since 1.0.0
	 *
	 * @param integer $post_id
	 * @param integer $i
	 *
	 * @return void
	 */
	public function woocommerce_save_product_variation_bookable( $post_id, $i ) {
		$is_bookable = isset( $_POST['variable_is_bookable'][ $i ] ) ? 'yes' : 'no';
		update_post_meta( $post_id , '_bookable', $is_bookable );
	}


	/**
	 * Save options for tab "bookable"
	 *
	 * @since 1.0.0
	 *
	 * @param $post_id
	 *
	 * @return void
	 */
	function woocommerce_process_product_save_bookable_options( $post_id ) {
		$is_bookable = isset( $_POST['_bookable'] ) ? 'yes' : 'no';
		update_post_meta( $post_id, '_bookable', wc_clean($is_bookable) );

		if ( isset( $_POST['_bookable_has_accommodation'] ) && $_POST['_bookable_accommodation'] !== 0 ) :
			update_post_meta( $post_id, '_bookable_has_accommodation', wc_clean( $_POST['_bookable_has_accommodation'] ) );
		endif;
		if ( isset( $_POST['_bookable_accommodation'] ) && $_POST['_bookable_accommodation'] !== 0) :
			update_post_meta( $post_id, '_bookable_accommodation', wc_clean( $_POST['_bookable_accommodation'] ) );
		endif;
		if ( isset( $_POST['_bookable_package'] )  && $_POST['_bookable_accommodation'] !== 0 ) :
			update_post_meta( $post_id, '_bookable_package', wc_clean( $_POST['_bookable_package'] ) );
		endif;

	}

	/**
	 * Add a custom product tab "bookable"
	 *
	 * @since 1.0.0
	 *
	 * @param mixed $tabs
	 *
	 * @return mixed $tabs
	 */
	function woocommerce_product_data_tabs_bookable( $tabs ) {
		$tabs['bookable'] = array(
			'label'		=> __( 'Bookable', 'tmsm-woocommerce-booking-thalasso' ),
			'target'	=> 'bookable_options',
			'class'  => array( 'show_if_virtual', 'show_if_bookable', 'show_if_variable' ),
		);
		return $tabs;
	}

	/**
	 * Tab content of tab "bookable"
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	function woocommerce_product_data_panels_bookable() {
		global $post;

		// Note the 'id' attribute needs to match the 'target' parameter set above
		?><div id="bookable_options" class="panel woocommerce_options_panel hidden"><?php
		?>

		<div class='options_group'>

			<?php
			$packages = get_posts(['post_type' => 'package', 'numberposts' => -1]);
			if(is_array($packages)){
				$packages_array = [ 0 => '-- '.__( 'Select', 'tmsm-woocommerce-booking-thalasso' ). ' --'];
				foreach($packages as $package){
					$packages_array[$package->ID] = $package->post_title;
				}
				woocommerce_wp_select( array(
						'id'      => '_bookable_package',
						'label'   => __( 'Package', 'tmsm-woocommerce-booking-thalasso' ),
						'options' => $packages_array
					)
				);
			}
			?>

			<?php
			woocommerce_wp_checkbox( array(
				'id'          => '_bookable_has_accommodation',
				'label'       => __( 'Product has accommodation', 'tmsm-woocommerce-booking-thalasso' ),
				'default'     => 'no',
				'desc_tip'    => false,
			) );
			?>
			<?php

			$accommodations = get_posts(['post_type' => 'accommodation', 'numberposts' => -1]);
			if(is_array($accommodations)){
				$accommodations_array = [ 0 => '-- '.__( 'Select', 'tmsm-woocommerce-booking-thalasso' ). ' --'];
				foreach($accommodations as $accommodation){
					$accommodations_array[$accommodation->ID] = $accommodation->post_title;
				}
				woocommerce_wp_select( array(
						'id'      => '_bookable_accommodation',
						'label'   => __( 'Accommodation', 'tmsm-woocommerce-booking-thalasso' ),
						'options' => $accommodations_array
					)
				);
			}
			?>

		</div>

		</div><?php
	}

	/**
	 * ACF Register Groups
	 */
	public function acf_register_groups(){

		if( function_exists('acf_add_local_field_group') ):

			acf_add_local_field_group(array(
				'key' => 'group_5b92821712faa',
				'title' => 'Accommodation Type',
				'fields' => array(
					array(
						'key' => 'field_5b92821b40a42',
						'label' => 'Nombre de nuits par défaut',
						'name' => 'defaultnights',
						'type' => 'number',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => '',
						'max' => '',
						'step' => '',
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'taxonomy',
							'operator' => '==',
							'value' => 'accommodation_type',
						),
					),
				),
				'menu_order' => 0,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => 1,
				'description' => '',
			));

			acf_add_local_field_group(array(
				'key' => 'group_5b59b8de56b2e',
				'title' => 'Découverte',
				'fields' => array(
					array(
						'key' => 'field_5b5f15b970c42',
						'label' => 'Type de découverte',
						'name' => 'discovery_type',
						'type' => 'taxonomy',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'taxonomy' => 'discovery_type',
						'field_type' => 'checkbox',
						'allow_null' => 0,
						'add_term' => 0,
						'save_terms' => 1,
						'load_terms' => 1,
						'return_format' => 'object',
						'multiple' => 0,
					),
					array(
						'key' => 'field_5b5f11f7a55dc',
						'label' => 'Durée',
						'name' => 'duration',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '12',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_5b5b0c4bfe052',
						'label' => 'Prix',
						'name' => 'price',
						'type' => 'number',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '13',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => 'en € TTC',
						'min' => '',
						'max' => '',
						'step' => '',
					),
					array(
						'key' => 'field_5b59b982258be',
						'label' => 'ID Resaweb',
						'name' => 'id_resaweb',
						'type' => 'number',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '20',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => '',
						'max' => '',
						'step' => '',
					),
					array(
						'key' => 'field_5b59b959258bc',
						'label' => 'URL achat cadeau',
						'name' => 'gift_url',
						'type' => 'url',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
					),
					array(
						'key' => 'field_5b59b96b258bd',
						'label' => 'URL réservation',
						'name' => 'booking_url',
						'type' => 'url',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
					),
					array(
						'key' => 'field_5b59b9237d542',
						'label' => 'Description courte',
						'name' => 'short_description',
						'type' => 'textarea',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'rows' => 18,
						'new_lines' => 'wpautop',
					),
					array(
						'key' => 'field_5b8538dde0818',
						'label' => 'Galerie d’images',
						'name' => 'gallery',
						'type' => 'gallery',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'min' => '',
						'max' => '',
						'insert' => 'append',
						'library' => 'all',
						'min_width' => '',
						'min_height' => '',
						'min_size' => '',
						'max_width' => '',
						'max_height' => '',
						'max_size' => '',
						'mime_types' => '',
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'discovery',
						),
					),
				),
				'menu_order' => 0,
				'position' => 'normal',
				'style' => 'seamless',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => array(
					0 => 'discussion',
					1 => 'comments',
					2 => 'revisions',
					3 => 'author',
					4 => 'format',
					5 => 'categories',
					6 => 'tags',
					7 => 'send-trackbacks',
				),
				'active' => 1,
				'description' => '',
			));

			acf_add_local_field_group(array(
				'key' => 'group_5b5992d294411',
				'title' => 'Soins',
				'fields' => array(
					array(
						'key' => 'field_5b5b0b1c1fca4',
						'label' => 'Type de soin',
						'name' => 'spatreatment_type',
						'type' => 'taxonomy',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'taxonomy' => 'spatreatment_type',
						'field_type' => 'checkbox',
						'allow_null' => 0,
						'add_term' => 0,
						'save_terms' => 1,
						'load_terms' => 1,
						'return_format' => 'object',
						'multiple' => 0,
					),
					array(
						'key' => 'field_5b5993752a733',
						'label' => 'Durée',
						'name' => 'duration',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '12',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_5b5993952a734',
						'label' => 'Prix',
						'name' => 'price',
						'type' => 'number',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '13',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '€ TTC',
						'min' => '',
						'max' => '',
						'step' => '',
					),
					array(
						'key' => 'field_5b59f042a0189',
						'label' => 'Nombre de personnes',
						'name' => 'persons',
						'type' => 'radio',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '12',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							1 => '1',
							2 => '2',
						),
						'allow_null' => 0,
						'other_choice' => 0,
						'save_other_choice' => 0,
						'default_value' => 1,
						'layout' => 'horizontal',
						'return_format' => 'value',
					),
					array(
						'key' => 'field_5b5993c6a088a',
						'label' => 'Nouveau',
						'name' => 'new',
						'type' => 'true_false',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '13',
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => 0,
						'ui' => 0,
						'ui_on_text' => '',
						'ui_off_text' => '',
					),
					array(
						'key' => 'field_5b599405a088b',
						'label' => 'URL achat cadeau',
						'name' => 'gift_url',
						'type' => 'url',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
					),
					array(
						'key' => 'field_5b59b5c2ee60e',
						'label' => 'URL réservation',
						'name' => 'booking_url',
						'type' => 'url',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
					),
					array(
						'key' => 'field_5b5993a62a735',
						'label' => 'Description courte',
						'name' => 'short_description',
						'type' => 'textarea',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'rows' => '',
						'new_lines' => 'wpautop',
					),
					array(
						'key' => 'field_5b8538efe081a',
						'label' => 'Galerie d’images',
						'name' => 'gallery',
						'type' => 'gallery',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'min' => '',
						'max' => '',
						'insert' => 'append',
						'library' => 'all',
						'min_width' => '',
						'min_height' => '',
						'min_size' => '',
						'max_width' => '',
						'max_height' => '',
						'max_size' => '',
						'mime_types' => '',
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'spatreatment',
						),
					),
				),
				'menu_order' => 0,
				'position' => 'normal',
				'style' => 'seamless',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => array(
					0 => 'discussion',
					1 => 'comments',
					2 => 'revisions',
					3 => 'author',
					4 => 'format',
					5 => 'categories',
					6 => 'tags',
					7 => 'send-trackbacks',
				),
				'active' => 1,
				'description' => '',
			));

			acf_add_local_field_group(array(
				'key' => 'group_5b87ec0d07b9f',
				'title' => 'Taxonomy Secondary Description',
				'fields' => array(
					array(
						'key' => 'field_5b87ec05f12a8',
						'label' => 'Description secondaire',
						'name' => 'secondary_desc',
						'type' => 'wysiwyg',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'tabs' => 'visual',
						'toolbar' => 'full',
						'media_upload' => 1,
						'delay' => 0,
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'taxonomy',
							'operator' => '==',
							'value' => 'package_type',
						),
					),
					array(
						array(
							'param' => 'taxonomy',
							'operator' => '==',
							'value' => 'trip_type',
						),
					),
					array(
						array(
							'param' => 'taxonomy',
							'operator' => '==',
							'value' => 'discovery_type',
						),
					),
					array(
						array(
							'param' => 'taxonomy',
							'operator' => '==',
							'value' => 'spatreatment_type',
						),
					),
					array(
						array(
							'param' => 'taxonomy',
							'operator' => '==',
							'value' => 'accommodation_type',
						),
					),
				),
				'menu_order' => 0,
				'position' => 'normal',
				'style' => 'seamless',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => 1,
				'description' => '',
			));

			acf_add_local_field_group(array(
				'key' => 'group_5b62f9a2d2c62',
				'title' => 'Trip Type',
				'fields' => array(
					array(
						'key' => 'field_5b62f9d31fc44',
						'label' => 'Nombre de nuits par défautt',
						'name' => 'defaultnights',
						'type' => 'number',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '12',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => '',
						'max' => '',
						'step' => '',
					),
					array(
						'key' => 'field_5b8d22b6e78ea',
						'label' => 'Type d’hébergement',
						'name' => 'accommodation_type',
						'type' => 'taxonomy',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'taxonomy' => 'accommodation_type',
						'field_type' => 'checkbox',
						'add_term' => 1,
						'save_terms' => 0,
						'load_terms' => 0,
						'return_format' => 'id',
						'multiple' => 0,
						'allow_null' => 0,
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'taxonomy',
							'operator' => '==',
							'value' => 'trip_type',
						),
					),
				),
				'menu_order' => 0,
				'position' => 'normal',
				'style' => 'seamless',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => 1,
				'description' => '',
			));

			acf_add_local_field_group(array(
				'key' => 'group_5ba3bef36c906',
				'title' => 'Vidéo',
				'fields' => array(
					array(
						'key' => 'field_5ba3bf400a771',
						'label' => 'Vidéo',
						'name' => 'video',
						'type' => 'url',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'discovery',
						),
					),
				),
				'menu_order' => 0,
				'position' => 'normal',
				'style' => 'seamless',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => 1,
				'description' => '',
			));

			acf_add_local_field_group(array(
				'key' => 'group_5add9a2f4336f',
				'title' => 'Forfaits',
				'fields' => array(
					array(
						'key' => 'field_5b597fb250c94',
						'label' => 'Type de séjour',
						'name' => 'trip_type',
						'type' => 'taxonomy',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '25',
							'class' => '',
							'id' => '',
						),
						'taxonomy' => 'trip_type',
						'field_type' => 'radio',
						'allow_null' => 0,
						'add_term' => 0,
						'save_terms' => 1,
						'load_terms' => 1,
						'return_format' => 'object',
						'multiple' => 0,
					),
					array(
						'key' => 'field_5add9b41ce377',
						'label' => 'Type de forfait',
						'name' => 'package_type',
						'type' => 'taxonomy',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '25',
							'class' => '',
							'id' => '',
						),
						'taxonomy' => 'package_type',
						'field_type' => 'checkbox',
						'allow_null' => 0,
						'add_term' => 0,
						'save_terms' => 1,
						'load_terms' => 1,
						'return_format' => 'object',
						'multiple' => 0,
					),
					array(
						'key' => 'field_5b9147d82987f',
						'label' => 'Hébergements disponibles',
						'name' => 'accommodation',
						'type' => 'post_object',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'post_type' => array(
							0 => 'accommodation',
						),
						'taxonomy' => array(
						),
						'allow_null' => 0,
						'multiple' => 1,
						'return_format' => 'id',
						'ui' => 1,
					),
					array(
						'key' => 'field_5add9ad686f2b',
						'label' => 'Jours minimum',
						'name' => 'daysmin',
						'type' => 'number',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '12',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => '',
						'max' => '',
						'step' => '',
					),
					array(
						'key' => 'field_5add9b0286f2c',
						'label' => 'Jours maximum',
						'name' => 'daysmax',
						'type' => 'number',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '13',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => '',
						'max' => '',
						'step' => '',
					),
					array(
						'key' => 'field_5b87bb6d74ac5',
						'label' => 'Nouveau',
						'name' => 'new',
						'type' => 'true_false',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '12',
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => 0,
						'ui' => 0,
						'ui_on_text' => '',
						'ui_off_text' => '',
					),
					array(
						'key' => 'field_5b87bbe21d67b',
						'label' => 'Argumentaire',
						'name' => 'pitch',
						'type' => 'text',
						'instructions' => 'durée, soins, repas...',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_5b598b7aac662',
						'label' => 'Description courte',
						'name' => 'short_description',
						'type' => 'textarea',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'rows' => 4,
						'new_lines' => 'wpautop',
					),
					array(
						'key' => 'field_5addcb883f3af',
						'label' => 'Avantages',
						'name' => 'advantages',
						'type' => 'wysiwyg',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'tabs' => 'visual',
						'toolbar' => 'full',
						'media_upload' => 0,
						'delay' => 0,
					),
					array(
						'key' => 'field_5b59b732917ca',
						'label' => 'ID Resaweb',
						'name' => 'id_resaweb',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '13',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_5b61ce089b222',
						'label' => 'Nom de code Resaweb',
						'name' => 'codename',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '12',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_5b8538ebe0819',
						'label' => 'Galerie d’images',
						'name' => 'gallery',
						'type' => 'gallery',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'min' => '',
						'max' => '',
						'insert' => 'append',
						'library' => 'all',
						'min_width' => '',
						'min_height' => '',
						'min_size' => '',
						'max_width' => '',
						'max_height' => '',
						'max_size' => '',
						'mime_types' => '',
					),
					array(
						'key' => 'field_5add9a5386f2a',
						'label' => 'Jour de début',
						'name' => 'startday',
						'type' => 'checkbox',
						'instructions' => 'Jours pour lequels on peut commencer le forfait',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							1 => 'Lundi',
							2 => 'Mardi',
							3 => 'Mercredi',
							4 => 'Jeudi',
							5 => 'Vendredi',
							6 => 'Samedi',
							0 => 'Dimanche',
						),
						'allow_custom' => 0,
						'save_custom' => 0,
						'default_value' => array(
							0 => 0,
							1 => 1,
							2 => 2,
							3 => 3,
							4 => 4,
							5 => 5,
							6 => 6,
						),
						'layout' => 'horizontal',
						'toggle' => 0,
						'return_format' => 'value',
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'package',
						),
					),
				),
				'menu_order' => 100,
				'position' => 'normal',
				'style' => 'seamless',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => array(
					0 => 'revisions',
					1 => 'author',
					2 => 'format',
					3 => 'categories',
					4 => 'tags',
					5 => 'send-trackbacks',
				),
				'active' => 1,
				'description' => '',
			));

			acf_add_local_field_group(array(
				'key' => 'group_5ad9f39162772',
				'title' => 'Hébergement',
				'fields' => array(
					array(
						'key' => 'field_5b5976b4739c7',
						'label' => 'Type d’hébergement',
						'name' => 'accommodation_type',
						'type' => 'taxonomy',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '25',
							'class' => '',
							'id' => '',
						),
						'taxonomy' => 'accommodation_type',
						'field_type' => 'radio',
						'allow_null' => 0,
						'add_term' => 0,
						'save_terms' => 1,
						'load_terms' => 1,
						'return_format' => 'object',
						'multiple' => 0,
					),
					array(
						'key' => 'field_5ad9f3f998ae8',
						'label' => 'Étoiles',
						'name' => 'stars',
						'type' => 'number',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '13',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => '',
						'max' => '',
						'step' => '',
					),
					array(
						'key' => 'field_5ad9f59d5060b',
						'label' => 'Vue mer',
						'name' => 'seaview',
						'type' => 'true_false',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '12',
							'class' => '',
							'id' => '',
						),
						'message' => '',
						'default_value' => 0,
						'ui' => 0,
						'ui_on_text' => '',
						'ui_off_text' => '',
					),
					array(
						'key' => 'field_5ad9ff4798bbd',
						'label' => 'Localisation',
						'name' => 'location',
						'type' => 'text',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_5ad9fe4bde5db',
						'label' => 'Description courte',
						'name' => 'short_description',
						'type' => 'textarea',
						'instructions' => 'Slogan',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'rows' => 4,
						'new_lines' => 'wpautop',
					),
					array(
						'key' => 'field_5b8535b9485af',
						'label' => 'Galerie d’images',
						'name' => 'gallery',
						'type' => 'gallery',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'min' => '',
						'max' => '',
						'insert' => 'append',
						'library' => 'all',
						'min_width' => '',
						'min_height' => '',
						'min_size' => '',
						'max_width' => '',
						'max_height' => '',
						'max_size' => '',
						'mime_types' => '',
					),
					array(
						'key' => 'field_5b58877006b35',
						'label' => 'URL Availpro',
						'name' => 'availpro_url',
						'type' => 'url',
						'instructions' => 'URL de la page de de réservation Availpro',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
					),
					array(
						'key' => 'field_5b5887a906b36',
						'label' => 'URL Resaweb',
						'name' => 'resaweb_url',
						'type' => 'url',
						'instructions' => 'URL de la page de l’hébergement',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
					),
					array(
						'key' => 'field_5b58880c783c9',
						'label' => 'Adresse',
						'name' => 'address',
						'type' => 'textarea',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'rows' => 6,
						'new_lines' => '',
					),
					array(
						'key' => 'field_5b602c2f4639c',
						'label' => 'URL Site web',
						'name' => 'website_url',
						'type' => 'url',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '25',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
					),
					array(
						'key' => 'field_5b602c544639d',
						'label' => 'Email de contact',
						'name' => 'email',
						'type' => 'email',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '25',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array(
						'key' => 'field_5b58882e783ca',
						'label' => 'Téléphone',
						'name' => 'phone',
						'type' => 'text',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '12',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_5b588844783cb',
						'label' => 'Fax',
						'name' => 'fax',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '13',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_5ad9f49d1a416',
						'label' => 'Checkin',
						'name' => 'checkin',
						'type' => 'select',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '12',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							12 => '12',
							13 => '13',
							14 => '14',
							15 => '15',
							16 => '16',
							17 => '17',
							18 => '18',
							19 => '19',
						),
						'default_value' => array(
							0 => 15,
						),
						'allow_null' => 0,
						'multiple' => 0,
						'ui' => 0,
						'ajax' => 0,
						'return_format' => 'value',
						'placeholder' => '',
					),
					array(
						'key' => 'field_5ad9f4de9c63c',
						'label' => 'Checkout',
						'name' => 'checkout',
						'type' => 'select',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '12',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							8 => '8',
							9 => '9',
							10 => '10',
							11 => '11',
							12 => '12',
							13 => '13',
							14 => '14',
						),
						'default_value' => array(
							0 => 12,
						),
						'allow_null' => 0,
						'multiple' => 0,
						'ui' => 0,
						'ajax' => 0,
						'return_format' => 'value',
						'placeholder' => '',
					),
					array(
						'key' => 'field_5b59b71d31a3b',
						'label' => 'ID Resaweb',
						'name' => 'id_resaweb',
						'type' => 'number',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '12',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => '',
						'max' => '',
						'step' => '',
					),
					array(
						'key' => 'field_5ad9f3e298ae7',
						'label' => 'Nom de code',
						'name' => 'codename',
						'type' => 'text',
						'instructions' => '3 caractères',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '13',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => 3,
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'accommodation',
						),
					),
				),
				'menu_order' => 100,
				'position' => 'acf_after_title',
				'style' => 'seamless',
				'label_placement' => 'top',
				'instruction_placement' => 'field',
				'hide_on_screen' => array(
					0 => 'discussion',
					1 => 'comments',
					2 => 'revisions',
					3 => 'author',
					4 => 'format',
					5 => 'categories',
					6 => 'tags',
					7 => 'send-trackbacks',
				),
				'active' => 1,
				'description' => '',
			));

		endif;

	}

	/**
	 * ACF Show Admin Menu
	 *
	 * @param $path
	 *
	 * @return string
	 */
	public function acf_show_admin( $path ) {
		return defined('WP_DEBUG') && true === WP_DEBUG;
	}

}
