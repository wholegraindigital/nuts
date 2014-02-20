<?php

// The file must have the type-[data-type].php filename format



define	( "DEFAULT_IMAGE_SIZE",	"full");




// Enqueue the media uploader script
add_action( 'admin_print_scripts-appearance_page_nuts_theme_options', 'nuts_enqueue_media' );
function nuts_enqueue_media( ) {
	wp_enqueue_media();
}



// The function must have the nuts_type_[data-type]_field name format
function nuts_type_image_field ( $name, $id ) {

	$imgdata = wp_get_attachment_image_src( $id, 'thumbnail' );

	echo '<div class="uploader">
			<div class="image-container">
				<img class="uploaded-image" id="' . $name . '_img" src="' . $imgdata[0] . '"';
				
		if ( $id == '' ) echo ' style="display: none"';
		
	echo ' />
				<img class="placeholder" src="' . get_bloginfo('template_url') .'/nuts/img/no-image-placeholder.png"';
				
		if ( $id != '' ) echo ' style="display: none;"';
				
	echo '  />		
				<div class="closer" style="';
				
		if ( $id == '' ) echo ' display: none';
				
	echo '">
					<div class="hovermsg">Click here to remove image.</div>
				</div>
			</div>
			<input type="hidden" name="' . nuts_form_ref ( $name ) . '" id="' . $name . '" value="' . $id . '" />
			<input class="attrib" type="hidden" name="' . nuts_get_section ( $name ) . '_attrib[' . $name . ']" id="attrib_' . $name . '" value="' . $name . '" />
			<input class="button" type="button" name="' . $name . '_button" id="' . $name . '_button" value="Upload" />
		</div>';

}



// Get the default size of the image
function nuts_get_image_size ( $name ) {

	global $nuts_options_array;
	
	if ( $nuts_options_array[$name]["size"] != "" ) $size = $nuts_options_array[$name]["size"];
		else $size = DEFAULT_IMAGE_SIZE;

	return $size;	
	
}




// Gives you the image object based on the option name
function nuts_get_image_object ( $name, $size = DEFAULT_IMAGE_SIZE ) {

	global $nuts_options_array;

	if ( get_option ( 'nuts_theme_options' ) == "" ) return $nuts_options_array[$name];
		else $options = get_option ( 'nuts_theme_options' );
	if ( !array_key_exists ( $name, $options ) ) return '';

		
	if ( $size == "" ) $size = nuts_get_image_size ( $name );

	
	$id = $options[$name];
	
	$value = wp_get_attachment_image( $id, $size );
	

	return $value;

}




// Gives you the image URL based on the option name
function nuts_get_image ( $name, $size = DEFAULT_IMAGE_SIZE ) {

	global $nuts_options_array;

	
	if ( get_option ( 'nuts_theme_options' ) == "" ) return $nuts_options_array[$name];
		else $options = get_option ( 'nuts_theme_options' );
	if ( !array_key_exists ( $name, $options ) ) return '';
	
	
	
	if ( $size == "" ) $size = nuts_get_image_size ( $name );
	
	
	$id = $options[$name];
	
	$value = wp_get_attachment_url( $id, $size );
	

	return $value;

}




// This is the function that returns the image in the size defined in its registered array
function nuts_image_object ( $name, $size = "", $print = "img" ) {

	global $nuts_options_array;
	
	if ( $size == "" ) $size = $nuts_options_array[$name]["size"];
	if ( $print == "" ) $print = "img";
	
	if ( $print == "img" ) {
		$value = nuts_get_image_object ( $name, $size );
	}
	
	elseif ( $print == "url" ) {
		$value = nuts_get_image_url ( $name, $size );
	}
	
	else {
		$value = "Invalid parameter: " . $print;
	}
	
	echo $value;
	
}



?>