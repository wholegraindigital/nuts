<?php 

// Safe loader for framework parts. Uses require_once if the file exists and is readable
function nuts_loader ( $filename ) {
	
	if ( file_exists ( $filename ) ) {
	
		require_once $filename;	
		return $filename;

	}
	
	else return $filename;
	
}



// Read all options that are present int the 'options' directory
function nuts_load_all_options ( $file_dir, $options_dir = "options" ) {

	$files = glob ( $file_dir . '/' . $options_dir . '/*.php' );
	foreach ( $files as $file ) {
		nuts_loader ( $file );
	}

}



$nuts_options_array = array ();

// Make an option appear in the Theme Options page
function nuts_register_option ( ) {

	global $nuts_options_array;

	return 1;

}



// Theme Option page generator function
function nuts_theme_options () {
	
	$output = '<div class="wrap">
            <?php screen_icon(); ?>
            <h2>My Settings</h2>           
            <form method="post" action="options.php">
            </form>
        </div>';
        
	echo $output;
	
}

// Add the submenu 'Theme Options' under Appearance
function nuts_theme_options_menu () {

	add_submenu_page ( 'themes.php', 'NUTS Theme Options', 'Theme Options', 'manage_options', 'nuts-theme-options', 'nuts_theme_options' );

}

// Only show the Theme Options menu if there's any option registered by NUTS modules
if ( !empty ( $nuts_options_array ) ) add_action( 'admin_menu', 'nuts_theme_options_menu' );




?>