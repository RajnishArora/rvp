<?php
if( !class_exists('rvp_create_list')){

	class rvp_create_list{
		private $options = [];

		public function __construct()
		{
						$this->options = get_option( 'rvpplugin_settings' );
		}

	    // is_user_logged_in()
	    // create a new custom post type & add a metabox
	    // also add a custom field say viewedids
			// add a new enrty in the custom post type with the name say rvp_custId
	    // if user visits a single product page add the product id to the custom field products
	    // of the rvp_custId


		public function rvp_create_view_list() {
    		//echo " create list view";

			if( is_user_logged_in() && is_product() ) {  //
		            //check whether an entry exists in rvp post type if yes add the single page post id  to the custom field
		            // if no add create an entry using wp_insert_post
			
		            $product_id = get_the_ID();
		            $currentUser = get_current_user_id();
		            $rvp_user = 'rvp_'.$currentUser;
		            $rvp_post='';
		            $rvp_post = get_page_by_title($rvp_user,'' , 'rvp');

		            if( $rvp_post ) {
		                $rvp_id = $rvp_post->ID;
		                $viewed_ids = get_post_meta($rvp_id,'viewedids',true);
		                $array_viewed_ids = explode(',',$viewed_ids);
		                 if(in_array($product_id, $array_viewed_ids)){

		                      if( $product_id != $array_viewed_ids[0] ){
		                            $key = array_search($product_id, $array_viewed_ids);
		                            if ($key != false) {
		                                unset( $array_viewed_ids[$key] );
		                            }
		                            $array_viewed_ids = array_values($array_viewed_ids);
		                            array_unshift($array_viewed_ids, $product_id );
		                            $product_str = implode(',',$array_viewed_ids);
		                            update_post_meta($rvp_id, 'viewedids' , $product_str );
		                      }


		                 } else {

		                      array_unshift($array_viewed_ids, $product_id ); //add it to array
		                      $product_str = implode(',',$array_viewed_ids);  //convert to string
		                      update_post_meta($rvp_id, 'viewedids' , $product_str );

		                 }

		               // append to already existing custom field viewedids
		                // add a comma & add the product id
		            } else {
		                $rvp_id = wp_insert_post(array(
		                        'post_type'   => 'rvp',
		                        'post_status' => 'publish',
		                        'post_title'  => $rvp_user,
		                        'meta_input'  => array(
		                                            'viewedids' => $product_id

		                                        )
		                        ));
		            }
	        }  // if user logged in ends

        	else if( !is_user_logged_in() && is_product() ){  //  user if not logged in so use cookie
        		$product_id = get_the_ID();
        		$rvpguest = 'rvpguest';
						$cookie_time = 30;

						if( isset( $this->options['cookie_time'] ) && $this->options['cookie_time'] !=''  ){
								$cookie_time = esc_html( $this->options['cookie_time'] );
								$cookie_days = $cookie_time * 86400 ;
						} else {
								$cookie_days = 30 * 86400 ;
						}

						
        		if( !isset( $_COOKIE['rvpguest'] ) ) {
        			//print_r("cookie empty");
        			$rvpval = array($product_id);
        			$rvpval = serialize($rvpval);
        			setcookie('rvpguest', $rvpval, time() + $cookie_days ,'/',COOKIE_DOMAIN);
        			$_COOKIE['rvpguest'] = $rvpval;
        		} else {
        			$prev_val = $_COOKIE['rvpguest'] ;
        			$prev_val = stripslashes($prev_val);
        			$array_val = unserialize($prev_val);
        			if(in_array($product_id, $array_val)){

		                    if( $product_id != $array_val[0] ){
		                    		//print_r("bringing in front ");
		                            $key = array_search($product_id, $array_val);
		                            if ($key != false) {
		                                unset( $array_val[$key] );
		                            }
		                            $array_val = array_values($array_val);
		                            array_unshift($array_val, $product_id );
		                            //print_r($array_val) ;
		                            $new_rvp_val = serialize($array_val);
		                            setcookie('rvpguest', $new_rvp_val, time() + $cookie_days,'/',COOKIE_DOMAIN);
		                            $_COOKIE['rvpguest'] = $new_rvp_val;

		                    }


		            } else { // not in array so add
		                 	array_unshift($array_val, $product_id ); //add it to array
		                    $new_rvp_val = serialize($array_val);
		                    setcookie('rvpguest', $new_rvp_val, time() + $cookie_days,'/',COOKIE_DOMAIN);
		                    $_COOKIE['rvpguest'] = $new_rvp_val;

		                 }


        		}   // else outer


	    	}   // !is_user_logged_in() && is_product()

		}  // rvp_create_view_list() ends

	}  // class ends


} // ! class_exists
