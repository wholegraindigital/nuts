<?php get_header(); ?>

<div id="contentWrapper">
    <div id="content">
            
		<?php get_template_part ( 'loop' ); ?>
		<?php echo nuts_get_value ( 'color45' ); ?>

    </div><!-- content -->
</div><!-- contentWrapper -->
    
<?php get_sidebar(); ?>

<?php get_footer(); ?>