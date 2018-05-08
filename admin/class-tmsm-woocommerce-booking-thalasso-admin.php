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
		$opts['has_archive']                            = false;
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
		$opts['has_archive']                            = false;
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

		register_taxonomy( 'package-type', array( 'package' ), $args );
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
	 * ACF Settings Path
	 *
	 * @param $path
	 *
	 * @return string
	 */
	public function acf_settings_path( $path ) {
		$path = plugin_dir_path( __FILE__ ) . 'advanced-custom-fields/';
		return $path;
	}

	/**
	 * ACF Settings Directory
	 *
	 * @param $path
	 *
	 * @return string
	 */
	public function acf_settings_dir( $path ) {
		$dir = plugin_dir_url( __FILE__ ) . '../includes/advanced-custom-fields/';
		return $dir;
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

	/**
	 * ACF Json Save Path
	 *
	 * @param $path
	 *
	 * @return string
	 */
	public function acf_json_save_path( $path ) {
		$path = plugin_dir_path( __FILE__ ) . '../acf-json';
		return $path;
	}

	/**
	 * ACF Json Load Path
	 *
	 * @param array $path
	 *
	 * @return array
	 */
	public function acf_json_load_path( $path ) {
		unset($path[0]);
		$path[] = plugin_dir_path( __FILE__ ) . '../acf-json';
		return $path;
	}

}
