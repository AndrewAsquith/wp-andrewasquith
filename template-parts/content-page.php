<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package andrewasquith
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header mb-4">
		<?php the_title( '<h1 class="entry-title display-3 text-center">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php 
		if ( get_theme_mod( 'featured_image_as_header' ) == 0 ) {
			andrewasquith_post_thumbnail(); 
		}	
	?>

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
	<?php wp_link_pages(
			array(
				'before'      => '<div class="page-links text-center">' . __( 'Pages:', 'andrewasquith' ),
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			)
		);
		if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="sr-only">%s</span>', 'andrewasquith' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
