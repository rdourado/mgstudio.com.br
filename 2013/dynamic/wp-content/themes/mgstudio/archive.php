<?php 
/*
Template name: Portfolio
*/
?>
<?php get_header(); ?>
	<article id="body" class="entry">
		<h1 id="entry-title">Portfolio</h1>
		<div class="filter-archive">
			<strong>Filtrar por</strong>
			<ul class="categories-list">
				<li class="category-item"><a href="<?php 
				$portfolio = get_page_by_path( 'portfolio' );
				echo get_permalink( $portfolio );
				?>" data-slug="">Todos</a></li>
<?php 
				foreach( get_categories() as $c )
					echo "\t\t\t\t" . '<li class="category-item"><a href="' . get_category_link( $c ) . '" data-slug="' . $c->slug . '"' . (is_category( $c->term_id ) ? ' class="current"' : '') . '>' . $c->name . '</a></li>' . "\n";
?>
			</ul>
		</div>
		<ul class="projects-list filter-list">
<?php 		query_posts( "{$query_string}&ignore_sticky_posts=1&orderby=menu_order&order=ASC" );
			while( have_posts() ) : the_post(); ?>
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
<?php 		endwhile; ?>
		</ul>
	</article>
<?php get_footer(); ?>