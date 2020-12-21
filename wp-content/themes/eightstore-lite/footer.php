<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package 8Store Lite
 */

?>

</div><!-- #content -->
<div class="clear"></div>
<footer id="colophon" class="site-footer" role="contentinfo">
	<?php
	//Top Footer Widget
	if(is_active_sidebar('footer-1')){
		$tfcolumns = get_theme_mod('footer_top_layout','3');
		?>
		<section id="section-footer" class="clear columns-<?php echo esc_attr($tfcolumns);?>">
			<div class="store-wrapper">
				<?php dynamic_sidebar('footer-1'); ?>
			</div>
		</section>
		<?php
	}
	//Footer Widget
	if(is_active_sidebar('footer-2')){
		?>
		<section id="section-footer2" class="clear">
			<div class="store-wrapper">
				<?php dynamic_sidebar('footer-2'); ?>
			</div>
		</section>
		<?php
	}

	$footer_layout = get_theme_mod('footer_layout','centered');
	?>
	<div class="store-footer <?php echo esc_attr($footer_layout);?>">
		<div class="store-wrapper">
			<div class="footer-copyrt">
				<div class="site-info">
					<span class="custom-copyright">
						<?php
						if(get_theme_mod('footer_copyright_text','')!=""){
							echo wp_kses_post(get_theme_mod('footer_copyright_text'));
						}?>
					</span>
					<?php
					esc_html_e( 'WordPress Theme : ', 'eightstore-lite' );  ?>
					<a target="__blank" title="<?php esc_attr_e('Free WordPress Theme','eightstore-lite');?>" href="<?php echo esc_url('https://8degreethemes.com/wordpress-themes/eightstore-lite/');?>">
						<?php esc_html_e( 'EightStore Lite','eightstore-lite' ); ?>
					</a>
					<?php esc_html_e('by','eightstore-lite');?>
					<a target="__blank" href="<?php echo esc_url('https://8degreethemes.com/');?>">
						<span><?php esc_html_e('8Degree Themes','eightstore-lite');?></span>
					</a>
				</div><!-- .site-info -->
				
				<!-- Social Icons -->
				<?php if(get_theme_mod('social_icons_in_footer') && get_theme_mod('social_icons_in_footer')!='0'){ ?>
					<div class="es-social-footer">
						<?php do_action('eightstore_lite_social_links'); ?>
					</div>
				<?php } ?>

				<!-- Payment Partner Logos -->
				<?php do_action('eightstore_lite_payment_partner_logos');?>
			</div>
		</div>
	</div>
</footer><!-- #colophon -->
</div><!-- #page -->
<div id="es-top"></div>
<?php wp_footer(); ?>

</body>
</html>
