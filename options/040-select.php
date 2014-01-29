<?php 

// Text field
$nuts_option_array = array ( 
        "name"			=> "select1",
        "title"			=> "A dropdown select field",
        "description"	=> "Select an option.",
        "section"		=> "nuts_first_section",
        "type"			=> "select",
        "size"			=> "",
        "values"		=> array( "Red", "Green", "Blue" )
);
nuts_register_option ( $nuts_option_array );


// Now set up the settings for the Theme Options page




?>