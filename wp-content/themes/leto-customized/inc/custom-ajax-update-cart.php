<?php

add_action( 'wp_ajax_custom_change_variation_in_cart', 'change_variation_in_cart' );
add_action( 'wp_ajax_nopriv_custom_change_variation_in_cart', 'change_variation_in_cart' );
function change_variation_in_cart() {

	$product_id = $_POST['product_id'];
	$quantity = $_POST['quantity'];
	$variation_id = $_POST['variation_id'];

	$variation = wc_get_product($variation_id);
	$variation_attributes = $variation->get_variation_attributes();

	$variation_data = wc_get_product_variation_attributes($variation_id);
	$selected_key = $_POST['cart_key'];

	$cartCountBefore = count( WC()->cart->get_cart() );
	error_log('cartCountBefore'.$cartCountBefore);
	WC()->cart->add_to_cart( $product_id, $quantity, $variation_id );
	$cartCountAfter = count( WC()->cart->get_cart() );
	error_log('cartCountAfter'.$cartCountAfter);

	$item_count = 0;
	$sorted_cart = [];
	//$item_position = 0;
	$last_key = "";

	$cart_items = WC()->cart->get_cart();
	foreach ( $cart_items as $key => $item ) {

		if ( $selected_key === $key ) {
			error_log('selected_key: '.$selected_key);
			//$item_position = $item_count;
			if ( $cartCountAfter > $cartCountBefore ) {
				$last_key = array_key_last($cart_items);
				$sorted_cart[ $last_key ] = array_pop($cart_items);
			}

		} else {
			$sorted_cart[ $key ] = WC()->cart->cart_contents[ $key ];
		}

		$item_count++;
	}

	WC()->cart->cart_contents = $sorted_cart;
	
	WC_AJAX::get_refreshed_fragments();
}

add_action( 'wp_ajax_custom_change_quantity_in_cart', 'change_quantity_in_cart' );
add_action( 'wp_ajax_nopriv_custom_change_quantity_in_cart', 'change_quantity_in_cart' );
function change_quantity_in_cart() {

	$cart_key 	= sanitize_text_field( $_POST['cart_key'] );
	$new_qty 	= $_POST['quantity'];

	if (!empty( WC()->cart->get_cart_item( $cart_key ) )) {

		$updated = $new_qty == 0 ? WC()->cart->remove_cart_item( $cart_key ) : WC()->cart->set_quantity( $cart_key, $new_qty );

		if( $updated ) {

			if( $new_qty == 0 ){

				//$notice = __( 'Item removed', 'side-cart-woocommerce' );

				//$notice .= '<span class="xoo-wsc-undo-item" data-key="'.$cart_key.'">'.__('Undo?','side-cart-woocommerce').'</span>';  

			}
			else{
				//$notice = __( 'Item updated', 'side-cart-woocommerce' );
			}

			//$this->set_notice( $notice, 'success' );
		}
	}

	WC_AJAX::get_refreshed_fragments();
}
