<?php 




// First collect the action hooks here
add_action( 'admin_menu', 'nuts_admin_init' );
// Make the scripts appear only in the code of the Theme Options page, thus reducing the possibilities of interferences
add_action( 'admin_print_scripts-appearance_page_nuts_theme_options', 'nuts_admin_scripts' );
// Load data type components
add_action( 'init', 'nuts_load_data_types' );
// Load admin CSS, compile from LESS files
add_action( 'wp_loaded', 'nuts_make_admin_css' );
// Load front end CSS, compile from LESS files
add_action( 'wp_loaded', 'nuts_make_front_css' );
// Load front end CSS, compile from LESS files
add_action( 'wp_enqueue_scripts', 'nuts_front_scripts' );





// The options array that stores all the options to be displayed in Theme Options
$nuts_options_array = array ();

// The sections array that stores the sections (tabs) in Theme Options
$nuts_sections = array ();

// Registered data types
$nuts_data_types = array ();

// Registered less files
$nuts_less_files = array ();




// This function compiles the admin.css from 1. /less/, 2. /data-types/*.less, 3. /less/media/
function nuts_make_admin_css () {

	global $nuts_less_files;

	require_once "lib/lessphp/Less.php";
	
	$base_less = '';
	$addon_less = '';
	$media_less = '';

	$files = glob ( dirname ( __FILE__ ) . '/less/*.less' );
	foreach ( $files as $file ) {
		$base_less .= '@import "' . $file . '";
		';
	}
	
	foreach ( $nuts_less_files as $file ) {
		$addon_less .= '@import "' . $file . '";
		';
	}
	
	$files = glob ( dirname ( __FILE__ ) . '/less/media/*.less' );
	foreach ( $files as $file ) {
		$media_less .= '@import "' . $file . '";
		';
	}
	
	$parser = new Less_Parser ();
	$parser->parse ( $base_less );
	$parser->parse ( $addon_less );
	$parser->parse ( $media_less );
	$css = $parser->getCss ();
	$nuts_css = fopen( dirname ( __FILE__ ) . '/css/admin.css', "w");
	if ( !fwrite ( $nuts_css, $css ) ) nuts_error ( 'Could not write CSS file - check your file permissions!' );
	
}



// This function compiles the frontend style.css from 1. /less/, 2. /less/media/
function nuts_make_front_css () {

	require_once "lib/lessphp/Less.php";
	
	$base_less = '';
	$media_less = '';

	$files = glob ( dirname ( dirname ( __FILE__ ) ) . '/less/*.less' );
	foreach ( $files as $file ) {
		$base_less .= '@import "' . $file . '";
		';
		
	}
	
	$files = glob ( dirname ( dirname ( __FILE__ ) ) . '/less/media/*.less' );
	foreach ( $files as $file ) {
		$media_less .= '@import "' . $file . '";
		';
	}
	
	$parser = new Less_Parser ();
	$parser->parse ( $base_less );
	$parser->parse ( $media_less );
	$css = $parser->getCss ();
	$nuts_css = fopen( dirname ( dirname ( __FILE__ ) ) . '/css/style.css', "w");
	if ( !fwrite ( $nuts_css, $css ) ) nuts_error ( 'Could not write CSS file - check your file permissions!' );
	
}





// Displays an error message in an alert box
function nuts_error ( $msg ) {

	echo '<p class="error">' . $msg . '</p>';

}




// Safe loader for framework parts. Uses require_once if the file exists and is readable
function nuts_loader ( $filename ) {
	
	if ( file_exists ( $filename ) ) {
	
		require_once $filename;	
		return $filename;

	}
	
	else return "File not exists:" . $filename;
	
}



// Read all data types that are present in the 'nuts/data-types' directory
function nuts_load_data_types () {

	global $nuts_data_types, $nuts_less_files;

	$files = glob ( dirname ( __FILE__ ) . '/data-types/*.php' );
	foreach ( $files as $file ) {

		nuts_loader ( $file );
		$file = basename ( $file, ".php" );
		$curtype = explode ( '-', $file );
		$nuts_data_types[] = $curtype[1];
		
		if ( file_exists ( dirname ( __FILE__ ) . '/data-types/' . $file . '.less' ) ) $nuts_less_files[$file] = dirname ( __FILE__ ) . '/data-types/' . $file . '.less';
		
	}
	
}




// Read all options that are present in the 'options' directory
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
	
	$narr_name = $narr["name"];
	
	$nuts_options_array[$narr_name] = $narr;

}



// Adds extra info for the tabs in the Theme Options
function nuts_register_section ( $narr ) {
        
	// Use the global $nuts_sections that builds up the Theme Options panel's sections
	global $nuts_sections;
	
	$narr_name = $narr["name"];
	
	$nuts_sections[$narr_name] = $narr;

}






// Checks if a data type is present in the Framework
function nuts_type_registered ( $type ) {

	global $nuts_data_types;

	if ( in_array ( $type, $nuts_data_types ) ) return true;
	else return false;

}




// Checks if a section is registered
function nuts_section_registered ( $section ) {

	global $nuts_sections;

	if ( array_key_exists ( $section, $nuts_sections ) ) return true;
	else return false;

}





// Initializes the Theme Options
function nuts_admin_init () {

    global $nuts_options_array;
    
    add_theme_page ( 'NUTS Theme Options', 'Theme Options', 'manage_options', 'nuts_theme_options', 'nuts_theme_options' );
    
	if( get_option( 'nuts_theme_options' ) == false )    
		add_option( 'nuts_theme_options' );  

	register_setting (
		'nuts_theme_options',
		'nuts_theme_options'
	);
	
	$loaded_sections = array();

	// Add the option fields
	foreach ( $nuts_options_array as $setting ) {
	
		if ( !in_array ( $setting["section"], $loaded_sections ) ) {
		
			add_settings_section(
				$setting["section"], 
				nuts_section_name ( $setting["section"] ), 
				'nuts_section_info', 
				'nuts_theme_options'
			);  
			
			$loaded_sections[] = $setting["section"];

			if ( !nuts_section_registered ( $setting["section"] ) ) {
			
				nuts_register_section ( array(
						"name"			=> $setting["section"],
						"title"			=> $setting["section"],
						"description"	=> "",
						"tab"			=> $setting["section"]
					) );
				
			}
			
		}
	
		if ( !isset ( $setting["type"] ) ) $setting["type"] = "";
	
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
function nuts_section_info ( $arg ) {

	global $nuts_sections;
	
	if ( !nuts_section_registered ( $arg["id"] ) ) return;

	echo '<p>' . $nuts_sections[$arg["id"]]["description"] . '</p>';
	
}



// Section callback function
function nuts_section_name ( $section_slug ) {

	global $nuts_sections;
	
	if ( !nuts_section_registered ( $section_slug ) ) return $section_slug;

	return $nuts_sections[$section_slug]["title"];
	
}




// This function puts an option input field on the Theme Options page
function nuts_theme_options_callback ( $args ) {

	$name = $args["name"];
	$type = $args["type"];

	if ( get_option ( 'nuts_theme_options' ) == "" ) $options = array ();
		else $options = get_option ( 'nuts_theme_options' );
	if ( !array_key_exists ( $name, $options ) ) $options[$name] = "";

	
	if ( $type == "" ) nuts_error ( 'No data type was set up for option: ' . $name );
	
	elseif ( !nuts_type_registered ( $type ) ) nuts_error ( 'Invalid data type (' . $type . ') for option: ' . $name );
	
	else {
	
		$type_func = "nuts_type_" . $type . "_field";

		$type_func ( $name, $options[$name] );

	}
	
}




// This is the modified version of WP's do_settings_sections that allows us to use jQuery UI tabs in the Theme Options page.
function nuts_settings_sections( $page ) {
	global $wp_settings_sections, $wp_settings_fields, $nuts_sections;

	if ( ! isset( $wp_settings_sections[$page] ) )
		return;

	foreach ( (array) $wp_settings_sections[$page] as $section ) {
	
		echo '<div id="' . $section["id"] . '">';
	
		if ( $section['title'] )
			echo "<h3>{$section['title']}</h3>\n";

		if ( $section['callback'] )
			call_user_func( $section['callback'], $section );

		if ( ! isset( $wp_settings_fields ) || !isset( $wp_settings_fields[$page] ) || !isset( $wp_settings_fields[$page][$section['id']] ) )
			continue;
		echo '<table class="form-table">';
		do_settings_fields( $page, $section['id'] );
		echo '</table>
		</div>';
	}
}




// Theme Option page generator function
function nuts_theme_options () {

	global $nuts_sections;

	// Make the base structure of the Theme Options page
	echo '<div class="wrap">
            ' . screen_icon() . '
            <h2 id="nuts-options-main-title">My Settings</h2>           
            <form method="post" action="options.php">';

// Launch the tabbed layout only if there are more than 1 sections defined            
	if ( count ( $nuts_sections ) > 1 ) {
		echo '<div id="nuts-settings-tabs">
				<ul class="nav-tab-wrapper">';
            
		$i = 1;
		foreach ( $nuts_sections as $section ) {
			echo '<li><a class="nav-tab';
			echo '" href="#' . $section["name"] . '">' . $section["tab"] . '</a></li>';
			$i++;
		}
			
		echo '</ul>
		';  
    }
    
           
	nuts_settings_sections ( 'nuts_theme_options' );
    
    if ( count ( $nuts_sections ) > 1 ) echo '</div>';
    
	settings_fields ( 'nuts_theme_options' );
    echo get_submit_button() . '</form>
        </div>';
	
}





// Load the scripts needed in the front-end
function nuts_front_scripts( ) {

	wp_enqueue_style( 'front-style', get_template_directory_uri() . '/css/style.css' );

}


// Load the scripts needed in Theme Options
function nuts_admin_scripts( ) {

	wp_enqueue_style( 'jquery-ui-style', get_template_directory_uri() . '/nuts/css/admin.css' );
	wp_enqueue_script( 'jquery-ui-tabs', '', array('jquery', 'jquery-ui-core') );
	wp_enqueue_script( 'nuts-admin-scripts', get_template_directory_uri() . '/nuts/script/admin-scripts.js', array('jquery', 'jquery-ui-tabs') );

}


?>