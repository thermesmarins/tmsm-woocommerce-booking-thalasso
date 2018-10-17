<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/nicomollet
 * @since      1.0.0
 *
 * @package    Tmsm_Woocommerce_Booking_Thalasso
 * @subpackage Tmsm_Woocommerce_Booking_Thalasso/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Tmsm_Woocommerce_Booking_Thalasso
 * @subpackage Tmsm_Woocommerce_Booking_Thalasso/public
 * @author     Nicolas Mollet <nico.mollet@gmail.com>
 */
class Tmsm_Woocommerce_Booking_Thalasso_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tmsm-woocommerce-booking-thalasso-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		global $post;

		// Scripts
		wp_enqueue_script( 'moment', plugin_dir_url( dirname(__FILE__) ) . 'vendor/moment/min/moment.min.js', array( 'jquery' ), $this->version, true );
		if ( function_exists( 'PLL' ) && $language = PLL()->model->get_language( get_locale() ) && pll_current_language() !== 'en')
		{
			wp_enqueue_script( 'moment-'.pll_current_language(), plugin_dir_url( dirname(__FILE__) ) . 'vendor/moment/locale/'.pll_current_language().'.js', array( 'jquery' ), $this->version, true );
		}

		wp_enqueue_script( 'clndr', plugin_dir_url( dirname(__FILE__) ) . 'vendor/clndr/clndr.min.js', array( 'jquery', 'moment', 'underscore' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tmsm-woocommerce-booking-thalasso-public.js', array( 'jquery','clndr', 'moment' ), $this->version, true );

		// Params
		$params = [
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'security' => wp_create_nonce( 'security' ),
			'i18n' => [
				'button_continue' => __( 'Book now', 'tmsm-woocommerce-booking-thalasso' ),
			],
			'booking_settings' => [
				'hourlimit' => 17,
			],
		];
		if(is_singular('product')){
			$params['product_data'] = [
				'title' => get_the_title($post),
				'bookable' => (get_post_meta($post->ID, '_bookable', true) == 'yes'),
			];
		}

		wp_localize_script( $this->plugin_name, 'tmsm_woocommerce_booking_thalasso_params', $params);

	}

	/**
	 * Filters the permalink for custom post type accommodation
	 *
	 * @since 3.0.0
	 *
	 * @param string  $post_link The post's permalink.
	 * @param WP_Post $post      The post in question.
	 * @param bool    $leavename Whether to keep the post name.
	 * @param bool    $sample    Is it a sample permalink.
	 *
	 * @return string
	 */
	public function post_type_link_accommodation( $post_link, $post, $leavename, $sample){
		if ( get_post_type( $post ) === 'accommodation' && function_exists( 'get_field' ) ) {
			$resaweb_url = get_field( 'resaweb_url', $post->ID );
			if ( ! empty( $resaweb_url ) ) {
				$post_link = $resaweb_url;
			}
			else{
				$website_url = get_field( 'website_url', $post->ID );
				if ( ! empty( $website_url ) ) {
					$post_link = $website_url;
				}
			}
		}

		return $post_link;
	}

	/**
	 * Redirect before displaying template for accommodation
	 */
	public function template_redirect_accommodation( ){
		global $post;

		if( is_singular( 'accommodation' ) )
		{
			if ( get_post_type( $post ) === 'accommodation' && function_exists( 'get_field' ) ) {
				$resaweb_url = get_field( 'resaweb_url', $post->ID );
				if ( ! empty( $resaweb_url ) ) {
					wp_redirect( $resaweb_url );
				}
			}
		}
	}

	/**
	 * Item class (for single and archive)
	 *
	 * @param array $classes
	 *
	 * @return array
	 */
	private function item_class($classes){

		global $post;

		if ( get_post_type( $post ) === 'spatreatment' && function_exists( 'get_field' ) ) {
			$booking_url = get_field( 'booking_url', $post->ID );
			if ( empty( $booking_url) ) {
				$classes[] = 'spatreatment-no-bookingurl';
			}

			$gift_url = get_field( 'gift_url', $post->ID );
			if ( empty( $gift_url) ) {
				$classes[] = 'spatreatment-no-gifturl';
			}
		}

		if ( get_post_type( $post ) === 'package' && function_exists( 'get_field' ) ) {
			$codename = get_field( 'codename', $post->ID );
			if ( empty( $codename) ) {
				$classes[] = 'package-no-codename';
			}

			$triptype = get_field( 'trip_type', $post->ID );
			if ( ! empty( $triptype ) ) {
				$classes[] = 'triptype-' . $triptype->slug;
			}
		}

		if ( get_post_type( $post ) === 'discovery' && function_exists( 'get_field' ) ) {
			$booking_url = get_field( 'booking_url', $post->ID );
			if ( empty( $booking_url) ) {
				$classes[] = 'discovery-no-bookingurl';
			}

			$gift_url = get_field( 'gift_url', $post->ID );
			if ( empty( $gift_url) ) {
				$classes[] = 'discovery-no-gifturl';
			}
		}

		if ( get_post_type( $post ) === 'accommodation' && function_exists( 'get_field' ) ) {

			$availpro_url = get_field( 'availpro_url', $post->ID );
			if ( empty( $availpro_url) ) {
				$classes[] = 'accommodation-no-availprourl';
			}

			$resaweb_url = get_field( 'resaweb_url', $post->ID );
			if ( empty( $resaweb_url) ) {
				$classes[] = 'accommodation-no-resaweburl';
			}

		}

		return $classes;
	}

	/**
	 * Body class
	 *
	 * @param array $classes
	 *
	 * @return array
	 */
	public function body_class($classes){
		if(is_single()){
			return self::item_class($classes);
		}
		else{
			return $classes;
		}
	}

	/**
	 * Post class
	 *
	 * @param array $classes
	 *
	 * @return array
	 */
	public function post_class($classes){
		return self::item_class($classes);
	}

	/**
	 *  WooCommerce Before Add To Cart Button
	 */
	public function woocommerce_before_add_to_cart_form(){
		global $product;

		if ($product instanceof WC_Product) {

			$is_booking = get_post_meta( $product->get_id(), '_booking', true) == 'yes';
			if($is_booking){
				echo '<div style="display: none">';
			}

		}
	}

	/**
	 *  WooCommerce After Add To Cart Button
	 */
	public function woocommerce_after_add_to_cart_form(){
		global $product;

		if ($product instanceof WC_Product) {

			$is_booking = get_post_meta( $product->get_id(), '_booking', true) == 'yes';
			$accommodation_id = get_post_meta( $product->get_id(), '_booking_accommodation', true);
			$package_id = get_post_meta( $product->get_id(), '_booking_package', true);

			if($is_booking){

				echo '</div>';
				echo '<a class="button button-booking omw-open-modal" data-productid="'. $product->get_id().'"   data-accommodationid="'. $accommodation_id.'"  data-packageid="'. $package_id.'" id="booking-'. $product->get_id().'" href="#omw-2263">'.__('Book now', 'tmsm-woocommerce-booking-thalasso').'</a>';
				echo '
				<div id="'.$this->plugin_name.'-calendar">
                            <script id="tmsm-woocommerce-booking-thalasso-calendar-template" type="text/template">

                                <table class="table-calendarprices table-condensed" border="0" cellspacing="0" cellpadding="0">
                                    <thead>
                                    <tr class="clndr-controls">
                                        <th class="clndr-control-button">
                                            <span class="clndr-previous-button"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></span>
                                        </th>
                                        <th class="month text-center" colspan="5">
                                            <%= month %> <%= year %>

                                            &nbsp;
                                            <small class="calendar-error">(Aucune date disponible pour ce mois)</small>
                                            <small class="calendar-loading">Chargement <span class="glyphicon glyphicon-refresh glyphicon-spin"></span></small>

                                        </th>
                                        <th class="clndr-control-button text-right">
                                            <span class="clndr-next-button"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></span>
                                        </th>
                                    </tr>
                                    <tr class="header-days">

                                        <% for(var i = 0; i < daysOfTheWeek.length; i++) { %>
                                        <th class="header-day">
                                            <%= moment().weekday(i).format(\'dd\').charAt(0) %><span class="rest"><%= moment().weekday(i).format(\'dddd\').slice(1) %></span>
                                        </th>
                                        <% } %>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <% for(var i = 0; i < numberOfRows; i++){ %>
                                    <tr>
                                        <% for(var j = 0; j < 7; j++){ %>
                                        <% var d = j + i * 7; %>
                                        <td class="<%= days[d].classes %>" data-daynumber="<%= days[d].day %>">

                                            <% if (days[d].events.length != 0) { %>
                                            <% _.each(days[d].events, function(event) { %>
                                            <div class="cell" data-promofebruary="<%= event._special_promofebruary %>"  data-vidangeaquatonic="<%= event._special_vidangeaquatonic %>"   data-vidangepiscine="<%= event._special_vidangepiscine %>"  data-christmas="<%= event._special_christmas %>" data-newyearseve="<%= event._special_newyearseve %>"  data-dateend="<%= event.date_end %>" data-roomorderids="<%= event.room_order_ids %>" data-pricediscounted="<%= event.price_discounted %>" data-priceregular="<%= event.price_regular %>" data-discount="<%= event.discount %>" data-discount-10="<%= event.discount > 0 %>" data-discount-15="<%= event.discount > 10 %>" data-discount-20="<%= event.discount > 15 %>" data-discount-30="<%= event.discount > 20 %>" data-equal="<%= event.discount == \'0\' %>">
                                                <small class="day-number"><%= days[d].day %></small>
                                                <small class="day-special">
                                                    <%= (event._special_promofebruary == 1 ? \'<span class="glyphicon glyphicon-special glyphicon-star"></span>\':\'\') %>
                                                    <%= (event._special_vidangeaquatonic == 1 ? \'<span class="glyphicon glyphicon-special glyphicon-warning-sign"></span>\':\'\') %>
                                                    <%= (event._special_vidangepiscine == 1 ? \'<span class="glyphicon glyphicon-special glyphicon-warning-sign"></span>\':\'\') %>
                                                    <%= (event._special_christmas == 1 ? \'<span class="glyphicon glyphicon-special glyphicon-warning-sign"></span>\':\'\') %>
                                                    <%= (event._special_newyearseve == 1 ? \'<span class="glyphicon glyphicon-special glyphicon-warning-sign"></span>\':\'\') %>
                                                </small>

                                                <p class="price"><%= event.price_perperson_discounted %><sup class="currency">&euro;</sup></p>
                                                <small class="instead">au lieu de <%=
                                                    event.price_perperson_regular
                                                    %><sup class="currency">&euro;</sup>
                                                </small>

                                            </div>
                                            <% }) %>

                                            <% } else { %>

                                            <div class="cell">
                                                <small class="day-number"><%= days[d].day %></small>
                                                <small class="day-special"></small>
                                                <p class="price">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                                                <small class="instead">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</small>
                                            </div>
                                            <% } %>
                                        </td>
                                        <% } %>
                                    </tr>
                                    <% } %>
                                    </tbody>
                                </table>

                            </script>
                        </div>
				';
			}

		}

	}

	/*
	 * Ajax Function: Booking Start
	 */
	public function booking_start(){
		check_ajax_referer( 'security', 'nonce' );

		sleep(0.5);

		$error = null;


		$packageid = wc_clean(urldecode($_POST['packageid']));
		$productid = wc_clean(urldecode($_POST['productid']));
		$bookinghasaccommodation = get_post_meta( $productid, '_booking_has_accommodation', true);

		$package = get_post($packageid);
		if(empty($package)){
			$error = __('Package not found', 'tmsm-woocommerce-booking-thalasso');
		}

		$pages = self::get_pages_all();
		$posts = self::get_posts_all();

		$results = [
			'package' => get_the_title($package),
			'bookinghasaccommodation' => $bookinghasaccommodation,
			'pages' => $pages,
			'posts' => $posts,
		];

		if(!empty($results)){
			wp_send_json($results);
		}

		wp_send_json_error($error);
		wp_die();
	}

	/**
	 * Get All Pages
	 *
	 * @return array
	 */
	private function get_pages_all(){
		$data = get_posts( [
			'post_type'      => 'page',
			'posts_per_page' => -1,
		]);
		$items = [];
		if(is_array($data)){
			foreach($data as $item){
				$items[$item->ID] = $item->post_title;
			}
		}

		return $items;
	}

	/**
	 * Get All Posts
	 *
	 * @return array
	 */
	private function get_posts_all(){
		$data = get_posts( [
			'post_type'      => 'post',
			'posts_per_page' => -1,
		]);
		$items = [];
		if(is_array($data)){
			foreach($data as $item){
				$items[$item->ID] = $item->post_title;
			}
		}

		return $items;
	}

	/**
	 * Elementor Register Dynamic Tags
	 *
	 * @param $dynamic_tags
	 */
	public function elementor_tags_register( $dynamic_tags){
		\Elementor\Plugin::$instance->dynamic_tags->register_group( 'tmsm-woocommerce-booking-thalasso-tags', [
			'title' => __('TMSM WooCommerce Booking Thalasso Tags', 'tmsm-woocommerce-booking-thalasso')
		] );

		$dynamic_tags->register_tag( 'Elementor_Tag_NoAccommodationPackagePrice' );
		$dynamic_tags->register_tag( 'Elementor_Tag_AccommodationPackagePrice' );
		$dynamic_tags->register_tag( 'Elementor_Tag_CriteoProductID' );
		$dynamic_tags->register_tag( 'Elementor_Tag_PackagePrice' );
		$dynamic_tags->register_tag( 'Elementor_Tag_PackagePriceExplanation' );
		$dynamic_tags->register_tag( 'Elementor_Tag_BookResawebUrl' );
		$dynamic_tags->register_tag( 'Elementor_Tag_ResawebUrlNoAccommodation' );
		$dynamic_tags->register_tag( 'Elementor_Tag_BookRoomButtonLabel' );
		$dynamic_tags->register_tag( 'Elementor_Tag_PackageRatesTable' );
		$dynamic_tags->register_tag( 'Elementor_Tag_PackageRatesCards' );
	}

	/**
	 * Elementor Custom Query "accommodationpackage_price"
	 *
	 * @param WP_Query $query
	 *
	 * @return mixed
	 */
	function elementor_query_accommodationpackage_price( $query ) {

		$package = get_post();

		if(get_post_type($package) !== 'package'){
			return;
		}

		if(!function_exists('get_field')){
			return;
		}

		// Select only accommodation with resaweb_url
		$meta_query[] = array (
			'key'	=> 'resaweb_url',
			'value'	=> 'http',
			'compare'	=> 'LIKE',
		);
		$query->set( 'meta_query', $meta_query );

		$accommodations_relation = get_field('accommodation', $package->ID);

		if(!empty($accommodations_relation)){
			$query->set( 'post__in', $accommodations_relation );
		}

	}

	/**
	 * Elementor Custom Query "package_discover"
	 *
	 * @param WP_Query $query
	 *
	 * @return mixed
	 */
	function elementor_query_package_discover( $query ) {

		$package = get_post();

		if(get_post_type($package) !== 'package'){
			return;
		}

		if(!function_exists('get_field')){
			return;
		}

		$triptype = get_field('trip_type', $package->ID);

		$tax_query = $query->get( 'tax_query' );

		// Select packages only in the same packagetype
		$packagetype = get_field( 'package_type', $package->ID );
		if ( ! empty( $packagetype ) ) {
			$packagetype_first = array_shift( array_values( $packagetype ) );
			$tax_query[]       = [
				'taxonomy' => 'package_type',
				'terms'    => $packagetype_first->term_id,
			];
		} // Select packages only in the same triptype
		else {
			if ( ! empty( $triptype ) ) {
				$tax_query[] = [
					'taxonomy' => 'trip_type',
					'terms'    => $triptype->term_id,
				];
			}
		}

		$query->set( 'tax_query', $tax_query );

	}

	/**
	 * ACF Format Value New
	 *
	 * @param $value
	 *
	 * @return mixed
	 */
	public function acf_format_value_new( $value ){
		if($value){
			$value = ' ';
		}
		return $value;
	}

}
