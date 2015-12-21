<!DOCTYPE html>
<html class="default" <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width" />
        <title><?php wp_title( '|', true, 'right' ); bloginfo('name'); ?></title>

        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.gif">
		
		<?php wp_head(); ?>


	</head>
    
    <body>
		<div id="wrapper" class="wrapper">
		
			<header>
				<div class="logo-wrapper">
					<?php nuts_logo(); ?>
				</div>
				<nav>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary_menu', 'container'       => false ) ); ?>
				</nav>
			</header>
