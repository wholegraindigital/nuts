<?php

// Load the NUTS PHP engine
require_once "nuts/nuts.php";


// Register sidebars
$args = array(
	'name'          => 'Right sidebar',
	'id'            => 'right-sidebar',
	'description'   => 'Sidebar displayed in the right column',
	'class'         => 'right-sidebar',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => "</aside>\n",
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => "</h2>\n",
);register_sidebar( $args );


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