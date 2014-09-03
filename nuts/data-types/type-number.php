<?php

// The file must have the type-[data-type].php filename format


define	( "DEFAULT_NUMBER_STEP",	1 );
define	( "DEFAULT_NUMBER_MIN",		1 );
define	( "DEFAULT_NUMBER_MAX",		100 );



// The function must have the nuts_type_[data-type]_field name format
function nuts_type_number_field ( $name, $value ) {

	global $nuts_options_array;
	
	if ( $nuts_options_array[$name]["step"] != NULL ) $step = $nuts_options_array[$name]["step"];
		else $step = DEFAULT_NUMBER_STEP;

	if ( $nuts_options_array[$name]["min"] != NULL ) $min = $nuts_options_array[$name]["min"];
		else $min = DEFAULT_NUMBER_MIN;

	if ( $nuts_options_array[$name]["max"] != NULL ) $max = $nuts_options_array[$name]["max"];
		else $max = DEFAULT_NUMBER_MAX;
		
	if ( $value == "" ) $value = $nuts_options_array[$name]["default"];
		
	echo '<div class="number">
			<input type="number" name="' . nuts_form_ref ( $name ) . '" id="' . $name . '" value="' . $value . '" min="' . $min . '" max="' . $max . '" step="' . $step . '" />
		</div>';

}



// Returns the number value. Adds the prefix before and the suffix after the number. If you add the 2nd parameter true, you'll get the pure number, without prefix and suffix
function nuts_get_number ( $name, $pure = false ) {

	global $nuts_options_array;

	if ( $pure == false ) return $nuts_options_array[$name]["prefix"] . nuts_get_option ( $name ) . $nuts_options_array[$name]["suffix"];
		else nuts_get_option ( $name );

}




// Prints the number value
function nuts_number ( $name ) {

	echo nuts_get_number ( $name );
	
}



?>