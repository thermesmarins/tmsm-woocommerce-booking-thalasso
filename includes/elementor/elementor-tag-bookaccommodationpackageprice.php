<?php
if(!class_exists('\Elementor\Core\DynamicTags\Tag')){
	die();
}
class Elementor_Tag_BookAccommodationPackagePrice extends \Elementor\Core\DynamicTags\Tag {

	public function get_name() {
		return 'tmsm-woocommerce-booking-thalasso-bookaccommodationpackageprice';
	}

	public function get_title() {
		return __( 'Accommodation/Package: Book Label With Price', 'tmsm-woocommerce-booking-thalasso' );
	}

	public function get_group() {
		return 'tmsm-woocommerce-booking-thalasso-tags';
	}

	public function get_categories() {
		return [ ElementorPro\Modules\DynamicTags\Module::TEXT_CATEGORY ];
	}

	public function render() {
		$output = '';

		// Package is the queried object
		$package = get_queried_object();
		if(empty($package)){
			return;
		}
		if(get_post_type($package) !== 'package'){
			return;
		}

		// Accommodation is in the loop
		$accommodation = get_post();
		if(empty($accommodation)){
			return;
		}
		if(get_post_type($accommodation) !== 'accommodation'){
			return;
		}

		// Generate output
		$lang = esc_html((function_exists('pll_current_language') ? pll_current_language() : substr(get_locale(),0, 2)));

		$package_idresaweb = absint( esc_html( get_field( 'id_resaweb', $package->ID ) ) );
		$package_codename  = esc_html( get_field( 'codename', $package->ID ) );
		$package_daysmin  = esc_html( get_field( 'daysmin', $package->ID ) );
		$accommodation_codename  = esc_html( get_field( 'codename', $accommodation->ID ) );

		$triptype = get_field('trip_type', $package->ID); // term object trip_type
		$triptype_defaultnights = null;
		if(!empty($triptype)){
			$triptype_slug = esc_html($triptype->slug);
			$triptype_defaultnights = get_field('defaultnights', $triptype->taxonomy . '_' . $triptype->term_id);
		}
		if(empty($triptype_defaultnights)){
			return;
		}

		$defaultnights_toload = [];
		$defaultnights = $triptype_defaultnights;
		$accommodation_type = get_field('accommodation_type', $accommodation->ID); // term object accommodation_type

		if($defaultnights < $package_daysmin){
			$defaultnights = $package_daysmin;
		}

		if(!empty($accommodation_type)){

			$accommodation_type_for_trip_type = get_field( 'accommodation_type', 'trip_type_'.$triptype->term_id);
			// Trip Type is not related to accommodation type, exclude
			if(!(is_array($accommodation_type_for_trip_type) && in_array($accommodation_type->term_id, $accommodation_type_for_trip_type))){
				//continue;
			}


			$accommodation_defaultnights = get_field('defaultnights', $accommodation_type->taxonomy . '_' . $accommodation_type->term_id);
			if(!empty($accommodation_defaultnights)){
				$defaultnights = $accommodation_defaultnights;
			}
		}
		if(!in_array($defaultnights, $defaultnights_toload)){
			$defaultnights_toload[] = $defaultnights;
		}

		$shortcode .= '[resaweb_price from="1" hotel_id="'.$accommodation_codename.'" package_id="'.$package_idresaweb.'" lang="'.$lang.'" nights="'.$defaultnights.'"]';

		foreach($defaultnights_toload as $defaultnights_toload_item){
			$output .= do_shortcode('[resaweb_load package_id="'.$package_idresaweb.'" nights="'.$defaultnights_toload_item.'" lang="'.$lang.']');
		}

		$output .= sprintf(__('Book %s', 'tmsm-woocommerce-booking-thalasso'), do_shortcode($shortcode));



		echo $output;
	}
}