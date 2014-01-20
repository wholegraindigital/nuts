<?php


function type_image_field ( $name, $value ) {

	echo '<div class="uploader">
			<input type="text" name="nuts_theme_options[' . $name . ']" id="' . $name . '" value="' . $value . '" />
			<input class="attrib" type="hidden" name="nuts_theme_options_attrib[' . $name . ']" id="attrib_' . $name . '" value="' . $name . '" />
			<input class="button" type="button" name="' . $name . '_button" id="' . $name . '_button" value="Upload" />
		</div>';
	

}


?>