<?php


// Set up the sections in Theme Options

$section = array (
	"name"			=> "header",
	"title"			=> __( 'Header', 'nuts' ),
	"description"	=> __( 'Options for the header, logo, etc.', 'nuts' ),
	"tab"			=> "Header"
);
nuts_register_section ( $section );


$section = array (
	"name"			=> "colors",
	"title"			=> __( 'Colors', 'nuts' ),
	"description"	=> __( 'Set up the theme colors here', 'nuts' ),
	"tab"			=> "Colors"
);
nuts_register_section ( $section );


$section = array (
	"name"			=> "other",
	"title"			=> __( 'Other options', 'nuts' ),
	"description"	=> __( 'Some miscellaneous options', 'nuts' ),
	"tab"			=> "Other"
);
nuts_register_section ( $section );


// And some custom field sections for posts

$section = array (
	"name"			=> "post::post_options",
	"title"			=> __( 'Post Options', 'nuts' ),
	"description"	=> __( 'This is an example metabox section', 'nuts' ),
	"tab"			=> ""
);
nuts_register_section ( $section );



?>
