<?php
if(!class_exists('\Elementor\Core\DynamicTags\Tag')){
	die();
}
class Elementor_Tag_SpaTreatmentPricePerPerson extends \Elementor\Core\DynamicTags\Tag {

	public function get_name() {
		return 'tmsm-woocommerce-booking-thalasso-spatreatmentpriceperperson';
	}

	public function get_title() {
		return __( 'Spa Treatment Price Per Person', 'tmsm-woocommerce-booking-thalasso' );
	}

	public function get_group() {
		return 'tmsm-woocommerce-booking-thalasso-tags';
	}

	public function get_categories() {
		return [ ElementorPro\Modules\DynamicTags\Module::TEXT_CATEGORY ];
	}

	public function render() {
		$output = '';

		$spatreatment = get_post();

		if(empty($spatreatment)){
			return;
		}
		if(get_post_type($spatreatment) !== 'spatreatment'){
			return;
		}

		$spatreatment_price  = esc_html( get_field( 'price', $spatreatment->ID ) );
		$spatreatment_persons  = esc_html( get_field( 'persons', $spatreatment->ID ) );

		$price = $spatreatment_price;

		if(!empty($price)){
			if(!empty($spatreatment_persons) && $spatreatment_persons > 1){
				$price = $spatreatment_price / $spatreatment_persons;
			}

			$price_formatted = sprintf( __( '€%s', 'tmsm-woocommerce-booking-thalasso' ), number_format_i18n( $price ) );

			if(!empty($spatreatment_persons) && $spatreatment_persons > 1){
				$output = sprintf( __( '%s <small>per person</small>', 'tmsm-woocommerce-booking-thalasso' ), $price_formatted );
			}
			else{
				$output = $price_formatted;
			}
		}


		echo $output;
	}
}