<?php 

// Safe loader for framework parts. Uses require_once if the file exists and is readable
function nuts_loader ( $filename ) {
	
	if ( file_exists ( $filename ) ) {
	
		require_once $filename;	
		return $filename;

	}
	
	else return $filename;
	
}



function nuts_load_all_options ( $file_dir, $options_dir = "options" ) {

	$files = glob ( $file_dir . '/' . $options_dir . '/*.php' );
	foreach ( $files as $file ) {
		nuts_loader ( $file );
	}

}



?>