<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Sophie Theme
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<p><?php _e( 'Hosted by: ', 'wpp' );?><a href="<?php echo esc_url( __( 'http://mediatemple.net/', 'sophie' ) ); ?>">
					<img src="<?php echo get_template_directory_uri();?>/images/mt-logo.png"></a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<?php _e( 'Powered by: ', 'sophie' );?><a href="<?php echo esc_url( __( 'http://wordpress.org/', 'sophie' ) ); ?>">
					<img src="<?php echo get_template_directory_uri();?>/images/wordpress-logo.png"></a></p>

		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
