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

// Make an option appear in the Theme Options page. $narr is a foreign array coming from a module that is to be added to the global $nuts_options_array
function nuts_register_option ( $narr ) {
	
	// Use the global $nuts_options_array that builds up the Theme Options panel
	global $nuts_options_array;
	
	// Put the options in the right option group --- if no value is set, use the General option group, which is displayed as the first one in Theme Options
	if ( !empty ( $narr["option_group"] ) ) $option_group = $narr["option_group"];
	else $option_group = "General";
	
	$nuts_options_array[$option_group][] = $narr;

	return 1;

}



// Theme Option page generator function
function nuts_theme_options () {
	
	// Use the global $nuts_options_array that builds up the Theme Options panel
	global $nuts_options_array;

	// Make the base structure of the Theme Options page
	$output = '<div class="wrap">
            <?php screen_icon(); ?>
            <h2>My Settings</h2>           
            <form method="post" action="options.php">';
            
    foreach ( $nuts_options_array as $key => $option_group ) {
		settings_fields ( $key );
		$output .= '<h3>' . $key . '</h3>';
		
		foreach ( $option_group as $option ) {
			$output .= '<h4>' . $option["title"] . '</h4>' . '<p>' . $option["description"] . '</p>';
			register_setting ( $key, $option["name"] );
			
			if ( $option["type"] == "image" ) {
				$output .= '<div class="uploader">
  <input type="text" name="mp_logo_image" id="mp_logo_image" />
  <input class="button" name="mp_logo_image_button" id="mp_logo_image_button" value="Upload" />
</div>';
			}
		}
    }
            
    $output .= '</form>
        </div>';
        
	echo $output;
	
}




// Add the submenu 'Theme Options' under Appearance
function nuts_theme_options_menu () {

	add_submenu_page ( 'themes.php', 'NUTS Theme Options', 'Theme Options', 'manage_options', 'nuts-theme-options', 'nuts_theme_options' );

}


function nuts_admin_scripts( ) {

	wp_enqueue_media();
	wp_enqueue_script( 'nuts-admin-scripts', get_template_directory_uri() . '/script/admin-scripts.js', array('jquery') );

}

add_action( 'admin_enqueue_scripts', 'nuts_admin_scripts' );

?>