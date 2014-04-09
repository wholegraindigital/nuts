<?php

// Load the NUTS PHP engine
require_once "nuts/nuts.php";




// Run the SETUP process
function fullflow_setup () {

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Register the menu locations
	register_nav_menu( 'primary', __( 'Primary Menu', 'nuts' ) );
    register_nav_menu( 'footermenu', __( 'Footer Menu', 'nuts' ) );
    
}

add_action ( 'after_setup_theme', 'fullflow_setup' );

?>