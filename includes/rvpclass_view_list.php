<?php

if( !class_exists('rvp_view_list')){
	class rvp_view_list{

		// define variables
		private $rvp_label = "Recently Viewed Products";
		private $options = [];

		public function __construct(){
				$this->options = get_option( 'rvpplugin_settings' );
		}


		public function rvp_show($no_of_prods,$array_viewed_ids,$wrap_slider){
			$count = 0;
			//print_r( $no_of_prods);
			if($no_of_prods <= 0 ){ //show all products
					if( is_product()){
							array_shift($array_viewed_ids);
					}
					$array_ids_to_show = $array_viewed_ids;
			} else {
					if(is_product()){
							$array_ids_to_show = array_slice($array_viewed_ids,1,$no_of_prods);
					} else {
							$array_ids_to_show = array_slice($array_viewed_ids,0,$no_of_prods);
					}

					// slice to array from 1 so that current item doesnot shows in rvp in product page
					// slice from 0 to slice it till no of products
			}


			$max_prods = count($array_ids_to_show);

			if ($max_prods < 1 ) return;
			//print_r( $array_ids_to_show);
			$the_query = new WP_Query( array(
				'post_type'  =>  'product',
				'post_status'  =>  'publish',
				'posts_per_page' => '-1',
				'post__in'  =>  $array_ids_to_show,
				'orderby' => 'post__in'
			));

			$total = $the_query->found_posts;

			if ( $the_query->have_posts() ) {
					_e( '<section class="recent_products">' ) ;
					_e('<h2>'. $this->rvp_label.'</h2>');
					if ($wrap_slider == "true" || $wrap_slider == '1' ){
							_e( '<ul class="products rvpscarousel">');

					} elseif($wrap_slider == "false" || $wrap_slider == '0' ){
							_e( '<ul class="products">');
					}

					while ( $the_query->have_posts()  && $count < $max_prods  ) {
						$the_query->the_post();
						wc_get_template_part( 'content', 'product' );

						$count++;
					}
					_e('</ul>');
					_e('</section>') ;
				/* Restore  Post Data */
				wp_reset_postdata();
			}else{
				return ;
			}
		}

		public function rvp_view_guest($no_of_prods,$wrap_slider){
			if( !isset($_COOKIE['rvpguest'] )) return ;
			$array_values = unserialize($_COOKIE['rvpguest']);
			$this->rvp_show($no_of_prods,$array_values,$wrap_slider);

		}

		public function rvp_view_logged_in($no_of_prods,$wrap_slider){
				$currentUser = get_current_user_id();
		    $rvp_user = 'rvp_'.$currentUser;
		    $rvp_post = get_page_by_title($rvp_user,'' , 'rvp');

		    if( $rvp_post ) {
		        $rvp_id = $rvp_post->ID;
		        $viewed_ids = get_post_meta($rvp_id,'viewedids',true);
		        $array_viewed_ids = explode(',',$viewed_ids);
			//			print_r($array_viewed_ids);
		       	$this->rvp_show($no_of_prods,$array_viewed_ids,$wrap_slider);
						//$this->rvp_sc_show($no_of_prods,$array_viewed_ids,$wrap_slider);

		    } // if rvp_post
		}

		public function rvp_view_shortcode($no_products,$slider_use){
			//[rvp_show no_products="5"  slider_use="false" ]
			if(is_user_logged_in()){
				$this->rvp_view_logged_in($no_products,$slider_use);
			} else {
				$this->rvp_view_guest($no_products,$slider_use);
			}
		}

		public function rvp_view_single(){
			$no_to_pass;
			$no_of_prods = 3;
			$no_of_prods_slider;
			$wrap_slider = false;
			if( isset( $this->options[ 'rvp_label' ] ) && ($this->options[ 'rvp_label' ] != '')  ) {
				$this->rvp_label = __( $this->options['rvp_label'] );
			}

			if( isset( $this->options[ 'no_of_prods' ] ) && ($this->options[ 'no_of_prods' ] != '') ) {
			    $no_of_prods = esc_html( $this->options['no_of_prods'] );
			}
			$checkbox = '';
			if( isset( $this->options[ 'checkbox' ] ) ) {
				$checkbox = esc_html( $this->options['checkbox'] );
				if( isset( $this->options[ 'no_of_prods_slider' ] ) && ($this->options[ 'no_of_prods_slider' ] != '') ) {
			    $no_of_prods_slider = esc_html( $this->options['no_of_prods_slider'] );
			  }
			}

			if($checkbox == '1' ){
				$no_to_pass = $no_of_prods_slider;
				$wrap_slider = true;
			} else {
				$no_to_pass = $no_of_prods;
				$wrap_slider = false;
			}


			if(is_user_logged_in()){
				$this->rvp_view_logged_in($no_to_pass,$wrap_slider);
			} else {
				$this->rvp_view_guest($no_to_pass,$wrap_slider);
			}

		} //end of function rvp_view_single

	} //class rvp_view_list
}
