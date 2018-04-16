<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package andrewasquith
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

	<div class="container">
		<header id="masthead" class="site-header">
		<div class="row">
			<div class="col-md-12 site-branding">
				<?php
				the_custom_logo();
				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				endif;
				$andrewasquith_description = get_bloginfo( 'description', 'display' );
				if ( $andrewasquith_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $andrewasquith_description; /* WPCS: xss ok. */ ?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->

		</div> <!-- row -->	
		</header><!-- #masthead -->
	</div> <!-- container -->




	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'andrewasquith' ); ?></a>
	<nav class="navbar navbar-expand-md">
		<div class="container">

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<?php wp_nav_menu(
				array(
					'theme_location'  => 'primary',
					'container_class' => 'collapse navbar-collapse',
					'container_id'    => 'navbarNavDropdown',
					'menu_class'      => 'navbar-nav',
					'fallback_cb'     => '',
					'menu_id'         => 'main-menu',
					'walker'          => new WP_Bootstrap_Navwalker(),
				)
			); ?>

		</div> <!-- container -->
	</nav> <!-- site nav -->
