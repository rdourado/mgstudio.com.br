<?php 

$t_url = get_template_directory_uri();

/* Setup */

add_action( 'after_setup_theme', 'my_setup' );

function my_setup() {
	global $t_url;

	add_theme_support( 'post-thumbnails', array( 'post' ) );
	set_post_thumbnail_size( 300, 180, true );
	
	add_image_size( 'feature', 452, 283, true );
	add_image_size( 'cliente', 173, 125, true );
	add_image_size( 'portfolio', 600, 360, true );

	register_nav_menu( 'primary', 'Menu' );

	add_theme_support( 'custom-header', array(
		'default-image'          => "{$t_url}/img/banner-1.jpg",
		'random-default'         => true,
		'width'                  => 1600,
		'height'                 => 385,
		'flex-height'            => false,
		'flex-width'             => true,
		'default-text-color'     => 'fff',
		'header-text'            => true,
		'uploads'                => true,
		'wp-head-callback'       => wp_head_callback,
		'admin-head-callback'    => admin_head_callback,
		'admin-preview-callback' => '',
	) );
}

function wp_head_callback() {
?>
<style media="screen">
#hello{background-image:url(<?php echo get_header_image(); ?>)}
#hello span{color:#<?php echo get_header_textcolor(); ?>}
</style>
<?php
}

function admin_head_callback() {
?>
<link href='http://fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>
<style type="text/css">
	#headimg h1 { display: none }
	#desc {
		display: block;
		float: right;
		font-family: 'Montserrat', sans-serif;
		font-size: 54px;
		font-weight: 700;
		letter-spacing: -4px;
		line-height: 1em;
		margin: 0 auto;
		padding: 178px 20px 0;
		text-align: right;
		text-transform: uppercase;
		width: 400px;

		text-shadow: 1px 1px 2px rgba(0,0,0,.3);
	}
</style>
<?php
}

/* Actions */

add_action( 'wp_enqueue_scripts', 'my_scripts' );
add_action( 'login_enqueue_scripts', 'my_login_logo' );
add_action( 'admin_menu', 'change_post_menu_label' );

function my_scripts() {
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', 'http://code.jquery.com/jquery-1.8.3.min.js', array(), false, true );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'interface', "/min/g=mgjs", array( 'jquery' ), null, true );
}

function my_login_logo() { ?>
<style type="text/css">
body.login { background: #fff }
body.login div#login h1 a {
	background-image: url(<?php echo get_bloginfo( 'template_directory' ) ?>/img/mg-studio.png);
	background-size: auto;
	height: 87px;
	margin-left: auto;
	margin-right: auto;
	width: 217px;
}
</style>
<?php }

function change_post_menu_label() {
	global $menu;
	global $submenu;
	$menu[5][0] = 'Portfolio';
	$submenu['edit.php'][5][0] = 'Portfolio';
	$submenu['edit.php'][16][0] = 'Feito com';
	echo '';
}

/* Filters */

add_filter( 'the_excerpt', 'my_excerpt' );
add_filter( 'excerpt_length', 'my_excerpt_length' );
add_filter( 'login_headerurl', 'my_login_logo_url' );
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

function my_excerpt( $html ) { return str_replace( '<p>', '<p class="excerpt">', $html ); }
function my_excerpt_length( $length ) { return 10; }
function my_login_logo_url() { return get_bloginfo( 'url' ); }
function my_login_logo_url_title() { return 'Ir para o início'; }

/* Shortcode */

add_shortcode( 'email', 'email_antispam' );

function email_antispam( $atts ) {
	$email = antispambot( get_option( 'admin_email' ) );
	return '<a href="mailto:' . $email . '">' . $email . '</a>';
}

/* Functions */

function my_logo() {
	global $t_url, $post;
	if ( is_home() || is_page( array( 'home', 'inicio', 'pagina-inicial' ) ) )
		echo '<h1 id="logo"><img src="' . $t_url . '/img/mg-studio.png" alt="MG Studio" width="217" height="87"></h1>' . "\n";
	else
		echo '<div id="logo"><a href="' . home_url( '/' ) . '"><img src="' . $t_url . '/img/mg-studio.png" alt="MG Studio" width="217" height="87"></a></div>' . "\n";
}
