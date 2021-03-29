<?php

add_action( 'wp_ajax_custom_update_user_shipping_data', 'update_user_shipping_data' );
function update_user_shipping_data() {
	error_log('form submit start');
	error_log(print_r($_POST, true));

	unset($_POST['action']);

	$user_id = get_current_user_id();

	foreach ($_POST as $key => $new_value) {
		update_user_meta( $user_id, $key, $new_value );
		if ( $new_value != get_user_meta( $user_id, $key, true ) ) {
		    wp_die( __( 'An error occurred', 'textdomain' ) );
		}
	}

	wp_send_json_success();
}
