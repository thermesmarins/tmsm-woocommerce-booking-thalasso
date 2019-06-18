<?php

use Elementor\Controls_Manager;
use Elementor\Core\DynamicTags\Tag;
use ElementorPro\Modules\DynamicTags\Module;

if(!class_exists('\Elementor\Core\DynamicTags\Tag')){
	die();
}
class Elementor_Tag_DiscoveryPrice extends \Elementor\Core\DynamicTags\Tag {

	public function get_name() {
		return 'tmsm-woocommerce-booking-thalasso-discoveryprice';
	}

	public function get_title() {
		return __( 'Discovery Price', 'tmsm-woocommerce-booking-thalasso' );
	}

	public function get_group() {
		return 'tmsm-woocommerce-booking-thalasso-tags';
	}

	public function get_categories() {
		return [ ElementorPro\Modules\DynamicTags\Module::TEXT_CATEGORY ];
	}

	public function render() {

		$from = $this->get_settings( 'from' );
		$instead = $this->get_settings( 'instead' );
		$accommodation_codename = $this->get_settings( 'accommodation' );

		$accommodation = get_posts([
			'post_type' => 'accommodation',
			'meta_key' => 'codename',
			'meta_value' => $accommodation_codename,
		]);

		$output = '';

		$discovery = get_post();

		if(empty($discovery)){
			return;
		}
		if(get_post_type($discovery) !== 'discovery'){
			return;
		}

		$lang = esc_html((function_exists('pll_current_language') ? pll_current_language() : substr(get_locale(),0, 2)));

		$pdiscovery_price = absint(esc_html(get_field('price', $discovery->ID)));
		$pdiscovery_pricesale = absint(esc_html(get_field('price_sale', $discovery->ID)));
		$discovery_idresaweb = absint(esc_html(get_field('id_resaweb', $discovery->ID)));

		$output .= '<span class="price">';
		if(!empty($pdiscovery_pricesale)){
			$output .=  sprintf(__('From <span class="pricevalue">%s</span> <span class="instead">instead of <span class="salepricevalue">%s</span></span>','tmsm-woocommerce-booking-thalasso'), sprintf(__('€%s','tmsm-woocommerce-booking-thalasso'), money_format( '%!.0n', $pdiscovery_pricesale)), sprintf(__('€%s','tmsm-woocommerce-booking-thalasso'), money_format( '%!.0n', $pdiscovery_price )));
		}
		else{
			$output .= '<span class="pricevalue">'.sprintf(__('€%s','tmsm-woocommerce-booking-thalasso'), money_format( '%!.0n', $pdiscovery_price)).'</span>';
		}
		$output .= '</span>';

		echo $output;
	}
}