<?php 



// First collect the action hooks here
add_action( 'admin_menu', 'nuts_admin_init' );
// Make the scripts appear only in the code of the Theme Options page, thus reducing the possibilities of interferences
add_action( 'admin_print_scripts-appearance_page_nuts_theme_options', 'nuts_admin_scripts' );
// Load data type components
add_action( 'init', 'nuts_load_data_types' );





// The options array that stores all the options to be displayed in Theme Options
$nuts_options_array = array ();

// The sections array that stores the sections (tabs) in Theme Options
$nuts_sections = array ();





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

	$files = glob ( dirname ( __FILE__ ) . '/data-types/*.php' );
	foreach ( $files as $file ) {
		nuts_loader ( $file );
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



// Similar to the nuts_register_option function, but it adds sections to the Theme Options
function nuts_register_section ( $narr ) {
        
	// Use the global $nuts_sections that builds up the Theme Options panel's sections
	global $nuts_sections;
	
	$narr_name = $narr["name"];
	
	$nuts_sections[$narr_name] = $narr;

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
			
		}
	
	
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
	
	echo '<p>' . $nuts_sections[$arg["id"]]["description"] . '</p>';
	
}



// Section callback function
function nuts_section_name ( $section_slug ) {

	global $nuts_sections;
	
	return $nuts_sections[$section_slug]["title"];
	
}




// This function puts an option input field on the Theme Options page
function nuts_theme_options_callback ( $args ) {

	$name = $args["name"];
	$type = $args["type"];

	if ( get_option ( 'nuts_theme_options' ) == "" ) $options = array ();
		else $options = get_option ( 'nuts_theme_options' );
	if ( !array_key_exists ( $name, $options ) ) $options[$name] = "";

	
	$type_func = "nuts_type_" . $type . "_field";

	$type_func ( $name, $options[$name] );

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




// Load the jQuery code needed in Theme Options
function nuts_admin_scripts( ) {

	wp_enqueue_style( 'jquery-ui-style', get_template_directory_uri() . '/nuts/admin.css' );
	wp_enqueue_script( 'jquery-ui-tabs', '', array('jquery', 'jquery-ui-core') );
	wp_enqueue_script( 'nuts-admin-scripts', get_template_directory_uri() . '/script/admin-scripts.js', array('jquery', 'jquery-ui-tabs') );

}


?>