<?php
/**
 * @package
 *
 */
add_shortcode('rvp_show', function($atts,$content){
		$atts = shortcode_atts(
				array(
						'no_products'	=> '4',
						'slider_use'	=> true
				), $atts
		);

		extract($atts);
		if ( !isset($rvp_view_object) ){
				$rvp_view_object = new rvp_view_list;
		}

		return $rvp_view_object->rvp_view_shortcode($no_products,$slider_use);
});
