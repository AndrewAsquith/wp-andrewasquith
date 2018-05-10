<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package andrewasquith
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('mb-4'); ?>>
	<?php 
		if ((!is_singular()) || ( get_theme_mod( 'featured_image_as_header' ) == 0 )) {
			andrewasquith_post_thumbnail(); 
		}	
	?>
	<div id="post-container-<?php the_ID(); ?>" class="post-container col pb-4">
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title display-3 text-center">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title display-3 text-center"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta pb-3 pt-2">
				<?php
				andrewasquith_posted_on();
				andrewasquith_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->



	<div class="entry-content">
		<?php
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'andrewasquith' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'andrewasquith' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer d-flex">
		<?php andrewasquith_entry_footer(); ?>
	</footer><!-- .entry-footer -->
	</div><!-- .post-container -->
</article><!-- #post-<?php the_ID(); ?> -->
