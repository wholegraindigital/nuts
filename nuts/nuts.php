<?php 

/*
NUTS WordPress Theme Framework
Version: 0.1
For more information and documentation, visit [http://www.wholegraindigital.com/nuts]
*/



// Make the scripts appear only in the code of the Theme Options page, thus reducing the possibilities of interferences
add_action ( 'admin_enqueue_scripts', 'nuts_admin_scripts' );

// Load data type components
add_action ( 'init', 'nuts_load_data_types' );
// Load ALL options
add_action ( 'init', 'nuts_load_all_options' );
// Load the shortcodes
add_action ( 'init', 'nuts_load_shortcodes' );

// First collect the action hooks here
add_action ( 'admin_menu', 'nuts_admin_init' );
// Load admin CSS, compile from LESS files

add_action ( 'wp_loaded', 'nuts_make_admin_css' );
// Load front end CSS, compile from LESS files
add_action ( 'wp_loaded', 'nuts_make_front_css' );
// Load front end CSS, compile from LESS files

add_action ( 'wp_enqueue_scripts', 'nuts_front_scripts' );
// Add metaboxes for post editor

add_action( 'add_meta_boxes', 'nuts_add_custom_box' );
// Save postmeta when saving a post

add_action( 'pre_post_update', 'nuts_save_postdata' );
// Add the possibility to use shortcodes in text widgets

add_filter( 'widget_text', 'do_shortcode' );

// Security: hide the META Generator tag to make it more difficult for hackers to find out your WP version.
remove_action( 'wp_head', 'wp_generator' );

// Security: remove ?ver=x.x from css and js
add_filter( 'style_loader_src', 'nuts_remove_cssjs_ver', 10, 2 );
add_filter( 'script_loader_src', 'nuts_remove_cssjs_ver', 10, 2 );


// The options array that stores all the options to be displayed in Theme Options
$nuts_options_array = array ();

// The sections array that stores the sections (tabs) in Theme Options
$nuts_sections = array ();

// Registered data types
$nuts_data_types = array ();

// Registered less files
$nuts_less_files = array ();



// Remove version numbers from JS and CSS files
function nuts_remove_cssjs_ver( $src ) {
	if( strpos( $src, '?ver=' ) )
	$src = remove_query_arg( 'ver', $src );
	return $src;
}


// This function compiles the admin.css from 1. /less/, 2. /data-types/*.less
function nuts_make_admin_css () {

	global $nuts_less_files;

	require_once "lib/lessphp/Less.php";
	
	$base_less = '';
	$addon_less = '';
	
	$files = glob ( dirname ( __FILE__ ) . '/style/admin/*.less' );
	foreach ( $files as $file ) {
		$base_less .= '@import "' . $file . '";
		';
	}
	
	foreach ( $nuts_less_files as $file ) {
		$addon_less .= '@import "' . $file . '";
		';
	}
	
	
	$parser = new Less_Parser ();
	$parser->parse ( $base_less );
	$parser->parse ( $addon_less );
	$css = $parser->getCss ();
	$nuts_css = fopen( dirname ( __FILE__ ) . '/style/admin/css/admin.css', "w");
	if ( !fwrite ( $nuts_css, $css ) ) nuts_error ( 'Could not write CSS file - check your file permissions!' );
	
}



// This function compiles the frontend style.css from 1. Variables enabled for LESS 2. /less/, 3. /less/media/
function nuts_make_front_css () {

	global $nuts_options_array;

	require_once "lib/lessphp/Less.php";
	
	$base_less = '';
	$theme_less = '';
	$less_variables = '';
	
	foreach ( $nuts_options_array as $option ) {
	
		if ( nuts_is_primary_section ( $option["section"] ) ) {
			if ( isset ( $option["less"] ) and ( $option["less"] == true ) )
				$less_variables .= '@' . $option["name"] . ': ' . nuts_get_value ( $option["name"] ) . ';';
		}
	
	}
	
	$files = glob ( dirname ( dirname ( __FILE__ ) ) . '/nuts/style/*.less' );
	foreach ( $files as $file ) {
		$base_less .= '@import "' . $file . '";
		';
		
	}
	
	$files = glob ( dirname ( dirname ( __FILE__ ) ) . '/style/*.less' );
	foreach ( $files as $file ) {
		$theme_less .= '@import "' . $file . '";
		';
	}
	
	$parser = new Less_Parser ();
	$parser->parse ( $less_variables );
	$parser->parse ( $base_less );
	$parser->parse ( $theme_less );
	$css = $parser->getCss ();
	$nuts_css = fopen( dirname ( dirname ( __FILE__ ) ) . '/style/css/style.css', "w");
	if ( !fwrite ( $nuts_css, $css ) ) nuts_error ( 'Could not write CSS file - check your file permissions!' );
	
}





// Displays an error message in an alert box
function nuts_error ( $msg ) {

	echo '<p class="nuts-error">' . $msg . '</p>';

}




// Safe loader for framework parts. Uses require_once if the file exists and is readable
function nuts_loader ( $filename ) {
	
	if ( file_exists ( $filename ) ) {
	
		require_once $filename;	
		return $filename;

	}
	
	else nuts_error ( "File not exists:" . $filename );
	
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



// Load the shortcodes that are present in "nuts/inc/shortcodes"
function nuts_load_shortcodes () {

	$files = glob ( dirname ( __FILE__ ) . '/inc/shortcodes/*.php' );
	foreach ( $files as $file ) {

		nuts_loader ( $file );
		
	}

}




// Read all options that are present in the 'options' directory
function nuts_load_all_options () {

	$files = glob ( dirname ( dirname ( __FILE__ ) ) . '/options/*.php' );
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



// Checks if an option is registered
function nuts_option_registered ( $name ) {

	global $nuts_options_array;

	if ( array_key_exists ( $name, $nuts_options_array ) ) return true;
	else return false;

}




// Collects the sections for the $post_type requested. If no post type is selected, it returns the Theme Options sections.
function nuts_get_sections ( $post_type = "theme_options" ) {

	global $nuts_sections;

	$output_sections = array();
	
	if ( $post_type == "theme_options" ) {
	
		foreach ( $nuts_sections as $section ) {
			if ( strstr ( $section["name"], "::" ) == false )  {
				$output_sections[] = $section;
			}
		}
	
	}
	
	else {
	
		foreach ( $nuts_sections as $section ) {
			if ( strstr ( $section["name"], "::", true ) == $post_type )  {
				$output_sections[] = $section;
			}
		}
	
	}
	
	return $output_sections;

}


// Gets the pure form reference name based on the option name
function nuts_form_ref ( $option_name ) {

    global $nuts_options_array;

	if ( strstr ( $nuts_options_array[$option_name]["section"], "::" ) != false ) {
		
		$value = explode ( "::", $nuts_options_array[$option_name]["section"] );
		
		return $value[1] . '_' . $option_name;
	
	}
	
	return 'nuts_theme_options[' . $option_name . ']';
    
}





// Gets the section name based on the option name
function nuts_get_section ( $option_name ) {

    global $nuts_options_array;

	if ( strstr ( $nuts_options_array[$option_name]["section"], "::" ) != false ) {
		
		$value = explode ( "::", $nuts_options_array[$option_name]["section"] );
		
		return $value[1];
	
	}
	
	return 'nuts_theme_options';
    
}




// Gets all options for $section and returns an array of them.
function nuts_options_by_section ( $section ) {

    global $nuts_options_array;

    $result = array();
    
    foreach ( $nuts_options_array as $option ) {
    
		if ( $option["section"] == $section ) $result[] = $option;
    
    }
    
    return $result;

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
	
		// Dynamically create sections if not registered yet.
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
	
		if ( strstr ( $setting["section"], "::" ) == false ) {
	
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




// Gets the value of a variable from wpdb
function nuts_get_value ( $name ) {

    global $nuts_options_array;
    
    if ( !isset ( $nuts_options_array[$name] ) ) return false;
    
    else {
		
		if ( isset ( $nuts_options_array[$name]["type"] ) ) {

			$type_func = "nuts_get_" . $nuts_options_array[$name]["type"];
			return $type_func ( $name );

		}

		else return '';		
		
    }

}




// Checks if this is primary (Theme Options) or secondary (Post Metabox) section
function nuts_is_primary_section ( $section ) {

	if ( strstr ( $section, "::" ) == false ) return true;
	
	else return false;

}




// This is the modified version of WP's do_settings_sections that allows us to use jQuery UI tabs in the Theme Options page.
function nuts_settings_sections ( $page ) {
	global $wp_settings_sections, $wp_settings_fields;

	if ( ! isset( $wp_settings_sections[$page] ) )
		return;

	foreach ( (array) $wp_settings_sections[$page] as $section ) {
	
		if ( nuts_is_primary_section ( $section["id"] ) == true ) {
	
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
}





// Theme Option page generator function
function nuts_theme_options () {

	global $nuts_sections;

	// Make the base structure of the Theme Options page
	echo '<div class="wrap">
            ' . screen_icon() . '
            <h2 id="nuts-options-main-title">My Settings</h2>           
            <form method="post" action="options.php">';
            
	// The number of sections to be created for Theme Options page
	$nuts_to_sections = nuts_get_sections ();
	

	// Launch the tabbed layout only if there are more than 1 sections defined            
	if ( count ( $nuts_to_sections ) > 1 ) {
		echo '<div id="nuts-settings-tabs">
				<ul class="nav-tab-wrapper">';
            
		foreach ( $nuts_to_sections as $section ) {
			echo '<li><a class="nav-tab';
			echo '" href="#' . $section["name"] . '">' . $section["tab"] . '</a></li>';
		}
			
		echo '</ul>
		';  
    }
    
	// Output the sections           
	nuts_settings_sections ( 'nuts_theme_options' );

	// There was an open div if we used the tabbed layout	
    if ( count ( $nuts_sections ) > 1 ) echo '</div>';
    
	settings_fields ( 'nuts_theme_options' );
    echo get_submit_button() . '</form>
        </div>';
	
}




// Adds the post metaboxes from the registered sections
function nuts_add_custom_box ( $post_type ) {

    $sections = nuts_get_sections ( $post_type );
    
    foreach ( $sections as $section ) {
    
		$dname = explode ( "::", $section["name"] );

        add_meta_box(
            $dname[1],
            $section["title"],
            'nuts_inner_custom_box',
            $post_type,
            'normal',
            'low',
            array ( "section" => $section["name"], "description" => $section["description"] )
        );
        
    }
}




// Display contents of custom metabox for post types
function nuts_inner_custom_box ( $post, $metabox ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field ( 'nuts_inner_custom_box', 'nuts_inner_custom_box_nonce' );

	if ( $metabox["args"]["description"] != '' ) echo $metabox["args"]["description"];
	
	
	// Selects all options from $nuts_options_array which are in the current section
	$options = nuts_options_by_section ( $metabox["args"]["section"] );
	
	foreach ( $options as $option ) {
	
		if ( $option["type"] == "" ) nuts_error ( 'No data type was set up for option: ' . $option["name"] );
		
		elseif ( !nuts_type_registered ( $option["type"] ) ) nuts_error ( 'Invalid data type (' . $option["type"] . ') for option: ' . $option["name"] );
		
		else {
			
			$meta_key = '_' . nuts_get_section ( $option["name"] );
			
			if ( get_post_meta ( $post->ID, $meta_key ) == "" ) $values = array();
				else $values = get_post_meta ( $post->ID, $meta_key );
				
			if ( !isset ( $values[0][$option["name"]] ) ) $values[0][$option["name"]] = "";
				
			echo '<div class="clearfix meta-option">';
				
			echo '<span class="meta-option-label">' . $option["title"] . '</span>';
			
			$type_func = "nuts_type_" . $option["type"] . "_field";
			
			$type_func ( $option["name"], $values[0][$option["name"]] );
			
			echo '</div><div class="clearfix"></div>';

		}
		
	}

	echo '<div class="clearfix"></div>';

}



// Saves post meta into the database
function nuts_save_postdata( $post_id ) {

	// Check if our nonce is set.
	if ( ! isset( $_POST['nuts_inner_custom_box_nonce'] ) )
	return $post_id;

	$nonce = $_POST['nuts_inner_custom_box_nonce'];

	// Verify that the nonce is valid.
	if ( !wp_verify_nonce ( $nonce, 'nuts_inner_custom_box' ) )	return $post_id;

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return $post_id;

	// Check the user's permissions.
	if ( 'page' == $_POST['post_type'] ) {

	if ( ! current_user_can( 'edit_page', $post_id ) )
		return $post_id;

	} else {

	if ( ! current_user_can( 'edit_post', $post_id ) )
		return $post_id;
	}

	/* OK, its safe for us to save the data now. */

	// Update the meta field in the database.

	$sections = nuts_get_sections ( get_post_type ( $post_id ) );
	
	foreach ( $sections as $section ) {

		$options = nuts_options_by_section ( $section["name"] );
		$data = array();
		
		foreach ( $options as $option ) {
	
			$sn = nuts_form_ref ( $option["name"] );
			$data[$option["name"]] = $_POST[$sn];
			
		}

		$sec = explode ( "::", $section["name"] );
		update_post_meta( $post_id, '_' . $sec[1], $data );
		unset ( $data );
		
	}

}


// Gets the option array from Theme Options or Post metabox and returns an array if any values found --- returns default value or empty string if no value found in database. 
// This function is used by data types, please use it if you are writing your own data type!
function nuts_get_option ( $name ) {

	global $nuts_options_array, $post;
	
	if( !is_object ( $post ) ) $id = 0; 
	else $id = get_the_ID();
	$meta_key = '_' . nuts_get_section ( $name );
	

	// If the option is connected to a post meta, let it be the return value
	if ( !nuts_is_primary_section ( $nuts_options_array[$name]["section"] ) ) {
	
		// If the metadata exists in the database, return it!
		if ( metadata_exists ( 'post', $id, $meta_key ) ) {
			$options = get_post_meta ( $id, $meta_key );
			$options = $options[0];
		}
		// If not, return the default value defined in your options file
		else if ( isset ( $nuts_options_array[$name]["default"] ) ) return $nuts_options_array[$name]["default"];
			// If no default value defined, simply return an empty string
			else return '';
	}
	
	// In the case it's not a post meta, return the value from the main options page
	else {
		if ( isset ( $nuts_options_array[$name]["default"] ) ) $default = $nuts_options_array[$name]["default"];
			else $default = '';
		$options = get_option ( 'nuts_theme_options', $default );
	}
		
	
	if ( is_array ($options) ) {
		if ( !array_key_exists ( $name, $options ) ) return $nuts_options_array[$name]["default"];
		else return $options[$name];
	}
	else return $nuts_options_array[$name]["default"];

}





// Load the scripts needed in the front-end
function nuts_front_scripts( ) {

	wp_enqueue_style( 'front-style', get_template_directory_uri() . '/style/css/style.css' );

}


// Load the scripts needed in Theme Options
function nuts_admin_scripts( ) {

	wp_enqueue_script( 'jquery-ui-tabs', '', array('jquery', 'jquery-ui-core') );
	wp_enqueue_script( 'nuts-admin-scripts', get_template_directory_uri() . '/nuts/script/admin-scripts.js', array('jquery', 'jquery-ui-tabs') );
	wp_enqueue_style( 'nuts-admin-style', get_template_directory_uri() . '/nuts/style/admin/css/admin.css' );

}


?>