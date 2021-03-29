<?php

add_action( 'wp_ajax_custom_submit_user_registration_form', 'submit_user_registration_form' );
add_action( 'wp_ajax_nopriv_custom_submit_user_registration_form', 'submit_user_registration_form' );
function submit_user_registration_form() {
	error_log('form submit start');
	
// PROFILE DATA
	$user_role = 'customer';

	$user_name = $_POST['user_name'];
	$user_email = $_POST['user_email'];
	$user_password = $_POST['user_password'];
	$display_name = $_POST['display_name'];	// optional
	$website = $_POST['website'];	// optional

	$user_meta_data = [];

	$user_meta_data['full_name'] = $_POST['full_name'];
/*
	$phone_code = $_POST['phone_code'];
	if ( '00' === substr($phone_code, 0, 2) ) {
		
		//$pos = strpos($phone_code, '00');
		if ($pos !== false) {
		    $phone_code = substr_replace( $phone_code, '+', 0, 2 );
		}
	}
*/
	$user_meta_data['phone_code'] = $_POST['phone_code'];
	$user_meta_data['phone_number'] = $_POST['phone_number'];

// OPTIONAL DATA
	$user_meta_data['company'] = $_POST['company'];
	$user_meta_data['date_of_birth'] = $_POST['date_of_birth'];

	$user_meta_data['gender'] = $_POST['gender'];
	if ( $user_meta_data['gender'] === 'other' ) {
		$user_meta_data['gender_other'] = $_POST['gender_other'];
	}

	$user_meta_data['hear_about_us'] = $_POST['hear_about_us'];
	if ( $user_meta_data['hear_about_us'] === 'other' ) {
		$user_meta_data['hear_about_us_other'] = $_POST['hear_about_us_other'];
	}


// SHIPPING ADDRESS DATA
	$user_meta_data['shipping_address_line_1'] = $_POST['shipping_address_line_1'];
	$user_meta_data['shipping_address_line_2'] = $_POST['shipping_address_line_2'];
	$user_meta_data['shipping_city'] = $_POST['shipping_city'];
	$user_meta_data['shipping_state_region_province'] = $_POST['shipping_state_region_province'];
	$user_meta_data['shipping_country'] = $_POST['shipping_country'];
	$user_meta_data['shipping_postal_code'] = $_POST['shipping_postal_code'];

// BILLING ADDRESS DATA
	if ( $_POST['billing_same_as_shipping'] === 'true' ) {

		$user_meta_data['billing_address_line_1'] = $_POST['shipping_address_line_1'];
		$user_meta_data['billing_address_line_2'] = $_POST['shipping_address_line_2'];
		$user_meta_data['billing_city'] = $_POST['shipping_city'];
		$user_meta_data['billing_state_region_province'] = $_POST['shipping_state_region_province'];
		$user_meta_data['billing_country'] = $_POST['shipping_country'];
		$user_meta_data['billing_postal_code'] = $_POST['shipping_postal_code'];
	} else {
		$user_meta_data['billing_address_line_1'] = $_POST['billing_address_line_1'];
		$user_meta_data['billing_address_line_2'] = $_POST['billing_address_line_2'];
		$user_meta_data['billing_city'] = $_POST['billing_city'];
		$user_meta_data['billing_state_region_province'] = $_POST['billing_state_region_province'];
		$user_meta_data['billing_country'] = $_POST['billing_country'];
		$user_meta_data['billing_postal_code'] = $_POST['billing_postal_code'];
	}

	error_log('user meta data');
	error_log( print_r($user_meta_data, true) );

// Create a new user in wp_users

	$user_data  = array(
		'user_login'      => $user_name,
		'user_pass'       => $user_password,
		'user_email'      => $user_email,
		'display_name'    => $display_name,
		'user_url'        => $website,
		// When creating an user, `user_pass` is expected.
		'role'            => $user_role,
		'user_registered' => current_time( 'Y-m-d H:i:s' ),
	);

	$user_id = wp_insert_user( $user_data );
	if ( is_wp_error($user_id) ) {
		error_log('insert user error');
		error_log( print_r($user_id, true) );
		wp_send_json_error($user_id);
	}
	error_log('user id');
	error_log( print_r($user_id, true) );

// Add meta data to wp_usermeta

	foreach ($user_meta_data as $meta_key => $meta_value) {
		
		if ( add_user_meta($user_id, $meta_key, $meta_value) == false ) {
			$errorObj = new WP_Error( 'Error: add_user_meta()', __("Internal Error: add_user_meta"));
			wp_send_json_error($errorObj);
		}
		error_log('adding meta');
		error_log('key: '.$meta_key.'--- value: '.$meta_value);
	}

	wp_send_json_success();

/*
	global $wp_roles;

    $all_roles = $wp_roles->roles;
    error_log('all roles');
    error_log( print_r($all_roles, true) );
 
    $editable_roles = apply_filters('editable_roles', $all_roles);
    error_log('editable roles');
    error_log( print_r($editable_roles, true) );
*/
}


add_action( 'wp_ajax_custom_submit_wholesale_registration_form', 'submit_wholesale_registration_form' );
add_action( 'wp_ajax_nopriv_custom_submit_wholesale_registration_form', 'submit_wholesale_registration_form' );
function submit_wholesale_registration_form() {

}
