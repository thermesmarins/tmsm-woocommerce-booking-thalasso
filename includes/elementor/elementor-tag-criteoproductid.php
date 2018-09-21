<?php
if(!class_exists('\Elementor\Core\DynamicTags\Tag')){
	die();
}
class Elementor_Tag_CriteoProductID extends \Elementor\Core\DynamicTags\Tag {

	public function get_name() {
		return 'tmsm-woocommerce-booking-thalasso-criteoproductid';
	}

	public function get_title() {
		return __( 'Criteo Product ID', 'tmsm-woocommerce-booking-thalasso' );
	}

	public function get_group() {
		return 'tmsm-woocommerce-booking-thalasso-tags';
	}

	public function get_categories() {
		return [ ElementorPro\Modules\DynamicTags\Module::TEXT_CATEGORY ];
	}

	public function render() {
		$output = '';

		$post = get_post();

		if ( get_post_type( $post ) === 'package' ) {

			if ( function_exists( 'get_field' ) ) {
				$package_codename = esc_html( get_field( 'codename', $post->ID ) );

				$output .= '<script type="text/javascript">CriteoProductIDList.push(\'' . $package_codename . '\');</script>';
			}

		}

		echo $output;
	}
}