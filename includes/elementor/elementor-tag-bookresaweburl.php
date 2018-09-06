<?php
if(!class_exists('\Elementor\Core\DynamicTags\Tag')){
	die();
}
class Elementor_Tag_BookResawebUrl extends \Elementor\Core\DynamicTags\Tag {

	public function get_name() {
		return 'tmsm-woocommerce-booking-thalasso-bookresaweburl';
	}

	public function get_title() {
		return __( 'Book Resaweb URL', 'tmsm-woocommerce-booking-thalasso' );
	}

	public function get_group() {
		return 'tmsm-woocommerce-booking-thalasso-tags';
	}

	public function get_categories() {
		return [ ElementorPro\Modules\DynamicTags\Module::URL_CATEGORY ];
	}

	public function render() {
		$output = '';

		$queried_object = get_queried_object();
		if(get_post_type($queried_object) === 'package'){
			$package = $queried_object;
		}
		if(get_post_type($queried_object) === 'accommodation'){
			$accommodation = $queried_object;
			$accommodation_resaweburl = get_field('resaweb_url', $accommodation->ID);
		}

		$post = get_post();
		if(get_post_type($post) === 'package'){
			$package = $post;
		}
		if(get_post_type($post) === 'accommodation'){
			$accommodation = $post;
		}

		$accommodation_resaweburl = get_field('resaweb_url', $accommodation->ID);
		$package_codename  = esc_html( get_field( 'codename', $package->ID ) );

		if(empty($accommodation_resaweburl)){
			$output = get_permalink( $accommodation->ID );
		}
		else{
			if(empty($package)){
				$output = $accommodation_resaweburl;
			}
			else{
				if(empty($package_codename)){
					$output = $accommodation_resaweburl;
				}
				else{
					$output = $accommodation_resaweburl.'/'.$package_codename;
				}
			}
		}

		echo wp_kses_post($output);
	}
}