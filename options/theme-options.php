<?php 


// The "nuts_logo" is a special (unique) option. It can be reached with the nuts_logo() function in the frontend - if defined
$nuts_logo = array ( 
        "name"			=> "nuts_logo",
        "title"			=> "Theme Logo",
        "description"	=> "Please upload your website's logo here.",
        "section"		=> "header",
        "type"			=> "image",
        "size"			=> "homepage-thumb"
);
nuts_register_option ( $nuts_logo );


// The margin above the logo
$nuts_option_array = array ( 
        "name"			=> "starter_topmargin",
        "title"			=> "Top margin above the logo",
        "description"	=> "Enter the top margin value in pixels.",
        "section"		=> "header",
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



// Color field
$nuts_option_array = array ( 
        "name"			=> "acolor",
        "title"			=> "Theme Colour Scheme",
        "description"	=> "Please select a color. It will be the base of your colour scheme. Change it and test how your site responds to it.",
        "section"		=> "colors",
        "type"			=> "color",
        "default"		=> "#a5d5a3",
        "less"			=> true
);
nuts_register_option ( $nuts_option_array );


// Color field
$nuts_option_array = array ( 
        "name"			=> "h1color",
        "title"			=> "Heading elements",
        "description"	=> "Please select a color for the heading (h1 .. h6) elements.",
        "section"		=> "colors",
        "type"			=> "color",
        "default"		=> "#3366aa",
        "less"			=> true
);
nuts_register_option ( $nuts_option_array );


// Color field
$nuts_option_array = array ( 
        "name"			=> "bodyColor",
        "title"			=> "Main body text",
        "description"	=> "You can modify the body text color here. Use this as @bodyColor variable in your LESS files",
        "section"		=> "colors",
        "type"			=> "color",
        "default"		=> "#666666",
        "less"			=> true
);
nuts_register_option ( $nuts_option_array );


// Text field
$nuts_option_array = array ( 
        "name"			=> "source_label",
        "title"			=> "Label for the source",
        "description"	=> "The text label that's displayed before the source link.",
        "section"		=> "other",
        "type"			=> "text",
        "size"			=> "",
        "default"		=> "Source:"
);
nuts_register_option ( $nuts_option_array );


// Text field
$nuts_option_array = array ( 
        "name"			=> "readmore",
        "title"			=> "Read more text",
        "description"	=> "The read more text after the post excerpts in blog view.",
        "section"		=> "other",
        "type"			=> "text",
        "size"			=> "",
        "default"		=> "Read more..."
);
nuts_register_option ( $nuts_option_array );


// Text field
$nuts_option_array = array ( 
        "name"			=> "newerposts",
        "title"			=> "Newer Posts link text",
        "description"	=> "Newer posts text used for pagination in blog view.",
        "section"		=> "other",
        "type"			=> "text",
        "size"			=> "",
        "default"		=> "Newer Posts"
);
nuts_register_option ( $nuts_option_array );


// Text field
$nuts_option_array = array ( 
        "name"			=> "olderposts",
        "title"			=> "Older Posts link text",
        "description"	=> "Older posts text used for pagination in blog view.",
        "section"		=> "other",
        "type"			=> "text",
        "size"			=> "",
        "default"		=> "Older Posts"
);
nuts_register_option ( $nuts_option_array );


?>