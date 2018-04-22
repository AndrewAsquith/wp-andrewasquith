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

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'andrewasquith' ); ?></a>
	
	<nav class="navbar navbar-expand-md navbar-light bg-light fixed-top">
	<div class="col-md-4 site-branding">
				
		<?php if (has_custom_logo()) :
			$image = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
			$logo_url = $image[0];
		?> 
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="navbar-brand">
			<img src="<?php echo esc_url($logo_url); ?>" class="custom-logo" alt="<?php bloginfo('name'); ?>" itemprop="logo"/>
		</a>
		<?php else :
			
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php 
			endif;
		endif; ?>
	</div><!-- .site-branding -->
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<?php wp_nav_menu(
		array(
			'theme_location'  => 'primary',
			'container_class' => 'col-md-8 collapse navbar-collapse',
			'container_id'    => 'navbarNavDropdown',
			'menu_class'      => 'navbar-nav  ml-auto',
			'fallback_cb'     => '',
			'menu_id'         => 'main-menu',
			'walker'          => new WP_Bootstrap_Navwalker(),
			)
		); ?>
	</nav> <!-- site nav -->
			
	<div id="page" class="site">
			
		<header id="masthead" class="site-header">
			<?php
			if (has_header_image()) : ?>
				<div class="container-fluid header-image-container" id="header-container" style="background-image:url('<?php echo esc_url(get_header_image()); ?>');  ">
			<?php else : ?>
				<div class="container-fluid header-no-image-container" id="header-container">
			<?php endif;?>				
				<div class="row" >
					<div class="col-md-6 col-offset-3 pt-5" id="site-description" >
					<?php	$andrewasquith_description = get_bloginfo( 'description', 'display' );
					if ( $andrewasquith_description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $andrewasquith_description; /* WPCS: xss ok. */ ?></p>
					<?php endif; ?>
					</div><!-- #site-description -->
				</div> <!-- .row -->	
			</div><!-- #header-container -->		
		</header><!-- #masthead -->
