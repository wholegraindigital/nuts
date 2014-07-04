<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<article>
		<div class="featimage"><?php the_post_thumbnail(); ?></div>
		<h1><?php the_title(); ?></h1>
		<?php the_content(); ?>
		<aside class="postmeta"><?php 
			$author = get_the_author();
			$date = get_the_date( 'M j, Y' );
			printf ( __('Posted by %1$s on %2$s' ,'nuts'), $author, $date ); ?></aside>
	</article>
	
<?php endwhile; else: ?>

	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	
<?php endif; ?>
			