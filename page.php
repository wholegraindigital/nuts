<?php get_header(); ?>

<div id="contentWrapper">
    <div id="content">
        
		<?php get_template_part ( 'loop', 'page' ); ?>

    </div><!-- content -->
</div><!-- contentWrapper -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>