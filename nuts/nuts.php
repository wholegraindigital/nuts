<?php 

// Load the data types that are used by the framework
require_once "data-types/type-image.php";



// First collect the action hooks here
add_action( 'admin_enqueue_scripts', 'nuts_admin_scripts' );
add_action( 'admin_menu', 'nuts_theme_options_menu' );
add_action( 'admin_init', 'nuts_admin_init' );


// The options array that stores all the options to be displayed in Theme Options
$nuts_options_array = array ();




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





// Make an option appear in the Theme Options page. $narr is a foreign array coming from a module that is to be added to the global $nuts_options_array
function nuts_register_option ( $narr ) {
        
	// Use the global $nuts_options_array that builds up the Theme Options panel
	global $nuts_options_array;
	
	$nuts_options_array[] = $narr;

	return $nuts_options_array;

}






// Initializes the Theme Options
function nuts_admin_init () {

    global $nuts_options_array;

	if( get_option( 'nuts_theme_options' ) == false )    
		add_option( 'nuts_theme_options' );  

	register_setting (
		'nuts_theme_options',
		'nuts_theme_options'
	);
		       
	add_settings_section(
		'nuts_first_section', 
		'NUTS First section name', 
		'nuts_section_info', 
		'nuts_theme_options'
	);  	


	// Add the option fields
	foreach ( $nuts_options_array as $setting ) {
	
		add_settings_field (
			$setting["name"],
			$setting["title"],
			'nuts_theme_options_callback',
			'nuts_theme_options',
			$setting["section"],
			array( 	'name' => $setting["name"],
					'type' => $setting["type"] ) 
		);  
	
	}	

}




// Section callback function
function nuts_section_info () {
	echo '<p>This is the first section</p>';
}


function nuts_theme_options_callback ( $args ) {

	$name = $args["name"];
	$type = $args["type"];

	if ( get_option ( 'nuts_theme_options' ) == "" ) $options = array ();
		else $options = get_option ( 'nuts_theme_options' );
	if ( !array_key_exists ( $name, $options ) ) $options[$name] = "";

	
	
// Image uploader	
	type_image_field ( $name, $options[$name] );

}







// Theme Option page generator function
function nuts_theme_options () {
	
	// Make the base structure of the Theme Options page
	echo '<div class="wrap">
            <?php screen_icon(); ?>
            <h2>My Settings</h2>           
            <form method="post" action="options.php">';
            
	settings_fields ( 'nuts_theme_options' );
	do_settings_sections ( 'nuts_theme_options' );
                   
    echo get_submit_button() . '</form>
        </div>';
	
}




// Add the submenu 'Theme Options' under Appearance
function nuts_theme_options_menu () {

	add_theme_page ( 'NUTS Theme Options', 'Theme Options', 'manage_options', 'nuts_theme_options', 'nuts_theme_options' );

}


function nuts_admin_scripts( ) {

	wp_enqueue_media();
	wp_enqueue_script( 'nuts-admin-scripts', get_template_directory_uri() . '/script/admin-scripts.js', array('jquery') );

}


?>