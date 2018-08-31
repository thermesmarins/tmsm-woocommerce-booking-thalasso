<?php
if(!class_exists('\Elementor\Core\DynamicTags\Tag')){
	die();
}
class Elementor_Tag_BookRoomButtonLabel extends \Elementor\Core\DynamicTags\Tag {

	public function get_name() {
		return 'tmsm-woocommerce-booking-thalasso-bookroombuttonlabel';
	}

	public function get_title() {
		return __( 'Book Room Button Label', 'tmsm-woocommerce-booking-thalasso' );
	}

	public function get_group() {
		return 'tmsm-woocommerce-booking-thalasso-tags';
	}

	public function get_categories() {
		return [ ElementorPro\Modules\DynamicTags\Module::TEXT_CATEGORY ];
	}

	public function render() {
		$output = '';

		$accommodation = get_post();

		if(empty($accommodation)){
			return;
		}
		if(get_post_type($accommodation) !== 'accommodation'){
			return;
		}

		$accommodationtypes = get_the_terms( $accommodation, 'accommodation_type' );
		if(!empty($accommodationtypes ) && count($accommodationtypes) > 0){
			$accommodationtype = $accommodationtypes[0];
			if(!empty($accommodationtype->slug)){
				$accommodationtype_slug = $accommodationtype->slug;
				switch($accommodationtype_slug){
					case 'hotel': $output .= __('Book a room', 'tmsm-woocommerce-booking-thalasso'); break;
					case 'residence': $output .= __('Book an apartment', 'tmsm-woocommerce-booking-thalasso'); break;
					default: break;
				}
			}
		}

		echo wp_kses_post($output);
	}
}