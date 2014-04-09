<?php 

// Text field
$nuts_option_array = array ( 
        "name"			=> "select1",
        "title"			=> "A dropdown select field",
        "description"	=> "Select an option.",
        "section"		=> "page::first_metabox",
        "type"			=> "select",
        "values"		=> array( "", "Red", "Green", "Blue" ),
        "default"		=> "Red"
);
nuts_register_option ( $nuts_option_array );


?>