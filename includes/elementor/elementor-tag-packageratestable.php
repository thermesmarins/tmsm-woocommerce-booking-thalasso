<?php
if(!class_exists('\Elementor\Core\DynamicTags\Tag')){
	die();
}
class Elementor_Tag_PackageRatesTable extends \Elementor\Core\DynamicTags\Tag {

	public function get_name() {
		return 'tmsm-woocommerce-booking-thalasso-packageratestable';
	}

	public function get_title() {
		return __( 'Package Rates Table', 'tmsm-woocommerce-booking-thalasso' );
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

		if(!function_exists('get_field')){
			return;
		}
		$package_idresaweb = esc_html(get_field('id_resaweb', $package->ID));
		$package_codename = esc_html(get_field('codename', $package->ID));
		if(empty($package_idresaweb)){
			return;
		}

		$triptype = get_field('trip_type', $package->ID); // term object trip_type
		$triptype_defaultnights = null;
		if(!empty($triptype)){
			$triptype_slug = esc_html($triptype->slug);
			if(!empty($triptype_slug)){
				switch($triptype_slug){
					case 'long-sejour':
					case 'thalasso-spa-packages':
						$triptype_defaultnights = 6;
						break;
					case 'court-sejour':
					case 'escapade':
					case 'short-breaks':
					default:
						$triptype_defaultnights = 1;
				}
			}
		}

		if(get_post_type($package) !== 'package'){
			return;
		}

		$accommodations = get_posts([
			'post_type' => 'accommodation',
			'numberposts' => -1,
			'orderby' => 'menuorder',
			'order' => 'ASC',
		]);

		$lang = esc_html((function_exists('pll_current_language') ? pll_current_language() : substr(get_locale(),0, 2)));

		$theme = wp_get_theme();
		$buttonclass = '';
		if ( 'StormBringer' == $theme->get( 'Name' ) || 'stormbringer' == $theme->get( 'Template' ) ) {
			$buttonclass = 'btn btn-primary';
		}
		if ( 'OceanWP' == $theme->get( 'Name' ) || 'oceanwp' == $theme->get( 'Template' ) ) {
			$buttonclass = 'button';
		}

		if(!empty($accommodations) ){
			$output .= do_shortcode('[resaweb_load package_id="'.$package_idresaweb.'" nights="'.$triptype_defaultnights.'" lang="'.$lang.']');
			$output .= '<table class="tmsm-woocommerce-booking-thalasso-packageratestable">';
			foreach ($accommodations as $accommodation){
				$accommodation_codename = esc_html(get_field('codename', $accommodation->ID));
				$accommodation_resaweburl = esc_html(get_field('resaweb_url', $accommodation->ID));
				if(!empty($accommodation_resaweburl)){
					$accommodation_resaweburl .= esc_html('/'.$package_codename);
				}

				$output .= '<tr id="resaweb-price-container-'.$accommodation_codename.'-'.$package_idresaweb.'-'.$triptype_defaultnights.'">';
				$output .= '<td class="accommodationname">';
				if(!empty($accommodation_resaweburl)){
					$output .= '<a href="'.$accommodation_resaweburl.'">';
				}
				$output .= esc_html($accommodation->post_title).'</td>';
				if(!empty($accommodation_resaweburl)){
					$output .= '</a>';
				}
				$output .= '</td>';
				$output .= '<td class="price">';
				$output .= do_shortcode('[resaweb_price from="1" instead="1" hotel_id="'.$accommodation_codename.'" package_id="'.$package_idresaweb.'" nights="'.$triptype_defaultnights.'" lang="'.$lang.'"]');
				$output .= '</td>';
				$output .= '<td class="booklink">';
				if(!empty($accommodation_resaweburl)){
					$output .= '<a href="'.$accommodation_resaweburl.'" class="'.$buttonclass.'">';
					$output .= __('Book now', 'tmsm-woocommerce-booking-thalasso');
					$output .= '</a>';
				}
				$output .= '</td>';
				$output .= '</tr>';
			}
			$output .= '</table>';
		}

		echo $output;
	}
}