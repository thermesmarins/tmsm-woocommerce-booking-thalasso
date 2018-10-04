<?php
if(!class_exists('\Elementor\Core\DynamicTags\Tag')){
	die();
}
class Elementor_Tag_PackagePriceExplanation extends \Elementor\Core\DynamicTags\Tag {

	public function get_name() {
		return 'tmsm-woocommerce-booking-thalasso-packagepriceexplanation';
	}

	public function get_title() {
		return __( 'Package Price Explanation', 'tmsm-woocommerce-booking-thalasso' );
	}

	public function get_group() {
		return 'tmsm-woocommerce-booking-thalasso-tags';
	}

	public function get_categories() {
		return [ ElementorPro\Modules\DynamicTags\Module::TEXT_CATEGORY ];
	}

	public function render() {
		$output = '';

		$package = get_post();

		if(empty($package)){
			return;
		}
		if(get_post_type($package) !== 'package'){
			return;
		}

		$package_daysmin  = esc_html( get_field( 'daysmin', $package->ID ) );

		$triptype = get_field('trip_type', $package->ID); // term object trip_type
		$triptype_defaultnights = null;
		if(!empty($triptype)){
			$triptype_slug = esc_html($triptype->slug);
			$triptype_defaultnights = get_field('defaultnights', $triptype->taxonomy . '_' . $triptype->term_id);
		}
		if(empty($triptype_defaultnights)){
			return;
		}
		$defaultnights = $triptype_defaultnights;

		if($defaultnights < $package_daysmin){
			$defaultnights = $package_daysmin;
		}

		if($defaultnights < 6){
			$output .= sprintf(_n( 'Rates per person per day in a double room, half board (except Hotel du Louvre, breakfast only', 'Rates per person for %s days in a double room, half board (except Hotel du Louvre), breakfast only', $defaultnights, 'tmsm-woocommerce-booking-thalasso' ), number_format_i18n( $defaultnights ));
		}
		elseif($defaultnights == 6){
			$output .= __('In hotel: Rates per person for 6 days in a double room, half board.','tmsm-woocommerce-booking-thalasso').'<br/>';
			$output .= __('In Residence: Rates per person for 2 persons spa guests occupying the same apartment, including 6 treatments days and 7 nights from saturday to saturday.','tmsm-woocommerce-booking-thalasso');
		}

		echo $output;
	}
}