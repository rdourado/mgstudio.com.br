<?php global $t_url; ?>
<?php get_header(); ?>
	<article id="body" class="entry">
<?php 	while( have_posts() ) : the_post(); ?>
		<h1 id="entry-title">Portfolio</h1>
		<div class="entry-content">
			<h2 class="nocase"><?php the_title(); ?></h2>
			<?php the_content(); ?>
			<ul class="screens-list slideshow" data-time="5000">
<?php 		if ( $gallery = get_field( 'gallery' ) )
				foreach( $gallery as $img ) : ?>
				<li class="screen-item"><img src="<?php echo $img['sizes']['portfolio']; ?>" alt="<?php echo $img['sizes']; ?>" class="thumbnail" width="600" height="360"></li>
<?php 			endforeach; ?>
			</ul>
			<div class="info">
<?php 			if ( $tags = get_the_tags() ) : ?>
				<p class="features">
					<em>Feito com:</em><br>
<?php 				foreach( $tags as $tag ) : ?>
					<img src="<?php echo $t_url; ?>/img/<?php echo $tag->slug; ?>.png" alt="<?php echo $tag->name; ?>" class="feature" width="80" height="80"><span> + </span>
<?php 				endforeach; ?>
					<img src="<?php echo $t_url; ?>/img/amor.png" alt="Amor" class="feature" width="80" height="80">
				</p>
<?php 			endif; ?>
<?php 			if ( $link = get_field( 'link' ) ) : ?>
				<p class="website">
					<img src="<?php echo $t_url; ?>/img/visite-o-site.png" alt="Visite o site" width="132" height="14"><br>
					<a href="<?php echo $link; ?>" target="_blank"><?php echo str_replace( 'http://', '', $link ); ?></a>
				</p>
<?php 			endif; ?>
			</div>
			<a href="<?php echo get_permalink( get_page_by_path( 'portfolio' ) ); ?>" class="back">« Voltar</a>
		</div>
<?php 	endwhile; ?>
	</article>
<?php get_footer(); ?>