<?php 
defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$fields_array = get_option("EWD_UWCF_Fields_Array");
if (!is_array($fields_array)) {$fields_array = array('name', 'image', 'price', 'rating', 'add_to_cart');}

?>
<tr <?php wc_product_class( '', $product ); ?>>
	<?php foreach ($fields_array as $field) { ?>
		<?php $display = EWD_UWCF_Get_Field_Displayed( $field ) == 'Yes' ? true : false; ?>
		<?php if ($display) { ?>
			<td><?php ewd_uwcf_field_template( $field ); ?></td>
		<?php } ?>
	<?php } ?>
</tr>
