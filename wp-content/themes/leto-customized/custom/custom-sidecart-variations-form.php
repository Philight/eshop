<?php 
// /woocommerce/templates/single-product/add-to-cart/variable.php

function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

add_action( 'custom_sidecart_variations', 'custom_function' );
function custom_function( $variation_cart_key ) { 

	global $woocommerce;

	$items = $woocommerce->cart->get_cart_item($variation_cart_key);
	$selected_variation = $items['variation'];

	$variableProduct = wc_get_product($items['product_id']);

	$available_variations = $variableProduct->get_available_variations();
	$attributes = $variableProduct->get_variation_attributes();

	ob_start();
?>

<?php// console_log($items); ?>

<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<div class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $variableProduct->get_id() ); ?>" data-product_variations="<?php echo htmlspecialchars( json_encode( $available_variations ) ) ?>">

	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This product is currently out of stock and unavailable.', 'woocommerce' ) ) ); ?></p>
	<?php else : ?>
		<table class="variations" cellspacing="0">
			<tbody>
				<?php foreach ( $attributes as $attribute_name => $options ) : ?>
					<tr>
						<td class="label"><label for="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>"><?php echo wc_attribute_label( $attribute_name ); // WPCS: XSS ok. ?></label></td>
						<td class="value">
							<?php

								$selected = $selected_variation[ 'attribute_' . sanitize_title( $attribute_name ) ];

								wc_dropdown_variation_attribute_options(
									array(
										'options'   => $options,
										'attribute' => $attribute_name,
										'product'   => $variableProduct,
										'selected'  => $selected, 
									)
								);
								// echo
							?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</div>

<?php 
	ob_end_flush();
}