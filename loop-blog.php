<?php
/* Loop for pages displaying multiple posts */

$count = 1;
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<article>
		<?php if ( has_post_thumbnail() ) { ?><div class="featimage"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a></div><?php } ?>
		<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		<?php the_excerpt(); ?>
		<?php if ( nuts_get_value ( 'source' ) ) echo '<p>'. nuts_get_value ( 'source_label' ) .' <a href="'.nuts_get_value ( 'source' ).'">'.nuts_get_value ( 'source' ).'</a></p>' ?>
		<aside class="postmeta"><?php 
			$author = get_the_author();
			$date = get_the_date( 'M j, Y' );
			printf ( __( 'Posted by %1$s on %2$s', 'nuts' ), $author, $date ); ?></aside>
	</article>
	
	<?php $count++;
		if ( $count <= $wp_query->post_count ) echo '<hr>';
	?>
	
<?php endwhile; else: ?>

	<p><?php _e( 'Sorry, no posts matched your criteria.', 'nuts' ); ?></p>
	
<?php endif; ?>
			