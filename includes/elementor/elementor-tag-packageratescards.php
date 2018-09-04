<?php
if(!class_exists('\Elementor\Core\DynamicTags\Tag')){
	die();
}
class Elementor_Tag_PackageRatesCards extends \Elementor\Core\DynamicTags\Tag {

	public function get_name() {
		return 'tmsm-woocommerce-booking-thalasso-packageratescards';
	}

	public function get_title() {
		return __( 'Package Rates Cards', 'tmsm-woocommerce-booking-thalasso' );
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
			$triptype_defaultnights = get_field('defaultnights', $triptype->taxonomy . '_' . $triptype->term_id);
		}

		if(get_post_type($package) !== 'package'){
			return;
		}

		$accommodations = get_posts([
			'post_type' => 'accommodation',
			'numberposts' => -1,
			'orderby' => 'menu_order',
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

		$defaultnights_toload = [];

		if(!empty($accommodations) ){

			$output .= '<ul class="tmsm-woocommerce-booking-thalasso-packageratescards">';
			foreach ($accommodations as $accommodation){
				$accommodation_codename = esc_html(get_field('codename', $accommodation->ID));
				$accommodation_resaweburl = esc_html(get_field('resaweb_url', $accommodation->ID));

				$defaultnights = $triptype_defaultnights;
				$accommodation_type = get_field('accommodation_type', $accommodation->ID); // term object accommodation_type

				if(!empty($accommodation_type)){

					$accommodation_type_for_trip_type = get_field( 'accommodation_type', 'trip_type_'.$triptype->term_id);
					// Trip Type is not related to accommodation type, exclude
					if(!(is_array($accommodation_type_for_trip_type) && in_array($accommodation_type->term_id, $accommodation_type_for_trip_type))){
						continue;
					}

					$accommodation_defaultnights = get_field('defaultnights', $accommodation_type->taxonomy . '_' . $accommodation_type->term_id);
					if(!empty($accommodation_defaultnights)){
						$defaultnights = $accommodation_defaultnights;
					}
				}

				if(!in_array($defaultnights, $defaultnights_toload)){
					$defaultnights_toload[] = $defaultnights;
				}

				if(!empty($accommodation_resaweburl)){
					if(!empty($accommodation_codename)){
						$accommodation_resaweburl .= esc_html('/'.$package_codename);
					}
					$output .= '<div id="resaweb-price-container-'.$accommodation_codename.'-'.$package_idresaweb.'-'.$defaultnights.'">';
					$output .= get_the_post_thumbnail($accommodation, 'medium');
					$output .= '<h3>';
					$output .= '<a href="'.$accommodation_resaweburl.'">';

					$output .= esc_html($accommodation->post_title);
					$output .= '</a>';
					$output .= '<h3>';
					$output .= '<p>';
					$output .= do_shortcode('[resaweb_price fallback="1" from="1" instead="1" hotel_id="'.$accommodation_codename.'" package_id="'.$package_idresaweb.'" nights="'.$defaultnights.'" lang="'.$lang.'"]');
					$output .= '</p>';
					$output .= '<a href="'.$accommodation_resaweburl.'" class="'.$buttonclass.'">';
					$output .= __('Book now', 'tmsm-woocommerce-booking-thalasso');
					$output .= '</a>';
					$output .= '</div>';
				}

			}
			$output .= '</ul>';

			if(!empty($triptype_slug)){
				$output .= '<p class="tmsm-woocommerce-booking-thalasso-packageratescards-caption">';
				switch($triptype_slug){
					case 'long-sejours':
					case 'long-sejour':
					case 'thalasso-spa-packages':
						$output .= __('In hotel: Rates per person for 6 days in a double room, half board.','tmsm-woocommerce-booking-thalasso').'<br/>';
						$output .= __('In Residence: Rates per person for 2 persons spa guests occupying the same apartment, including 6 treatments days and 7 nights from saturday to saturday.','tmsm-woocommerce-booking-thalasso');
						break;
					case 'court-sejours':
					case 'court-sejour':
					case 'escapade':
					case 'short-breaks':
						$output .= __('Rates per person per day in a double room, half board (except Hotel du Louvre, breakfast only).','tmsm-woocommerce-booking-thalasso').'<br/>';
					default:
				}
				$output .= '</p>';
			}

			foreach($defaultnights_toload as $defaultnights_toload_item){
				$output .= do_shortcode('[resaweb_load package_id="'.$package_idresaweb.'" nights="'.$defaultnights_toload_item.'" lang="'.$lang.']');
			}
		}

		echo $output;
	}
}