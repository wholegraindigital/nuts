<?php


// Set up the sections in Theme Options

$section = array (
	"name"			=> "header",
	"title"			=> "Header",
	"description"	=> "Options for the header, logo, etc.",
	"tab"			=> "Header"
);
nuts_register_section ( $section );


$section = array (
	"name"			=> "colors",
	"title"			=> "Colors",
	"description"	=> "Set up the theme colors here",
	"tab"			=> "Colors"
);
nuts_register_section ( $section );


$section = array (
	"name"			=> "other",
	"title"			=> "Other options",
	"description"	=> "Some miscellaneous options",
	"tab"			=> "Other"
);
nuts_register_section ( $section );


// And some custom field sections for posts

$section = array (
	"name"			=> "post::post_options",
	"title"			=> "Post Options",
	"description"	=> "This is an example metabox section",
	"tab"			=> ""
);
nuts_register_section ( $section );



?>