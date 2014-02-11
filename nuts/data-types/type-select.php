<?php

// The file must have the type-[data-type].php filename format




// The function must have the nuts_type_[data-type]_field name format
function nuts_type_select_field ( $name, $id ) {

	global $nuts_options_array;
	

	echo '<select name="nuts_theme_options[' . $name . ']" id="' . $name . '">';

	foreach ( $nuts_options_array[$name]["values"] as $key => $value ) {
		echo '<option value="' . $key . '"';
		
		if ( $key == $id ) echo ' selected';
		
		echo '>' . $value . '</option>';
	}
	
	echo '</select>';

}



// Gets the value of the saved option
function nuts_get_select ( $name ) {

	global $nuts_options_array;

	if ( get_option ( 'nuts_theme_options' ) == "" ) return $nuts_options_array[$name]["default"];
		else $options = get_option ( 'nuts_theme_options' );
	if ( !array_key_exists ( $name, $options ) ) return $nuts_options_array[$name]["default"];


	$id = $options[$name];
	
	$value = $nuts_options_array[$name]["values"][$id];
	

	return $value;

}




// This is the function that returns the image in the size defined in its registered array
function nuts_select ( $name ) {

	echo nuts_get_select ( $name );
	
}



?>