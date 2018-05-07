<?php
/**
 * Comment layout.
 *
 * @package andrewasquith
 */

// Comments form.
add_filter( 'comment_form_default_fields', 'andrewasquith_comment_form_fields' );

/**
 * Creates the comments form.
 *
 * @param string $fields Form fields.
 *
 * @return array
 */

if ( ! function_exists( 'andrewasquith_comment_form_fields' ) ) {

	function andrewasquith_comment_form_fields( $fields ) {
		$commenter = wp_get_current_commenter();
		$req       = get_option( 'require_name_email' );
		$aria_req  = ( $req ? "required aria-required='true'" : '' );
		$html5     = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;
		$fields    = array(
			'author' => '<div class="form-group comment-form-author"><label for="author">' . __( 'Name',
					'andrewasquith' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
			            '<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . '></div>',
			'email'  => '<div class="form-group comment-form-email"><label for="email">' . __( 'Email',
					'andrewasquith' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
			            '<input class="form-control" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . '></div>',
			'url'    => '<div class="form-group comment-form-url"><label for="url">' . __( 'Website',
					'andrewasquith' ) . '</label> ' .
			            '<input class="form-control" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30"></div>',
		);

		return $fields;
	}
} // endif function_exists( 'andrewasquith_comment_form_fields' )

add_filter( 'comment_form_defaults', 'andrewasquith_comment_form' );

/**
 * Builds the form.
 *
 * @param string $args Arguments for form fields.
 *
 * @return mixed
 */

if ( ! function_exists( 'andrewasquith_comment_form' ) ) {

	function andrewasquith_comment_form( $args ) {
		$args['comment_field'] = '<div class="form-group comment-form-comment">
	    <label for="comment">' . _x( 'Comment', 'noun', 'andrewasquith' ) . ' <span class="required">*</span></label>
	    <textarea class="form-control" id="comment" name="comment" required aria-required="true" cols="45" rows="8"></textarea>
	    </div>';
		$args['class_submit']  = 'btn btn-secondary'; 
		return $args;
	}
} // endif function_exists( 'andrewasquith_comment_form' )


if (! function_exists('andrewasquith_custom_comment') ) {
	function andrewasquith_custom_comment($comment, $args, $depth){
        
        ?>
        <article id="comment-<?php comment_ID();?>" class="comment-body pb-3">
                    
			<footer class="comment-meta">
					<div class="comment-author vcard d-flex flex-row">
						<?php echo get_avatar($comment) ?>    
						<div class="comment-metadata d-flex flex-column">
							<span class="author pb-2"><a href=""><?php echo get_comment_author_link($comment) ?></a></span>
							<span class="comment-date pb-2">On <?php comment_date('M j Y', $comment) ?></span>
                       		<span class="comment-reply pb-2"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>
                        	<span class="comment-edit"><?php edit_comment_link() ?></span>
						</div><!-- .comment-metadata -->
					</div><!-- .comment-author --> 
                    
			</footer><!-- .comment-meta -->   

            <div class="comment-content">
				<?php echo get_comment_text($comment); ?>
				<?php if ($comment->comment_approved == '0') : ?>
				<div class="alert alert-info" role="alert"><span class="awaiting-moderation">Your comment is awaiting moderation.</span></div>
				<?php endif; ?>  
			</div><!-- .comment-content -->
		</article><!-- .comment-body -->                        
 <?php } 
	}	
 ?>