<?php
if(!class_exists('\Elementor\Core\DynamicTags\Tag')){
	die();
}
class Elementor_Tag_SpaTreatmentPricePerPerson extends \Elementor\Core\DynamicTags\Tag {

	public function get_name() {
		return 'tmsm-woocommerce-booking-thalasso-spatreatmentpriceperperson';
	}

	public function get_title() {
		return __( 'Discovery Price Per Person', 'tmsm-woocommerce-booking-thalasso' );
	}

	public function get_group() {
		return 'tmsm-woocommerce-booking-thalasso-tags';
	}

	public function get_categories() {
		return [ ElementorPro\Modules\DynamicTags\Module::TEXT_CATEGORY ];
	}

	public function render() {
		$output = '';

		$discovery = get_post();

		if(empty($discovery)){
			return;
		}
		if(get_post_type($discovery) !== 'discovery'){
			return;
		}

		$discovery_price  = esc_html( get_field( 'price', $discovery->ID ) );
		$discovery_persons  = esc_html( get_field( 'persons', $discovery->ID ) );

		$price = $discovery_price;

		if(!empty($discovery_persons) && $discovery_persons > 1){
			$price = $discovery_price / $discovery_persons;
		}

		$price_formatted = money_format( '%.2n', $price );

		if(!empty($discovery_persons) && $discovery_persons > 1){
			$output = sprintf( __( '%s per person', 'tmsm-woocommerce-booking-thalasso' ), $price_formatted );
		}
		else{
			$output = $price_formatted;
		}

		echo $output;
	}
}