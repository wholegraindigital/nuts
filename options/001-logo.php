<?php 

// Read the logo settings for Theme Options and return its URL or the IMG object



// Now set up the settings for the Theme Options page
$nuts_option_array = array ( 
        "name"			=> "nuts_logo",
        "title"			=> "Theme Logo",
        "description"	=> "Please upload your website's logo here.",
        "section"		=> "nuts_first_section",
        "type"			=> "image",
        "size"			=> "homepage-thumb"
);
nuts_register_option ( $nuts_option_array );




// This is a shortcut for the nuts_image() function.
function nuts_logo ( $a = "home" ) {

	if ( $a == "home" ) echo '<a href="' . get_bloginfo ('url') . '">' . nuts_get_image_object ( "nuts_logo", nuts_get_image_size ( "nuts_logo" ) ) . '</a>';
	if ( $a == "img" ) echo nuts_get_image_object ( "nuts_logo", nuts_get_image_size ( "nuts_logo" ) );

}


?>