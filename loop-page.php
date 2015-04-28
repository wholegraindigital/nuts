<?php 
/* Loop for pages displaying static pages */

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<article>
		<?php if ( has_post_thumbnail() ) { ?><div class="featimage"><?php the_post_thumbnail(); ?></div><?php } ?>
		<h1><?php the_title(); ?></h1>
		<?php the_content(); ?>
	</article>
	
<?php endwhile; else: ?>

	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	
<?php endif; ?>
			