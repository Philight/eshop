<?php
/**
 * Welcome Page Initiation
*/

include get_template_directory() . '/welcome/welcome.php';

/** Plugins **/
$plugins = array(
	// *** Companion Plugins
	'companion_plugins' => array(
		'access-demo-importer' 	=> array(
			'slug' 				=> 'access-demo-importer',
			'name' 				=> esc_html__('Instant Demo Importer', 'eightstore-lite'),
			'filename' 			=>'access-demo-importer.php',
 			// Use either bundled, remote, wordpress
			'host_type' 		=> 'wordpress',
			'class' 			=> 'Access_Demo_Importer',
			'info' => __('Access Demo Importer Plugin adds the feature to Import the Demo Conent with a single click.', 'eightstore-lite'),
		)
	),
	// *** Required Plugins
	'required_plugins' 			=> array(),

	// *** Recommended Plugins
	'recommended_plugins' => array(
			// Free Plugins
		'free_plugins' => array(
			'woocommerce' => array(
				'slug' 		=> 'woocommerce',
				'filename' 	=> 'woocommerce.php',
				'class' 	=> 'WooCommerce'
			),
			'ultimate-form-builder-lite' => array(
				'slug' 		=> 'ultimate-form-builder-lite',
				'filename' 	=> 'ultimate-form-builder-lite.php',
				'class' 	=> 'UFBL_Class'
			),
			'8-degree-coming-soon-page' => array(
				'slug' 		=> '8-degree-coming-soon-page',
				'filename' 	=> '8-degree-coming-soon-page.php',
				'class' 	=> 'Eight_Degree_Coming_Soon_Page'
			),
			'8-degree-notification-bar' => array(
				'slug' 		=> '8-degree-notification-bar',
				'filename' 	=> '8degree-notification.php',
				'class' 	=> 'Edn_Class'
			)
		),
		// Pro Plugins
		'pro_plugins' => array()
	),
);

$strings = array(
		// Welcome Page General Texts
	'welcome_menu_text' => esc_html__( 'Eightstore Lite Setup', 'eightstore-lite' ),
	'theme_short_description' => esc_html__( 'EightStore Lite - is a free Ecommerce, WooCommerce theme to help you build online store easily. This theme is probably the most feature-rich free WooCommerce theme, which allows you to create your online store in just no time. Some of the major features include: Beautiful design, boxed/full width layout, highly configurable home page, product slider, advanced wishlist, Featured product show list, youtube video integration on popup banner, multiple category display layout, product and post search, promo ticker, payment/partners logo showcase, call to action, blogs on home page, testimonials, 4 sidebar options, typography option, fully responsive, browser compatible, bbPress compatible, CSS3 Animaton,Translation ready, RTL support, SEO friendly, fast loading.', 'eightstore-lite' ),

	// Plugin Action Texts
	'install_n_activate' => esc_html__('Install and Activate', 'eightstore-lite'),
	'deactivate' => esc_html__('Deactivate', 'eightstore-lite'),
	'activate' => esc_html__('Activate', 'eightstore-lite'),

	// Recommended Plugins Section
	'pro_plugin_title' => esc_html__( 'Pro Plugins', 'eightstore-lite' ),
	'pro_plugin_description' => esc_html__( 'Take Advantage of some of our Premium Plugins.', 'eightstore-lite' ),
	'free_plugin_title' => esc_html__( 'Free Plugins', 'eightstore-lite' ),
	'free_plugin_description' => esc_html__( 'These Free Plugins might be handy for you.', 'eightstore-lite' ),

	// Demo Actions
	'installed_btn' => esc_html__('Activated', 'eightstore-lite'),
	'deactivated_btn' => esc_html__('Activated', 'eightstore-lite'),
	'demo_installing' => esc_html__('Installing Demo', 'eightstore-lite'),
	'demo_installed' => esc_html__('Demo Installed', 'eightstore-lite'),
	'demo_confirm' => esc_html__('Are you sure to import demo content ?', 'eightstore-lite'),

	// Actions Required
	'req_plugins_installed' => esc_html__( 'All Recommended action has been successfully completed.', 'eightstore-lite' ),
	'customize_theme_btn' => esc_html__( 'Customize Theme', 'eightstore-lite' ),
);

/**
 * Initiating Welcome Page
*/
$my_theme_wc_page = new eightstore_Lite_Welcome( $plugins, $strings );