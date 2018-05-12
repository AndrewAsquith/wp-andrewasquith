<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package andrewasquith
 */

get_header();
?>
	<div class="container pt-5 pb-5" id="content">

		<div class="row">
			<div id="primary" class="col-md-8 content-area">
				<main id="main" class="site-main">

				<?php if ( have_posts() ) : ?>

					<header class="page-header">
						<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="archive-description">', '</div>' );
						?>
					</header><!-- .page-header -->

					<?php
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

					andrewasquith_page_nav();

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>

				</main><!-- #main -->
			</div><!-- #primary -->
			<?php get_sidebar(); ?>
		</div> <!-- row -->
	</div> <!-- container -->
<?php get_footer(); 
