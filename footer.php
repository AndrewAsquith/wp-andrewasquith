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
	<footer id="colophon" class="bg-dark site-footer pt-4 pb-2">
		<div class="text-center">
			<ul class="list-inline">
			<li class="list-inline-item h2"><a href="https://goaa.ca/twitter" class="text-white"><span class="fab fa-twitter"></span></a></li>
			<li class="list-inline-item h2"><a href="https://goaa.ca/linkedin" class="text-white"><span class="fab fa-linkedin"></span></a></li>
			<li class="list-inline-item h2"><a href="https://goaa.ca/github" class="text-white"><span class="fab fa-github"></span></a></li>
			</ul>
		</div>
		<div class="text-center">
			<p class="text-white">
			&copy;<a href="<?php echo esc_url( __( 'https://goaa.ca/me', 'andrewasquith' ) ); ?>" class="text-white">
			<?php esc_html_e('Andrew Asquith', 'andrewasquith');?></a>
			 | <a href="<?php echo esc_url(get_privacy_policy_url()); ?>" class="text-white"><?php esc_html_e('Privacy Policy', 'andrewasquith');?></a></p>
		</div>	
	</footer><!-- #colophon -->
</div> <!-- page -->
<?php wp_footer(); ?>
</body>
</html>
