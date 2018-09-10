<?php
if(!class_exists('\Elementor\Core\DynamicTags\Tag')){
	die();
}
class Elementor_Tag_PackagePrice extends \Elementor\Core\DynamicTags\Tag {

	public function get_name() {
		return 'tmsm-woocommerce-booking-thalasso-packageprice';
	}

	public function get_title() {
		return __( 'Package Price', 'tmsm-woocommerce-booking-thalasso' );
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

		$lang = esc_html((function_exists('pll_current_language') ? pll_current_language() : substr(get_locale(),0, 2)));

		$package_idresaweb = absint(esc_html(get_field('id_resaweb', $package->ID)));
		$package_codename = esc_html(get_field('codename', $package->ID));

		$triptype = get_field('trip_type', $package->ID); // term object trip_type
		$triptype_defaultnights = null;
		if(!empty($triptype)){
			$triptype_slug = esc_html($triptype->slug);
			$triptype_defaultnights = get_field('defaultnights', $triptype->taxonomy . '_' . $triptype->term_id);
		}
		if(empty($triptype_defaultnights)){
			return;
		}

		$shortcode = '[resaweb_load package_id="'.$package_idresaweb.'" lang="'.$lang.'" nights="'.$triptype_defaultnights.'"]';
		$shortcode .= '[resaweb_price from="1" hotel_id="BEST" package_id="'.$package_idresaweb.'" lang="'.$lang.'"]';
		$output .= do_shortcode($shortcode);

		echo $output;
	}
}