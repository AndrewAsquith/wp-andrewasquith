<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package andrewasquith
 */

get_header();
?>
				<main id="main" class="site-main container pt-5 pb-5">

					<section class="error-404 not-found row d-flex">
						
						<div class="col-md-2 d-none d-md-block text-right align-self-center">
							<span class="p-2 bg-white border border-warning rounded error-code display-4"><?php _e( '404', 'andrewasquith' ) ?></span>
						</div>
						<div class="d-flex flex-column col-md-10">
						<header class="page-header ">
							<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'andrewasquith' ); ?></h1>
						</header><!-- .page-header -->
						<div class="page-content">
							<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'andrewasquith' ); ?></p>

							
						</div>
						</div>
						
					</section>
					
					<section class="search-form mt-3">
					<?php get_search_form(); ?>
					</section><!-- .error-404 -->
				</main><!-- #main -->
			
	</div> <!-- container -->
<?php get_footer(); 
