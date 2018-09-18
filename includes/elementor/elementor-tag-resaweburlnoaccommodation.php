<?php
if(!class_exists('\Elementor\Core\DynamicTags\Tag')){
	die();
}
class Elementor_Tag_ResawebUrlNoAccommodation extends \Elementor\Core\DynamicTags\Tag {

	public function get_name() {
		return 'tmsm-woocommerce-booking-thalasso-resaweburlnoaccommodation';
	}

	public function get_title() {
		return __( 'Resaweb URL No Accommodation', 'tmsm-woocommerce-booking-thalasso' );
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

		$post = get_post();
		if(get_post_type($post) === 'package'){
			$package = $post;
		}

		$noaccommodation_resaweburl = __( 'https://reservation.thalassotherapy.com/thalasso-sans-hebergement', 'tmsm-woocommerce-booking-thalasso' );
		$package_codename  = esc_html( get_field( 'codename', $package->ID ) );

		if(empty($package)){
			$output = $noaccommodation_resaweburl;
		}
		else{
			if(empty($package_codename)){
				$output = $noaccommodation_resaweburl;
			}
			else{
				$output = $noaccommodation_resaweburl.'/'.$package_codename;
			}
		}

		echo wp_kses_post($output);
	}
}