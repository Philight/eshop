<?php
if (isset($_POST['hide_uwcf_review_box_hidden'])) {update_option('EWD_UWCF_Hide_Dash_Review_Ask', sanitize_text_field($_POST['hide_uwcf_review_box_hidden']));}
$hideReview = get_option('EWD_UWCF_Hide_Dash_Review_Ask');
$Ask_Review_Date = get_option('EWD_UWCF_Ask_Review_Date');
if ($Ask_Review_Date == "") {$Ask_Review_Date = get_option("EWD_UWCF_Install_Time") + 3600*24*4;}
?>

<!-- START NEW DASHBOARD -->

<div id="ewd-uwcf-dashboard-content-area">

	<div id="ewd-uwcf-dashboard-content-left">

		<?php if ($EWD_UWCF_Full_Version != "Yes" or get_option("EWD_UWCF_Trial_Happening") == "Yes") {
			$premium_info = '<div class="ewd-uwcf-dashboard-new-widget-box ewd-widget-box-full">';
			$premium_info .= '<div class="ewd-uwcf-dashboard-new-widget-box-top">';
			$premium_info .= sprintf( __( '<a href="%s" target="_blank">Visit our website</a> to learn how to upgrade to premium.'), 'https://www.etoilewebdesign.com/premium-upgrade-instructions/' );
			$premium_info .= '</div>';
			$premium_info .= '</div>';

			echo apply_filters( 'ewd_dashboard_top', $premium_info, 'UWCF', 'https://www.etoilewebdesign.com/plugins/woocommerce-filters/#buy' );
		 } ?>

		<div class="ewd-uwcf-dashboard-new-widget-box ewd-widget-box-full" id="ewd-uwcf-dashboard-support-widget-box">
			<div class="ewd-uwcf-dashboard-new-widget-box-top">Get Support<span id="ewd-uwcf-dash-mobile-support-down-caret">&nbsp;&nbsp;&#9660;</span><span id="ewd-uwcf-dash-mobile-support-up-caret">&nbsp;&nbsp;&#9650;</span></div>
			<div class="ewd-uwcf-dashboard-new-widget-box-bottom">
				<ul class="ewd-uwcf-dashboard-support-widgets">
					<li>
						<a href="https://www.youtube.com/channel/UCZPuaoetCJB1vZOmpnMxJNw/featured" target="_blank">
							<img src="<?php echo plugins_url( '../images/ewd-support-icon-youtube.png', __FILE__ ); ?>">
							<div class="ewd-uwcf-dashboard-support-widgets-text">YouTube Tutorials</div>
						</a>
					</li>
					<li>
						<a href="https://wordpress.org/plugins/color-filters/#faq" target="_blank">
							<img src="<?php echo plugins_url( '../images/ewd-support-icon-faqs.png', __FILE__ ); ?>">
							<div class="ewd-uwcf-dashboard-support-widgets-text">Plugin FAQs</div>
						</a>
					</li>
					<li>
						<a href="https://www.etoilewebdesign.com/support-center/?Plugin=UWCF&Type=FAQs" target="_blank">
							<img src="<?php echo plugins_url( '../images/ewd-support-icon-documentation.png', __FILE__ ); ?>">
							<div class="ewd-uwcf-dashboard-support-widgets-text">Documentation</div>
						</a>
					</li>
					<li>
						<a href="https://www.etoilewebdesign.com/support-center/" target="_blank">
							<img src="<?php echo plugins_url( '../images/ewd-support-icon-forum.png', __FILE__ ); ?>">
							<div class="ewd-uwcf-dashboard-support-widgets-text">Get Support</div>
						</a>
					</li>
				</ul>
			</div>
		</div>

		<!--
		<div class="ewd-uwcf-dashboard-new-widget-box ewd-widget-box-full" id="ewd-uwcf-dashboard-optional-table">
			<div class="ewd-uwcf-dashboard-new-widget-box-top">FAQ Summary<span id="ewd-uwcf-dash-optional-table-down-caret">&nbsp;&nbsp;&#9660;</span><span id="ewd-uwcf-dash-optional-table-up-caret">&nbsp;&nbsp;&#9650;</span></div>
			<div class="ewd-uwcf-dashboard-new-widget-box-bottom">
			</div>
		</div>
		-->

		<div class="ewd-uwcf-dashboard-new-widget-box <?php echo ( ($hideReview != 'Yes' and $Ask_Review_Date < time()) ? 'ewd-widget-box-two-thirds' : 'ewd-widget-box-full' ); ?>">
			<div class="ewd-uwcf-dashboard-new-widget-box-top">What People Are Saying</div>
			<div class="ewd-uwcf-dashboard-new-widget-box-bottom">
				<ul class="ewd-uwcf-dashboard-testimonials">
					<?php $randomTestimonial = rand(0,2);
					if($randomTestimonial == 0){ ?>
						<li id="ewd-uwcf-dashboard-testimonial-one">
							<img src="<?php echo plugins_url( '../images/dash-asset-stars.png', __FILE__ ); ?>">
							<div class="ewd-uwcf-dashboard-testimonial-title">"Straight forward! Love it!"</div>
							<div class="ewd-uwcf-dashboard-testimonial-author">- @elisandroborges</div>
							<div class="ewd-uwcf-dashboard-testimonial-text">Nice, quick, easy! Solved my issue! Thank you very much! <a href="https://wordpress.org/support/topic/straight-forward-love-it/" target="_blank">read more</a></div>
						</li>
					<?php }
					if($randomTestimonial == 1){ ?>
						<li id="ewd-uwcf-dashboard-testimonial-one">
							<img src="<?php echo plugins_url( '../images/dash-asset-stars.png', __FILE__ ); ?>">
							<div class="ewd-uwcf-dashboard-testimonial-title">"Straight forward! Love it!"</div>
							<div class="ewd-uwcf-dashboard-testimonial-author">- @elisandroborges</div>
							<div class="ewd-uwcf-dashboard-testimonial-text">Nice, quick, easy! Solved my issue! Thank you very much! <a href="https://wordpress.org/support/topic/straight-forward-love-it/" target="_blank">read more</a></div>
						</li>
					<?php }
					if($randomTestimonial == 2){ ?>
						<li id="ewd-uwcf-dashboard-testimonial-one">
							<img src="<?php echo plugins_url( '../images/dash-asset-stars.png', __FILE__ ); ?>">
							<div class="ewd-uwcf-dashboard-testimonial-title">"Straight forward! Love it!"</div>
							<div class="ewd-uwcf-dashboard-testimonial-author">- @elisandroborges</div>
							<div class="ewd-uwcf-dashboard-testimonial-text">Nice, quick, easy! Solved my issue! Thank you very much! <a href="https://wordpress.org/support/topic/straight-forward-love-it/" target="_blank">read more</a></div>
						</li>
					<?php } ?>
				</ul>
			</div>
		</div>

		<?php if($hideReview != 'Yes' and $Ask_Review_Date < time()){ ?>
			<div class="ewd-uwcf-dashboard-new-widget-box ewd-widget-box-one-third">
				<div class="ewd-uwcf-dashboard-new-widget-box-top">Leave a review</div>
				<div class="ewd-uwcf-dashboard-new-widget-box-bottom">
					<div class="ewd-uwcf-dashboard-review-ask">
						<img src="<?php echo plugins_url( '../images/dash-asset-stars.png', __FILE__ ); ?>">
						<div class="ewd-uwcf-dashboard-review-ask-text">If you enjoy this plugin and have a minute, please consider leaving a 5-star review. Thank you!</div>
						<a href="https://wordpress.org/plugins/color-filters/#reviews" class="ewd-uwcf-dashboard-review-ask-button">LEAVE A REVIEW</a>
						<form action="admin.php?page=ewd-uwcf-Options" method="post">
							<input type="hidden" name="hide_uwcf_review_box_hidden" value="Yes">
							<input type="submit" name="hide_uwcf_review_box_submit" class="ewd-uwcf-dashboard-review-ask-dismiss" value="I've already left a review">
						</form>
					</div>
				</div>
			</div>
		<?php } ?>

		<?php if ($EWD_UWCF_Full_Version != "Yes" or get_option("EWD_UWCF_Trial_Happening") == "Yes") { ?>
			<div class="ewd-uwcf-dashboard-new-widget-box ewd-widget-box-full" id="ewd-uwcf-dashboard-guarantee-widget-box">
				<div class="ewd-uwcf-dashboard-new-widget-box-top">
					<div class="ewd-uwcf-dashboard-guarantee">
						<div class="ewd-uwcf-dashboard-guarantee-title">14-Day 100% Money-Back Guarantee</div>
						<div class="ewd-uwcf-dashboard-guarantee-text">If you're not 100% satisfied with the premium version of our plugin - no problem. You have 14 days to receive a FULL REFUND. We're certain you won't need it, though.</div>
					</div>
				</div>
			</div>
		<?php } ?>

	</div> <!-- left -->

	<div id="ewd-uwcf-dashboard-content-right">

		<?php if ($EWD_UWCF_Full_Version != "Yes" or get_option("EWD_UWCF_Trial_Happening") == "Yes") { ?>
			<div class="ewd-uwcf-dashboard-new-widget-box ewd-widget-box-full" id="ewd-uwcf-dashboard-get-premium-widget-box">
				<div class="ewd-uwcf-dashboard-new-widget-box-top">Get Premium</div>
				
				<?php if ( get_option("EWD_UWCF_Trial_Happening") == "Yes" ) { do_action( 'ewd_trial_happening', 'UWCF' ); } ?>

				<div class="ewd-uwcf-dashboard-new-widget-box-bottom">
					<div class="ewd-uwcf-dashboard-get-premium-widget-features-title"<?php echo ( get_option("EWD_UWCF_Trial_Happening") == "Yes" ? "style='padding-top: 20px;'" : ""); ?>>GET FULL ACCESS WITH OUR PREMIUM VERSION AND GET:</div>
					<ul class="ewd-uwcf-dashboard-get-premium-widget-features">
						<li>Unique Layouts for Each Filter</li>
						<li>Display Available Colors, Sizes &amp; Attributes Below Thumbnails on Shop Page</li>
						<li>Advanced Customization Options</li>
						<li>+ More</li>
					</ul>
					<a href="https://www.etoilewebdesign.com/plugins/woocommerce-filters/#buy" class="ewd-uwcf-dashboard-get-premium-widget-button" target="_blank">UPGRADE NOW</a>
					<?php if ( ! get_option( "EWD_UWCF_Trial_Happening") ) {
						$trial_info = sprintf( __( '<a href="%s" target="_blank">Visit our website</a> to learn how to get a free 7-day trial of the premium plugin.'), 'https://www.etoilewebdesign.com/premium-upgrade-instructions/' );
						
						echo apply_filters( 'ewd_trial_button', $trial_info, 'UWCF' );
					} ?>
				</div>
			</div>
		<?php } ?>

		<div class="ewd-uwcf-dashboard-new-widget-box ewd-widget-box-full">
			<div class="ewd-uwcf-dashboard-new-widget-box-top">Other Plugins by Etoile</div>
			<div class="ewd-uwcf-dashboard-new-widget-box-bottom">
				<ul class="ewd-uwcf-dashboard-other-plugins">
					<li>
						<a href="https://wordpress.org/plugins/ultimate-product-catalogue/" target="_blank"><img src="<?php echo plugins_url( '../images/ewd-upcp-icon.png', __FILE__ ); ?>"></a>
						<div class="ewd-uwcf-dashboard-other-plugins-text">
							<div class="ewd-uwcf-dashboard-other-plugins-title">Product Catalog</div>
							<div class="ewd-uwcf-dashboard-other-plugins-blurb">Enables you to display your business's products in a clean and efficient manner.</div>
						</div>
					</li>
					<li>
						<a href="https://wordpress.org/plugins/ultimate-reviews/" target="_blank"><img src="<?php echo plugins_url( '../images/ewd-urp-icon.png', __FILE__ ); ?>"></a>
						<div class="ewd-uwcf-dashboard-other-plugins-text">
							<div class="ewd-uwcf-dashboard-other-plugins-title">Ultimate Reviews</div>
							<div class="ewd-uwcf-dashboard-other-plugins-blurb">Let visitors submit reviews and display them right in the tabbed page layout!</div>
						</div>
					</li>
				</ul>
			</div>
		</div>

	</div> <!-- right -->	

</div> <!-- ewd-uwcf-dashboard-content-area -->

<?php if ($EWD_UWCF_Full_Version != "Yes" or get_option("EWD_UWCF_Trial_Happening") == "Yes") { ?>
	<div id="ewd-uwcf-dashboard-new-footer-one">
		<div class="ewd-uwcf-dashboard-new-footer-one-inside">
			<div class="ewd-uwcf-dashboard-new-footer-one-left">
				<div class="ewd-uwcf-dashboard-new-footer-one-title">What's Included in Our Premium Version?</div>
				<ul class="ewd-uwcf-dashboard-new-footer-one-benefits">
					<li>Multiple Layouts/Styles for Selecting Colors</li>
					<li>Multiple Layouts for Selecting Sizes</li>
					<li>Multiple Layouts for Product Attributes</li>
					<li>Multiple Layouts for Categories &amp; Tags</li>
					<li>Display Available Colors, Sizes &amp; Attributes Below Thumbnails on Shop Page</li>
					<li>Advanced Customization Options</li>
				</ul>
			</div>
			<div class="ewd-uwcf-dashboard-new-footer-one-buttons">
				<a class="ewd-uwcf-dashboard-new-upgrade-button" href="https://www.etoilewebdesign.com/plugins/woocommerce-filters/#buy" target="_blank">UPGRADE NOW</a>
			</div>
		</div>
	</div> <!-- ewd-uwcf-dashboard-new-footer-one -->
<?php } ?>	
<div id="ewd-uwcf-dashboard-new-footer-two">
	<div class="ewd-uwcf-dashboard-new-footer-two-inside">
		<img src="<?php echo plugins_url( '../images/ewd-logo-white.png', __FILE__ ); ?>" class="ewd-uwcf-dashboard-new-footer-two-icon">
		<div class="ewd-uwcf-dashboard-new-footer-two-blurb">
			At Etoile Web Design, we build reliable, easy-to-use WordPress plugins with a modern look. Rich in features, highly customizable and responsive, plugins by Etoile Web Design can be used as out-of-the-box solutions and can also be adapted to your specific requirements.
		</div>
		<ul class="ewd-uwcf-dashboard-new-footer-two-menu">
			<li>SOCIAL</li>
			<li><a href="https://www.facebook.com/EtoileWebDesign/" target="_blank">Facebook</a></li>
			<li><a href="https://twitter.com/EtoileWebDesign" target="_blank">Twitter</a></li>
			<li><a href="https://www.etoilewebdesign.com/blog/" target="_blank">Blog</a></li>
		</ul>
		<ul class="ewd-uwcf-dashboard-new-footer-two-menu">
			<li>SUPPORT</li>
			<li><a href="https://www.youtube.com/channel/UCZPuaoetCJB1vZOmpnMxJNw/featured" target="_blank">YouTube Tutorials</a></li>
			<li><a href="https://www.etoilewebdesign.com/support-center/?Plugin=UWCF&Type=FAQs" target="_blank">Documentation</a></li>
			<li><a href="https://www.etoilewebdesign.com/support-center/" target="_blank">Get Support</a></li>
			<li><a href="https://wordpress.org/plugins/color-filters/#faq" target="_blank">FAQs</a></li>
		</ul>
	</div>
</div> <!-- ewd-uwcf-dashboard-new-footer-two -->

<!-- END NEW DASHBOARD -->
