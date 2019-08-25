<?php

function rvpplugin_settings() {

  // If plugin settings don't exist, then create them
  if( false == get_option( 'rvpplugin_settings' ) ) {
      add_option( 'rvpplugin_settings' );
  }

  // Define (at least) one section for our fields
  add_settings_section(
    // Unique identifier for the section
    'rvpplugin_settings_section',
    // Section Title
    __( 'Please choose the relevant options ', 'rvpplugin' ),
    // Callback for an optional description
    'rvpplugin_settings_section_callback',
    // Admin page to add section to
    'rvpplugin'
  );

    // Input Text Field
  add_settings_field(
    // Unique identifier for field
    'rvpplugin_settings_label_text',
    // Field Title
    __( 'Label for Recent Products ', 'rvpplugin'),
    // Callback for field markup
    'rvpplugin_settings_label_text_callback',
    // Page to go on
    'rvpplugin',
    // Section to go in
    'rvpplugin_settings_section'
  );

  // Input Text Field
  add_settings_field(
    // Unique identifier for field
    'rvpplugin_settings_input_text',
    // Field Title
    __( 'Number of products ', 'rvpplugin'),
    // Callback for field markup
    'rvpplugin_settings_text_input_callback',
    // Page to go on
    'rvpplugin',
    // Section to go in
    'rvpplugin_settings_section'
  );



  add_settings_section(
    // Unique identifier for the section
    'rvpplugin_slider_section',
    // Section Title
    __( 'Please choose if you want products in a slider ', 'rvpplugin' ),
    // Callback for an optional description
    'rvpplugin_slider_section_callback',
    // Admin page to add section to
    'rvpplugin'
  );

  // Checkbox Field
  add_settings_field(
    'rvpplugin_slider_checkbox',
    __( 'Wrap Products in a Slider', 'rvpplugin'),
    'rvpplugin_slider_checkbox_callback',
    'rvpplugin',
    'rvpplugin_slider_section',
    [
      'label' => 'Click to Add Slider'
    ]
  );

  // Input Text Field
  add_settings_field(
    // Unique identifier for field
    'rvpplugin_slider_slides_to_show',
    // Field Title
    __( 'Number of Slides in the view', 'rvpplugin'),
    // Callback for field markup
    'rvpplugin_slider_slides_to_show_callback',
    // Page to go on
    'rvpplugin',
    // Section to go in
    'rvpplugin_slider_section'
  );

  // Input Text Field
  add_settings_field(
    // Unique identifier for field
    'rvpplugin_slider_input_text',
    // Field Title
    __( 'Total Number of products in Slider ', 'rvpplugin'),
    // Callback for field markup
    'rvpplugin_slider_text_input_callback',
    // Page to go on
    'rvpplugin',
    // Section to go in
    'rvpplugin_slider_section'
  );


  register_setting(
    'rvpplugin_settings',
    'rvpplugin_settings'
  );

}

add_action( 'admin_init', 'rvpplugin_settings' );

function rvpplugin_settings_section_callback() {

  esc_html_e( '', 'rvpplugin' );

}

function rvpplugin_settings_label_text_callback() {

  $options = get_option( 'rvpplugin_settings' );

	$rvp_label = '';
	if( isset( $options[ 'rvp_label' ] ) ) {
		$rvp_label = esc_html( $options['rvp_label'] );
	}

  echo '<input type="text" id="rvpplugin_labeltext" name="rvpplugin_settings[rvp_label]" value="' . $rvp_label . '" />';

}

function rvpplugin_settings_text_input_callback() {

  $options = get_option( 'rvpplugin_settings' );

  $no_of_prods = '';
  if( isset( $options[ 'no_of_prods' ] ) ) {
    $no_of_prods = esc_html( $options['no_of_prods'] );
  }


  $checkbox1 = '';

		$checkbox1 = esc_html( $options['checkbox'] );
    //echo $checkbox1;
    if( $checkbox1 == '1' ){
        echo '<input  type="text" id="rvpplugin_customtext" name="rvpplugin_settings[no_of_prods]" value="' . $no_of_prods . '"  disabled />';
    } else {
        echo '<input type="text" id="rvpplugin_customtext" name="rvpplugin_settings[no_of_prods]" value="'  . $no_of_prods . '"  />';
    }


}




function rvpplugin_slider_section_callback() {

  esc_html_e( '', 'rvpplugin' );

}



function rvpplugin_slider_checkbox_callback( $args ) {

  $options = get_option( 'rvpplugin_settings' );

  $checkbox = '';
	if( isset( $options[ 'checkbox' ] ) ) {
		$checkbox = esc_html( $options['checkbox'] );

	}

	$html = '<input type="checkbox" id="rvpplugin_slider_checkbox" name="rvpplugin_settings[checkbox]" value="1"' . checked( 1, $checkbox, false ) . '/>';
	$html .= '&nbsp;';
	$html .= '<label for="rvpplugin_slider_checkbox">' . $args['label'] . '</label>';

	echo $html;

}

function rvpplugin_slider_slides_to_show_callback() {

  $options = get_option( 'rvpplugin_settings' );

  $slides_to_show = '';
  if( isset( $options[ 'slides_to_show' ] ) ) {
    $slides_to_show = esc_html( $options['slides_to_show'] );
  }

  $checkbox1 = '';

		$checkbox1 = esc_html( $options['checkbox'] );
    //echo $checkbox1;
    if( $checkbox1 == '1' ){
        echo '<input type="text" id="rvpplugin_slides_to_show" name="rvpplugin_settings[slides_to_show]" value="' . $slides_to_show . '" />';
    } else {
      echo '<input type="text" id="rvpplugin_slides_to_show" name="rvpplugin_settings[slides_to_show]" value="' . $slides_to_show . '" disabled />';

    }
}


function rvpplugin_slider_text_input_callback() {

  $options = get_option( 'rvpplugin_settings' );

  $no_of_prods_slider = '';
  if( isset( $options[ 'no_of_prods_slider' ] ) ) {
    $no_of_prods_slider = esc_html( $options['no_of_prods_slider'] );
  }

  $checkbox1 = '';

		$checkbox1 = esc_html( $options['checkbox'] );
    //echo $checkbox1;
    if( $checkbox1 == '1' ){
        echo '<input type="text" id="rvpplugin_slidertext" name="rvpplugin_settings[no_of_prods_slider]" value="' . $no_of_prods_slider . '" />';
    } else {
      echo '<input type="text" id="rvpplugin_slidertext" name="rvpplugin_settings[no_of_prods_slider]" value="' . $no_of_prods_slider . '" disabled />';

    }
}
