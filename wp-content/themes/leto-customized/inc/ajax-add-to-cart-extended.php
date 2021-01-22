<?php
/*
 * Extended ajax on product page loop, added ajax for variable products
 * original method: woocommerce/includes/class-wc-ajax.php, public static function add_to_cart()
 */

add_action( 'wp_ajax_woocommerce_ajax_add_to_cart', 'ajax_add_to_cart_extended' );
add_action( 'wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'ajax_add_to_cart_extended' );
function ajax_add_to_cart_extended() {

    ob_start();

    $product_id        = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) );
    $quantity          = empty( $_POST['quantity'] ) ? 1 : wc_stock_amount( wp_unslash( $_POST['quantity'] ) );

    $variation_id      = isset( $_POST['variation_id'] ) ? absint( $_POST['variation_id'] ) : 0;
    $variations         = ! empty( $_POST['variation'] ) ? (array) $_POST['variation'] : '';

    $passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity, $variation_id, $variations, $cart_item_data );

    $product_status    = get_post_status( $product_id );
    $product           = wc_get_product( $product_id );

	$variation         = array();

	if ( $product && 'variation' === $product->get_type() ) {
		$variation_id = $product_id;
		$product_id   = $product->get_parent_id();
		$variation    = $product->get_variation_attributes();
	}

	if ( $product && 'variable' === $product->get_type() ) {
		$variation_ids = $product->get_children();

		$i = 0;
		do {
			$variation_id = $variation_ids[$i];
			$i++;
		} 
		// add first purchasable variation (in stock)
		while ( !(new WC_Product_Variation($variation_id))->is_in_stock() && $i < count($variation_ids) );

	}

    if ( $passed_validation && WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variations ) && 'publish' === $product_status ) {

        do_action( 'woocommerce_ajax_added_to_cart', $product_id );

        if ( get_option( 'woocommerce_cart_redirect_after_add' ) == 'yes' ) {
            wc_add_to_cart_message( $product_id );
        }

        // Return fragments
        WC_AJAX::get_refreshed_fragments();

    } else {

        // If there was an error adding to the cart, redirect to the product page to show any errors
        $data = array(
            'error' => true,
            'product_url' => apply_filters( 'woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id )
        );

        wp_send_json( $data );

    }

    die();
}