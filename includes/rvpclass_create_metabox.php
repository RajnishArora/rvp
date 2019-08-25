<?php 

if( !class_exists('rvp_create_metabox')){
	
	class rvp_create_metabox{

		public function __construct(){

		}
		
		public function add_rvp_meta_box(){
			add_meta_box("rvp_meta", "Viewed Products", array($this,'add_viewed_products_meta_box'), "rvp", "normal", "low");
		}	

		public function add_viewed_products_meta_box(){
		      global $post;
		      $custom = get_post_custom( $post->ID );
		     
		      ?>
		      
		      <p>
		          <label>Viewed product Ids</label><br />
		          <input type="text" name="viewedids" value="<?= @$custom["viewedids"][0] ?>" />
		      </p>
		      
		      <?php
		}

		public function save_viewed_products_custom_fields(){
			  global $post;
			 
			  if ( $post )
			  {
			    update_post_meta($post->ID, "viewedids", @$_POST["viewedids"]);
			  }
		}


	}  // class 

}