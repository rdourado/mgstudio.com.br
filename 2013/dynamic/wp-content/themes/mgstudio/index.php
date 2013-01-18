<?php get_header(); ?>
	<article id="body" class="entry">
<?php 	while( have_posts() ) : the_post(); ?>
		<h1 id="entry-title"><?php the_title(); ?></h1>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
<?php 	endwhile; ?>
	</article>
<?php get_footer(); ?>