<?php 
/*
Template name: Portfolio
*/
?>
<?php get_header(); ?>
	<article id="body" class="entry">
		<h1 id="entry-title">Portfolio</h1>
		<div class="filter">
			<strong>Filtrar por</strong>
			<ul class="categories-list">
				<li class="category-item"><a href="<?php 
				$portfolio = get_page_by_path( 'portfolio' );
				echo get_permalink( $portfolio );
				?>" data-slug="" class="current">Todos</a></li>
<?php 
				foreach( get_categories() as $c )
					echo "\t\t\t\t" . '<li class="category-item"><a href="' . get_category_link( $c ) . '" data-slug="' . $c->slug . '">' . $c->name . '</a></li>' . "\n";
?>
			</ul>
		</div>
		<ul class="projects-list filter-list">
<?php 		$loop = new WP_Query( 'posts_per_page=-1&ignore_sticky_posts=1&orderby=menu_order&order=ASC' );
			while( $loop->have_posts() ) : $loop->the_post(); ?>
			<li class="project-item <?php 
			$categories = wp_get_post_categories( get_the_ID(), array( 'fields' => 'slugs' ) );
			echo implode( ' ', $categories );
			?>">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( 'post-thumbnail', array( 'class' => 'thumbnail' ) ); ?>

					<h2 class="title"><?php the_title(); ?></h2>
					<?php the_excerpt(); ?>
				</a>
			</li>
<?php 		endwhile;
			wp_reset_postdata(); ?>
		</ul>
	</article>
<?php get_footer(); ?>