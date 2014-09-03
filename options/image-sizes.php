<?php 

// Set up the image sizes for the theme

// This theme uses a custom image size for featured images, displayed on "standard" posts.
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 700, 350, true, array( 'left', 'center' ) ); 

// Add extra image sizes
add_image_size( 'homepage-thumb', 220, 180, false );
	

?>