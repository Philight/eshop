<?php
/**
 * Loop Add to Cart
 *
 * OVERRIDEN 
 * /woocommerce/loop/add-to-cart.php
 * Add variable product to cart
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

$isVariableProduct = false;
if ( $product->get_type() === 'variable' ) {
	// Get children product variation IDs in an array
	$variation_ids = $product->get_children();

// add while loop ( default var is out of stock )
	// default variable id
	$i = 0;
	do {
		$isVariableProduct = $variation_ids[$i];
		$i++;
	} 
	// add first purchasable variation (in stock)
	while ( !(new WC_Product_Variation($isVariableProduct))->is_in_stock() && $i < count($variation_ids) );	
/*
	$variation = new WC_Product_Variation($isVariableProduct);
	$variationAttr = $variation->get_attribute( 'pa_color' );
*/
}


echo apply_filters(
	'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
	sprintf(
		'<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
		esc_url( $isVariableProduct ? remove_query_arg(
			'added-to-cart',
			add_query_arg(
				array(
					'add-to-cart' => $product->get_id(),
					'variation_id' => esc_attr($isVariableProduct),
					//'attribute_pa_color' => esc_attr($variationAttr),
				),
				( function_exists( 'is_feed' ) && is_feed() ) || ( function_exists( 'is_404' ) && is_404() ) ? $product->get_permalink() : ''
			)
		) : $product->add_to_cart_url()
		),
		esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
		esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
		isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
// Replace with simple products' text for variable product 		
		$isVariableProduct ? esc_html((new WC_Product)->single_add_to_cart_text()) : esc_html( $product->add_to_cart_text() )
	),
	$product,
	$args
);
