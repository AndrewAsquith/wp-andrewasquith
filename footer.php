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
	<footer id="colophon" class="bg-dark site-footer mt-4">
		<div class="text-center text-white pt-3">
			&copy;<a href="<?php echo esc_url( __( 'https://goaa.ca/me', 'andrewasquith' ) ); ?>" class="text-white">
			<?php esc_html_e('Andrew Asquith', 'andrewasquith');?></a>
			 | <a href="<?php echo esc_url(get_privacy_policy_url()); ?>" class="text-white">Privacy Policy</a>
		</div>	
	</footer><!-- #colophon -->
</div> <!-- page -->
<?php wp_footer(); ?>
</body>
</html>
