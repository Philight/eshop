<?php

add_filter('woocommerce_cart_item_quantity', 'custom_cart_item_quantity_filter', 10, 3);
function custom_cart_item_quantity_filter( $inputDiv, $cart_item_key, $cart_item = null ) {

	$minus = '<button class="custom-qty-btn custom-btn-minus">-</button>';
	$plus = '<button class="custom-qty-btn custom-btn-plus">+</button>';

	$input = str_replace(array('<div class="quantity">', '</div>'), array('', ''), $inputDiv);
    $newDiv = '<div class="quantity custom-quantity">' . $minus . $input . $plus . '</div>';

    return apply_filters('custom_quantity_div', $newDiv);
}