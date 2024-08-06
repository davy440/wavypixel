<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wavypixel
 */
?>
    <?php do_action('wavypixel_before_footer'); 
	get_template_part( 'template-parts/footer/before-footer-widget'); 
	get_template_part( 'template-parts/footer/footer-widgets'); ?>

<footer id="colophon" class="site-footer">
	<div class="site-info">
		<?php 
			if (get_theme_mod('wavypixel-copyright-text')) : 
				echo esc_html(get_theme_mod('wavypixel-copyright-text'));
			else :	
				_e('© ','wavypixel'); ?> <?php echo esc_html(get_bloginfo('name'));?> <?php echo esc_html(date('Y'));
			endif;	
		?>
		<span class="sep"> | </span>
			<?php
			/* translators: 1: Theme name, 2: Theme author. */
			printf( esc_html__( 'Designed by %1$s', 'wavypixel' ), '<a href="https://pixahive.com/themes/">PiXaHive.com</a>' );
			?>
	</div><!-- .site-info -->
	
</footer><!-- #colophon -->
</div><!-- #page -->

<div id="mobileMenu" class="mobile-navigation" role="navigation">
	
	<button class="go-to-bottom"></button>
	<div class="close-menu-wrapper">
		<button id="close-menu" class="menu-link"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/></svg></button>
	</div>
	<?php
		if ( has_nav_menu( 'menu-top' ) ) {
			get_template_part('inc/modules/nav', 'top');
		}

		if ( has_nav_menu( 'menu-1' ) ) {

			$args = array(
				'menu_class'		=>	'mobile-menu',
				'theme_location'    =>  'menu-1',
				'walker'			=>	has_nav_menu('menu-1') ? new wavypixel_Mobile_Menu : '',
			);

			wp_nav_menu( $args );
		}
	?>
	<button class="go-to-top"></button>
</div>

<?php wp_footer(); ?>

</body>
</html>
