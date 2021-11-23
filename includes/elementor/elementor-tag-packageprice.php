<?php

use Elementor\Controls_Manager;
use Elementor\Core\DynamicTags\Tag;
use ElementorPro\Modules\DynamicTags\Module;

if(!class_exists('\Elementor\Core\DynamicTags\Tag')){
	die();
}
class Elementor_Tag_PackagePrice extends Tag {

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


	private function _select_accommodation(){

		$accommodations = [];

		foreach( get_posts([
			'post_type' => 'accommodation',
			'posts_per_page' => 100,
		]) as $accommodation){

			if(function_exists('get_field')){
				$accommodation_codename = esc_html(get_field('codename', $accommodation->ID));
			}

			$accommodations[ $accommodation_codename ] = sprintf( __( 'Price for: %s', 'tmsm-woocommerce-booking-thalasso' ),
				$accommodation->post_title );
		}

		return $accommodations;
	}

	private function _select_not_accommodation(){

		$notaccommodation = [
			'BEST' => __( 'Best Price With Accommodation', 'tmsm-woocommerce-booking-thalasso' ),
			'TMS'  => __( 'Price Without accommodation', 'tmsm-woocommerce-booking-thalasso' ),
		];

		return $notaccommodation;
	}

	protected function _register_controls() {

		$this->add_control(
			'accommodation',
			[
				'label'   => __( 'Price', 'tmsm-woocommerce-booking-thalasso' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array_merge( self::_select_accommodation(), self::_select_not_accommodation() ),
				'default' => 'BEST',
			]
		);

		$this->add_control(
			'from',
			[
				'label'   => __( 'From Label', 'tmsm-woocommerce-booking-thalasso' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'0' => __( 'Without From Label', 'tmsm-woocommerce-booking-thalasso' ),
					'1' => __( 'With From Label', 'tmsm-woocommerce-booking-thalasso' ),
				],
				'default' => '1',
			]
		);

		$this->add_control(
			'instead',
			[
				'label'   => __( 'Instead Price', 'tmsm-woocommerce-booking-thalasso' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'0' => __( 'Without Instead Price', 'tmsm-woocommerce-booking-thalasso' ),
					'1' => __( 'With Instead Price', 'tmsm-woocommerce-booking-thalasso' ),
				],
				'default' => '0',
			]
		);

		$this->add_control(
			'suffix',
			[
				'label'   => __( 'Suffix', 'tmsm-woocommerce-booking-thalasso' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
			]
		);

	}

	public function render() {

		$from = $this->get_settings( 'from' );
		$instead = $this->get_settings( 'instead' );
		$suffix = $this->get_settings( 'suffix' );
		$accommodation_codename = $this->get_settings( 'accommodation' );

		$accommodation = get_posts([
			'post_type' => 'accommodation',
			'meta_key' => 'codename',
			'meta_value' => $accommodation_codename,
		]);

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

		$suffix = str_replace('||', '<br>', $suffix);
		$shortcode = '[resaweb_load package_id="'.$package_idresaweb.'" lang="'.$lang.'" '.(!empty($accommodation) ? 'nights="'.$defaultnights.'"' :'' ).'"]';
		$shortcode .= '[resaweb_price from="'.esc_attr($from).'" instead="'.esc_attr($instead).'" '.(!empty($accommodation) ? 'nights="'.$defaultnights.'"' :'' ).' hotel_id="'.$accommodation_codename.'" package_id="'.$package_idresaweb.'" lang="'.$lang.'" suffix="'.($suffix).'"]';
		$output .= do_shortcode($shortcode);

		echo $output;
	}
}