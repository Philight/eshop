<?php
add_filter( 'block_categories', 'ewd_uwcf_add_block_category' );
function ewd_uwcf_add_block_category( $categories ) {
	$categories[] = array(
		'slug'  => 'ewd-uwcf-blocks',
		'title' => __( 'Ultimate WooCommerce Filters', 'color-filters' ),
	);
	return $categories;
}

