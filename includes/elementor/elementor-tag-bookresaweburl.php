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
		global $post, $wp;

		$output = '';

		/*
		error_log('$wp->request');
		error_log($wp->request);
		error_log('$wp->query_vars');
		error_log(print_r($wp->query_vars, true));

		error_log('home_url( $wp->request )');
		error_log(home_url( $wp->request ));

		error_log('url_to_postid( home_url( $wp->request ) )');
		error_log(url_to_postid(home_url( $wp->request ) ));
		*/

		$queried_object = get_queried_object();
		if($queried_object){
			//error_log('queried_object exists');
		}
		else{
			$current_url_postid = url_to_postid(home_url( $wp->request ) );
			//error_log('queried_object does not exist');
			if(!empty($current_url_postid)){
				$queried_object = get_post($current_url_postid);
				//error_log('queried_object from url');
			}
		}

		//error_log(print_r($queried_object, true));

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

		if(!empty($package)){
			$package_codename  = esc_html( get_field( 'codename', $package->ID ) );
		}

		if(!empty($accommodation)){
			$accommodation_resaweburl = get_field('resaweb_url', $accommodation->ID);
		}
		else{
			return;
		}

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