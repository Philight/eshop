<?php

$Enable_Table_Format = get_option("EWD_UWCF_Table_Format");

if ($Enable_Table_Format == "Yes") {
	add_filter('woocommerce_product_loop_start', 'UWCF_WC_Table_Format_Product_Loop_Start');
	add_filter('woocommerce_product_loop_end', 'UWCF_WC_Table_Format_Product_Loop_End');
	add_filter('wc_get_template_part', 'UWCF_WC_Table_Format_Replace_Product_Content_Template', 10, 3);
}

function UWCF_WC_Table_Format_Product_Loop_Start( $content ) {
	$Allow_Sorting = get_option("EWD_UWCF_Allow_Sorting");

	$Fields_Array = get_option("EWD_UWCF_Fields_Array");
	if (!is_array($Fields_Array)) {$Fields_Array = array('name', 'image', 'price', 'rating', 'add_to_cart');}

	?>

	<form id='ewd-uwcf-filtering-form' data-shopurl='<?php echo get_permalink(wc_get_page_id('shop')); ?>'>
	<table class="products">
		<thead>
	
			<tr>
				<?php echo ewd_uwcf_table_filters( array() );?>
			</tr>

			<tr>
				<?php foreach ($Fields_Array as $Field) { ?>
					<?php $display = EWD_UWCF_Get_Field_Displayed( $Field ) == 'Yes' ? true : false; ?>
					<?php if ($display) { ?>
						<td><?php ewd_uwcf_field_title( $Field ); ?></td>
					<?php } ?>
				<?php } ?>
			</tr>
		</thead>
<?php }

function UWCF_WC_Table_Format_Product_Loop_End( $content ) { ?>
	</table>
	</form>
<?php }

function UWCF_WC_Table_Format_Replace_Product_Content_Template( $template, $slug, $name ) {
	if ($slug == 'content' and $name == 'product') {
		$template = CF_PLUGIN_PATH . '/html/template-content-product.php';
	}

	return $template;
}

/*function UWCF_WC_Table_Format_Orderby_Rating_Desc( $args, $orderby, $order ) {
	global $wpdb;

	if ($orderby == 'rating' and $order == 'DESC') {
		if ( !isset($args['join']) or ! strstr( $args['join'], 'wc_product_meta_lookup' ) ) {
    		if ( !isset($args['join']) ) { $args['join'] = " LEFT JOIN {$wpdb->wc_product_meta_lookup} wc_product_meta_lookup ON $wpdb->posts.ID = wc_product_meta_lookup.product_id "; }
    		else { $args['join'] .= " LEFT JOIN {$wpdb->wc_product_meta_lookup} wc_product_meta_lookup ON $wpdb->posts.ID = wc_product_meta_lookup.product_id "; }
    	}
		$args['orderby'] = ' wc_product_meta_lookup.average_rating DESC, wc_product_meta_lookup.product_id DESC ';
		$args['order'] = 'DESC';
	}
	elseif ($orderby == 'rating') {
		if ( !isset($args['join']) or ! strstr( $args['join'], 'wc_product_meta_lookup' ) ) {
    		if ( !isset($args['join']) ) { $args['join'] = " LEFT JOIN {$wpdb->wc_product_meta_lookup} wc_product_meta_lookup ON $wpdb->posts.ID = wc_product_meta_lookup.product_id "; }
    		else { $args['join'] .= " LEFT JOIN {$wpdb->wc_product_meta_lookup} wc_product_meta_lookup ON $wpdb->posts.ID = wc_product_meta_lookup.product_id "; }
    	}
		$args['orderby'] = ' wc_product_meta_lookup.average_rating ASC, wc_product_meta_lookup.product_id DESC ';
		$args['order'] = 'ASC';
	}

	return $args;
}
add_filter('woocommerce_get_catalog_ordering_args', 'UWCF_WC_Table_Format_Orderby_Rating_Desc', 10, 3);*/


function EWD_UWCF_Get_Field_Name( $slug ) {
	global $wpdb;

	if ($slug == 'name') 				{$Field_Name = 'Title';}
	elseif ($slug == 'image') 			{$Field_Name = 'Image';}
	elseif ($slug == 'price') 			{$Field_Name = 'Price';}
	elseif ($slug == 'rating') 			{$Field_Name = 'Rating';}
	elseif ($slug == 'add_to_cart') 	{$Field_Name = 'Add to Cart';}
	elseif ($slug == 'colors') 			{$Field_Name = 'Colors';}
	elseif ($slug == 'sizes') 			{$Field_Name = 'Sizes';}
	else {
		if (isset($Attribute_Options[$slug]['Label'])) {$Field_Name = $Attribute_Options[$slug]['Label'];}
		else {
			$wc_attribute_table_name = $wpdb->prefix . "woocommerce_attribute_taxonomies";
			$Field_Name = $wpdb->get_var($wpdb->prepare("SELECT attribute_label FROM $wc_attribute_table_name WHERE attribute_name=%s", $slug));
		}
	}

	return $Field_Name;
}

function EWD_UWCF_Get_Field_Displayed( $slug ) {
	if ($slug == 'name') 				{
		$Field_Displayed = get_option("EWD_UWCF_Product_Title_Displayed");
		$Field_Displayed = ($Field_Displayed != '' ? $Field_Displayed : 'Yes');
	}
	elseif ($slug == 'image') 			{
		$Field_Displayed = get_option("EWD_UWCF_Product_Image_Displayed");
		$Field_Displayed = ($Field_Displayed != '' ? $Field_Displayed : 'Yes');
	}
	elseif ($slug == 'price') 			{
		$Field_Displayed = get_option("EWD_UWCF_Product_Price_Displayed");
		$Field_Displayed = ($Field_Displayed != '' ? $Field_Displayed : 'Yes');
	}
	elseif ($slug == 'rating') 			{
		$Field_Displayed = get_option("EWD_UWCF_Product_Rating_Displayed");
		$Field_Displayed = ($Field_Displayed != '' ? $Field_Displayed : 'Yes');
	}
	elseif ($slug == 'add_to_cart') 	{
		$Field_Displayed = get_option("EWD_UWCF_Product_Add_To_Cart_Displayed");
		$Field_Displayed = ($Field_Displayed != '' ? $Field_Displayed : 'Yes');
	}
	elseif ($slug == 'colors') 	{
		$Field_Displayed = get_option("EWD_UWCF_Colors_Displayed");
		$Field_Displayed = ($Field_Displayed != '' ? $Field_Displayed : 'Yes');
	}
	elseif ($slug == 'sizes') 	{
		$Field_Displayed = get_option("EWD_UWCF_Sizes_Displayed");
		$Field_Displayed = ($Field_Displayed != '' ? $Field_Displayed : 'Yes');
	}
	else {
		$Field_Displayed = get_option("EWD_UWCF_" . $slug . "_Displayed");
		$Field_Displayed = ($Field_Displayed != '' ? $Field_Displayed : 'No');
	}

	return $Field_Displayed;
}

function EWD_UWCF_Get_Field_Filtering( $slug ) {
	global $EWD_UWCF_Full_Version;

	if ($slug == 'name') 				{
		$Field_Filtering = get_option("EWD_UWCF_Product_Title_Filtering");
		$Field_Filtering = ($Field_Filtering != '' ? $Field_Filtering : 'Yes');
	}
	elseif ($slug == 'image') 			{
		$Field_Filtering = "N/A";
	}
	elseif ($slug == 'price') 			{
		if ($EWD_UWCF_Full_Version == "Yes") {
			$Field_Filtering = get_option("EWD_UWCF_Product_Price_Enable");
			$Field_Filtering = ($Field_Filtering != '' ? $Field_Filtering : 'Yes');
		}
		else {$Field_Filtering = "N/A";}
	}
	elseif ($slug == 'rating') 			{
		$Field_Filtering = get_option("EWD_UWCF_Product_Rating_Filtering");
		$Field_Filtering = ($Field_Filtering != '' ? $Field_Filtering : 'Yes');
	}
	elseif ($slug == 'add_to_cart') 	{
		$Field_Filtering = "N/A";
	}
	elseif ($slug == 'colors') 			{
		$Field_Filtering = get_option("EWD_UWCF_Enable_Colors");
		$Field_Filtering = ($Field_Filtering != '' ? $Field_Filtering : 'Yes');
	}
	elseif ($slug == 'sizes') 			{
		$Field_Filtering = get_option("EWD_UWCF_Enable_Sizes");
		$Field_Filtering = ($Field_Filtering != '' ? $Field_Filtering : 'Yes');
	}
	else {
		if (isset($Attribute_Options[$slug]['Enabled'])) {$Field_Filtering = $Attribute_Options[$slug]['Enabled'];}
		else {$Field_Filtering = get_option("EWD_UWCF_" . $slug . "_Enabled");}

		$Field_Filtering = ($Field_Filtering != '' ? $Field_Filtering : 'No');
	}

	return $Field_Filtering;
}

function EWD_UWCF_Get_Field_Filter_Type( $slug ) {
	if ($slug == 'name') 				{
		$Field_Filter_Type = get_option("EWD_UWCF_Product_Title_Filter_Type");
		$Field_Filter_Type = ($Field_Filter_Type != '' ? $Field_Filter_Type : 'Yes');
	}
	elseif ($slug == 'image') 			{
		$Field_Filter_Type = "N/A";
	}
	elseif ($slug == 'price') 			{
		$Field_Filter_Type = get_option("EWD_UWCF_Product_Price_Display");
		$Field_Filter_Type = ($Field_Filter_Type != '' ? $Field_Filter_Type : 'Yes');
	}
	elseif ($slug == 'rating') 			{
		$Field_Filter_Type = get_option("EWD_UWCF_Product_Rating_Filter_Type");
		$Field_Filter_Type = ($Field_Filter_Type != '' ? $Field_Filter_Type : 'Yes');
	}
	elseif ($slug == 'add_to_cart') 	{
		$Field_Filter_Type = "N/A";
	}
	elseif ($slug == 'colors') 			{
		$Field_Filter_Type = get_option("EWD_UWCF_Color_Filters_Display");
		$Field_Filter_Type = ($Field_Filter_Type != '' ? $Field_Filter_Type : 'Yes');
	}
	elseif ($slug == 'sizes') 			{
		$Field_Filter_Type = get_option("EWD_UWCF_Size_Filters_Display");
		$Field_Filter_Type = ($Field_Filter_Type != '' ? $Field_Filter_Type : 'Yes');
	}
	else {
		if (isset($Attribute_Options[$slug]['Display'])) {$Field_Filter_Type = $Attribute_Options[$slug]['Display'];}
		else {$Field_Filter_Type = get_option("EWD_UWCF_" . $slug . "_Display");}

		$Field_Filter_Type = ($Field_Filter_Type != '' ? $Field_Filter_Type : 'No');
	}

	return $Field_Filter_Type;
}

function EWD_UWCF_Get_Field_Filtering_Type_Options( $slug ) {
	$Filtering_Options = array(
		'List',
		'Checklist',
		'Dropdown'
	);

	if ($slug == 'name') {
		$Filtering_Options = array('Text');
	}

	if ($slug == 'price') {
		$Filtering_Options = array('Text', 'Slider');
	}

	if ($slug == 'colors') {
		$Filtering_Options = array('List', 'Tiles', 'Swatch', 'Checklist', 'Dropdown');
	}

	return $Filtering_Options;
}

function ewd_uwcf_field_title( $slug ) {
	$Allow_Sorting = get_option("EWD_UWCF_Allow_Sorting");

	if ($slug == 'name') {echo '<a class="' . ($Allow_Sorting == 'Yes'? 'uwcf-table-format-header': '') . '" data-orderby="title">Product</a>';}
	elseif ($slug == 'image') {echo 'Image';}
	elseif ($slug == 'price') {echo '<a class="' . ($Allow_Sorting == 'Yes'? 'uwcf-table-format-header': '') . '" data-orderby="price">Price</a>';}
	elseif ($slug == 'rating') {echo '<a class="' . ($Allow_Sorting == 'Yes'? 'uwcf-table-format-header': '') . '" data-orderby="rating">Rating</a>';}
	elseif ($slug == 'add_to_cart') {echo 'Add to Cart';}
	elseif ($slug == 'colors') {echo 'Colors';}
	elseif ($slug == 'sizes') {echo 'Sizes';}
	else {ewd_uwcf_wc_table_display_attribute_title( $slug );}
}

function ewd_uwcf_wc_table_display_attribute_title( $slug ) {
	global $wpdb;

	$wc_attribute_table_name = $wpdb->prefix . "woocommerce_attribute_taxonomies";
	echo $wpdb->get_var($wpdb->prepare("SELECT attribute_label FROM $wc_attribute_table_name WHERE attribute_name=%s", $slug));
}

function ewd_uwcf_field_template( $slug ) {
	if ($slug == 'name') {woocommerce_template_loop_product_title();}
	elseif ($slug == 'image') {woocommerce_template_loop_product_thumbnail();}
	elseif ($slug == 'price') {woocommerce_template_loop_price();}
	elseif ($slug == 'rating') {woocommerce_template_loop_rating();}
	elseif ($slug == 'add_to_cart') {woocommerce_template_loop_add_to_cart();}
	elseif ($slug == 'colors') {ewd_uwcf_wc_table_display_color_field();}
	elseif ($slug == 'sizes') {ewd_uwcf_wc_table_display_size_field();}
	else {ewd_uwcf_wc_table_display_attribute_field( $slug );}
}

function ewd_uwcf_wc_table_display_color_field() {
	global $product;

	if ( empty( $product ) || ! $product->is_visible() ) {
		return;
	}

	$Color_Filters_Display = get_option("EWD_UWCF_Color_Filters_Display");
	$Color_Filters_Color_Shape = get_option("EWD_UWCF_Color_Filters_Color_Shape");

	$terms = wp_get_post_terms($product->get_id(), 'product_color');

	if (!empty($terms)) {
		echo "<div class='ewd-uwcf-thumbnail-links ewd-uwcf-wc-shop-product-colors'>";
		echo "<div class='ewd-uwcf-shop-product-colors-container'>";
		foreach ($terms as $term) {
			$Color = get_term_meta($term->term_id, 'EWD_UWCF_Color', true);
			$Style = ($Color != '' ? apply_filters( 'elm_cf_color_style_attribute', 'style="background: ' . $Color . ';"' ) : '');
	
			echo "<div class='ewd-uwcf-color-wrap'>";
			echo "<a href='" . EWD_UWCF_Build_Term_Link('product_color', $term->slug, $Color_Filters_Display) . "''><div class='ewd-uwcf-color-preview " . ($Color_Filters_Color_Shape == "Circle" ? 'ewd-uwcf-rcorners' : '' ) . "' " . $Style . "></div></a>";
			echo "</div>";
		}
		echo "<div class='ewd-uwcf-clear'></div>";
		echo "</div>";
		echo "</div>";
	}
}

function ewd_uwcf_wc_table_display_size_field() {
	global $product;

	if ( empty( $product ) || ! $product->is_visible() ) {
		return;
	}

	$Size_Filters_Display = get_option("EWD_UWCF_Size_Filters_Display");

	$terms = wp_get_post_terms($product->get_id(), 'product_size');

	if (!empty($terms)) {
		echo "<div class='ewd-uwcf-thumbnail-links ewd-uwcf-wc-shop-product-sizes'>";
		echo "<div class='ewd-uwcf-shop-product-sizes-container'>";
		foreach ($terms as $term) {
			echo "<div class='ewd-uwcf-size-wrap'>";
			echo "<a href='" . EWD_UWCF_Build_Term_Link('product_size', $term->slug, $Size_Filters_Display) . "'>" . $term->name . "</a>";
			echo "</div>";
		}
		echo "<div class='ewd-uwcf-clear'></div>";
		echo "</div>";
		echo "</div>";
	}
}

function ewd_uwcf_wc_table_display_attribute_field( $slug ) {
	global $product;

	if ( empty( $product ) || ! $product->is_visible() ) {
		return;
	}

	$terms = wp_get_post_terms($product->get_id(), 'pa_' . $slug );
	
	foreach ($terms as $term) {
		echo "<div class='ewd-uwcf-" . $slug . "-wrap'>" . $term->name . "</div>";
	}
}
?>