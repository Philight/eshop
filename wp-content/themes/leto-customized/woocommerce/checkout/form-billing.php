	<?php
	/**
	 * Checkout billing information form
	 *
	 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
	 *
	 * HOWEVER, on occasion WooCommerce will need to update template files and you
	 * (the theme developer) will need to copy the new files to your theme to
	 * maintain compatibility. We try to do this as little as possible, but it does
	 * happen. When this occurs the version of the template file will be bumped and
	 * the readme will list any important changes.
	 *
	 * @see     https://docs.woocommerce.com/document/template-structure/
	 * @package WooCommerce\Templates
	 * @version 3.6.0
	 * @global WC_Checkout $checkout
	 */

	defined( 'ABSPATH' ) || exit;


	$str = file_get_contents(get_stylesheet_directory()."/data/countries/countriesData.json");
	$json = json_decode( $str, true );
	$user_meta = [];

	if ( is_user_logged_in() ) {
		$customer_id = get_current_user_id();
		$user_data = get_userdata($customer_id);

		$user_meta['full_name'] = get_user_meta($customer_id, 'full_name', true);
		$user_meta['company'] = get_user_meta($customer_id, 'company', true);

		$user_meta['shipping_address_line_1'] = get_user_meta($customer_id, 'shipping_address_line_1', true);
		$user_meta['shipping_address_line_2'] = get_user_meta($customer_id, 'shipping_address_line_2', true);
		$user_meta['shipping_postal_code'] = get_user_meta($customer_id, 'shipping_postal_code', true);
		$user_meta['shipping_city'] = get_user_meta($customer_id, 'shipping_city', true);
		$user_meta['shipping_state_region_province'] = get_user_meta($customer_id, 'shipping_state_region_province', true);
		$user_meta['shipping_country'] = get_user_meta($customer_id, 'shipping_country', true);

		$user_meta['billing_address_line_1'] = get_user_meta($customer_id, 'billing_address_line_1', true);
		$user_meta['billing_address_line_2'] = get_user_meta($customer_id, 'billing_address_line_2', true);
		$user_meta['billing_postal_code'] = get_user_meta($customer_id, 'billing_postal_code', true);
		$user_meta['billing_city'] = get_user_meta($customer_id, 'billing_city', true);
		$user_meta['billing_state_region_province'] = get_user_meta($customer_id, 'billing_state_region_province', true);
		$user_meta['billing_country'] = get_user_meta($customer_id, 'billing_country', true);

		$user_meta['phone_code'] = get_user_meta($customer_id, 'phone_code', true);
		$user_meta['phone_number'] = get_user_meta($customer_id, 'phone_number', true);
		$user_meta['email'] = $user_data->user_email;

	} else {
		$user_meta['full_name'] = '';
		$user_meta['company'] = '';

		$user_meta['shipping_address_line_1'] = '';
		$user_meta['shipping_address_line_2'] = '';
		$user_meta['shipping_postal_code'] = '';
		$user_meta['shipping_city'] = '';
		$user_meta['shipping_state_region_province'] = '';
		$user_meta['shipping_country'] = '';

		$user_meta['billing_address_line_1'] = '';
		$user_meta['billing_address_line_2'] = '';
		$user_meta['billing_postal_code'] = '';
		$user_meta['billing_city'] = '';
		$user_meta['billing_state_region_province'] = '';
		$user_meta['billing_country'] = '';

		$user_meta['phone_code'] = '';
		$user_meta['phone_number'] = '';
		$user_meta['email'] = '';
	}
	?>
		<div class="already-registered">
			<i class="ion-log-in"></i> Already registered? <a href="#">Click here to login</a>
		</div>

		<div class="black-bkg">
		</div>
		<div class="login-modal">

			<h2><?php esc_html_e( 'Login', 'woocommerce' ); ?></h2>
			<form class="woocommerce-form woocommerce-form-login login" method="post">

				<?php do_action( 'woocommerce_login_form_start' ); ?>

				<div class="login-username-wrapper">
					<label for="username">
						<span>
							<?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>&nbsp;
							<strong><abbr title="required">*</abbr></strong>
						</span>
						<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
					</label>
				</div>
				<div class="">
					<label for="password">
						<?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;
						<strong><abbr title="required">*</abbr></strong>
					</label>
					<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
				</div>

				<?php do_action( 'woocommerce_login_form' ); ?>

				<div class="form-row login-rememberme-wrapper">
					<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
						<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
					</label>
					<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
					<div class="woocommerce-LostPassword lost_password">
						<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
					</div>
				</div>

				<button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>
			</form>
		</div>
		

		

		<fieldset class="billing-details">
			<legend class="billing-title">BILLING DETAILS</legend>

			<label for="FullName" class="full-name-field required">
				<span>Full Name <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>
				<input id="FullName" name="full_name" type="text" maxlength="100" value="<?php echo $user_meta['full_name']?>" required>
			</label>

	<!--				    		
			<label for="FirstName" class="first-name-field required">
				<span >First Name</span>
				<input id="FirstName" type="text" maxlength="50" required>	
			</label>			
	    	<label for="LastName" class="last-name-field required">
	    		<span>Last Name</span>
		    	<input id="LastName" type="text" maxlength="50" required>
	    	</label>
	-->

			<label for="Company" class="company-field">
	    		<span>Company <em>- <?php esc_html_e('Optional', 'custom_registration_text'); ?></em></span>
		    	<input id="Company" name="company" type="text" value="<?php echo $user_meta['company']; ?>" maxlength="100">
	    	</label>

	 		<label for="BillingAddressLine1" class="address-line-1-field required">
	    		<span>Address Line 1 <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>
	    		<input id="BillingAddressLine1" name="billing_address_line_1" type="text" maxlength="100" required value="<?php echo $user_meta['billing_address_line_1']; ?>">
	    	</label>
	    	<label for="BillingAddressLine2" class="address-line-2-field">
	    		<span>Address Line 2 <em>(Apartment, Suite, Building, etc.) - <?php esc_html_e('Optional', 'custom_registration_text'); ?></em></span>
	    		<input id="BillingAddressLine2" name="billing_address_line_2" type="text" maxlength="100" value="<?php echo $user_meta['billing_address_line_2']; ?>">
	    	</label>

	    	<label for="BillingCity" class="city-field required">
	    		<span>City <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>
	    		<input id="BillingCity" name="billing_city" type="text" maxlength="50" required value="<?php echo $user_meta['billing_city']; ?>">
	    	</label>				    	
	    	<label for="BillingStateRegionProvince" class="state-region-province-field">
	    		<span>State / Region / Province <em>- <?php esc_html_e('Optional', 'custom_registration_text'); ?></em></span>
	    		<input id="BillingStateRegionProvince" name="billing_state_region_province" type="text" maxlength="50" value="<?php echo $user_meta['billing_state_region_province']; ?>"> 
	    	</label>

	    	<label for="BillingCountry" class="country-field required">
	    		<span>Country <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>
	    		<select id="BillingCountry" name="billing_country" required>
	    			<?php echo (is_user_logged_in()) 
	    				? '<option value="'.$user_meta['billing_country'].'" selected>'.$user_meta['billing_country'].'</option>' 
	    				: '<option value="Slovakia" selected>Slovakia</option>'?>
		
		<?php 	foreach ($json as $key => $value) { ?>
					<option value="<?php echo $value['countryNameEn']; ?>" data-list-order="<?php echo $key ?>"><?php echo $value['countryNameEn']; ?></option>
	    <?php	} ?>
	    		
	    		</select>
	    	</label>
	    	<label for="BillingPostalCode" class="postal-code-field required">
	    		<span>Postal Code <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>
	    		<input id="BillingPostalCode" name="billing_postal_code" type="text" maxlength="10" required value="<?php echo $user_meta['billing_postal_code']?>">
	    	</label>

	    	<label for="Email" class="email-field required">
	    		<span>Email <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>
		    	<input id="Email" name="user_email" type="text" maxlength="100" placeholder="e.g. example@gmail.com" required value="<?php echo $user_meta['email']?>">
	    	</label>					    	
	    	<label for="PhoneNumber" class="phone-number-field required">
	    		<span>Phone <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>
	    		
	    		<div class="country-code-wrapper">
	    			<input type="text" name="phone_code" id="PhoneCode" value="+421" required value="<?php echo $user_meta['phone_code']?>">
	    			<i class="ion-ios-arrow-down"></i>
	    		</div>
		    	<input id="PhoneNumber" name="phone_number" type="text" maxlength="15" required value="<?php echo $user_meta['phone_number']?>">

	    		<ul class="country-code-dropdown collapsed">

		<?php   foreach ($json as $key => $value) { ?>
					<li class="country-code-item" value="<?php echo $key;?>" data-country-code="<?php echo '+'.$value['countryCallingCode']?>">
						<?php $country_code = strtolower($value['countryCode']); ?>
						<div class="country-flag" style="background-image: url(<?php echo get_stylesheet_directory_uri().'/data/countries/country-4x3/'.$country_code.'.svg'?>);">
						</div>
						<span class="country-name"><?php echo $value['countryNameEn'].' +'.$value['countryCallingCode']?></span>
					</li>
		<?php 	} ?> 
	    		</ul>
	    	</label>	    		
	 	</fieldset>

	 	<fieldset class="shipping-details">
	 		<legend class="shipping-title">
		 		SHIPPING ADDRESS
		 		<label for="ShippingOption" class="shipping-option">
		 			Same As Billing Address	
			 		<div class="switch_box box_4">
						<div class="input_wrapper">
							<input type="checkbox" class="switch_4" id="ShippingOption" checked>
							<svg class="is_checked" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 426.67 426.67">
							  <path d="M153.504 366.84c-8.657 0-17.323-3.303-23.927-9.912L9.914 237.265c-13.218-13.218-13.218-34.645 0-47.863 13.218-13.218 34.645-13.218 47.863 0l95.727 95.727 215.39-215.387c13.218-13.214 34.65-13.218 47.86 0 13.22 13.218 13.22 34.65 0 47.863L177.435 356.928c-6.61 6.605-15.27 9.91-23.932 9.91z"/>
							</svg>
							<svg class="is_unchecked" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 212.982 212.982">
							  <path d="M131.804 106.49l75.936-75.935c6.99-6.99 6.99-18.323 0-25.312-6.99-6.99-18.322-6.99-25.312 0L106.49 81.18 30.555 5.242c-6.99-6.99-18.322-6.99-25.312 0-6.99 6.99-6.99 18.323 0 25.312L81.18 106.49 5.24 182.427c-6.99 6.99-6.99 18.323 0 25.312 6.99 6.99 18.322 6.99 25.312 0L106.49 131.8l75.938 75.937c6.99 6.99 18.322 6.99 25.312 0 6.99-6.99 6.99-18.323 0-25.313l-75.936-75.936z" fill-rule="evenodd" clip-rule="evenodd"/>
							</svg>
						</div>
					</div>
		        </label>
	 		</legend>
	 		<label for="ShippingOption" class="shipping-option">
	 		<div class="switch_box box_4">
				<div class="input_wrapper">
					<input type="checkbox" class="switch_4" id="ShippingOption">
					<svg class="is_checked" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 426.67 426.67">
					  <path d="M153.504 366.84c-8.657 0-17.323-3.303-23.927-9.912L9.914 237.265c-13.218-13.218-13.218-34.645 0-47.863 13.218-13.218 34.645-13.218 47.863 0l95.727 95.727 215.39-215.387c13.218-13.214 34.65-13.218 47.86 0 13.22 13.218 13.22 34.65 0 47.863L177.435 356.928c-6.61 6.605-15.27 9.91-23.932 9.91z"/>
					</svg>
					<svg class="is_unchecked" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 212.982 212.982">
					  <path d="M131.804 106.49l75.936-75.935c6.99-6.99 6.99-18.323 0-25.312-6.99-6.99-18.322-6.99-25.312 0L106.49 81.18 30.555 5.242c-6.99-6.99-18.322-6.99-25.312 0-6.99 6.99-6.99 18.323 0 25.312L81.18 106.49 5.24 182.427c-6.99 6.99-6.99 18.323 0 25.312 6.99 6.99 18.322 6.99 25.312 0L106.49 131.8l75.938 75.937c6.99 6.99 18.322 6.99 25.312 0 6.99-6.99 6.99-18.323 0-25.313l-75.936-75.936z" fill-rule="evenodd" clip-rule="evenodd"/>
					</svg>
				</div>
			</div>
	        	Same As Billing Address
	        </label>

	    	<label for="ShippingAddressLine1" class="shipping-address-line-1-field required">
	    		<span>Address Line 1 <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>
	    		<input id="ShippingAddressLine1" name="shipping_address_line_1" type="text" maxlength="100" required value="<?php echo $user_meta['shipping_address_line_1']?>">
	    	</label>
	    	<label for="ShippingAddressLine2" class="shipping-address-line-2-field">
	    		<span>Address Line 2 <em>(Apartment, Suite, Building, etc.) - <?php esc_html_e('Optional', 'custom_registration_text'); ?></em></span>
	    		<input id="ShippingAddressLine2" name="shipping_address_line_2" type="text" maxlength="100" value="<?php echo $user_meta['shipping_address_line_2']?>">
	    	</label>

	    	<label for="ShippingCity" class="shipping-city-field required">
	    		<span>City <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>
	    		<input id="ShippingCity" name="shipping_city" type="text" maxlength="50" required value="<?php echo $user_meta['shipping_city']?>">
	    	</label>				    	
	    	<label for="ShippingStateRegionProvince" class="shipping-state-region-province-field">
	    		<span>State / Region / Province <em>- <?php esc_html_e('Optional', 'custom_registration_text'); ?></em></span>
	    		<input id="ShippingStateRegionProvince" name="shipping_state_region_province" type="text" maxlength="50" value="<?php echo $user_meta['shipping_state_region_province']?>"> 
	    	</label>

	    	<label for="ShippingCountry" class="shipping-country-field required">
	    		<span>Country <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>
	    		<select id="ShippingCountry" name="shipping_country" required>
	    			<?php echo (is_user_logged_in()) 
	    				? '<option value="'.$user_meta['shipping_country'].'" selected>'.$user_meta['shipping_country'].'</option>' 
	    				: '<option value="Slovakia" selected>Slovakia</option>'?>
		
		<?php 	foreach ($json as $key => $value) { ?>
					<option value="<?php echo $value['countryNameEn']; ?>" data-list-order="<?php echo $key ?>"><?php echo $value['countryNameEn']; ?></option>
	    <?php	} ?>
	    		
	    		</select>
	    	</label>
	    	<label for="ShippingPostalCode" class="shipping-postal-code-field required">
	    		<span>Postal Code <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>
	    		<input id="ShippingPostalCode" name="shipping_postal_code" type="text" maxlength="10" required value="<?php echo $user_meta['shipping_postal_code']?>">
	    	</label>				    	
		</fieldset>  

		<fieldset class="register-optional">
	 		<legend class="register-optional-title">
	 			CREATE AN ACCOUNT?
	 			<label for="RegisterOption" class="register-option">
		        	Enter a password and username to save your information (Optional)
		        	<div class="switch_box box_4">
						<div class="input_wrapper">
							<input type="checkbox" class="switch_4" id="RegisterOption">
							<svg class="is_checked" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 426.67 426.67">
							  <path d="M153.504 366.84c-8.657 0-17.323-3.303-23.927-9.912L9.914 237.265c-13.218-13.218-13.218-34.645 0-47.863 13.218-13.218 34.645-13.218 47.863 0l95.727 95.727 215.39-215.387c13.218-13.214 34.65-13.218 47.86 0 13.22 13.218 13.22 34.65 0 47.863L177.435 356.928c-6.61 6.605-15.27 9.91-23.932 9.91z"/>
							</svg>
							<svg class="is_unchecked" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 212.982 212.982">
							  <path d="M131.804 106.49l75.936-75.935c6.99-6.99 6.99-18.323 0-25.312-6.99-6.99-18.322-6.99-25.312 0L106.49 81.18 30.555 5.242c-6.99-6.99-18.322-6.99-25.312 0-6.99 6.99-6.99 18.323 0 25.312L81.18 106.49 5.24 182.427c-6.99 6.99-6.99 18.323 0 25.312 6.99 6.99 18.322 6.99 25.312 0L106.49 131.8l75.938 75.937c6.99 6.99 18.322 6.99 25.312 0 6.99-6.99 6.99-18.323 0-25.313l-75.936-75.936z" fill-rule="evenodd" clip-rule="evenodd"/>
							</svg>
						</div>
					</div>
		        </label>
	 		</legend> 		

			<label for="Username" class="user-name-field required">
				<span>Username <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>
				<input id="Username" name="user_name" type="text" maxlength="50" required>
			</label>
			<label for="DisplayName" class="display-name-field">
				<span>Display Name <em>(How should we address you?) - <?php esc_html_e('Optional', 'custom_registration_text'); ?></em></span>
				<input id="DisplayName" name="display_name" type="text" maxlength="50">
			</label>
	    	<label for="Password" class="password-field required">
				<span >Password <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>
				<div class="password-wrapper">
					<input type="password" id="Password" name="user_password" maxlength="128" required>	
					<i class="ion-eye-disabled" id="TogglePassword"></i>
				</div>
			</label>
	    	<label for="ConfirmPassword" class="confirm-password-field required">
	    		<span>Confirm Password <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>
	    		<div class="password-wrapper">
			    	<input type="password" id="ConfirmPassword" name="user_confirm_password" maxlength="128" required>
			    	<i class="ion-eye-disabled" id="ToggleConfirmPassword"></i>
				</div>
	    	</label>
	 	</fieldset>

	<div class="woocommerce-billing-fields">
		<?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

			<h3><?php esc_html_e( 'Billing &amp; Shipping', 'woocommerce' ); ?></h3>

		<?php else : ?>

			<h3><?php esc_html_e( 'Billing details', 'woocommerce' ); ?></h3>

		<?php endif; ?>

		<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

		<div class="woocommerce-billing-fields__field-wrapper">
			<p class="form-row form-row-first validate-required" id="billing_full_name_field" data-priority="10"><label for="billing_full_name" class="">Full Name&nbsp;<abbr class="required" title="required">*</abbr></label>
				<span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="billing_full_name" id="billing_full_name" placeholder="" value="" autocomplete="given-name"></span>
			</p>
			<?php
			$fields = $checkout->get_checkout_fields( 'billing' );

			foreach ( $fields as $key => $field ) {
				woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
			}
			?>
		</div>

		<?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
	</div>

	<?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
		<div class="woocommerce-account-fields">
			<?php if ( ! $checkout->is_registration_required() ) : ?>

				<p class="form-row form-row-wide create-account">
					<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
						<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ); ?> type="checkbox" name="createaccount" value="1" /> <span><?php esc_html_e( 'Create an account?', 'woocommerce' ); ?></span>
					</label>
				</p>

			<?php endif; ?>

			<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

			<?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>

				<div class="create-account">
					<?php foreach ( $checkout->get_checkout_fields( 'account' ) as $key => $field ) : ?>
						<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
					<?php endforeach; ?>
					<div class="clear"></div>
				</div>

			<?php endif; ?>

			<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
		</div>
	<?php endif; ?>
