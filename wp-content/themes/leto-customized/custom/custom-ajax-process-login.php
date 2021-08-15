<?php
/*
if (is_user_logged_in()) {
	error_log('logged in');
	add_action( 'wp_ajax_custom_process_login', 'process_login' );
} else {
	error_log('not logged in');
	add_action( 'wp_ajax_nopriv_custom_process_login', 'process_login' );
}
*/

add_action( 'wp_ajax_custom_process_login', 'process_login' );
add_action( 'wp_ajax_nopriv_custom_process_login', 'process_login' );
//error_log('wp ajax process login');

function process_login() {
	error_log('login submit start');
	//wp_send_json_success();	

	// The global form-login.php template used `_wpnonce` in template versions < 3.3.0.
	$nonce_value = wc_get_var( $_REQUEST['woocommerce-login-nonce'], wc_get_var( $_REQUEST['_wpnonce'], '' ) ); // @codingStandardsIgnoreLine.
error_log('wp nonce set');
	if ( isset( /*$_POST['login'],*/ $_POST['username'], $_POST['password'] ) && wp_verify_nonce( $nonce_value, 'woocommerce-login' ) ) {
error_log('login, ');

		try {
			$creds = array(
				'user_login'    => trim( wp_unslash( $_POST['username'] ) ), // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
				'user_password' => $_POST['password'], // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
				'remember'      => isset( $_POST['rememberme'] ), // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
			);

			$validation_error = new WP_Error();
			$validation_error = apply_filters( 'woocommerce_process_login_errors', $validation_error, $creds['user_login'], $creds['user_password'] );

			if ( $validation_error->get_error_code() ) {
				throw new Exception( '<strong>' . __( 'Error:', 'woocommerce' ) . '</strong> ' . $validation_error->get_error_message() );
			}

			if ( empty( $creds['user_login'] ) ) {
				throw new Exception( '<strong>' . __( 'Error:', 'woocommerce' ) . '</strong> ' . __( 'Username is required.', 'woocommerce' ) );
			}

			// On multisite, ensure user exists on current site, if not add them before allowing login.
			if ( is_multisite() ) {
				$user_data = get_user_by( is_email( $creds['user_login'] ) ? 'email' : 'login', $creds['user_login'] );

				if ( $user_data && ! is_user_member_of_blog( $user_data->ID, get_current_blog_id() ) ) {
					add_user_to_blog( get_current_blog_id(), $user_data->ID, 'customer' );
				}
			}
error_log('before sign in ');
			// Perform the login.
			$user = wp_signon( apply_filters( 'woocommerce_login_credentials', $creds ), is_ssl() );
error_log('after sign in ');

			if ( is_wp_error( $user ) ) {
				throw new Exception( $user->get_error_message() );
			} else {
error_log('no error');				

				if ( ! empty( $_POST['redirect'] ) ) {
					$redirect = wp_unslash( $_POST['redirect'] ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
error_log('redirect set');				
/*
				} elseif ( wc_get_raw_referer() ) {
					$redirect = wc_get_raw_referer();
error_log('redirect raw refresher');				
*/
				} else {
					$redirect = wc_get_page_permalink( 'myaccount' );
error_log('redirect myaccount');				

				}
				wp_safe_redirect( wc_get_page_permalink( 'myaccount' ) ); // phpcs:ignore

				//wp_redirect( wp_validate_redirect( apply_filters( 'woocommerce_login_redirect', remove_query_arg( 'wc_error', $redirect ), $user ), wc_get_page_permalink( 'myaccount' ) ) ); // phpcs:ignore
error_log('after redirect');				
				exit;
			}
		} catch ( Exception $e ) {
			wc_add_notice( apply_filters( 'login_errors', $e->getMessage() ), 'error' );
			do_action( 'woocommerce_login_failed' );
		}
	}

}