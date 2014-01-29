<!DOCTYPE html>
<html class="default" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width" />
        <title><?php wp_title( '|', true, 'right' ); bloginfo('name'); ?></title>
        
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.gif">
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<!--        <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,400italic,700' rel='stylesheet' type='text/css'> -->
<?php wp_head(); ?>
</head>
    
    <div id="wrapper">
    
		<header>
			<?php nuts_logo(); ?>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'first_menu', 'container'       => 'nav' ) ); ?>
		</header>

        