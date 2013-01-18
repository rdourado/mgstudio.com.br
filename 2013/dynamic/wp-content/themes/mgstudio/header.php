<?php 
global $t_url;
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="UTF-8">
	<title><?php wp_title(); ?></title>
	<link rel="shortcut icon" href="<?php echo $t_url; ?>/favicon.ico">
	<link rel="stylesheet" href="/min/g=mgcss" media="screen">
	<!--[if lte IE 7]><link rel="stylesheet" href="<?php echo $t_url; ?>/ie7.css" media="screen"><![endif]-->
	<!--[if lt IE 9]><script src="<?php echo $t_url; ?>/js/html5shiv.js"></script><![endif]-->
	<!-- WP/ --><?php wp_head(); ?><!-- /WP -->
</header>
<body <?php body_class( "page-{$post->post_name}" ); ?>>
	<!-- ClickTale Top part -->
	<script>var WRInitTime=(new Date()).getTime();</script>
	<!-- ClickTale end of Top part -->
	<header id="head">
		<?php my_logo(); ?>
		<?php 
		wp_nav_menu( array(
			'theme_location'  => 'primary',
			'container'       => 'nav', 
			'container_id'    => 'nav',
			'menu_id'         => 'menu',
			'fallback_cb'     => false,
			) 
		); ?>

		<div id="social">
			<iframe src="//www.facebook.com/plugins/like.php?locale=en_US&amp;href=http%3A%2F%2Fwww.facebook.com%2Fmgstudioweb&amp;send=false&amp;layout=button_count&amp;width=85&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;appId=462254627128823" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:85px; height:21px;" allowTransparency="true"></iframe>
			<a href="http://pinterest.com/mgstudio/" target="_blank"><img src="<?php echo $t_url; ?>/img/ico-pin.png" alt="Pinterest" width="16" height="16"></a>
			<a href="http://facebook.com/mgstudioweb/" target="_blank"><img src="<?php echo $t_url; ?>/img/ico-fb.png" alt="Facebook" width="16" height="16"></a>
		</div>
	</header>
	<hr>
