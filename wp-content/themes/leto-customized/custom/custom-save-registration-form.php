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

	//`$user_confirm_password = $_POST['user_confirm_password'];
	$full_name = $_POST['full_name'];
	$phone_code = $_POST['phone_code'];
	$phone_number = $_POST['phone_number'];

	// OPTIONAL DATA
	$display_name = $_POST['display_name'];
	$date_of_birth = $_POST['date_of_birth'];
	$gender = $_POST['gender'];
	$company = $_POST['company'];
	$website = $_POST['website'];


// SHIPPING ADDRESS DATA
	$shipping_address_line_1 = $_POST['shipping_address_line_1'];
	$shipping_address_line_2 = $_POST['shipping_address_line_2'];
	$shipping_city = $_POST['shipping_city'];
	$shipping_stateregionprovince = $_POST['shipping_stateregionprovince'];
	$shipping_country = $_POST['shipping_country'];
	$shipping_postal_code = $_POST['shipping_postal_code'];

// BILLING ADDRESS DATA
	$billing_address_line_1 = $_POST['billing_address_line_1'];
	$billing_address_line_2 = $_POST['billing_address_line_2'];
	$billing_city = $_POST['billing_city'];
	$billing_stateregionprovince = $_POST['billing_stateregionprovince'];
	$billing_country = $_POST['billing_country'];
	$billing_postal_code = $_POST['shipping_postal_code'];

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

/*
	global $wp_roles;

    $all_roles = $wp_roles->roles;
    error_log('all roles');
    error_log( print_r($all_roles, true) );
    $editable_roles = apply_filters('editable_roles', $all_roles);
    error_log('editable roles');
    error_log( print_r($editable_roles, true) );

	
	$user_id = wp_insert_user( $user_data );
*/
}

/*
add_action( 'wp_ajax_custom_submit_user_registration_form', 'submit_user_registration_form' );
add_action( 'wp_ajax_nopriv_custom_submit_user_registration_form', 'submit_user_registration_form' );
function submit_user_registration_form() {
}
*/