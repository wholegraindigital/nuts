<?php

// Text field
$nuts_option_array = array ( 
        "name"			=> "source",
        "title"			=> __( 'Source link', 'nuts' ),
        "description"	=> __( 'Source URL of the original article.', 'nuts' ),
        "section"		=> "post::post_options",
        "type"			=> "text",
        "size"			=> ""
);
nuts_register_option ( $nuts_option_array );


?>