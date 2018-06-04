<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package andrewasquith
 */

get_header();
?>
<div class="container-fluid" id="content">
		<div id="primary" class="content-area">
			<main id="main" class="site-main">
				<?php
				if ( have_posts() ) : ?>
						<header>
							<h1 class="page-title sr-only"><?php single_post_title(); ?></h1>
						</header>

					<?php

					/* Start the Loop */
					while ( have_posts() ) :
						the_post();
					
						 the_content();
				
					endwhile;

				

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>
			</main><!-- #main -->
		</div><!-- #primary -->
	</div> <!-- container -->		
<?php get_footer(); 
