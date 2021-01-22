<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Leto
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

if (is_cart()) {
	echo '<div class="cart-collaterals col-md-3">';

	do_action( 'custom_sidebar_cart_collaterals' );

	echo "</div>";

	return;
}
?>

<aside id="secondary" class="widget-area primary-sidebar col-md-3">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->