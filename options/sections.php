<?php


// Set up the sections in Theme Options

$nuts_first_section = array (
	"name"			=> "nuts_first_section",
	"title"			=> "NUTS First Section",
	"description"	=> "This is the first section",
	"tab"			=> "First"
);
nuts_register_section ( $nuts_first_section );


$nuts_second_section = array (
	"name"			=> "nuts_second_section",
	"title"			=> "NUTS Second Section",
	"description"	=> "This is the second section",
	"tab"			=> "Second"
);
nuts_register_section ( $nuts_second_section );

$nuts_post_metabox = array (
	"name"			=> "post::first_metabox",
	"title"			=> "Metabox section",
	"description"	=> "This is an example metabox section",
	"tab"			=> ""
);
nuts_register_section ( $nuts_post_metabox );



?>