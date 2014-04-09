<?php 

// Text field
$nuts_option_array = array ( 
        "name"			=> "text1",
        "title"			=> "A good old text field",
        "description"	=> "Write your text here.",
        "section"		=> "page::first_metaboxi",
        "type"			=> "text",
        "size"			=> "",
        "default"		=> "This is the default text."
);
nuts_register_option ( $nuts_option_array );




// Image field
$nuts_image_array = array ( 
        "name"			=> "image2",
        "title"			=> "Sample image 2",
        "description"	=> "Please upload an optional image here.",
        "section"		=> "page::first_metabox",
        "type"			=> "image",
        "size"			=> "medium",
        "default"		=> "No image found."
);
nuts_register_option ( $nuts_image_array );


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



// Color field for metabox. It won't be parsed to LESS (only theme options will)
$nuts_option_array = array ( 
        "name"			=> "color45",
        "title"			=> "Color picker in metabox",
        "description"	=> "Select a colour.",
        "section"		=> "page::first_metabox",
        "type"			=> "color",
        "default"		=> "#999",
        "less"			=> true
);
nuts_register_option ( $nuts_option_array );



?>