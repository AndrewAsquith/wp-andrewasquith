<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package andrewasquith
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('mb-4'); ?>>
	<div id="post-container-<?php the_ID(); ?>" class="post-container col pb-4">
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title display-3 text-center"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta pb-3 pt-2">
			<?php
			andrewasquith_posted_on();
			andrewasquith_posted_by();
			?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php andrewasquith_post_thumbnail(); ?>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer d-flex">
		<?php andrewasquith_entry_footer(); ?>
	</footer><!-- .entry-footer -->
	</div><!-- .post-container -->
</article><!-- #post-<?php the_ID(); ?> -->
