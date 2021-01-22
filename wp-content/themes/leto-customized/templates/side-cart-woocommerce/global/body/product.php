<?php
/**
 * Product
 *
 * This template can be overridden by copying it to yourtheme/templates/side-cart-woocommerce/global/body/product.php.
 *
 * Added ajax quantity
 *
 * HOWEVER, on occasion we will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen.
 * @see     https://docs.xootix.com/side-cart-woocommerce/
 * @version 2.1
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$productClasses = apply_filters( 'xoo_wsc_product_class', $productClasses );

?>

<div data-key="<?php echo $cart_item_key ?>" class="<?php echo implode( ' ', $productClasses ) ?>">

	<?php do_action( 'xoo_wsc_product_start', $_product, $cart_item_key ); ?>

	<?php if( $showPimage ): ?>

		<div class="xoo-wsc-img-col">

			<?php echo $thumbnail; ?>

			<?php do_action( 'xoo_wsc_product_image_col', $_product, $cart_item_key ); ?>

		</div>

	<?php endif; ?>

	<div class="xoo-wsc-sum-col">

		<?php do_action( 'xoo_wsc_product_summary_col_start', $_product, $cart_item_key ); ?>

		<div class="xoo-wsc-sm-info">

			<div class="xoo-wsc-sm-left">

				<?php if( $showPname ): ?>
					<span class="xoo-wsc-pname"><?php echo $product_name; ?></span>
				<?php endif; ?>
<!-- -->
				<?php 
					if( $_product->get_type() === 'variation' ) {
						//$variableProduct = wc_get_product( $_product->get_parent_id() );
						do_action( 'custom_sidecart_variations', $cart_item_key ); 
					} else {
						if( $showPmeta ) { echo $product_meta; }
					}
				?>


				<?php if( $showPprice && ( $qtyPriceDisplay === 'separate' ) ): ?>
					<div class="xoo-wsc-pprice">
						<?php echo __( 'Price: ', 'side-cart-woocommerce' ) . $product_price ?>
					</div>
				<?php endif; ?>

				<!-- Quantity -->

				<div class="xoo-wsc-qty-price">

					<?php if( $showPprice && $qtyPriceDisplay === 'one_liner' ): ?>
						<span><?php echo $cart_item['quantity']; ?></span> X <span><?php echo $product_price; ?></span>
						<?php if( $showPtotal ): ?>
							<span> = <?php echo $product_subtotal ?></span>
						<?php endif; ?>

					<?php else: ?>
						<!--
						<span><?php// _e( 'Qty:', 'side-cart-woocommerce' ) ?></span> <span><?php// echo $cart_item['quantity']; ?></span>
						-->

						<?php
					// taken from 'woocommerce/templates/cart/cart.php', quantity column
						if ( $_product->is_sold_individually() ) {
							$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
						} else {
							$product_quantity = woocommerce_quantity_input(
								array(
									'input_name'   => "cart[{$cart_item_key}][qty]",
									'input_value'  => $cart_item['quantity'],
									'max_value'    => $_product->get_max_purchase_quantity(),
									'min_value'    => '0',
									'product_name' => $_product->get_name(),
								),
								$_product,
								false
							);
						}

						$quantityDiv = apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
	
						$originalClasses = array(
							"a href", 
							"wac-qty-button wac-btn-sub", 
							"wac-qty-button wac-btn-inc", 
							"input-text qty text");
						$addClasses = array(
							'a role="button"', 
							"wac-qty-button wac-btn-sub xoo-wsc-chng xoo-wsc-minus", 
							"wac-qty-button wac-btn-inc xoo-wsc-chng xoo-wsc-plus", 
							"input-text qty text xoo-wsc-qty");

						echo str_replace($originalClasses, $addClasses, $quantityDiv);
						echo '<div id="wsc-empty-div-placeholder">Subtotal: </div>';
						?>
					<?php endif; ?>

				</div>

			</div>

			<!-- End Quantity -->

		

			<div class="xoo-wsc-sm-right">

				<?php if( $showPdel ): ?>
					<span class="xoo-wsc-smr-del <?php echo $delete_icon ?>"></span>
				<?php endif; ?>

				<?php if( $showPtotal && ( $qtyPriceDisplay === 'separate' ) ): ?>
					<span class="xoo-wsc-smr-ptotal"><?php echo $product_subtotal ?></span>
				<?php endif; ?>

			</div>

		</div>

		<?php do_action( 'xoo_wsc_product_summary_col_end', $_product, $cart_item_key ); ?>

	</div>

	<?php do_action( 'xoo_wsc_product_end', $_product, $cart_item_key ); ?>

</div>