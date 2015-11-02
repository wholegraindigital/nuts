<?php

// The file must have the type-[data-type].php filename format



define	( "DEFAULT_IMAGE_SIZE",	"medium" );




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
	
	if ( $nuts_options_array[$name]["size"] != NULL ) $size = $nuts_options_array[$name]["size"];
		else $size = DEFAULT_IMAGE_SIZE;

	return $size;	
	
}




// Gives you the image object based on the option name
function nuts_get_image ( $name, $size = "", $class = "" ) {

	global $nuts_options_array;

	$img_id = nuts_get_option ( $name );

	if ( is_numeric ( $img_id ) ) {
		if ( $size == "" ) $size = nuts_get_image_size ( $name );
		if ( $class != "" ) $value = wp_get_attachment_image ( $img_id, $size, 0, array( "class" => $class ) );
		else $value = wp_get_attachment_image ( $img_id, $size );
	}
	else $value = $img_id;
	
//	if ( $img_id == "" ) $value = $nuts_options_array[$name]["default"];

	return $value;

}




// Gives you the image URL based on the option name
function nuts_get_image_url ( $name, $size = "" ) {

	global $nuts_options_array;
	
	$img_id = nuts_get_option ( $name );

	if ( is_numeric ( $img_id ) ) {
		if ( $size == "" ) $size = nuts_get_image_size ( $name );
		$value = wp_get_attachment_image_src ( $img_id, $size );
		$value = $value[0];
	}
	else $value = $img_id;
	
	return $value;

}




// This is the function that returns the image in the size defined in its registered array
function nuts_image ( $name, $size = "", $print = "img" ) {

	global $nuts_options_array;
	
	if ( $size == "" ) $size = nuts_get_image_size ( $name );
	if ( $print == "" ) $print = "img";
	
	if ( $print == "img" ) {
		$value = nuts_get_image ( $name, $size );
	}
	
	elseif ( $print == "url" ) {
		$value = nuts_get_image_url ( $name, $size );
	}
	
	else {
		nuts_error ( "Invalid parameter: " . $print );
		return;
	}
	
	echo $value;
	
}



// This is a special function that shows your "nuts_logo" option as the site logo, with linking it to the Home page. If no logo is present's shows the textual site name
function nuts_logo ( $a = "home" ) {

	if ( nuts_option_registered ( "nuts_logo" ) ) {

		if ( nuts_get_image ( "nuts_logo" ) != '' ) {
	
			if ( $a == "home" ) echo '<a href="' . get_bloginfo ('url') . '">' . nuts_get_image ( "nuts_logo", nuts_get_image_size ( "nuts_logo" ), "nuts-logo" ) . '</a>';
			if ( $a == "img" ) echo nuts_get_image ( "nuts_logo", nuts_get_image_size ( "nuts_logo" ), "nuts-logo" );
			
		}
			
		else {
		
			if ( $a == "home" ) echo '<h1 class="nuts-logo"><a href="' . get_bloginfo ('url') . '">' . get_bloginfo ( "name" ) . '</a></h1>';
			if ( $a == "img" ) echo '<h1 class="nuts-logo">' . get_bloginfo ( "name" ) . '</h1>';
		
		}

	}
	
	else nuts_error ( "Please register a logo first before calling the nuts_logo() function." );
		
}


?>