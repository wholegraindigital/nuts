<?php get_header(); ?>

<div id="contentWrapper">
    <div id="content" class="blog">
            
		<?php get_template_part ( 'loop', 'blog' ); ?>
		
		<aside class="pagination">
			<?php next_posts_link('Older Posts'); ?>
			<?php previous_posts_link('Newer Posts'); ?>
		</aside>

    </div><!-- content -->
</div><!-- contentWrapper -->
    
<?php get_sidebar(); ?>

<?php get_footer(); ?>