<?php
if(!class_exists('\Elementor\Core\DynamicTags\Tag')){
	die();
}
class Elementor_Tag_NoAccommodationPackagePrice extends \Elementor\Core\DynamicTags\Tag {

	public function get_name() {
		return 'tmsm-woocommerce-booking-thalasso-noaccommodationpackageprice';
	}

	public function get_title() {
		return __( 'NoAccommodation/Package Price', 'tmsm-woocommerce-booking-thalasso' );
	}

	public function get_group() {
		return 'tmsm-woocommerce-booking-thalasso-tags';
	}

	public function get_categories() {
		return [ ElementorPro\Modules\DynamicTags\Module::TEXT_CATEGORY ];
	}

	public function render() {
		global $post, $wp;

		$output = '';
		$shortcode = '';

		$current_url_postid = url_to_postid(home_url( $wp->request ) );
		if(!empty($current_url_postid)){
			$queried_object = get_post($current_url_postid);
		}
		else{
			$queried_object = get_queried_object();
		}

		// Package is the queried object
		$package = $queried_object;
		if(empty($package)){
			return;
		}
		if(get_post_type($package) !== 'package' && get_post_type($package) !== 'discovery' ){
			return;
		}

		$lang = esc_html((function_exists('pll_current_language') ? pll_current_language() : substr(get_locale(),0, 2)));

		$package_idresaweb = absint( esc_html( get_field( 'id_resaweb', $package->ID ) ) );
		$package_codename  = esc_html( get_field( 'codename', $package->ID ) );
		$package_daysmin  = esc_html( get_field( 'daysmin', $package->ID ) ?? 1 );
		$accommodation_codename  = 'TMS';

		if(get_post_type($package) === 'package'){
			$triptype = get_field('trip_type', $package->ID); // term object trip_type
			$triptype_defaultnights = null;
			if(!empty($triptype)){
				$triptype_slug = esc_html($triptype->slug);
				$triptype_defaultnights = get_field('defaultnights', $triptype->taxonomy . '_' . $triptype->term_id);
			}
			if(empty($triptype_defaultnights)){
				return;
			}
		}


		$defaultnights_toload = [];
		$defaultnights = 6;
		$discovery_price_formatted = null;
		if(get_post_type($package) === 'discovery' ){
			$defaultnights = 1;
			$discovery_price = absint( esc_html( get_field( 'price', $package->ID ) ) );
			$discovery_price_formatted = sprintf( __( '€%s', 'tmsm-woocommerce-booking-thalasso' ), number_format_i18n( $discovery_price ) );

		}
		// Todo error log 
		// error_log('package_daysmin no accomodations : ' . $package_daysmin) ;
		// error_log('default nights no accomodations : ' . $defaultnights) ;
		if ($package_daysmin == 4 ) {
			$defaultnights = 4;
		}

		if($defaultnights < $package_daysmin){
			$defaultnights = $package_daysmin;
		}

		if(!in_array($defaultnights, $defaultnights_toload)){
			$defaultnights_toload[] = $defaultnights;
		}

		$shortcode .= '[resaweb_price fallback="'.$discovery_price.'" from="1" hotel_id="'.$accommodation_codename.'" package_id="'.$package_idresaweb.'" lang="'.$lang.'" nights="'.$defaultnights.'"]';

		foreach($defaultnights_toload as $defaultnights_toload_item){
			$shortcode .= do_shortcode('[resaweb_load package_id="'.$package_idresaweb.'" nights="'.$defaultnights_toload_item.'" lang="'.$lang.']');
		}

		$output .= do_shortcode($shortcode);

		echo $output;
	}
}