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


// The margin above the logo
$nuts_option_array = array ( 
        "name"			=> "starter_topmargin",
        "title"			=> "Top margin above the logo",
        "description"	=> "Enter the top margin value in pixels.",
        "section"		=> "nuts_first_section",
        "type"			=> "number",
        "step"			=> "1",
        "min"			=> "0",
        "max"			=> "200",
        "default"		=> "105",
        "less"			=> true,
        "prefix"		=> "",
        "suffix"		=> "px",
);
nuts_register_option ( $nuts_option_array );



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