<?php 

// Read the logo settings for Theme Options and return its URL or the IMG object



// Now set up the settings for the Theme Options page
$nuts_logo_array = array ( 
        "name"			=> "nuts_logo",
        "title"			=> "Theme Logo",
        "description"	=> "Please upload your website's logo here.",
        "section"		=> "nuts_first_section",
        "type"			=> "image",
        "size"			=> "homepage-thumb"
);
nuts_register_option ( $nuts_logo_array );




// This is a shortcut for the nuts_image() function.
function nuts_logo ( $print = "img" ) {

	if ( $print == "img" ) echo '<a href="' . get_bloginfo ('url') . '">' . nuts_image ( "nuts_logo", $print ) . '</a>';
		else echo nuts_image ( "nuts_logo", $print );

}


?>