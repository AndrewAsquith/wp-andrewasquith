<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package andrewasquith
 */

?>
	<div class="container">
		<div class="row">
			<footer id="colophon" class="col-md-12 site-footer">
				<div class="site-info">
					<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'andrewasquith' ) ); ?>">
						<?php
						/* translators: %s: CMS name, i.e. WordPress. */
						printf( esc_html__( 'Proudly powered by %s', 'andrewasquith' ), 'WordPress' );
						?>
					</a>
					<span class="sep"> | </span>
						<?php
						/* translators: 1: Theme name, 2: Theme author. */
						printf( esc_html__( 'Theme: %1$s by %2$s.', 'andrewasquith' ), 'andrewasquith', '<a href="http://goaa.ca/me">Andrew Asquith</a>' );
						?>
				</div><!-- .site-info -->
			</footer><!-- #colophon -->
		</div> <!-- row -->
	</div> <!-- container -->
</div> <!-- page -->
<?php wp_footer(); ?>
</body>
</html>
