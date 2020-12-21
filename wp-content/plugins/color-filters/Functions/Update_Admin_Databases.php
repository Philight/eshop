<?php
function EWD_UWCF_Add_Color() {
	if ( ! isset( $_POST['EWD_UWCF_Nonce_Field'] ) ) {return;}

    if ( ! wp_verify_nonce( $_POST['EWD_UWCF_Nonce_Field'], 'EWD_UWCF_Nonce_Field' ) ) {return;}

    $args = array(
		'slug' => sanitize_text_field($_POST['Color_Slug']),
		'parent' => sanitize_text_field($_POST['parent']),
		'description' => sanitize_text_field($_POST['Color_Description'])
	);

	$term = wp_insert_term(sanitize_text_field($_POST['Color_Name']), 'product_color', $args);
	if (!isset($_POST['Color_Image']) or $_POST['Color_Image'] == 'http://') {update_term_meta($term['term_id'], 'EWD_UWCF_Color', sanitize_text_field($_POST['normal_fill']));}
	else {update_term_meta($term['term_id'], 'EWD_UWCF_Color', sanitize_text_field($_POST['Color_Image']));}

	$wc_term = wp_insert_term(sanitize_text_field($_POST['Color_Name']), 'pa_ewd_uwcf_colors', $args);
	update_term_meta($term['term_id'], 'EWD_UWCF_WC_Term_ID', $wc_term['term_id']);

	if ($args['parent'] != -1) {update_term_meta($term['term_id'], 'EWD_UWCF_Term_Order', get_term_meta($args['parent'], 'EWD_UWCF_Term_Order', true));}
	else {update_term_meta($term['term_id'], 'EWD_UWCF_Term_Order', 999);}

	$update = array("Message_Type" => "Update", "Message" => __("Color has been successfully created.", 'color-filters'));
	return $update;
}

function EWD_UWCF_Edit_Color() {
	if ( ! isset( $_POST['EWD_UWCF_Nonce_Field'] ) ) {return;}

    if ( ! wp_verify_nonce( $_POST['EWD_UWCF_Nonce_Field'], 'EWD_UWCF_Nonce_Field' ) ) {return;}

	$term_id = sanitize_text_field($_POST['term_id']);

	$args = array(
		'name' => sanitize_text_field($_POST['Color_Name']),
		'slug' => sanitize_text_field($_POST['Color_Slug']),
		'parent' => sanitize_text_field($_POST['parent']),
		'description' => sanitize_text_field($_POST['Color_Description'])
	);

	wp_update_term($term_id, 'product_color', $args);
	if (!isset($_POST['Color_Image']) or $_POST['Color_Image'] == 'http://') {update_term_meta($term_id, 'EWD_UWCF_Color', sanitize_text_field($_POST['normal_fill']));}
	else {update_term_meta($term['term_id'], 'EWD_UWCF_Color', sanitize_text_field($_POST['Color_Image']));}

	$WC_Term_ID = get_term_meta($term_id, 'EWD_UWCF_WC_Term_ID', true); 
	if (!is_wp_error($WC_Term_ID) and $WC_Term_ID) {wp_update_term($WC_Term_ID, 'pa_ewd_uwcf_colors', $args);}
	else {
		$wc_term = get_term_by('name', sanitize_text_field($_POST['Color_Name']), 'pa_ewd_uwcf_colors');
		if ($wc_term) {update_term_meta($term_id, 'EWD_UWCF_WC_Term_ID', $wc_term->term_id); }
		else {
			$wc_term = wp_insert_term(sanitize_text_field($_POST['Color_Name']), 'pa_ewd_uwcf_colors', $args); 
			update_term_meta($term_id, 'EWD_UWCF_WC_Term_ID', $wc_term['term_id']);
		}
	}

	$update = array("Message_Type" => "Update", "Message" => __("Color has been successfully edited.", 'color-filters'));
	return $update;
}

function EWD_UWCF_Delete_Color($Color_ID) {
	$WC_Term_ID = get_term_meta($Color_ID, 'EWD_UWCF_WC_Term_ID', true);

	wp_delete_term($Color_ID, 'product_color');
	if ($WC_Term_ID) {wp_delete_term($WC_Term_ID, 'pa_ewd_uwcf_colors');}

	$update = array("Message_Type" => "Update", "Message" => __("Color has been successfully deleted.", 'color-filters'));
	return $update;
}

function EWD_UWCF_Mass_Delete_Colors() {
	$Colors = $_POST['Colors_Bulk'];
	if (!is_array($Colors)) {$Colors = array();}

	foreach ($Colors as $Color_ID) {
		EWD_UWCF_Delete_Color( intval( $Color_ID ) );
	}

	$update = array("Message_Type" => "Update", "Message" => __("Colors have been successfully deleted.", 'color-filters'));
	return $update;
}

function EWD_UWCF_Add_Size() {
	if ( ! isset( $_POST['EWD_UWCF_Nonce_Field'] ) ) {return;}

    if ( ! wp_verify_nonce( $_POST['EWD_UWCF_Nonce_Field'], 'EWD_UWCF_Nonce_Field' ) ) {return;}

    $args = array(
		'slug' => sanitize_text_field( $_POST['Size_Slug'] ),
		'parent' => sanitize_text_field( $_POST['parent'] ),
		'description' => sanitize_text_field( $_POST['Size_Description'] )
	);

	$term = wp_insert_term( sanitize_text_field( $_POST['Size_Name'] ), 'product_size', $args );

	$wc_term = wp_insert_term( sanitize_text_field( $_POST['Size_Name'] ), 'pa_ewd_uwcf_sizes', $args );
	update_term_meta( $term['term_id'], 'EWD_UWCF_WC_Term_ID', $wc_term['term_id'] );

	if ($args['parent'] != -1) {update_term_meta($term['term_id'], 'EWD_UWCF_Term_Order', get_term_meta($args['parent'], 'EWD_UWCF_Term_Order', true));}
	else {update_term_meta($term['term_id'], 'EWD_UWCF_Term_Order', 999);}

	$update = array("Message_Type" => "Update", "Message" => __("Size has been successfully created.", 'color-filters'));
	return $update;
}

function EWD_UWCF_Edit_Size() {
	if ( ! isset( $_POST['EWD_UWCF_Nonce_Field'] ) ) {return;}

    if ( ! wp_verify_nonce( $_POST['EWD_UWCF_Nonce_Field'], 'EWD_UWCF_Nonce_Field' ) ) {return;}

	$term_id = intval($_POST['term_id']);

	$args = array(
		'name' => sanitize_text_field($_POST['Size_Name']),
		'slug' => sanitize_text_field($_POST['Size_Slug']),
		'parent' => sanitize_text_field($_POST['parent']),
		'description' => sanitize_text_field($_POST['Size_Description'])
	);

	wp_update_term($term_id, 'product_size', $args);

	$WC_Term_ID = get_term_meta($term_id, 'EWD_UWCF_WC_Term_ID', true);
	if (!is_wp_error($WC_Term_ID) and $WC_Term_ID) {wp_update_term($WC_Term_ID, 'pa_ewd_uwcf_sizes', $args);}
	else {
		$wc_term = get_term_by('name', sanitize_text_field($_POST['Size_Name']), 'pa_ewd_uwcf_sizes');
		if ($wc_term) {update_term_meta($term_id, 'EWD_UWCF_WC_Term_ID', $wc_term->term_id); }
		else {
			$wc_term = wp_insert_term(sanitize_text_field($_POST['Size_Name']), 'pa_ewd_uwcf_sizes', $args); 
			update_term_meta($term_id, 'EWD_UWCF_WC_Term_ID', $wc_term['term_id']);
		}
	}

	$update = array("Message_Type" => "Update", "Message" => __("Size has been successfully edited.", 'color-filters'));
	return $update;
}

function EWD_UWCF_Delete_Size($Size_ID) {
	$WC_Term_ID = get_term_meta($Size_ID, 'EWD_UWCF_WC_Term_ID', true);
	
	wp_delete_term($Size_ID, 'product_size');
	if ($WC_Term_ID) {wp_delete_term($WC_Term_ID, 'pa_ewd_uwcf_sizes');}

	$update = array("Message_Type" => "Update", "Message" => __("Size has been successfully deleted.", 'color-filters'));
	return $update;
}

function EWD_UWCF_Mass_Delete_Sizes() {
	$Sizes = $_POST['Sizes_Bulk'];
	if (!is_array($Sizes)) {$Sizes = array();}

	foreach ($Sizes as $Size_ID) {
		EWD_UWCF_Delete_Size($Size_ID);
	}

	$update = array("Message_Type" => "Update", "Message" => __("Sizes have been successfully deleted.", 'color-filters'));
	return $update;
}

function EWD_UWCF_Update_Options() {
	global $wpdb, $EWD_UWCF_Full_Version;

	if ( ! isset( $_POST['EWD_UWCF_Nonce_Field'] ) ) {return;}

    if ( ! wp_verify_nonce( $_POST['EWD_UWCF_Nonce_Field'], 'EWD_UWCF_Nonce_Field' ) ) {return;}

    $wc_attribute_table_name = $wpdb->prefix . "woocommerce_attribute_taxonomies";
    $attribute_taxonomies = $wpdb->get_results( "SELECT * FROM $wc_attribute_table_name order by attribute_name ASC;" );

    if (isset($_POST['colors_product_page_display'])) {
    	$Colors_PP_Display = get_option("EWD_UWCF_Colors_Product_Page_Display");
    	$Update_Colors_PP_Display = ($Colors_PP_Display == $_POST['colors_product_page_display'] ? false : true);
    }
    else {$Update_Colors_PP_Display = false;}

    if (isset($_POST['colors_used_for_variations'])) {
    	$Colors_Variation = get_option("EWD_UWCF_Colors_Used_For_Variations");
    	$Update_Colors_Variation = ($Colors_Variation == $_POST['colors_used_for_variations'] ? false : true);
    }
    else {$Update_Colors_Variation = false;}

    if (isset($_POST['sizes_product_page_display'])) {
    	$Sizes_PP_Display = get_option("EWD_UWCF_Sizes_Product_Page_Display");
    	$Update_Sizes_PP_Display = ($Sizes_PP_Display == $_POST['sizes_product_page_display'] ? false : true);
    }
    else {$Update_Sizes_PP_Display = false;}

    if (isset($_POST['sizes_used_for_variations'])) {
    	$Sizes_Variation = get_option("EWD_UWCF_Sizes_Used_For_Variations");
    	$Update_Sizes_Variation = ($Sizes_Variation == $_POST['sizes_used_for_variations'] ? false : true);
    }
    else {$Update_Sizes_Variation = false;}

	if ( isset( $_POST['enable_table_format'] ) ) { update_option( 'EWD_UWCF_Table_Format', sanitize_text_field( $_POST['enable_table_format'] ) ); }
	if ( isset( $_POST['allow_sorting'] ) ) { update_option( 'EWD_UWCF_Allow_Sorting', sanitize_text_field( $_POST['allow_sorting'] ) ); }
	if ( isset( $_POST['fields_array'] ) ) {
		$fields_array = isset( $_POST['fields_array'] ) ? explode( ",", sanitize_text_field( $_POST['fields_array'] ) ) : array(); 
		update_option( 'EWD_UWCF_Fields_Array', $fields_array );
	}

	if ( isset( $_POST['name_displayed'] ) ) { update_option( 'EWD_UWCF_Product_Title_Displayed', sanitize_text_field( $_POST['name_displayed'] ) ); }
	if ( isset( $_POST['image_displayed'] ) ) { update_option( 'EWD_UWCF_Product_Image_Displayed', sanitize_text_field( $_POST['image_displayed'] ) ); }
	if ( isset( $_POST['price_displayed'] ) ) { update_option( 'EWD_UWCF_Product_Price_Displayed', sanitize_text_field( $_POST['price_displayed'] ) ); }
	if ( isset( $_POST['rating_displayed'] ) ) { update_option( 'EWD_UWCF_Product_Rating_Displayed', sanitize_text_field( $_POST['rating_displayed'] ) ); }
	if ( isset( $_POST['add_to_cart_displayed'] ) ) { update_option( 'EWD_UWCF_Product_Add_To_Cart_Displayed', sanitize_text_field( $_POST['add_to_cart_displayed'] ) ); }

	if ( isset( $_POST['price_enable'] ) ) { update_option( 'EWD_UWCF_Product_Price_Enable', sanitize_text_field( $_POST['price_enable'] ) ); }
	if ( isset( $_POST['price_display'] ) ) { update_option( 'EWD_UWCF_Product_Price_Display', sanitize_text_field( $_POST['price_display'] ) ); }
	
	if ( isset( $_POST['enable_colors'] ) ) { update_option( 'EWD_UWCF_Enable_Colors', sanitize_text_field( $_POST['enable_colors'] ) ); }
	if ( isset( $_POST['color_filters_show_text'] ) ) { update_option( 'EWD_UWCF_Color_Filters_Show_Text', sanitize_text_field( $_POST['color_filters_show_text'] ) ); }
	if ( isset( $_POST['color_filters_show_color'] ) ) { update_option( 'EWD_UWCF_Color_Filters_Show_Color', sanitize_text_field( $_POST['color_filters_show_color'] ) ); }
	if ( isset( $_POST['color_filters_hide_empty'] ) ) { update_option( 'EWD_UWCF_Color_Filters_Hide_Empty', sanitize_text_field( $_POST['color_filters_hide_empty'] ) ); }
	if ( isset( $_POST['color_filters_show_product_count'] ) ) { update_option( 'EWD_UWCF_Color_Filters_Show_Product_Count', sanitize_text_field( $_POST['color_filters_show_product_count'] ) ); }
	if ( isset( $_POST['color_filters_display'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Color_Filters_Display', sanitize_text_field( $_POST['color_filters_display'] ) ); }
	if ( isset( $_POST['display_thumbnail_colors'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Display_Thumbnail_Colors', sanitize_text_field( $_POST['display_thumbnail_colors'] ) ); }
	if ( isset( $_POST['colors_product_page_display'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Colors_Product_Page_Display', sanitize_text_field( $_POST['colors_product_page_display'] ) ); }
	if ( isset( $_POST['colors_used_for_variations'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Colors_Used_For_Variations', sanitize_text_field( $_POST['colors_used_for_variations'] ) ); }
	
	if ( isset( $_POST['enable_sizes'] ) ) { update_option( 'EWD_UWCF_Enable_Sizes', sanitize_text_field( $_POST['enable_sizes'] ) ); }
	if ( isset( $_POST['size_filters_show_text'] ) ) { update_option( 'EWD_UWCF_Size_Filters_Show_Text', sanitize_text_field( $_POST['size_filters_show_text'] ) ); }
	if ( isset( $_POST['size_filters_hide_empty'] ) ) { update_option( 'EWD_UWCF_Size_Filters_Hide_Empty', sanitize_text_field( $_POST['size_filters_hide_empty'] ) ); }
	if ( isset( $_POST['size_filters_show_product_count'] ) ) { update_option( 'EWD_UWCF_Size_Filters_Show_Product_Count', sanitize_text_field( $_POST['size_filters_show_product_count'] ) ); }
	if ( isset( $_POST['size_filters_display'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Size_Filters_Display', sanitize_text_field( $_POST['size_filters_display'] ) ); }
	if ( isset( $_POST['display_thumbnail_sizes'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Display_Thumbnail_Sizes', sanitize_text_field( $_POST['display_thumbnail_sizes'] ) ); }
	if ( isset( $_POST['sizes_product_page_display'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Sizes_Product_Page_Display', sanitize_text_field( $_POST['sizes_product_page_display'] ) ); }
	if ( isset( $_POST['sizes_used_for_variations'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Sizes_Used_For_Variations', sanitize_text_field( $_POST['sizes_used_for_variations'] ) ); }

	if ( isset( $_POST['enable_categories'] ) ) { update_option( 'EWD_UWCF_Enable_Categories', sanitize_text_field( $_POST['enable_categories'] ) ); }
	if ( isset( $_POST['category_filters_show_text'] ) ) { update_option( 'EWD_UWCF_Category_Filters_Show_Text', sanitize_text_field( $_POST['category_filters_show_text'] ) ); }
	if ( isset( $_POST['category_filters_hide_empty'] ) ) { update_option( 'EWD_UWCF_Category_Filters_Hide_Empty', sanitize_text_field( $_POST['category_filters_hide_empty'] ) ); }
	if ( isset( $_POST['category_filters_show_product_count'] ) ) { update_option( 'EWD_UWCF_Category_Filters_Show_Product_Count', sanitize_text_field( $_POST['category_filters_show_product_count'] ) ); }
	if ( isset( $_POST['category_filters_display'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Category_Filters_Display', sanitize_text_field( $_POST['category_filters_display'] ) ); }
	if ( isset( $_POST['display_thumbnail_categories'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Display_Thumbnail_Categories', sanitize_text_field( $_POST['display_thumbnail_categories'] ) ); }

	if ( isset( $_POST['enable_tags'] ) ) { update_option( 'EWD_UWCF_Enable_Tags', sanitize_text_field( $_POST['enable_tags'] ) ); }
	if ( isset( $_POST['tag_filters_show_text'] ) ) { update_option( 'EWD_UWCF_Tag_Filters_Show_Text', sanitize_text_field( $_POST['tag_filters_show_text'] ) ); }
	if ( isset( $_POST['tag_filters_hide_empty'] ) ) { update_option( 'EWD_UWCF_Tag_Filters_Hide_Empty', sanitize_text_field( $_POST['tag_filters_hide_empty'] ) ); }
	if ( isset( $_POST['tag_filters_show_product_count'] ) ) { update_option( 'EWD_UWCF_Tag_Filters_Show_Product_Count', sanitize_text_field( $_POST['tag_filters_show_product_count'] ) ); }
	if ( isset( $_POST['tag_filters_display'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Tag_Filters_Display', sanitize_text_field( $_POST['tag_filters_display'] ) ); }
	if ( isset( $_POST['display_thumbnail_tags'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Display_Thumbnail_Tags', sanitize_text_field( $_POST['display_thumbnail_tags'] ) ); }

	if ( isset( $_POST['enable_text_search'] ) ) { update_option( 'EWD_UWCF_Enable_Text_Search', sanitize_text_field( $_POST['enable_text_search'] ) ); }
	if ( isset( $_POST['enable_autocomplete'] ) ) { update_option( 'EWD_UWCF_Enable_Autocomplete', sanitize_text_field( $_POST['enable_autocomplete'] ) ); }

	if ( isset( $_POST['enable_ratings_filtering'] ) ) { update_option( 'EWD_UWCF_Enable_Ratings_Filtering', sanitize_text_field( $_POST['enable_ratings_filtering'] ) ); }
	if ( isset( $_POST['ratings_type'] ) ) { update_option( 'EWD_UWCF_Ratings_Type', sanitize_text_field( $_POST['ratings_type'] ) ); }

	if ( isset( $_POST['enable_instock_filtering'] ) ) { update_option( 'EWD_UWCF_Enable_InStock_Filtering', sanitize_text_field( $_POST['enable_instock_filtering'] ) ); }

	if ( isset( $_POST['enable_onsale_filtering'] ) ) { update_option( 'EWD_UWCF_Enable_OnSale_Filtering', sanitize_text_field( $_POST['enable_onsale_filtering'] ) ); }

	foreach ($attribute_taxonomies as $attribute_taxonomy) {
		if ( isset( $_POST[$attribute_taxonomy->attribute_name . '_enable'] ) ) { update_option( "EWD_UWCF_" . $attribute_taxonomy->attribute_name . "_Enabled", $_POST[$attribute_taxonomy->attribute_name . '_enable'] ); }
		if ( isset( $_POST[$attribute_taxonomy->attribute_name . '_displayed'] ) ) { update_option( "EWD_UWCF_" . $attribute_taxonomy->attribute_name . "_Displayed", $_POST[$attribute_taxonomy->attribute_name . '_displayed'] ); }
		if ( isset( $_POST[$attribute_taxonomy->attribute_name . '_show_text'] ) ) { update_option( "EWD_UWCF_" . $attribute_taxonomy->attribute_name . "_Show_Text", $_POST[$attribute_taxonomy->attribute_name . '_show_text'] ); }
		if ( isset( $_POST[$attribute_taxonomy->attribute_name . '_hide_empty'] ) ) { update_option( "EWD_UWCF_" . $attribute_taxonomy->attribute_name . "_Hide_Empty", $_POST[$attribute_taxonomy->attribute_name . '_hide_empty'] ); }
		if ( isset( $_POST[$attribute_taxonomy->attribute_name . '_product_count'] ) ) { update_option( "EWD_UWCF_" . $attribute_taxonomy->attribute_name . "_Product_Count", $_POST[$attribute_taxonomy->attribute_name . '_product_count'] ); }
		if ( isset( $_POST[$attribute_taxonomy->attribute_name . '_display'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( "EWD_UWCF_" . $attribute_taxonomy->attribute_name . "_Display", $_POST[$attribute_taxonomy->attribute_name . '_display'] ); }
		if ( isset( $_POST[$attribute_taxonomy->attribute_name . '_thumbnail_tags'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( "EWD_UWCF_" . $attribute_taxonomy->attribute_name . "_Thumbnail_Tags", $_POST[$attribute_taxonomy->attribute_name . '_thumbnail_tags'] ); }
	}

	if ( isset( $_POST['access_role'] ) ) { update_option( 'EWD_UWCF_Access_Role', sanitize_text_field( $_POST['access_role'] ) ); }
	if ( isset( $_POST['reset_all_button'] ) ) { update_option( 'EWD_UWCF_Reset_All_Button', sanitize_text_field( $_POST['reset_all_button'] ) ); }
	
	if ( isset( $_POST['color_filters_label'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Color_Filters_Label', sanitize_text_field( $_POST['color_filters_label'] ) ); }
	if ( isset( $_POST['show_all_colors_label'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Show_All_Colors_Label', sanitize_text_field( $_POST['show_all_colors_label'] ) ); }
	if ( isset( $_POST['show_all_sizes_label'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Show_All_Sizes_Label', sanitize_text_field( $_POST['show_all_sizes_label'] ) ); }
	if ( isset( $_POST['show_all_categories_label'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Show_All_Categories_Label', sanitize_text_field( $_POST['show_all_categories_label'] ) ); }
	if ( isset( $_POST['show_all_tags_label'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Show_All_Tags_Label', sanitize_text_field( $_POST['show_all_tags_label'] ) ); }
	if ( isset( $_POST['show_all_attributes_label'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Show_All_Attributes_Label', sanitize_text_field( $_POST['show_all_attributes_label'] ) ); }
	if ( isset( $_POST['rating_label'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Rating_Label', sanitize_text_field( $_POST['rating_label'] ) ); }
	if ( isset( $_POST['thumbnail_colors_label'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Thumbnail_Colors_Label', sanitize_text_field( $_POST['thumbnail_colors_label'] ) ); }
	if ( isset( $_POST['thumbnail_sizes_label'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Thumbnail_Sizes_Label', sanitize_text_field( $_POST['thumbnail_sizes_label'] ) ); }
	if ( isset( $_POST['thumbnail_categories_label'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Thumbnail_Categories_Label', sanitize_text_field( $_POST['thumbnail_categories_label'] ) ); }
	if ( isset( $_POST['thumbnail_tags_label'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Thumbnail_Tags_Label', sanitize_text_field( $_POST['thumbnail_tags_label'] ) ); }
	if ( isset( $_POST['product_page_colors_label'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Product_Page_Colors_Label', sanitize_text_field( $_POST['product_page_colors_label'] ) ); }
	if ( isset( $_POST['product_page_sizes_label'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Product_Page_Sizes_Label', sanitize_text_field( $_POST['product_page_sizes_label'] ) ); }
	
	if (isset($_POST['Options_Submit'])) {update_option('EWD_UWCF_Custom_CSS', $_POST['custom_css']);}
	if ( isset( $_POST['color_filters_color_shape'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Color_Filters_Color_Shape', sanitize_text_field( $_POST['color_filters_color_shape'] ) ); }
	if ( isset( $_POST['color_icon_size'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Color_Icon_Size', sanitize_text_field( $_POST['color_icon_size'] ) ); }
	if ( isset( $_POST['widget_font_color'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Widget_Font_Color', sanitize_text_field( $_POST['widget_font_color'] ) ); }
	if ( isset( $_POST['widget_font_size'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Widget_Font_Size', sanitize_text_field( $_POST['widget_font_size'] ) ); }
	if ( isset( $_POST['ratings_bar_fill_color'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Ratings_Bar_Fill_Color', sanitize_text_field( $_POST['ratings_bar_fill_color'] ) ); }
	if ( isset( $_POST['ratings_bar_empty_color'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Ratings_Bar_Empty_Color', sanitize_text_field( $_POST['ratings_bar_empty_color'] ) ); }
	if ( isset( $_POST['ratings_bar_handle_color'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Ratings_Bar_Handle_Color', sanitize_text_field( $_POST['ratings_bar_handle_color'] ) ); }
	if ( isset( $_POST['ratings_bar_text_color'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Ratings_Bar_Text_Color', sanitize_text_field( $_POST['ratings_bar_text_color'] ) ); }
	if ( isset( $_POST['ratings_bar_font_size'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Ratings_Bar_Font_Size', sanitize_text_field( $_POST['ratings_bar_font_size'] ) ); }
	if ( isset( $_POST['reset_all_button_background_color'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Reset_All_Button_Background_Color', sanitize_text_field( $_POST['reset_all_button_background_color'] ) ); }
	if ( isset( $_POST['reset_all_button_text_color'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Reset_All_Button_Text_Color', sanitize_text_field( $_POST['reset_all_button_text_color'] ) ); }
	if ( isset( $_POST['reset_all_button_hover_background_color'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Reset_All_Button_Hover_Background_Color', sanitize_text_field( $_POST['reset_all_button_hover_background_color'] ) ); }
	if ( isset( $_POST['reset_all_button_hover_text_color'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Reset_All_Button_Hover_Text_Color', sanitize_text_field( $_POST['reset_all_button_hover_text_color'] ) ); }
	if ( isset( $_POST['reset_all_button_font_size'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Reset_All_Button_Font_Size', sanitize_text_field( $_POST['reset_all_button_font_size'] ) ); }
	if ( isset( $_POST['shop_thumbnails_font_color'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Shop_Thumbnails_Font_Color', sanitize_text_field( $_POST['shop_thumbnails_font_color'] ) ); }
	if ( isset( $_POST['shop_thumbnails_font_size'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Shop_Thumbnails_Font_Size', sanitize_text_field( $_POST['shop_thumbnails_font_size'] ) ); }
	if ( isset( $_POST['shop_thumbnails_color_icon_size'] ) and $EWD_UWCF_Full_Version == "Yes" ) { update_option( 'EWD_UWCF_Shop_Thumbnails_Color_Icon_Size', sanitize_text_field( $_POST['shop_thumbnails_color_icon_size'] ) ); }

	if ( $Update_Colors_PP_Display and $EWD_UWCF_Full_Version == "Yes" ) { EWD_UWCF_Update_Colors_PP_Display_Attribute( $_POST['colors_product_page_display'] ); }
	if ( $Update_Colors_Variation and $EWD_UWCF_Full_Version == "Yes" ) { EWD_UWCF_Update_Colors_Variation_Attribute( $_POST['colors_used_for_variations'] ); }
	if ( $Update_Sizes_PP_Display and $EWD_UWCF_Full_Version == "Yes" ) { EWD_UWCF_Update_Sizes_PP_Display_Attribute( $_POST['sizes_product_page_display'] ); }
	if ( $Update_Sizes_Variation and $EWD_UWCF_Full_Version == "Yes" ) { EWD_UWCF_Update_Sizes_Variation_Attribute( $_POST['sizes_used_for_variations'] ); }

	if (isset($_POST['Options_Submit'])) {
		$update = array("Message_Type" => "Update", "Message" => __("Options have been successfully updated.", 'color-filters'));
		return $update;
	}
}

function EWD_UWCF_Update_Colors_PP_Display_Attribute($Setting) {
	global $wpdb;

	$Updated_Value = ($Setting == "Yes" ? true : false);

	$Product_Attribute_Values = $wpdb->get_results("SELECT * FROM $wpdb->postmeta WHERE meta_key='_product_attributes'");
	foreach ($Product_Attribute_Values as $Product_Attribute_Value) {
		$Attributes = unserialize($Product_Attribute_Value->meta_value);
		foreach ($Attributes as $Attribute_Name => $Product_Attribute) {
			if ($Attribute_Name == 'pa_ewd_uwcf_colors') {
				$Attributes[$Attribute_Name]['is_visible'] = $Updated_Value;
				$wpdb->query($wpdb->prepare("UPDATE $wpdb->postmeta SET meta_value=%s WHERE meta_key='_product_attributes' AND post_id=%d", serialize($Attributes), $Product_Attribute_Value->post_id));
			}
		}
	}
}

function EWD_UWCF_Update_Colors_Variation_Attribute($Setting) {
	global $wpdb;

	$Updated_Value = ($Setting == "Yes" ? true : false);

	$Product_Attribute_Values = $wpdb->get_results("SELECT * FROM $wpdb->postmeta WHERE meta_key='_product_attributes'");
	foreach ($Product_Attribute_Values as $Product_Attribute_Value) {
		$Attributes = unserialize($Product_Attribute_Value->meta_value);
		foreach ($Attributes as $Attribute_Name => $Product_Attribute) {
			if ($Attribute_Name == 'pa_ewd_uwcf_colors') {
				$Attributes[$Attribute_Name]['is_variation'] = $Updated_Value;
				$wpdb->query($wpdb->prepare("UPDATE $wpdb->postmeta SET meta_value=%s WHERE meta_key='_product_attributes' AND post_id=%d", serialize($Attributes), $Product_Attribute_Value->post_id));
			}
		}
	}
}

function EWD_UWCF_Update_Sizes_PP_Display_Attribute($Setting) {
	global $wpdb;

	$Updated_Value = ($Setting == "Yes" ? true : false);

	$Product_Attribute_Values = $wpdb->get_results("SELECT * FROM $wpdb->postmeta WHERE meta_key='_product_attributes'");
	foreach ($Product_Attribute_Values as $Product_Attribute_Value) {
		$Attributes = unserialize($Product_Attribute_Value->meta_value);
		foreach ($Attributes as $Attribute_Name => $Product_Attribute) {
			if ($Attribute_Name == 'pa_ewd_uwcf_sizes') {
				$Attributes[$Attribute_Name]['is_visible'] = $Updated_Value;
				$wpdb->query($wpdb->prepare("UPDATE $wpdb->postmeta SET meta_value=%s WHERE meta_key='_product_attributes' AND post_id=%d", serialize($Attributes), $Product_Attribute_Value->post_id));
			}
		}
	}
}

function EWD_UWCF_Update_Sizes_Variation_Attribute($Setting) {
	global $wpdb;

	$Updated_Value = ($Setting == "Yes" ? true : false);

	$Product_Attribute_Values = $wpdb->get_results("SELECT * FROM $wpdb->postmeta WHERE meta_key='_product_attributes'");
	foreach ($Product_Attribute_Values as $Product_Attribute_Value) {
		$Attributes = unserialize($Product_Attribute_Value->meta_value);
		foreach ($Attributes as $Attribute_Name => $Product_Attribute) {
			if ($Attribute_Name == 'pa_ewd_uwcf_sizes') {
				$Attributes[$Attribute_Name]['is_variation'] = $Updated_Value;
				$wpdb->query($wpdb->prepare("UPDATE $wpdb->postmeta SET meta_value=%s WHERE meta_key='_product_attributes' AND post_id=%d", serialize($Attributes), $Product_Attribute_Value->post_id));
			}
		}
	}
}
?>