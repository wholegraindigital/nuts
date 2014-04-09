<?php

// The file must have the type-[data-type].php filename format


define	( "DEFAULT_COLOR",	"#000000");



// Enqueue the color picker script
add_action( 'admin_enqueue_scripts', 'nuts_enqueue_color_picker' );
function nuts_enqueue_color_picker( $hook_suffix ) {
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker', array('jquery') );    
}




// Get the default color
function nuts_get_default_color ( $name ) {

	global $nuts_options_array;
	
	if ( $nuts_options_array[$name]["default"] != "" ) $defcolor = $nuts_options_array[$name]["default"];
		else $defcolor = DEFAULT_COLOR;

	return $defcolor;	
	
}




// The function must have the nuts_type_[data-type]_field name format
function nuts_type_color_field ( $name, $value ) {

	if ( $value == "" ) $value = nuts_get_default_color ( $name );

	echo '<div class="color">
			<input id="' . $name . '" name="' . nuts_form_ref ( $name ) . '" type="text" value="' . $value . '" class="nuts-color-field" data-default-color="' . nuts_get_default_color ( $name ) . '" />
		</div>';

}



// Gives you the image object based on the option name
function nuts_get_color ( $name ) {

	$color = nuts_get_option ( $name );

	if ( $color == "" ) return nuts_get_default_color ( $name );

	return $color;

}




// This is the function that returns the image in the size defined in its registered array
function nuts_color ( $name ) {

	echo nuts_get_color ( $name );
	
}



?>