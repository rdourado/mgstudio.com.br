<?php 
/*
Template name: Início
*/
global $t_url;
?>
<?php get_header(); ?>
	<div id="body">
		<h2 id="hello"><span>Olá, somos<br> uma agência<br> de design :)</span></h2>
		<hr>
		<section id="jobs">
			<h3 class="heading">Trabalhos Recentes</h3>
<?php 		$sticky = get_option( 'sticky_posts' );
			$args = array(
				'posts_per_page' => -1,
				'post__in'  => $sticky,
				'ignore_sticky_posts' => 1,
			);
			$query = new WP_Query( $args );
			if ( $sticky[0] ) : ?>
			<ul class="jobs-list slideshow" data-time="4500">
<?php 			while( $query->have_posts() ) : $query->the_post(); ?>
				<li class="job-item">
					<?php the_post_thumbnail( 'feature', array( 'class' => 'screen' ) ); ?>
					<h4 class="job-name"><?php the_title(); ?></h4>
<?php 				if ( $tags = get_the_tags() ) : ?>
					<p class="features">
						<em>Feito com:</em><br>
<?php 				foreach( $tags as $tag ) : ?>
						<img src="<?php echo $t_url; ?>/img/<?php echo $tag->slug; ?>.png" alt="<?php echo $tag->name; ?>" class="feature" width="80" height="80"><span> + </span>
<?php 				endforeach; ?>
						<img src="<?php echo $t_url; ?>/img/amor.png" alt="Amor" class="feature" width="80" height="80">
					</p>
<?php 				endif; ?>
<?php 				if ( $link = get_field( 'link' ) ) : ?>
					<p class="website">
						<img src="<?php echo $t_url; ?>/img/visite-o-site.png" alt="Visite o site" width="132" height="14"><br>
						<a href="<?php echo $link; ?>" target="_blank"><?php echo str_replace( 'http://', '', $link ); ?></a>
					</p>
<?php 				endif; ?>
				</li>
<?php 			endwhile; ?>
			</ul>
<?php 		endif;
			wp_reset_postdata(); ?>
		</section>
	</div>
<?php get_footer(); ?>