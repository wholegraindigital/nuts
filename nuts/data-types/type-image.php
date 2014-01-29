<?php

// The file must have the type-[data-type].php filename format



define	( "DEFAULT_IMAGE_SIZE",	"full");



// The function must have the type_[data-type]_field name format
function nuts_type_image_field ( $name, $id ) {

	$imgdata = wp_get_attachment_image_src( $id, 'thumbnail' );

	echo '<div class="uploader">
			<div class="image-container" style="height: 150px; width: 150px; position: relative; float: left; margin-right: 16px;">
				<img class="uploaded-image" id="' . $name . '_img" src="' . $imgdata[0] . '"';
				
		if ( $id == '' ) echo ' style="display: none"';
		
	echo ' />
				<img class="placeholder" src="' . get_bloginfo('template_url') .'/img/no-image-placeholder.png"';
				
		if ( $id != '' ) echo ' style="display: none;"';
				
	echo '  />		
				<div class="closer" style="width: 32px; height: 32px; background-image: url(' . get_bloginfo('template_url') . '/img/admin-icons.png); position: absolute; top: -5px; right: -5px; opacity: 0.75; cursor:pointer;';
				
		if ( $id == '' ) echo ' display: none';
				
	echo '">
					<div class="hovermsg" style="display: none; width: 100px; background-color: rgba(255,255,255,0.9); border: #222 1px solid; padding: 2px; font-size: 12px; color: #000; border-radius: 2px; position: absolute; top: 20px; left: 20px;">Click here to remove image.</div>
				</div>
			</div>
			<input type="hidden" name="nuts_theme_options[' . $name . ']" id="' . $name . '" value="' . $id . '" />
			<input class="attrib" type="hidden" name="nuts_theme_options_attrib[' . $name . ']" id="attrib_' . $name . '" value="' . $name . '" />
			<input class="button" type="button" name="' . $name . '_button" id="' . $name . '_button" value="Upload" />
		</div>';

}



// Gives you the image object based on the option name
function nuts_get_image ( $name, $size = DEFAULT_IMAGE_SIZE ) {

	if ( get_option ( 'nuts_theme_options' ) == "" ) return "ERR01: no options set up for this theme";
		else $options = get_option ( 'nuts_theme_options' );
	if ( !array_key_exists ( $name, $options ) ) return "ERR02: option does not exist";

	
	
	if ( $size == "" ) $size = DEFAULT_IMAGE_SIZE;
	
	
	$id = $options[$name];
	
	$value = wp_get_attachment_image( $id, $size );
	

	return $value;

}




// Gives you the image URL based on the option name
function nuts_get_image_url ( $name, $size = DEFAULT_IMAGE_SIZE ) {

	if ( get_option ( 'nuts_theme_options' ) == "" ) return "ERR01: no options set up for this theme";
		else $options = get_option ( 'nuts_theme_options' );
	if ( !array_key_exists ( $name, $options ) ) return "ERR02: option does not exist";

	
	
	
	if ( $size == "" ) $size = DEFAULT_IMAGE_SIZE;
	
	
	$id = $options[$name];
	
	$value = wp_get_attachment_url( $id, $size );
	

	return $value;

}




// This is the function that returns the image in the size defined in its registered array
function nuts_image ( $name, $print = "img", $size = "" ) {

	global $nuts_options_array;
	
	if ( $size == "" ) $size = $nuts_options_array[$name]["size"];
	if ( $print == "" ) $print = "img";
	
	if ( $print == "img" ) {
		$value = nuts_get_image ( $name, $size );
	}
	
	elseif ( $print == "url" ) {
		$value = nuts_get_image_url ( $name, $size );
	}
	
	else {
		$value = "Invalid parameter: " . $print;
	}
	
	return $value;
	
}



?>