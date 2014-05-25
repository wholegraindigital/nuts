<?php 


// The "nuts_logo" is a special (unique) option. It can be reached with the nuts_logo() function in the frontend - if defined
$nuts_logo = array ( 
        "name"			=> "nuts_logo",
        "title"			=> "Theme Logo",
        "description"	=> "Please upload your website's logo here.",
        "section"		=> "nuts_first_section",
        "type"			=> "image",
        "size"			=> "homepage-thumb"
);
nuts_register_option ( $nuts_logo );



// Added image 1
$nuts_image_array = array ( 
        "name"			=> "image1",
        "title"			=> "Sample image 1",
        "description"	=> "Please upload an optional image here.",
        "section"		=> "nuts_first_section",
        "type"			=> "image",
        "size"			=> "thumbnail",
        "default"		=> "No image found."
);
nuts_register_option ( $nuts_image_array );



// Text field
$nuts_option_array = array ( 
        "name"			=> "text45",
        "title"			=> "TO text field",
        "description"	=> "Write your text here.",
        "section"		=> "nuts_first_section",
        "type"			=> "text",
        "size"			=> "",
        "default"		=> "This is the default text."
);
nuts_register_option ( $nuts_option_array );




// Color field
$nuts_option_array = array ( 
        "name"			=> "acolor",
        "title"			=> "Theme Colour Scheme",
        "description"	=> "Please select a color. It will be the base of your colour scheme. Change it and test how your site responds to it.",
        "section"		=> "nuts_second_section",
        "type"			=> "color",
        "default"		=> "#a5d5a3",
        "less"			=> true
);
nuts_register_option ( $nuts_option_array );


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


// Unknown type field
$nuts_option_array = array ( 
        "name"			=> "unk1",
        "title"			=> "Unknown type option",
        "description"	=> "Option with unknown type.",
        "section"		=> "nuts_third_section",
        "default"		=> ""
);
nuts_register_option ( $nuts_option_array );

?>