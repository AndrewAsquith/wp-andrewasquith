<?php
/**
 * The template for displaying search forms in Underscores.me
 *
 * @package andrewasquith
 */

?>
<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search" class="form">
	<label class="" for="s"><?php esc_html_e( 'Search', 'andrewasquith' ); ?></label>
	<div class="input-group">
		<input class="form-control" id="s" name="s" type="text"
			placeholder="<?php esc_attr_e( 'Search &hellip;', 'andrewasquith' ); ?>" value="<?php the_search_query(); ?>">
		<span class="input-group-append">
			<input class="submit btn btn-primary" id="searchsubmit" name="submit" type="submit"
			value="<?php esc_attr_e( 'Search', 'andrewasquith' ); ?>">
	</span>
	</div>
</form>