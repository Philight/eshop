<?php
add_action('current_screen', 'EWD_UWCF_Deactivation_Survey');
function EWD_UWCF_Deactivation_Survey() {
	if (in_array(get_current_screen()->id, array( 'plugins', 'plugins-network' ), true)) {
		add_action('admin_enqueue_scripts', 'EWD_UWCF_Enqueue_Deactivation_Scripts');
		add_action( 'admin_footer', 'EWD_UWCF_Deactivation_Survey_HTML'); 
	}
}

function EWD_UWCF_Enqueue_Deactivation_Scripts() {
	wp_enqueue_style('ewd-uwcf-deactivation-css', EWD_UWCF_CD_PLUGIN_URL . 'assets/css/ewd-uwcf-plugin-deactivation.css');
	wp_enqueue_script('ewd-uwcf-deactivation-js', EWD_UWCF_CD_PLUGIN_URL . 'js/ewd-uwcf-plugin-deactivation.js', array('jquery'));

	wp_localize_script('ewd-uwcf-deactivation-js', 'ewd_uwcf_deactivation_data', array('site_url' => site_url()));
}

function EWD_UWCF_Deactivation_Survey_HTML() {
	$Install_Time = get_option("EWD_UWCF_Install_Time");

	$options = array(
		1 => array(
			'title'   => esc_html__( 'I no longer need the plugin', 'color-filters' ),
		),
		2 => array(
			'title'   => esc_html__( 'I\'m switching to a different plugin', 'color-filters' ),
			'details' => esc_html__( 'Please share which plugin', 'color-filters' ),
		),
		3 => array(
			'title'   => esc_html__( 'I couldn\'t get the plugin to work', 'color-filters' ),
			'details' => esc_html__( 'Please share what wasn\'t working', 'color-filters' ),
		),
		4 => array(
			'title'   => esc_html__( 'It\'s a temporary deactivation', 'color-filters' ),
		),
		5 => array(
			'title'   => esc_html__( 'Other', 'color-filters' ),
			'details' => esc_html__( 'Please share the reason', 'color-filters' ),
		),
	);
	?>
	<div class="ewd-uwcf-deactivate-survey-modal" id="ewd-uwcf-deactivate-survey-ultimate-woocommerce-filters">
		<div class="ewd-uwcf-deactivate-survey-wrap">
			<form class="ewd-uwcf-deactivate-survey" method="post" data-installtime="<?php echo $Install_Time; ?>">
				<span class="ewd-uwcf-deactivate-survey-title"><span class="dashicons dashicons-testimonial"></span><?php echo ' ' . __( 'Quick Feedback', 'color-filters' ); ?></span>
				<span class="ewd-uwcf-deactivate-survey-desc"><?php echo __('If you have a moment, please share why you are deactivating Ultimate WooCommerce Filters:', 'color-filters' ); ?></span>
				<div class="ewd-uwcf-deactivate-survey-options">
					<?php foreach ( $options as $id => $option ) : ?>
						<div class="ewd-uwcf-deactivate-survey-option">
							<label for="ewd-uwcf-deactivate-survey-option-ultimate-faqs-<?php echo $id; ?>" class="ewd-uwcf-deactivate-survey-option-label">
								<input id="ewd-uwcf-deactivate-survey-option-ultimate-faqs-<?php echo $id; ?>" class="ewd-uwcf-deactivate-survey-option-input" type="radio" name="code" value="<?php echo $id; ?>" />
								<span class="ewd-uwcf-deactivate-survey-option-reason"><?php echo $option['title']; ?></span>
							</label>
							<?php if ( ! empty( $option['details'] ) ) : ?>
								<input class="ewd-uwcf-deactivate-survey-option-details" type="text" placeholder="<?php echo $option['details']; ?>" />
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="ewd-uwcf-deactivate-survey-footer">
					<button type="submit" class="ewd-uwcf-deactivate-survey-submit button button-primary button-large"><?php _e('Submit and Deactivate', 'color-filters' ); ?></button>
					<a href="#" class="ewd-uwcf-deactivate-survey-deactivate"><?php _e('Skip and Deactivate', 'color-filters' ); ?></a>
				</div>
			</form>
		</div>
	</div>
	<?php
}

?>