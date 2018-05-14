<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package andrewasquith
 */

if ( ! function_exists( 'andrewasquith_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function andrewasquith_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		//if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		//	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		//}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted %s', 'post date', 'andrewasquith' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'andrewasquith_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function andrewasquith_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'andrewasquith' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'andrewasquith_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function andrewasquith_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'andrewasquith' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'andrewasquith' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'andrewasquith' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'andrewasquith' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link asdf">';
			comments_popup_link( 
				__( 'Post a Comment', 'andrewasquith' ), 
				__( '1 Comment', 'andrewasquith' ), 
				__( '% Comments', 'andrewasquith' ),
				$css_class,
				__( 'Comments are Closed', 'andrewasquith' )
			);
			echo '</span>';
		}

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
	}
endif;

if ( ! function_exists( 'andrewasquith_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function andrewasquith_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail text-center d-block">
				<?php the_post_thumbnail('post-thumbnail', array('class' => 'img-fluid')); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

		<a class="post-thumbnail text-center d-block" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php
			the_post_thumbnail( 'post-thumbnail', array(
				'class' => 'img-fluid',
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
			?>
		</a>

		<?php
		endif; // End is_singular().
	}
endif;



if ( ! function_exists ( 'andrewasquith_post_nav' ) ) :
	/**
	 * Function to print the navigation amongst pages in an entry
	 */
	function andrewasquith_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
				<nav class="container navigation post-navigation mt-3">
					<h2 class="sr-only"><?php _e( 'Post navigation', 'andrewasquith' ); ?></h2>
					<div class="row nav-links d-flex justify-content-between mt-3 mb-3 p-3">
						
						<?php  if ($previous) : ?>
						<div id="nav-previous">
							
							<div class="d-flex flex-column">
							<a href="<?php echo get_permalink( $previous->ID ); ?>">
							<h4 class="nav-previous-header"><i class="pr-2 fa fa-arrow-left align-self-center"></i>Previous Post</h4>
							<h6 class="nav-previous-title"><?php echo get_the_title( $previous->ID ); ?></span></h6></a>
							</div>
						</div> <!-- #nav-previous -->
						<?php endif; ?>
						

						<?php  if ($next) : ?>
						<div id="nav-next" class="ml-auto">
							
							<div class="d-flex flex-column text-right">
							<a href="<?php echo get_permalink( $next->ID ); ?>">
							<h4 class="nav-next-header">Next Post<i class="pl-2 fa fa-arrow-right align-self-center"></i></h4>
							<h6 class="nav-next-title"><?php echo get_the_title( $next->ID ); ?></h6></a>
							</div>
						</div> <!-- #nav-next -->
						<?php endif; ?>
					</div><!-- .nav-links -->
				</nav><!-- .navigation -->
		<?php
	}
endif;

if ( ! function_exists ( 'andrewasquith_page_nav' ) ) :

	/**
	 * Function to print the page navigation on post list pages
	 */
	function andrewasquith_page_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		// on author/archive etc these are the reverse of what you'd expect
		$previous = get_next_posts_link('<h4 class="nav-previous-header"><i class="pr-2 fa fa-arrow-left align-self-center"></i>Older</h4>');
		$next     = get_previous_posts_link('<h4 class="nav-next-header">Newer<i class="pl-2 fa fa-arrow-right align-self-center"></i></h4>');

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
				<nav class="container navigation post-navigation mt-3">
					<h2 class="sr-only"><?php _e( 'Post navigation', 'andrewasquith' ); ?></h2>
					<div class="row nav-links d-flex justify-content-between mt-3 mb-3 p-3">
						
						<?php  if ($previous) : ?>
						<div id="nav-previous">
							<?php echo $previous; ?>
						</div> <!-- #nav-previous -->
						<?php endif; ?>

						<?php  if ($next) : ?>
						<div id="nav-next" class="ml-auto">
							<?php echo $next; ?>
						</div> <!-- #nav-next -->
						<?php endif; ?>
					</div><!-- .nav-links -->
				</nav><!-- .navigation -->
		<?php
	}
endif;