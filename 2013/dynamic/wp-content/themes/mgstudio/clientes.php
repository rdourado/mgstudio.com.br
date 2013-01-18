<?php 
/*
Template name: Clientes
*/
?>
<?php get_header(); ?>
	<article id="body" class="entry">
<?php 	while( have_posts() ) : the_post(); ?>
		<h1 id="entry-title">Clientes</h1>
		<ul class="clients-list">
<?php 		foreach( get_field( 'clientes' ) as $c ) : 
			if ( $link = get_field( 'link', $c['id'] ) ) : ?>
			<li class="client-item"><a href="<?php echo $link; ?>"><img src="<?php echo $c['sizes']['cliente']; ?>" alt="<?php echo $c['alt']; ?>" class="thumbnail" width="173" height="125"></a></li>
<?php 		else : ?>
			<li class="client-item"><img src="<?php echo $c['sizes']['cliente']; ?>" alt="<?php echo $c['alt']; ?>" class="thumbnail" width="173" height="125"></li>
<?php 		endif;
			endforeach; ?>
		</ul>
		<h2 class="heading">Já passaram por aqui…</h2>
		<ul class="clients-list">
<?php 		foreach( get_field( 'ex_clientes' ) as $c ) : ?>
			<li class="client-item"><img src="<?php echo $c['sizes']['cliente']; ?>" alt="<?php echo $c['alt']; ?>" class="thumbnail" width="173" height="125"></li>
<?php 		endforeach; ?>
		</ul>
<?php 	endwhile; ?>
	</article>
<?php get_footer(); ?>