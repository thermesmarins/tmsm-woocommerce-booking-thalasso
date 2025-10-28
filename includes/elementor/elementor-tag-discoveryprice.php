<?php

use Elementor\Controls_Manager;
use Elementor\Core\DynamicTags\Tag;
use ElementorPro\Modules\DynamicTags\Module;

if(!class_exists('\Elementor\Core\DynamicTags\Tag')){
	die();
}
class Elementor_Tag_DiscoveryPrice extends Tag {

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

		// $output .= '<span class="price">';
		// $fmt = new NumberFormatter( get_user_locale(), NumberFormatter::CURRENCY );
		// if(!empty($pdiscovery_pricesale)){


		// 	$output .=  sprintf(__('From <span class="pricevalue">%s</span> <span class="instead">instead of <span class="salepricevalue">%s</span></span>','tmsm-woocommerce-booking-thalasso'), $fmt->formatCurrency( $pdiscovery_pricesale, 'EUR' ), $fmt->formatCurrency( $pdiscovery_price, 'EUR' ));
		// }
		// else{
		// 	$output .= '<span class="pricevalue">'.$fmt->formatCurrency( $pdiscovery_price, 'EUR' ).'</span>';
		// }
		// $output .= '</span>';
		$output .= '<span class="price">';

        // 1. Définir le style de formatage comme MONÉTAIRE, mais sans les décimales
        // On utilise NumberFormatter::CURRENCY pour le symbole '€' mais on force le format
        $fmt = new NumberFormatter( get_user_locale(), NumberFormatter::CURRENCY );
        
        // 2. Modifier le format pour afficher ZERO chiffre après la virgule
        $fmt->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 0); 
        $fmt->setAttribute(NumberFormatter::MIN_FRACTION_DIGITS, 0);

        if(!empty($pdiscovery_pricesale)){
            
            // Note: $pdiscovery_pricesale et $pdiscovery_price sont déjà des entiers (absint)
            $formatted_sale_price = $fmt->formatCurrency( $pdiscovery_pricesale, 'EUR' );
            $formatted_price = $fmt->formatCurrency( $pdiscovery_price, 'EUR' );

            $output .=  sprintf(__('From <span class="pricevalue">%s</span> <span class="instead">instead of <span class="salepricevalue">%s</span></span>','tmsm-woocommerce-booking-thalasso'), $formatted_sale_price, $formatted_price);
        }
        else{
            // Note: $pdiscovery_price est déjà un entier (absint)
            $formatted_price = $fmt->formatCurrency( $pdiscovery_price, 'EUR' );
            $output .= '<span class="pricevalue">'.$formatted_price.'</span>';
        }

        $output .= '</span>';



		echo $output;
	}
}