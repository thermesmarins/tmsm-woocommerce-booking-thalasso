<?php
if(!class_exists('\Elementor\Core\DynamicTags\Tag')){
	die();
}
class Elementor_Tag_AccommodationUrl extends \Elementor\Core\DynamicTags\Tag {

	public function get_name() {
		return 'tmsm-woocommerce-booking-thalasso-accommodationurl';
	}

	public function get_title() {
		return __( 'Accommodation URL', 'tmsm-woocommerce-booking-thalasso' );
	}

	public function get_group() {
		return 'tmsm-woocommerce-booking-thalasso-tags';
	}

	public function get_categories() {
		return [ ElementorPro\Modules\DynamicTags\Module::URL_CATEGORY ];
	}

	public function render() {
		$output = '';

		$post = get_post();

		if(!empty($post) && function_exists('get_field')){

			if(!empty(get_field('resaweb_url', $post->ID))){
				$output = get_field('resaweb_url', $post->ID);
			}
			else{
				$output = get_permalink( $post->ID );
			}
		}

		echo wp_kses_post($output);
	}
}