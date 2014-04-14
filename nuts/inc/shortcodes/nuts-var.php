<?php

// Add Shortcode: [nuts-var]
// Returns the value for a saved option and displays it in your articles, text widgets, etc.


add_shortcode( 'nuts-var', 'nuts_shortcode_nuts_var' );


function nuts_shortcode_nuts_var ( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'name' => ''
		), $atts )
	);
	
	return nuts_get_value ( $name );
	
}

?>