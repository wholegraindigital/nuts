<?php 
/* Loop for pages displaying single post */

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<article>
		<?php if ( has_post_thumbnail() ) { ?><div class="featimage"><?php the_post_thumbnail(); ?></div><?php } ?>
		<h1><?php the_title(); ?></h1>
		<?php the_content(); ?>
		<?php if ( nuts_get_value ( 'source' ) ) echo '<p>'. nuts_get_value ( 'source_label' ) .' <a href="'.nuts_get_value ( 'source' ).'">'.nuts_get_value ( 'source' ).'</a></p>' ?>
		<aside class="postmeta"><?php 
			$author = get_the_author();
			$date = get_the_date( 'M j, Y' );
			printf ( __('Posted by %1$s on %2$s' ,'nuts'), $author, $date ); ?></aside>
	</article>
	
<?php endwhile; else: ?>

	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	
<?php endif; ?>
			