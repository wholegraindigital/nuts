<?php

require_once "nuts/nuts.php";

// Safe load the options and features

// Load ALL options
nuts_load_all_options ( dirname ( __FILE__ ) );

// Only show the Theme Options menu if there's any option registered by NUTS modules
if ( count ( $nuts_options_array ) > 0 ) add_action( 'admin_menu', 'nuts_theme_options_menu' );

// Run the SETUP process
function fullflow_setup () {

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Register the menu locations
	register_nav_menu( 'primary', __( 'Primary Menu', 'nuts' ) );
    register_nav_menu( 'footermenu', __( 'Footer Menu', 'nuts' ) );
    
//    nuts_image_sizes ();
}

add_action ( 'after_setup_theme', 'fullflow_setup' );

?>
