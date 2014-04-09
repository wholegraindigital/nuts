<?php 

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



?>