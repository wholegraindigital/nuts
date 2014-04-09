<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<article>
		<h1><?php the_title(); ?></h1>
		<?php the_content(); ?>
		<?php echo "The color is: " . nuts_get_value ("select1"); ?>
	</article>
	
<?php endwhile; else: ?>

	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	
<?php endif; ?>
			