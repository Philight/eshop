<?php
add_action('woocommerce_after_shop_loop_item', 'EWD_UWCF_WC_Shop_Add_Product_Color_Swatches');
function EWD_UWCF_WC_Shop_Add_Product_Color_Swatches() {
	global $post, $wpdb;

	$Color_Filters_Display = get_option("EWD_UWCF_Color_Filters_Display");
	$Display_Thumbnail_Colors = get_option("EWD_UWCF_Display_Thumbnail_Colors");
	$Size_Filters_Display = get_option("EWD_UWCF_Size_Filters_Display");
	$Display_Thumbnail_Sizes = get_option("EWD_UWCF_Display_Thumbnail_Sizes");
	$Category_Filters_Display = get_option("EWD_UWCF_Category_Filters_Display");
	$Display_Thumbnail_Categories = get_option("EWD_UWCF_Display_Thumbnail_Categories");
	$Tag_Filters_Display = get_option("EWD_UWCF_Tag_Filters_Display");
	$Display_Thumbnail_Tags = get_option("EWD_UWCF_Display_Thumbnail_Tags");

	$Color_Filters_Color_Shape = get_option("EWD_UWCF_Color_Filters_Color_Shape");

	$Thumbnail_Colors_Label = get_option("EWD_UWCF_Thumbnail_Colors_Label");
	if($Thumbnail_Colors_Label == ''){ $Thumbnail_Colors_Label = __('Colors', 'color-filters'); }
	$Thumbnail_Sizes_Label = get_option("EWD_UWCF_Thumbnail_Sizes_Label");
	if($Thumbnail_Sizes_Label == ''){ $Thumbnail_Sizes_Label = __('Sizes', 'color-filters'); }
	$Thumbnail_Categories_Label = get_option("EWD_UWCF_Thumbnail_Categories_Label");
	if($Thumbnail_Categories_Label == ''){ $Thumbnail_Categories_Label = __('Categories', 'color-filters'); }
	$Thumbnail_Tags_Label = get_option("EWD_UWCF_Thumbnail_Tags_Label");
	if($Thumbnail_Tags_Label == ''){ $Thumbnail_Tags_Label = __('Tags', 'color-filters'); }

	$wc_attribute_table_name = $wpdb->prefix . "woocommerce_attribute_taxonomies";
    $attribute_taxonomies = $wpdb->get_results( "SELECT * FROM $wc_attribute_table_name order by attribute_name ASC;" );

	if ($Display_Thumbnail_Colors == "Yes") {
		$terms = wp_get_post_terms($post->ID, 'product_color');
	
		if (!empty($terms)) {
			echo "<div class='ewd-uwcf-thumbnail-links ewd-uwcf-wc-shop-product-colors'>";
			echo "<div class='ewd-uwcf-shop-product-colors-title'>" . $Thumbnail_Colors_Label . "</div>";
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

	if ($Display_Thumbnail_Sizes == "Yes") {
		$terms = wp_get_post_terms($post->ID, 'product_size');
	
		if (!empty($terms)) {
			echo "<div class='ewd-uwcf-thumbnail-links ewd-uwcf-wc-shop-product-sizes'>";
			echo "<div class='ewd-uwcf-shop-product-sizes-title'>" . $Thumbnail_Sizes_Label . "</div>";
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

	if ($Display_Thumbnail_Categories == "Yes") {
		$terms = wp_get_post_terms($post->ID, 'product_cat');
	
		if (!empty($terms)) {
			echo "<div class='ewd-uwcf-thumbnail-links ewd-uwcf-wc-shop-product-categories'>";
			echo "<div class='ewd-uwcf-shop-product-categories-title'>" . $Thumbnail_Categories_Label . "</div>";
			echo "<div class='ewd-uwcf-shop-product-categories-container'>";
			foreach ($terms as $term) {
				echo "<div class='ewd-uwcf-category-wrap'>";
				echo "<a href='" . EWD_UWCF_Build_Term_Link('product_cat', $term->slug, $Category_Filters_Display) . "'>" . $term->name . "</a>";
				echo "</div>";
			}
			echo "<div class='ewd-uwcf-clear'></div>";
			echo "</div>";
			echo "</div>";
		}
	}

	if ($Display_Thumbnail_Tags == "Yes") {
		$terms = wp_get_post_terms($post->ID, 'product_tag');
	
		if (!empty($terms)) {
			echo "<div class='ewd-uwcf-thumbnail-links ewd-uwcf-wc-shop-product-tags'>";
			echo "<div class='ewd-uwcf-shop-product-tags-title'>" . $Thumbnail_Tags_Label . "</div>";
			echo "<div class='ewd-uwcf-shop-product-tags-container'>";
			foreach ($terms as $term) {
				echo "<div class='ewd-uwcf-tag-wrap'>";
				echo "<a href='" . EWD_UWCF_Build_Term_Link('product_tag', $term->slug, $Tag_Filters_Display) . "'>" . $term->name . "</a>";
				echo "</div>";
			}
			echo "<div class='ewd-uwcf-clear'></div>";
			echo "</div>";
			echo "</div>";
		}
	}

	foreach ($attribute_taxonomies as $attribute_taxonomy) {
		if ($attribute_taxonomy->attribute_name == "ewd_uwcf_colors" or $attribute_taxonomy->attribute_name == "ewd_uwcf_sizes") {continue;}

		$Attribute_Display = get_option("EWD_UWCF_" . $attribute_taxonomy->attribute_name . "_Display");;
		$Display_Attribute_Thumbnail_Tags = get_option("EWD_UWCF_" . $attribute_taxonomy->attribute_name . "_Thumbnail_Tags");
		if ($Display_Attribute_Thumbnail_Tags == "Yes") {
			$terms = wp_get_post_terms($post->ID, 'pa_' . $attribute_taxonomy->attribute_name);
		
			if (!empty($terms)) {
				echo "<div class='ewd-uwcf-thumbnail-links ewd-uwcf-wc-shop-product-" . $attribute_taxonomy->attribute_name . "'>";
				echo "<div class='ewd-uwcf-shop-product-" . $attribute_taxonomy->attribute_name . "-title'>" . $attribute_taxonomy->attribute_label . "</div>";
				echo "<div class='ewd-uwcf-shop-product-" . $attribute_taxonomy->attribute_name . "-container'>";
				foreach ($terms as $term) {
					echo "<div class='ewd-uwcf-" . $attribute_taxonomy->attribute_name . "-wrap'>";
					echo "<a href='" . EWD_UWCF_Build_Term_Link('pa_' . $attribute_taxonomy->attribute_name, $term->slug, $Attribute_Display) . "'>" . $term->name . "</a>";
					echo "</div>";
				}
				echo "<div class='ewd-uwcf-clear'></div>";
				echo "</div>";
				echo "</div>";
			}
		}
	}
}

function EWD_UWCF_Build_Term_Link($attribute, $attribute_slug, $Display) {
	$Shop_URL = get_permalink(wc_get_page_id('shop')) . "?ewd_uwcf=1";
	foreach ($_GET as $key => $value) {
		if ($key == "ewd_uwcf") {continue;}
		elseif ($key != $attribute) {$Shop_URL .= '&' . $key . '=' . $value;}
		elseif ($Display == "Dropdown") {$Shop_URL .= '&' . $key . '=' . $attribute_slug;}
		/*elseif (strpos($value, $attribute_slug) !== false) {
			if (strpos($value, ",") !== false) {$Shop_URL .= '&' . $key . '=' . str_replace($attribute_slug, '', $value);}
		}
		else {$Shop_URL .= '&' . $key . '=' . $value . "," . $attribute_slug;}*/
	}

	if (strpos($Shop_URL, $attribute) === false) {$Shop_URL .= '&' . $attribute . '=' . $attribute_slug;}

	return $Shop_URL;
}

add_action( 'woocommerce_product_query', 'EWD_UWCF_Modify_WC_Query');
function EWD_UWCF_Modify_WC_Query( $q ){
	global $wpdb;

	$Ratings_Type = get_option("EWD_UWCF_Ratings_Type");
	$Maximum_Score = get_option("EWD_URP_Maximum_Score");

	$meta_query = $q->get('meta_query');

	if ($Ratings_Type == 'Ultimate_Reviews') {
		$Modifier = 5 / $Maximum_Score;

		$min_rating = (isset($_GET['min_rating']) ? intval( $_GET['min_rating'] ) : '');
		$max_rating = (isset($_GET['max_rating']) ? intval( $_GET['max_rating'] ) : '');

		$Sql = "SELECT $wpdb->posts.ID
        	FROM $wpdb->posts
        	INNER JOIN $wpdb->postmeta on $wpdb->posts.ID=$wpdb->postmeta.post_id
        	WHERE $wpdb->postmeta.meta_key='EWD_URP_Average_Score'
        	AND $wpdb->posts.post_type = 'product'";
		if ($min_rating != '') {$Sql .= " AND $wpdb->postmeta.meta_value>='" . esc_sql( $min_rating ) . "'";}
		if ($max_rating != '') {$Sql .= " AND $wpdb->postmeta.meta_value<='" . esc_sql( $max_rating ) . "'";}

		if ($min_rating != '' or $max_rating != '') {
			$URP_Review_Products = $wpdb->get_results($Sql);

			$URP_Review_Product_IDs = array();
			foreach ($URP_Review_Products as $Review_Product) {$URP_Review_Product_IDs[] = $Review_Product->ID;}
		} 
	}
	else {
		if (isset($_GET['min_rating']) and isset($_GET['max_rating'])) {
			$meta_query[] = array(
				'key' => '_wc_average_rating',
				'value' => array(
					intval( $_GET['min_rating'] ),
					intval( $_GET['max_rating'] )
				),
				'compare' => 'BETWEEN'
			);
		}
		elseif (isset($_GET['min_rating'])) {
			$meta_query[] = array(
				'key' => '_wc_average_rating',
				'value' => intval( $_GET['min_rating'] ),
				'compare' => '>='
			);
		}
		elseif (isset($_GET['max_rating'])) {
			$meta_query[] = array(
				'key' => '_wc_average_rating',
				'value' => intval( $_GET['max_rating'] ),
				'compare' => '<='
			);
		}
	}

	if (isset($_GET['instock'])) {
		$meta_query[] = array(
			'key' => '_stock_status',
			'value' => 'instock',
			'compare' => '='
		);
	}

	if (isset($_GET['onsale'])) {
		$product_ids_on_sale = wc_get_product_ids_on_sale(); 
		$q->set( 'post__in', $product_ids_on_sale );
	}

	if (isset($product_ids_on_sale) and isset($URP_Review_Product_IDs) and is_array($URP_Review_Product_IDs)) {$product_ids = array_intersect($product_ids_on_sale, $URP_Review_Product_IDs);}
	if (isset($product_ids_on_sale)) {$product_ids = $product_ids_on_sale;}
	if (isset($URP_Review_Product_IDs) and is_array($URP_Review_Product_IDs)) {$product_ids = $URP_Review_Product_IDs;}

	if (isset($product_ids) and is_array($product_ids)) {
		if (empty($product_ids)) {$q->set('title', 'No products exist matching the UWCF query');}
		else {$q->set( 'post__in', $product_ids );}
	}

	$q->set( 'meta_query', $meta_query );
}


?>