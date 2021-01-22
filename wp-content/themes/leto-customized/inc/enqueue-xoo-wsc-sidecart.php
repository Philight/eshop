<<?php
if( !xoo_wsc()->isSideCartPage() ) return;

wp_register_script( 'xoo-wsc-main-js-overriden', get_stylesheet_directory_uri().'/js/xoo-wsc-main.js', array('jquery'), filemtime(get_stylesheet_directory().'/js/xoo-wsc-main.js'), true ); // Main JS  
wp_enqueue_script( 'xoo-wsc-main-js-overriden' ); 


$glSettings = xoo_wsc_frontend()->glSettings;

$noticeMarkup = '<ul class="xoo-wsc-notices">%s</ul>';

wp_localize_script( 'xoo-wsc-main-js-overriden', 'xoo_wsc_params', array(
	'adminurl'  			=> admin_url().'admin-ajax.php',
	'wc_ajax_url' 		  	=> WC_AJAX::get_endpoint( "%%endpoint%%" ),
	'qtyUpdateDelay' 		=> (int) $glSettings['scb-update-delay'],
	'notificationTime' 		=> (int) $glSettings['sch-notify-time'],
	'html' 					=> array(
		'successNotice' =>	sprintf( $noticeMarkup, xoo_wsc_notice_html( '%s%', 'success' ) ),
		'errorNotice'	=> 	sprintf( $noticeMarkup, xoo_wsc_notice_html( '%s%', 'error' ) ),
	),
	'strings'				=> array(
		'maxQtyError' 			=> __( 'Only %s% in stock', 'side-cart-woocommerce' ),
		'stepQtyError' 			=> __( 'Quantity can only be purchased in multiple of %s%', 'side-cart-woocommerce' ),
		'calculateCheckout' 	=> __( 'Please use checkout form to calculate shipping', 'side-cart-woocommerce' ),
		'couponEmpty' 			=> __( 'Please enter promo code', 'side-cart-woocommerce' )
	),
	'isCheckout' 			=> is_checkout(),
	'isCart' 				=> is_cart(),
	'sliderAutoClose' 		=> true,
	'shippingEnabled' 		=> in_array( 'shipping' , $glSettings['scf-show'] ),
	'couponsEnabled' 		=> in_array( 'coupon' , $glSettings['scf-show'] ),
	'autoOpenCart' 			=> $glSettings['m-auto-open'],
	'addedToCart' 			=> xoo_wsc_cart()->addedToCart,
	'ajaxAddToCart' 		=> $glSettings['m-ajax-atc'],
	'showBasket' 			=> xoo_wsc_helper()->get_style_option('sck-enable'),
	'flyToCart' 			=> 'no',
	'productFlyClass' 		=> apply_filters( 'xoo_wsc_product_fly_class', '' ),
	'refreshCart' 			=> xoo_wsc_helper()->get_advanced_option('m-refresh-cart'),
	'fetchDelay' 			=> apply_filters( 'xoo_wsc_cart_fetch_delay', 200 )
) );