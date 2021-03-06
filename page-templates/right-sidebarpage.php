<?php
/**
 * Template Name: Right Sidebar Page
 *
 * @package andrewasquith
 */

get_header();
?>
	<div class="container pt-4" id="content">
		<div class="row">
			<div id="primary" class="col-md-8 content-area">
				<main id="main" class="site-main">
				<?php
				if ( have_posts() ) :

					if ( is_home() && ! is_front_page() ) :
						?>
						<header>
							<h1 class="page-title sr-only"><?php single_post_title(); ?></h1>
						</header>
						<?php
					endif;

					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						* Include the Post-Type-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Type name) and that will be used instead.
						*/
						get_template_part( 'template-parts/content', get_post_type() );

					endwhile;

					the_posts_navigation();

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>

				</main><!-- #main -->
			</div><!-- #primary -->
			<?php get_sidebar('page'); ?>
		</div> <!-- row -->
	</div> <!-- container -->
<?php get_footer(); 
