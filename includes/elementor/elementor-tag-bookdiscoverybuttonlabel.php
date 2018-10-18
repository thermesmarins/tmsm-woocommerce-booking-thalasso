<?php
if(!class_exists('\Elementor\Core\DynamicTags\Tag')){
	die();
}
class Elementor_Tag_BookDiscoveryButtonLabel extends \Elementor\Core\DynamicTags\Tag {

	public function get_name() {
		return 'tmsm-woocommerce-booking-thalasso-bookdiscoverybuttonlabel';
	}

	public function get_title() {
		return __( 'Book Discovery Button Label', 'tmsm-woocommerce-booking-thalasso' );
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

		if(!empty($discovery)){
			$discovery_bookingurl = get_field('booking_url', $discovery->ID);
		}
		if(!empty($discovery_bookingurl)){
			$output .= __('Book now', 'tmsm-woocommerce-booking-thalasso');
		}
		else{
			$output .= __('Book at +33 299 407 523', 'tmsm-woocommerce-booking-thalasso');
		}

		echo wp_kses_post($output);
	}
}