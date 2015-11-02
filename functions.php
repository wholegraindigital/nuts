<?php

// Load the NUTS Framework engine
require_once "nuts/nuts.php";


// Set up the image sizes for the theme

// This theme uses a custom image size for featured images, displayed on "standard" posts.
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 700, 350, true, array( 'left', 'center' ) ); 

// Add extra image sizes
add_image_size( 'homepage-thumb', 220, 180, false );
	


// Register sidebars
$args = array(
	'name'          => 'Right sidebar',
	'id'            => 'right-sidebar',
	'description'   => 'Sidebar displayed in the right column',
	'class'         => 'right-sidebar',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>'
);
register_sidebar( $args );

$args = array(
	'name'          => 'Footer sidebar #1',
	'id'            => 'footer-sidebar-1',
	'class'         => 'footer-sidebar',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>'
);
register_sidebar( $args );

$args = array(
	'name'          => 'Footer sidebar #2',
	'id'            => 'footer-sidebar-2',
	'class'         => 'footer-sidebar',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>'
);
register_sidebar( $args );

$args = array(
	'name'          => 'Footer sidebar #3',
	'id'            => 'footer-sidebar-3',
	'class'         => 'footer-sidebar',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>'
);
register_sidebar( $args );

$args = array(
	'name'          => 'Footer sidebar #4',
	'id'            => 'footer-sidebar-4',
	'class'         => 'footer-sidebar',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>'
);
register_sidebar( $args );



// Replaces the excerpt "more" text by a link
function new_excerpt_more($more) {

	global $post;

	return ' <a class="readmore" href="'. get_permalink($post->ID) . '">'. nuts_get_value ( 'readmore' ) .'</a>';

}
add_filter('excerpt_more', 'new_excerpt_more');



// Run the SETUP process
function nuts_setup () {

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Register the menu locations
	register_nav_menu( 'primary', __( 'Primary Menu', 'nuts' ) );

}
add_action ( 'after_setup_theme', 'nuts_setup' );

?>