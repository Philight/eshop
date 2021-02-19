<?php

class CustomGetPageId {
	const REGISTRATIONENTRY = 118;
	const REGISTRATIONUSER = 141;
}
/*
add_filter( 'custom_get_page_url', 'get_page_url_from_name' );
function get_page_url_from_name( $pagename ) {
*/
function custom_get_page_url( $pagename ) {

	$page_id = 0;
	switch ( $pagename ) {	
		case 'registrationentry':
			$page_id = CustomGetPageId::REGISTRATIONENTRY;
			break;

		case 'registrationuser':
			$page_id = CustomGetPageId::REGISTRATIONUSER;
			break;
		
		default:
			break;
	}

	if (!$page_id) {
		/*
		global $wp_query;
  		$wp_query->set_404();
  		status_header( 404 );
  		get_template_part( 404 ); 
  		exit();*/
  		global $wp;
		$current_url = add_query_arg( $wp->query_vars, home_url( $wp->request ) );
		$current_url = explode("?", $current_url);
		$current_url[0] .= '/404';
  		return $current_url[0];

	} else {
		return get_page_link( $page_id );
	}
}


function custom_is_page( $pagename ) {
	$current_page_id = get_queried_object_id();

	$result = false;
	
	switch ($pagename) {
		case 'registrationentry':
			$result = $current_page_id === CustomGetPageId::REGISTRATIONENTRY ? true : false;
			break;

		case 'registrationuser':
			$result = $current_page_id === CustomGetPageId::REGISTRATIONUSER ? true : false;
			break;
		
		default:
			$result = false;
			break;
	}

	return $result;
}