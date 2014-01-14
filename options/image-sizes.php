<?php 

// Set up the image sizes for the theme

function nuts_image_sizes () {

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop

	// Add extra image sizes
	add_image_size( 'homepage-thumb', 220, 180, true );
	
}

add_action( 'after_setup_theme', 'nuts_image_sizes' );


?>