<?php 


// The "nuts_logo" is a special (unique) option. It can be reached with the nuts_logo() function in the frontend - if defined
$nuts_logo = array ( 
        "name"			=> "nuts_logo",
        "title"			=> __( 'Theme Logo', 'nuts' ),
        "description"	        => __( 'Please upload your website\'s logo here.', 'nuts' ),
        "section"		=> "header",
        "type"			=> "image",
        "size"			=> "homepage-thumb"
);
nuts_register_option ( $nuts_logo );


// The margin above the logo
$nuts_option_array = array ( 
        "name"			=> "starter_topmargin",
        "title"			=> __( 'Top margin above the logo', 'nuts' ),
        "description"	        => __( 'Enter the top margin value in pixels.', 'nuts' ),
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



// Position of the logo: left, center or right
$nuts_option_array = array ( 
        "name"			=> "logo_position",
        "title"			=> __( 'Horizontal position of the logo', 'nuts' ),
        "description"	        => __( 'The logo will be placed to this side of the header', 'nuts' ),
        "section"		=> "header",
        "type"			=> "select",
        "values"		=> array( "left" => "Left", "center" => "Center", "right" => "Right" ),
        "default"		=> "right",
        "less"			=> true,
);
nuts_register_option ( $nuts_option_array );



// Color field
$nuts_option_array = array ( 
        "name"			=> "acolor",
        "title"			=> __( 'Theme Color Scheme', 'nuts' ),
        "description"	        => __( 'Please select a color. It will be the base of your color scheme. Change it and test how your site responds to it.', 'nuts' ),
        "section"		=> "colors",
        "type"			=> "color",
        "default"		=> "#333333",
        "less"			=> true
);
nuts_register_option ( $nuts_option_array );


// Color field
$nuts_option_array = array ( 
        "name"			=> "h1color",
        "title"			=> __( 'Heading elements', 'nuts' ),
        "description"	        => __( 'Please select a color for the heading (h1 .. h6) elements.', 'nuts' ),
        "section"		=> "colors",
        "type"			=> "color",
        "default"		=> "#97a141",
        "less"			=> true
);
nuts_register_option ( $nuts_option_array );


// Color field
$nuts_option_array = array ( 
        "name"			=> "bodyColor",
        "title"			=> __( 'Main body text', 'nuts' ),
        "description"	        => __( 'You can modify the body text color here. Use this as @bodyColor variable in your LESS files', 'nuts' ),
        "section"		=> "colors",
        "type"			=> "color",
        "default"		=> "#666666",
        "less"			=> true
);
nuts_register_option ( $nuts_option_array );


// Text field
$nuts_option_array = array ( 
        "name"			=> "source_label",
        "title"			=> __( 'Label for the source', 'nuts' ),
        "description"	        => __( 'The text label that\'s displayed before the source link right after the post contents.', 'nuts' ),
        "section"		=> "other",
        "type"			=> "text",
        "size"			=> "",
        "default"		=> __( 'Source:', 'nuts' )
);
nuts_register_option ( $nuts_option_array );


// Text field
$nuts_option_array = array ( 
        "name"			=> "readmore",
        "title"			=> __( 'Read more text', 'nuts' ),
        "description"	        => __( 'The read more text after the post excerpts in blog view.', 'nuts' ),
        "section"		=> "other",
        "type"			=> "text",
        "size"			=> "",
        "default"		=> __( 'Read more...', 'nuts' )
);
nuts_register_option ( $nuts_option_array );


// Text field
$nuts_option_array = array ( 
        "name"			=> "newerposts",
        "title"			=> __( 'Newer Posts link text', 'nuts' ),
        "description"	        => __( 'Newer posts text used for pagination in blog view.', 'nuts' ),
        "section"		=> "other",
        "type"			=> "text",
        "size"			=> "",
        "default"		=> __( 'Newer Posts', 'nuts' )
);
nuts_register_option ( $nuts_option_array );


// Text field
$nuts_option_array = array ( 
        "name"			=> "olderposts",
        "title"			=> __( 'Older Posts link text', 'nuts' ),
        "description"	        => __( 'Older posts text used for pagination in blog view.', 'nuts' ),
        "section"		=> "other",
        "type"			=> "text",
        "size"			=> "",
        "default"		=> __( 'Older Posts', 'nuts' )
);
nuts_register_option ( $nuts_option_array );


?>