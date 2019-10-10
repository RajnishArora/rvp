<?php

if( !class_exists('rvp_create_metabox')){

	class rvp_create_metabox{

		public function __construct(){

		}

		public function add_rvp_meta_box(){
			add_meta_box("rvp_meta", _x("Viewed Products","rvpplugin metabox title",'rvpplugin'), array($this,'add_viewed_products_meta_box'), "rvp", "normal", "low");
		}

		public function add_viewed_products_meta_box(){
		      global $post;
					// add nonce fiels here & check before storing data
					wp_nonce_field( basename( __FILE__ ), 'rvp_meta_box_nonce' );
		      $custom = get_post_custom( $post->ID );

		      ?>

		      <p>
		          <label>Viewed product Ids</label><br />
		          <input type="text" name="viewedids" value="<?php _e($custom["viewedids"][0]); ?>" />
		      </p>

		      <?php
		}

		public function save_viewed_products_custom_fields(){
			  global $post;
				// verify nonce so that save command is coming from this plugin only
				if ( !isset( $_POST['rvp_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['rvp_meta_box_nonce'], basename( __FILE__ ) ) ){
						return;
				}

			  if ( $post )
			  {
			    update_post_meta($post->ID, "viewedids", sanitize_text_field($_POST["viewedids"]));
			  }
		}


	}  // class

}
