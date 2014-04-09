<?php 

// Color field
$nuts_option_array = array ( 
        "name"			=> "h1color",
        "title"			=> "Color picker for H1 elements",
        "description"	=> "Please select a color for H1 elements.",
        "section"		=> "nuts_second_section",
        "type"			=> "color",
        "default"		=> "#3366aa",
        "less"			=> true
);
nuts_register_option ( $nuts_option_array );


// Color field for metabox. Never use true value for less in metaboxes.
$nuts_option_array = array ( 
        "name"			=> "color45",
        "title"			=> "Color picker in metabox",
        "description"	=> "Select a colour.",
        "section"		=> "page::first_metabox",
        "type"			=> "color",
        "default"		=> "#999",
        "less"			=> false
);
nuts_register_option ( $nuts_option_array );


?>